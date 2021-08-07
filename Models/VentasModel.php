<?php

require_once "Connection.php";

  class VentasModel{
    public static function showSalesModel($table, $item, $value){
      if ($item != null) {
    
        $statement = Connection::connect()->prepare("SELECT * FROM $table WHERE $item = :$item ORDER BY fecha DESC");
    
        $statement->bindParam(":" . $item, $value, PDO::PARAM_STR);
    
        $statement->execute();
    
        return $statement->fetch();
    
        $statement->close();
    
        $statement = null;
    
      } else {
    
        $statement = Connection::connect()->prepare("SELECT * FROM $table ORDER BY fecha DESC");
    
        $statement->execute();
    
        return $statement->fetchAll();
    
        $statement->close();
    
        $statement = null;
    
      }
    }
  }