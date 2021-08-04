<?php

  require_once "../Controllers/UsuariosController.php";
  require_once "../Models/UsuariosModel.php";

  class UsersAjax{

    // EDITAR USUARIOS
    public $userId;
  
    /**
     * @throws JsonException
     */
    public function ajaxEditarUsuario():void{

      $item = "id";
      $valor = $this->userId;
      $respuesta = UsuariosController::controllerMostrarUsuario($item, $valor);

      echo json_encode($respuesta, JSON_THROW_ON_ERROR);
    }

    // ACTIVAR USUARIO
    public $activateUser;
    public $activateId;
  
    /**
     * @throws JsonException
     */
    public function ajaxActivarUsuario():void{

      $tabla = "usuarios";

      $item1 = "estado";
      $valor1 = $this->activateUser;

      $item2 = "id";
      $valor2 = $this->activateId;


      $respuesta = UsuariosModel::modelActualizarUsuario($tabla, $item1, $valor1, $item2, $valor2);
  
      echo json_encode($respuesta, JSON_THROW_ON_ERROR);
      

    }


    // VALIDAR SI USUARIOS ESTA REGISTRADO
    public $validateUser;
  
  
    /**
     * @throws JsonException
     */
    public function ajaxValidarUsuario():void{

      $item = "usuario";
      $valor = $this->validateUser;
      $respuesta = UsuariosController::controllerMostrarUsuario($item, $valor);
  
      echo json_encode($respuesta, JSON_THROW_ON_ERROR);
     
     

    }

  }

// EDITAR USUARIOS
  if(isset($_POST["idUsuario"])){

    $edit = new UsersAjax();
    $edit->userId = $_POST['idUsuario'];
    $edit->ajaxEditarUsuario();

  }

// ACTIVAR USUARIO

  if(isset($_POST["activarUsuario"])){

    $activateUser = new UsersAjax();
    $activateUser->activateUser = $_POST['activarUsuario'];
    $activateUser->activateId = $_POST['activarId'];
    $activateUser->ajaxActivarUsuario();

  }


// VALIDAR USUARIO NO SE REPETITE
  if(isset($_POST["validarUsuario"])){

    $validateUser = new UsersAjax();
    $validateUser->validateUser = $_POST['validarUsuario'];
    $validateUser->ajaxValidarUsuario();

  }