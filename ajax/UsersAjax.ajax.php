<?php

  require_once "../Controllers/UsuariosController.php";
  require_once "../Models/UsuariosModel.php";

  class UsersAjax{

    // EDITAR USUARIOS
    public $userId;

    public function ajaxEditarUsuario():void{

      $item = "id";
      $valor = $this->userId;
      $respuesta = UsuariosController::controllerMostrarUsuario($item, $valor);

      try{
        echo json_encode($respuesta, JSON_THROW_ON_ERROR);
      } catch(JsonException){

      }
    }

    // ACTIVAR USUARIO
    public $activateUser;
    public $activateId;

    public function ajaxActivarUsuario():void{

      $tabla = "usuarios";

      $item1 = "estado";
      $valor1 = $this->activateUser;

      $item2 = "id";
      $valor2 = $this->activateId;


      $respuesta = UsuariosModel::modelActualizarUsuario($tabla, $item1, $valor1, $item2, $valor2);

      try{
        echo json_encode($respuesta, JSON_THROW_ON_ERROR);
      } catch(JsonException){

      }

    }


    // VALIDAR SI USUARIOS ESTA REGISTRADO
    public $validateUser;


    public function ajaxValidarUsuario():void{

      $item = "usuario";
      $valor = $this->validateUser;
      $respuesta = UsuariosController::controllerMostrarUsuario($item, $valor);

      try{
        echo json_encode($respuesta, JSON_THROW_ON_ERROR);
      } catch(JsonException){

      }

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