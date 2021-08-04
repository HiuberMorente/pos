<?php

  require_once "../Controllers/ProductosController.php";
  require_once "../Models/ProductosModel.php";

  class ProductsAjax{

    public $idCategoria;
  
   
    public function createProductCode():void{

      $item = "idCategoria";
      $valor = $this -> idCategoria;
      $result = ProductosController::controllerMostrarProductos($item, $valor);
  
      try{
        echo json_encode($result, JSON_THROW_ON_ERROR);
      } catch(JsonException $e){
      }
  
    }
    
    //edit product
    public $idProduct;
    public function editProduct(){
      $item = "id";
      $valor = $this->idProduct;
      $response = ProductosController::controllerMostrarProductos($item, $valor);
  
      try{
        echo json_encode($response, JSON_THROW_ON_ERROR);
      } catch(JsonException $e){
      }
    }
    

  }

  if(isset($_POST["idCategoria"])){
    $productCode = new ProductsAjax();
    $productCode -> idCategoria = $_POST["idCategoria"];
    $productCode -> createProductCode();
  }
  
  //edit product

  if(isset($_POST["idProduct"])){
    $editProduct = new ProductsAjax();
    $editProduct -> idProduct = $_POST["idProduct"];
    $editProduct -> editProduct();
  }