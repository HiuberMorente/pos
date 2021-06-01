<?php

  require_once "../Controllers/ProductosController.php";
  require_once "../Models/ProductosModel.php";

  class ProductsAjax{

    public $idCategoria;

    public function createProductCode():void{

      $item = "idCategoria";
      $valor = $this -> idCategoria;
      $result = ProductosController::controllerMostrarProductos($item, $valor);

      echo json_encode($result, JSON_THROW_ON_ERROR);

    }

  }

  if(isset($_POST["idCategoria"])){
    $productCode = new ProductsAjax();
    $productCode -> idCategoria = $_POST["idCategoria"];
    $productCode -> createProductCode();
  }