<?php

require_once "../Controllers/ProductosController.php";
require_once "../Models/ProductosModel.php";


class SalesDatatableAjax{
//
//  // MOSTRAR TABLA PRODUCTOS
//  public function showProductsTable():void{
//
//    $item = null;
//    $valor = null;
//
//    $products = ProductosController::controllerMostrarProductos($item, $valor);
//
//    $jsonData = '{
//      "data": [';
//      for($i = 0, $iMax = count($products); $i < $iMax; $i++){
//
//        //imagen
//        $image = "<img src='".$products[$i]["imagen"]."' width='40px'>";
//
//        //stock
//        if($products[$i]["stock"] <= 10){
//          $stock = "<button class='btn btn-danger'>". $products[$i]["stock"]."</button>";
//        }elseif($products[$i]["stock"] > 11 && $products[$i]["stock"] <= 15){
//          $stock = "<button class='btn btn-warning'>". $products[$i]["stock"]."</button>";
//        }else{
//          $stock = "<button class='btn btn-success'>". $products[$i]["stock"]."</button>";
//        }
//
//        //acciones
//        $buttons = "<div class='btn-group'>
//                      <button class='btn btn-primary agregarProducto recuperarBoton'
//                              idproduct='".$products[$i]["id"]."'>
//                        Agregar
//                      </button>
//                    </div>";
//
//        $jsonData .= '[
//          "'.($i + 1).'",
//          "'.$image.'",
//          "'.$products[$i]["codigo"].'",
//          "'.$products[$i]["descripcion"].'",
//          "'.$stock.'",
//          "'.$buttons.'"
//        ],';
//
//      }
//
//      $jsonData = substr($jsonData,0,-1);
//
//      $jsonData .= ']
//      }';
//
//    echo $jsonData;
//
//  }
//
  
  
  public function showProductsTable():void{
    
    
    $item = null;
    $valor = null;
    
    $products = ProductosController::controllerMostrarProductos($item, $valor);
    
    $jsonData = '{
                    "data": [';
    
    foreach($products as $key => $product){
      
      $image = "<img src='". $product["imagen"]."' alt='productImage' style='width: 40px;'>";
      
      $buttons = "<div class='btn-group'><button class='btn btn-primary agregarProducto recuperarBoton' idProduct='".$product["id"]."'>Agregar</button></div>";
    
     
//          STOCK COLOR
      if($product["stock"] <= 10){
        
        $stock = "<button class='btn btn-danger'>". $product["stock"]."</button>";
        
      }elseif($product["stock"] > 11 && $product["stock"] <= 15){
        
        $stock = "<button class='btn btn-warning'>". $product["stock"]."</button>";
        
      }else{
        
        $stock = "<button class='btn btn-success'>". $product["stock"]."</button>";
        
      }
      
      
      
      $jsonData .= '[
                        "'.($key + 1).'",
                        "'.$image.'",
                        "'. $product["codigo"].'",
                        "'. $product["descripcion"].'",
                        "'. $stock.'",
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
$activateProductsVentas = new SalesDatatableAjax();
$activateProductsVentas->showProductsTable();