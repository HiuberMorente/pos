<?php

  class ProductosController{

    // MOSTRAR PRODUCTOS
    public static function controllerMostrarProductos($item, $valor){

      $tabla = "productos";

      return ProductosModel ::modelMostrarProductos($tabla, $item, $valor);


    }

  }