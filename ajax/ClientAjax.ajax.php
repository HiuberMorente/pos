<?php

require_once "../Controllers/ClientesController.php";
require_once "../Models/ClientesModel.php";


class ClientAjax{

  //editar cliente
  public $idClient;
  
  public function editClientAjax(){
    $item = "id";
    $value = $this -> idClient;
    
    $response = ClientesController::showClientsController($item, $value);
    try{
      echo json_encode($response, JSON_THROW_ON_ERROR);
    } catch(JsonException $e){
    }
  }

}

//obj edit client
if(isset($_POST["idClient"])){
  $editClient = new ClientAjax();
  $editClient -> idClient = $_POST["idClient"];
  $editClient -> editClientAjax();
}