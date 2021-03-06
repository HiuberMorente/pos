<?php

  require_once "../Controllers/ProductosController.php";
  require_once "../Models/ProductosModel.php";


  require_once "../Controllers/CategoriasController.php";
  require_once "../Models/CategoriasModel.php";




  class   ProductsDatatableAjax{

    // MOSTRAR TABLA PRODUCTOS
    public function showProductsTable():void{


      $item = null;
      $valor = null;
      $order = 'id';

      $products = ProductosController::showProductsController($item, $valor, $order);
      

        $jsonData = '{
                      "data": [';
  
        foreach($products as $key => $product){
  
          $image = "<img src='". $product["imagen"]."' alt='productImage' style='width: 40px;'>";
  
          if(isset($_GET['hiddenProfile']) && $_GET['hiddenProfile'] === 'Especial'){
    
            $buttons = "<div class='btn-group'><button class='btn btn-warning btnEditProducts' idProduct='"
                . $product["id"]."' data-bs-toggle='modal' data-bs-target='#modalEditProduct'><i class='fa fa-pen text-white'></i></button></div>";
            
          }else {
            
            $buttons = "<div class='btn-group'><button class='btn btn-warning btnEditProducts' idProduct='"
               . $product["id"]."' data-bs-toggle='modal' data-bs-target='#modalEditProduct'><i class='fa fa-pen text-white'></i></button><button class='btn btn-danger btnDeleteProduct' idProduct='"
               . $product["id"]."' codigo='". $product["codigo"]."' image='". $product["imagen"]
               ."'><i class='fa fa-times'></i></button></div>";
          }
  
          $item = "id";
          $valor = $products[$key]["idCategoria"];
  
          $categories = CategoriasController::showCategories($item, $valor);
  
  //          STOCK COLOR
          if($product["stock"] <= 10){
  
            $stock = "<button class='btn btn-danger'>". $product["stock"]."</button>";
  
          }elseif($product["stock"] > 10 && $product["stock"] <= 15){
  
            $stock = "<button class='btn btn-warning'>". $product["stock"]."</button>";
  
          }else{
  
            $stock = "<button class='btn btn-success'>". $product["stock"]."</button>";
  
          }
  
  
  
          $jsonData .= '[
                          "'.($key + 1).'",
                          "'.$image.'",
                          "'. $product["codigo"].'",
                          "'. $product["descripcion"].'",
                          "'.$categories["categoria"].'",
                          "'. $stock.'",
                          "Q. '.number_format($product["precioCompra"],2).'",
                          "Q. '.number_format($product["precioVenta"],2).'",
                          "'. $product["fecha"].'",
                          "'.$buttons.'"
                        ],';
        }
  
        $jsonData = substr($jsonData, 0, -1);
  
  
        $jsonData .= ']
                }';
  
  
        echo $jsonData;

        
        
    }

  }


// ACTIVAR TABLA PRODUCTOS
  $activateProducts = new ProductsDatatableAjax();
  $activateProducts->showProductsTable();