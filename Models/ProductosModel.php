<?php

  class ProductosModel{

    // MOSTRAR PRODUCTOS
    static public function modelMostrarProductos($tabla, $item, $valor){

      if($item != null){

        $statement = Connection ::connect() -> prepare("SELECT * FROM $tabla WHERE $item = :$item");

        $statement -> bindParam(":" . $item, $valor, PDO::PARAM_STR);

        $statement -> execute();

        return $statement -> fetch();

        $statement -> closeCursor();

        $statement = null;

      } else{

        $statement = Connection ::connect() -> prepare("SELECT * FROM $tabla");

        $statement -> execute();

        return $statement -> fetchAll();

        $statement -> closeCursor();

        $statement = null;

      }
    }
  }