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
    
    
    
    
    public static function editProductModel($table, $data){

      $statement = Connection::connect()->prepare("UPDATE $table SET idCategoria = :idCategoria, codigo = :codigo, descripcion = :descripcion, imagen = :imagen, stock = :stock, precioCompra = :precioCompra, precioVenta = :precioVenta WHERE codigo = :codigo");

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


      $statement->close();
      $statement = null;

    }
    
    //delete product
    
    public static function deleteProductModel($table, $data){
      $statement = Connection::connect()->prepare("DELETE FROM $table WHERE id = :id");
      
      $statement -> bindParam(":id", $data, PDO::PARAM_INT);
      
      if($statement -> execute()){
        return "ok";
      }else{
        return "error";
      }
      
      $statement -> close();
      $statement = null;
    }

  }