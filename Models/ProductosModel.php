<?php

  require_once "Connection.php";

  class ProductosModel{

    // MOSTRAR PRODUCTOS
    public static function modelMostrarProductos($tabla, $item, $valor){

      if($item !== null){

        $statement = Connection::connect()->prepare("SELECT * FROM $tabla WHERE $item = :$item");

        $statement->bindParam(":" . $item, $valor, PDO::PARAM_STR);

        $statement->execute();

        return $statement->fetch();

      }

      $statement = Connection::connect()->query("SELECT * FROM $tabla");

      $statement->execute();

      return $statement->fetchAll();

    }

  }