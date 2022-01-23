<?php
namespace Controllers;

use Models\Cliente;

class Clientes{
    
    private $model;
    
    public function __construct(){
        $this->model = new Cliente();
    }
    
    public function Index(){
       global $twig;
       echo $twig->render('index.html.twig',['datos' => ['hola','mundo',7]]
    );
       
    }
    
    public function Crud(){
        $cliente = new Cliente();
        
        if(isset($_REQUEST['id'])){
            $cliente = $this->model->Obtener($_REQUEST['id']);
        }
        
        require_once 'view/header.php';
        require_once 'view/cliente/cliente-editar.php';
        
    }
    
    public function Guardar(){
        $cliente = new cliente();
        
        $cliente->id = $_REQUEST['id'];
        $cliente->dni = $_REQUEST['dni'];
        $cliente->Nombre = $_REQUEST['Nombre'];
        $cliente->Apellido = $_REQUEST['Apellido'];
        $cliente->Correo = $_REQUEST['Correo'];  
        $cliente->telefono = $_REQUEST['telefono'];    
      

        $cliente->id > 0 
            ? $this->model->Actualizar($cliente)
            : $this->model->Registrar($cliente);
        
        header('Location: index.php');
    }
    
    public function Eliminar(){
        $this->model->Eliminar($_REQUEST['id']);
        header('Location: index.php');
    }
}