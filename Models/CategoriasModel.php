<?php

  require_once "Connection.php";

  class CategoriasModel{

    // MOSTRAR CATEGORÍA
    static public function modelMostrarCategoria($tabla, $item, $valor){

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

    // CREAR CATEGORÍA
    static public function modelCrearCategoria($tabla, $datos){
      $statement = Connection ::connect() -> prepare("INSERT INTO $tabla(categoria) VALUES(:categoria)");

      $statement -> bindParam(":categoria", $datos, PDO::PARAM_STR);

      if($statement -> execute()){
        return "ok";
      } else{
        return "error";
      }

      $statement -> closeCursor();
      $statement = null;
    }

    // EDITAR CATEGORÍA
    static public function modelEditarCategoria($tabla, $datos){

      $statement = Connection ::connect() -> prepare("UPDATE $tabla SET categoria = :categoria WHERE id = :id");

      $statement -> bindParam(":categoria", $datos["categoria"], PDO::PARAM_STR);
      $statement -> bindParam(":id", $datos["id"], PDO::PARAM_INT);

      if($statement -> execute()){
        return "ok";
      } else{
        return "error";
      }

      $statement -> closeCursor();
      $statement = null;
    }


    // BORRAR CATEGORÍA
    static public function modelBorrarCategoria($tabla, $datos){

      $statement = Connection ::connect() -> prepare("DELETE FROM $tabla WHERE id = :id");

      $statement -> bindParam(":id", $datos, PDO::PARAM_INT);

      if($statement -> execute()){
        return "ok";
      } else{
        return "error";
      }

      $statement -> closeCursor();
      $statement = null;
    }

  }