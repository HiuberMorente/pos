<?php

  require_once "Connection.php";

  class ProductosModel{

    // MOSTRAR PRODUCTOS
    public static function modelMostrarProductos($tabla, $item, $valor){

      if($item !== null){

        $statement = Connection::connect()->prepare("SELECT * FROM $tabla WHERE $item = :$item ORDER BY id DESC");

        $statement->bindParam(":" . $item, $valor, PDO::PARAM_STR);

        $statement->execute();

        return $statement->fetch();

      }

      $statement = Connection::connect()->query("SELECT * FROM $tabla");

      $statement->execute();

      return $statement->fetchAll();

    }


    public static function modelIngresarProducto($table, $data){

      $statement = Connection::connect()->prepare("INSERT INTO $table(idCategoria, codigo, descripcion, imagen, stock, precioCompra, precioVenta) VALUES(:idCategoria, :codigo, :descripcion, :imagen, :stock, :precioCompra, :precioVenta)");

      $statement->bindParam(":idCategoria", $data["idCategoria"], PDO::PARAM_INT);
      $statement->bindParam(":codigo", $data["codigo"], PDO::PARAM_STR);
      $statement->bindParam(":descripcion", $data["descripcion"], PDO::PARAM_STR);
      $statement->bindParam(":imagen", $data["imagen"], PDO::PARAM_STR);
      $statement->bindParam(":stock", $data["stock"], PDO::PARAM_STR);
      $statement->bindParam(":precioCompra", $data["precioCompra"], PDO::PARAM_STR);
      $statement->bindParam(":precioVenta", $data["precioVenta"], PDO::PARAM_STR);

      if($statement -> execute()){
        return "ok";
      }else{
        return "error";
      }


      $statement->closeCursor();
      $statement = null;

    }

  }