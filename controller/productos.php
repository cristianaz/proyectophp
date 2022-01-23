<?php
namespace Controllers;

use Models\Producto;

class Productos{
    
    public static function Index(){
      //usar twig
        global $twig;
        global $msg;
        $productos = Producto::all();
        echo  $twig->render('productos/index.html.twig',['productos' => $productos]);
    }

    public function Crud(){
      global $twig;
      $producto = new Producto;
      $productoBD = null; 
      if(isset($_REQUEST['id'])){
        $productoBD = $producto::where('id',$_REQUEST['id'])->first();
        if(!isset($productoBD)){
          header('Location: index.php');
        }

        
      }
      echo $twig->render('productos/formulario.html.twig', ['producto' => $productoBD]);
    }
    
    public function Guardar(){
      global $msg;
     try{
        $producto = new Producto;
        $productoBD = $producto::where('id',$_REQUEST['id'])->first();
        if(isset($productoBD)){
          $productoBD->nombre = $_REQUEST['nombre'];
          $productoBD->precio = $_REQUEST['precio'];
          $productoBD->existencia = $_REQUEST['existencia'];
          $productoBD->save();
          $msg->info('El producto '.$productoBD->nombre.' se edito correctamente');
        }else{
          $producto->nombre = $_REQUEST['nombre'];
          $producto->precio = $_REQUEST['precio'];
          $producto->existencia = $_REQUEST['existencia'];
          $producto->save();
          $msg->success('El producto '.$producto->nombre.' se agrego correctamente');
        }


        header('Location: index.php?c=productos');
     }catch(\Exception $e){
      $msg->error('Ocurrio un error al agregar o editar un producto');
          header('Location: index.php');
     }
    }

    public function Eliminar(){
      global $msg;
        $producto = new Producto;
        
        try{
          $productoBD = $producto::findOrFail($_REQUEST['id']);
          $productoBD->delete();
          $msg->warning('El producto '.$productoBD->nombre.' se eliminó correctamente');
          header('Location: index.php?c=productos');
        }catch(\Exception $e){
          $msg->error('Ocurrio un error al eliminar el producto');
          header('Location: index.php');

        }

       
    }

}   

