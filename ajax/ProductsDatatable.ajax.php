<?php

  require_once "../Controllers/ProductosController.php";
  require_once "../Models/ProductosModel.php";


  require_once "../Controllers/CategoriasController.php";
  require_once "../Models/CategoriasModel.php";




  class ProductsDatatable{

    // MOSTRAR TABLA PRODUCTOS
    public function showProductsTable():void{


      $buttons = "<div class='btn-group'><button class='btn btn-warning'><i class='fa fa-pen text-white'></i></button><button class='btn btn-danger'><i class='fa fa-times'></i></button></div>";

      $item = null;
      $valor = null;

      $products = ProductosController::controllerMostrarProductos($item, $valor);

      $sizeProducts = count($products);

      $jsonData = '{
                    "data": [';

      for($indice = 0; $indice < $sizeProducts; $indice++){

        $image = "<img src='". $products[$indice]["imagen"]."' alt='productImage' style='width: 40px;'>";

        $jsonData .= '[
                        "'.($indice + 1).'",
                        "'.$image.'",
                        "'. $products[$indice]["codigo"].'",
                        "'. $products[$indice]["descripcion"].'",
                        "Taladros",
                        "'. $products[$indice]["stock"].'",
                        "'. $products[$indice]["precioCompra"].'",
                        "'. $products[$indice]["precioVenta"].'",
                        "'. $products[$indice]["fecha"].'",
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
  $activateProducts = new ProductsDatatable();
  $activateProducts->showProductsTable();