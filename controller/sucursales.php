<?php
namespace Controllers;

use Models\Sucursal;

class Sucursales{
    
    public static function Index(){
      //usar twig
        global $twig;
        global $msg;
        $sucursales = Sucursal::all();
        echo  $twig->render('sucursales/index.html.twig',['sucursales' => $sucursales]);
    }

    public function Crud(){
      global $twig;
      $sucursal = new Sucursal;
      $sucursalBD = null; 
      if(isset($_REQUEST['id'])){
        $sucursalBD = $sucursal::where('id',$_REQUEST['id'])->first();
        if(!isset($sucursalBD)){
          header('Location: index.php');
        }

        
      }
      echo $twig->render('sucursales/formulario.html.twig', ['sucursal' => $sucursalBD]);
    }
    
    public function Guardar(){
      global $msg;
     try{
        $sucursal = new Sucursal;
        $sucursalBD = $sucursal::where('id',$_REQUEST['id'])->first();
        if(isset($sucursalBD)){
          $sucursalBD->nombre = $_REQUEST['nombre'];
          $sucursalBD->direccion = $_REQUEST['direccion'];
          $sucursalBD->encargado = $_REQUEST['encargado'];
          $sucursalBD->save();
          $msg->info('La sucursal '.$sucursalBD->nombre.' se edito correctamente');
        }else{
          $sucursal->nombre = $_REQUEST['nombre'];
          $sucursal->direccion = $_REQUEST['direccion'];
          $sucursal->encargado = $_REQUEST['encargado'];
          $sucursal->save();
          $msg->success('La sucursal '.$sucursal->nombre.' se agrego correctamente');
        }


        header('Location: index.php?c=sucursales');
     }catch(\Exception $e){
      $msg->error('Ocurrio un error al agregar o editar una sucursal');
          header('Location: index.php');
     }
    }

    public function Eliminar(){
      global $msg;
        $sucursal = new Sucursal;
        
        try{
          $sucursalBD = $sucursal::findOrFail($_REQUEST['id']);
          $sucursalBD->delete();
          $msg->warning('La sucursal '.$sucursalBD->nombre.' se eliminó correctamente');
          header('Location: index.php?c=sucursales');
        }catch(\Exception $e){
          $msg->error('Ocurrio un error al eliminar la sucursal ');
          header('Location: index.php');

        }

       
    }

}   

