<?php

  class ProductosController
  {

    // MOSTRAR PRODUCTOS
    static public function controllerMostrarProductos($item, $valor)
    {

      $tabla = "productos";

      $respuesta = ProductosModel::modelMostrarProductos($tabla, $item, $valor);

      return $respuesta;
    }

  }