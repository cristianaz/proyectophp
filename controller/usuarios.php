<?php
namespace Controllers;

use Models\Usuario;
  
class Usuarios{
    public function login(){
        global $twig;

        echo $twig->render('usuarios/login.html.twig');
    }

    public function entrar(){
        global $msg;
        $usuario = $_REQUEST['username'];
        $pass = $_REQUEST['pass'];

        if(strlen($usuario) < 1 || strlen($pass) < 1){
            $msg->warning('complete el formulario');
            header('Location: index.php?c=usuarios&a=login');
        }

        $user = Usuario::where('usuario',$usuario)->first();

        if(!isset($user)){
            $msg->error('El usuario o lo contraseña no coinicide');
            header('Location: index.php?c=usuarios&a=login');
        
        }

        $password = $user->password;
        if(!password_verify($pass,$password)){
            $msg->error('El usuario o lo contraseña no coinicide');
            header('Location: index.php?c=usuarios&a=login');
        }else {
            $msg->success('Bienvenido '.$user->nombre);
            $_SESSION['activo'] = 1;
            header('Location: index.php?c=productos');
        }

    }

    public function salir(){
        unset($_SESSION['activo']);

        header('Location: index.php?c=usuarios&a=login'); 
    }


}