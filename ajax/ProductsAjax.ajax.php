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
    public $traerProductos;
    public $nombreProducto;
    
    public function editProduct(){
      
      if($this->traerProductos == "ok"){
        $item = null;
        $valor = null;
        $response = ProductosController::controllerMostrarProductos($item, $valor);
        
        try{
          echo json_encode($response, JSON_THROW_ON_ERROR);
        } catch(JsonException $e){
        
        }
        
      }elseif($this->nombreProducto !== null){

        $item = "descripcion";
        $valor = $this->nombreProducto;
        $response = ProductosController::controllerMostrarProductos($item, $valor);

        try{
          echo json_encode($response, JSON_THROW_ON_ERROR);
        } catch(JsonException $e){

        }

      }else{
        $item = "id";
        $valor = $this->idProduct;
        $response = ProductosController::controllerMostrarProductos($item, $valor);
  
        try{
          echo json_encode($response, JSON_THROW_ON_ERROR);
        } catch(JsonException $e){
        
        }
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
  
  //traer product

  if(isset($_POST["traerProductos"])){
    $traerProductos = new ProductsAjax();
    $traerProductos -> traerProductos = $_POST["traerProductos"];
    $traerProductos -> editProduct();
  }
  
  if(isset($_POST["nombreProducto"])){
    $traerProductos = new ProductsAjax();
    $traerProductos -> nombreProducto = $_POST["nombreProducto"];
    $traerProductos -> editProduct();
  }