<?php
//configuración db
require 'config.php';
//autolad de vendor, todos los paquetes
require 'vendor/autoload.php';

use Models\Database;

new  Database();

//utilizando TWIG
$loader = new Twig\Loader\FilesystemLoader(__DIR__.'/templates');
$twig = new Twig\Environment($loader, ['debug' => true]);

//Habilitar la estensión para desarrollo y debug 

$twig->addExtension(new Twig\Extension\DebugExtension());

//habilitar las sesiones
if(!session_id()) @session_start();

//instanciamos los mensajes flash
$msg = new \Plasticbrain\FlashMessages\FlashMessages();

//siempre mostramos los mensajes si hay alguno
$msg->display(); 