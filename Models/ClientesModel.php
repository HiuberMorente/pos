<?php
  require_once "Connection.php";

  class ClientesModel{
    
    public static function createClientModel($table, $data){
      $statement = Connection::connect()->prepare("INSERT INTO $table(nombre, apellido, dpi, email, telefono, direccion) VALUES(:nombre, :apellido, :dpi, :email, :telefono, :direccion)");
      
      $statement->bindParam(":nombre", $data["nombre"], PDO::PARAM_STR);
      $statement->bindParam(":apellido", $data["apellido"], PDO::PARAM_STR);
      $statement->bindParam(":dpi", $data["dpi"], PDO::PARAM_STR);
      $statement->bindParam(":email", $data["email"], PDO::PARAM_STR);
      $statement->bindParam(":telefono", $data["telefono"], PDO::PARAM_STR);
      $statement->bindParam(":direccion", $data["direccion"], PDO::PARAM_STR);
      
      if($statement->execute()){
        return "ok";
      }else{
        return "error";
      }
      
      $statement->close();
      $statement = null;
      
    }
  
    public static function showClientsModel($table, $item, $valor)
    {
      if ($item != null) {
    
        $statement = Connection::connect()->prepare("SELECT * FROM $table WHERE $item = :$item");
    
        $statement->bindParam(":" . $item, $valor, PDO::PARAM_STR);
    
        $statement->execute();
    
        return $statement->fetch();
        
        $statement->close();
    
        $statement = null;
    
      } else {
    
        $statement = Connection::connect()->prepare("SELECT * FROM $table");
    
        $statement->execute();
    
        return $statement->fetchAll();
        
    
        $statement->close();
    
        $statement = null;
    
      }
    }
  
    public static function editClientModel( $table, array $data){
      $statement = Connection::connect()->prepare("UPDATE $table SET nombre = :nombre, apellido = :apellido, dpi = :dpi, email = :email, telefono = :telefono, direccion = :direccion, fechaRegistro = :fechaRegistro WHERE id = :id");
  
      $statement->bindParam(":id", $data["id"], PDO::PARAM_INT);
      $statement->bindParam(":nombre", $data["nombre"], PDO::PARAM_STR);
      $statement->bindParam(":apellido", $data["apellido"], PDO::PARAM_STR);
      $statement->bindParam(":dpi", $data["dpi"], PDO::PARAM_STR);
      $statement->bindParam(":email", $data["email"], PDO::PARAM_STR);
      $statement->bindParam(":telefono", $data["telefono"], PDO::PARAM_STR);
      $statement->bindParam(":direccion", $data["direccion"], PDO::PARAM_STR);
      $statement->bindParam(":fechaRegistro", $data["fechaRegistro"], PDO::PARAM_STR);
  
      if($statement->execute()){
        return "ok";
      }else{
        return "error";
      }
  
      $statement->close();
      $statement = null;
    }
    
    
    //delete cliente
    
    public static function deleteClientModel($table, $data){
      $statement = Connection::connect()->prepare("DELETE FROM $table WHERE id = :id");
  
      $statement->bindParam(":id", $data, PDO::PARAM_INT);
  
      if ($statement->execute()) {
        return "ok";
      } else {
        return "error";
      }
  
      $statement->closeCursor();
      $statement = null;
    
    }
    
  }