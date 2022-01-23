<?php
namespace Controllers;

use Models\Usuario;

class Users{
    public function registrar(){
        $usuario = new Usuario;
        $usuario->nombre = "Prueba desde controlador";
        $usuario->usuario = "test";
        $usuario->password = password_hash('passprueba',  PASSWORD_BCRYPT);
        $usuario->save();

        header("Location: index.php");

    }
}