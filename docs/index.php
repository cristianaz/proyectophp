<?php
require 'start.php';

$controller = 'Controllers\\Productos';

spl_autoload_register('mi_autoloader');

function mi_autoloader($nombreClase){
    include_once 'controller/'.$nombreClase.'.php';
}

if(!isset($_REQUEST['c']) || $_REQUEST['c'] != 'usuarios'){
    if(!isset($_SESSION['activo']) || $_SESSION['activo'] !=1){
        header('Location: index.php?c=usuarios&a=login');
    }

}

// Todo esta lógica hara el papel de un FrontController

if(!isset($_REQUEST['c']))
{
    $controller = new $controller;
    $controller->Index();    
}
else
{
    // Obtenemos el controlador que queremos cargar
    $controller = 'Controllers\\'.ucwords($_REQUEST['c']);
    $accion = isset($_REQUEST['a']) ? $_REQUEST['a'] : 'Index'; 
    
    // Instanciamos el controlador
    $controller = new $controller;
    
    // Llama la accion
    call_user_func( array( $controller, $accion ) );
}