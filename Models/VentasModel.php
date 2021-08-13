<?php

require_once "Connection.php";

  class VentasModel{
    
    public static function showSalesModel($table, $item, $value){
      
      if ($item != null) {
    
        $statement = Connection::connect()->prepare("SELECT * FROM $table WHERE $item = :$item ORDER BY id ASC");
    
        $statement->bindParam(":" . $item, $value, PDO::PARAM_STR);
    
        $statement->execute();
    
        return $statement->fetch();
    
        $statement->close();
    
        $statement = null;
    
      } else {
    
        $statement = Connection::connect()->prepare("SELECT * FROM $table ORDER BY id ASC");
    
        $statement->execute();
    
        return $statement->fetchAll();
    
        $statement->close();
    
        $statement = null;
    
      }
    }
    
    
    //guardar venta
    public static function createSaleModel($tabla, $datos){
  
      $statement = Connection::connect()->prepare("INSERT INTO $tabla(codigo, idCliente, idVendedor, productos, impuesto, neto, total, metodoPago) VALUES(:codigo, :idCliente, :idVendedor, :productos, :impuesto, :neto, :total, :metodoPago)");
  
      $statement->bindParam(":codigo", $datos["codigo"], PDO::PARAM_INT);
      $statement->bindParam(":idCliente", $datos["idCliente"], PDO::PARAM_INT);
      $statement->bindParam(":idVendedor", $datos["idVendedor"], PDO::PARAM_INT);
      $statement->bindParam(":productos", $datos["productos"], PDO::PARAM_STR);
      $statement->bindParam(":impuesto", $datos["impuesto"], PDO::PARAM_STR);
      $statement->bindParam(":neto", $datos["neto"], PDO::PARAM_STR);
      $statement->bindParam(":total", $datos["total"], PDO::PARAM_STR);
      $statement->bindParam(":metodoPago", $datos["metodoPago"], PDO::PARAM_STR);
      
      if($statement -> execute()){
        
        return "ok";
        
      }else{
        
        return "error";
        
      }
  
  
      $statement->close();
      $statement = null;
    }
    
    //editar venta
    public static function editSaleModel($tabla, $datos){
  
      $statement = Connection::connect()->prepare("UPDATE $tabla SET idCliente = :idCliente, idVendedor = :idVendedor, productos = :productos, impuesto = :impuesto, neto = :neto, total = :total, metodoPago = :metodoPago WHERE codigo = :codigo");
  
      $statement->bindParam(":codigo", $datos["codigo"], PDO::PARAM_INT);
      $statement->bindParam(":idCliente", $datos["idCliente"], PDO::PARAM_INT);
      $statement->bindParam(":idVendedor", $datos["idVendedor"], PDO::PARAM_INT);
      $statement->bindParam(":productos", $datos["productos"], PDO::PARAM_STR);
      $statement->bindParam(":impuesto", $datos["impuesto"], PDO::PARAM_STR);
      $statement->bindParam(":neto", $datos["neto"], PDO::PARAM_STR);
      $statement->bindParam(":total", $datos["total"], PDO::PARAM_STR);
      $statement->bindParam(":metodoPago", $datos["metodoPago"], PDO::PARAM_STR);
      
      if($statement -> execute()){
        
        return "ok";
        
      }else{
        
        return "error";
        
      }
  
  
      $statement->close();
      $statement = null;
    }
    
    
    
    
  }