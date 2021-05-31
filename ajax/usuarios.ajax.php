<?php 

require_once "../Controllers/UsuariosController.php";
require_once "../Models/UsuariosModel.php";

class AjaxUsuarios{

    // EDITAR USUARIOS
    public $idUsuario;

    public function ajaxEditarUsuario(){

        $item = "id";
        $valor = $this -> idUsuario;
        $respuesta = UsuariosController::controllerMostrarUsuario($item, $valor);

        echo json_encode($respuesta);        
    }

    // ACTIVAR USUARIO
    public $activarUsuario;
    public $activarId;

    public function ajaxActivarUsuario(){

        $tabla = "usuarios";

        $item1 = "estado";
        $valor1 = $this -> activarUsuario;
        
        $item2 = "id";
        $valor2 = $this -> activarId;
        
        

        $respuesta = UsuariosModel::modelActualizarUsuario($tabla, $item1, $valor1, $item2, $valor2);
        
    }


    // VALIDAR SI USUARIOS ESTA REGISTRADO
    public $validarUsuario;

    public function ajaxValidarUsuario(){

        $item = "usuario";
        $valor = $this -> validarUsuario;
        $respuesta = UsuariosController::controllerMostrarUsuario($item, $valor);

        echo json_encode($respuesta);    
        
    }

}

// EDITAR USUARIOS
if(isset($_POST["idUsuario"])){

    $editar = new AjaxUsuarios();
    $editar -> idUsuario = $_POST['idUsuario'];
    $editar -> ajaxEditarUsuario();

}

// ACTIVAR USUARIO

if(isset($_POST["activarUsuario"])){

    $activarUsuario = new AjaxUsuarios();
    $activarUsuario -> activarUsuario = $_POST['activarUsuario'];
    $activarUsuario -> activarId = $_POST['activarId'];
    $activarUsuario -> ajaxActivarUsuario();

}


// VALIDAR USUARIO NO SE REPETITE
if(isset($_POST["validarUsuario"])){

    $validarUsuario = new AjaxUsuarios();
    $validarUsuario -> validarUsuario = $_POST['validarUsuario'];
    $validarUsuario -> ajaxValidarUsuario();

}