<?php

namespace Controllers;

use Classes\Email;
use Model\Usuario;
use MVC\Router;

class LoginController{

    public static function login(Router $router){

        //$auth = $_SESSION['login'] ?? false;

        $alertas = [];

        if($_SERVER['REQUEST_METHOD'] === 'POST'){
            $auth = new Usuario($_POST);

            //debuguear($auth);

            $alertas = $auth->validarLogin();

            //debuguear($alertas);

            if(empty($alertas)){
                //Comprobar que el usuario exista
                $usuario = Usuario::where('email', $auth->email);

                if($usuario){
                    //Verificar el password
                    if($usuario->comprobarPasswordAndVerificado($auth->password)){
                        //Autenticar al usuario
                        session_start();

                        $_SESSION['id'] = $usuario->id;
                        $_SESSION['nombre'] = $usuario->nombre;
                        $_SESSION['apellido'] = $usuario->apellido;
                        $_SESSION['email'] = $usuario->email;
                        $_SESSION['login'] = true;

                        //Redireccionamiento
                        //debuguear($usuario->idRol);
                        if($usuario->idRol == '1'){
                            //debuguear('Es admin');

                            $_SESSION['admin'] = $usuario->idRol ?? null;

                            header('Location: /admin');
                        }else{
                            //debuguear('Es usuario');
                            header('Location: /');
                        }
                    }
                }else{
                    Usuario::setAlerta('error', 'Usuario no encontrado');
                }
            }
        }

        $alertas = Usuario::getAlertas();

        $router->render('auth/login', [
            'titulo' => 'Iniciar Sesión',
            'alertas' => $alertas
        ]);
    }

    public static function logout(){
        session_start();

        $_SESSION = [];

        header('Location: /');
    }

    public static function crearCuenta(Router $router){

        session_start();

        $alertas = [];

        //$auth = $_SESSION['login'] ?? false;

        $usuario = new Usuario;

        if($_SERVER['REQUEST_METHOD'] === 'POST'){
            
            //Sincronizar datos
            $usuario->sincronizar($_POST);

            //Validar alertas del formulario
            $alertas = $usuario->validarNuevaCuenta();

            //Revisar que alertas este vacio
            if(empty($alertas)){
                //Verificar que el usuario no este registrado
                $resultado = $usuario->existeUsuario();

                if($resultado->num_rows){
                    $alertas = Usuario::Get;
                }else{
                    //Hashear el password
                    $usuario->hashPassword();

                    //Generar un Token único
                    $usuario->crearToken();

                    //debuguear($usuario);

                    //Enviar el email
                    $email = new Email($usuario->nombre, $usuario->email, $usuario->token);

                    //debuguear($email);

                    $email->enviarConfirmacion();

                    //Crear el usuario
                    $resultado = $usuario->crear();

                    //debuguear($resultado);

                    if($resultado){
                        header('Location: /mensaje');
                    }
                }
            }
        }

        $alertas = Usuario::getAlertas();

        $router->render('auth/crear-cuenta', [
            'titulo' => 'Crear Cuenta',
            'alertas' => $alertas,
            'usuario' => $usuario
        ]);
    }

    public static function mensaje(Router $router){

        $router->render('auth/mensaje',[
            'titulo' => 'Mensaje'
        ]);
    }

    public static function olvide(Router $router){
        $alertas = [];

        if($_SERVER['REQUEST_METHOD'] === 'POST'){
            $usuario = new Usuario($_POST);

            $alertas = $usuario->validarEmail();

            if(empty($alertas)){
                //debuguear($usuario);

                //Buscar el usuario
                $usuario = Usuario::where('email', $usuario->email);

                //debuguear($usuario);

                if($usuario && $usuario->confirmado){
                    //Encontre al usuario
                    //debuguear('SI existe y esta confirmado');
                    //debuguear($usuario);

                    //Generar un nuevo token
                    $usuario->crearToken();
                    unset($usuario->password2);

                    //Actualizar usuario
                    $usuario->guardar();

                    //Enviar correo
                    $email = new Email($usuario->email, $usuario->nombre, $usuario->token);
                    $email->enviarInstrucciones();

                    //Imprimir alerta
                    Usuario::setAlerta('exito', 'Hemos enviado las instrucciones a tu email');

                    //debuguear($usuario);                    

                }else{
                    Usuario::setAlerta('error', 'El usuario no existe o no esta confirmado');
                    $alertas = Usuario::getAlertas();
                }
            }
        }

        $alertas = Usuario::getAlertas();

        $router->render('auth/olvide-password',[
            'titulo' => 'Olvide Mi Password',
            'alertas' => $alertas
        ]);
    }

    public static function recuperar(Router $router){

        $alertas = [];

        //Obtenemos el token del usuario desde get
        $token = s($_GET['token'] ?? "");

        //Buscar usuario por su token
        $usuario = Usuario::where('token', $token);

        if(empty($usuario)){
            // //Si token no obtiene un valor desde GET detenemos la renderización de la vista
            // if(!$token){
                
            // }
            Usuario::setAlerta('error', 'Token no válido');
            $alerta = true;
        }

        if($_SERVER['REQUEST_METHOD'] === 'POST'){
            //Leer el nuevo password
            $password = new Usuario($_POST);

            $alerta = $password->validarPassword();

            if(empty($alerta)){

                $usuario->password = null;

                $usuario->password = $password->password;
                $usuario->hashPassword();
                $usuario->token = null;

                $resultado = $usuario->actualizar();

                if($resultado){
                    header('Location: /login');
                }
            }
        }


        $alertas = Usuario::getAlertas();

        $router->render('auth/recuperar-password', [
            'titulo' => 'Recuperar Password',
            'alertas' => $alertas
        ]);
    }
}