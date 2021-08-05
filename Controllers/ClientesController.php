<?php
  class ClientesController{

//
//  &&
//  preg_match('/^[0-9]+$/', $_POST["nuevoDPI"]) &&
//  preg_match('/^[^0-9][a-zA-Z0-9_]+([.][a-zA-Z0-9_]+)*[@][a-zA-Z0-9_]+([.][a-zA-Z0-9_]+)*[.][a-zA-Z]{2,4}$/',
//  $_POST["nuevoEmail"]) &&
//  preg_match('/^[()\-0-9]+$/', $_POST["nuevoTelefono"]) &&
//  preg_match('/^[#\.\/a-zA-Z0-9]+$/', $_POST["nuevaDireccion"])
//
    
    public static function createClientController(){
     if(isset($_POST["nuevoClienteNombre"])){
       if(preg_match('/^[a-zA-Z0-9ñÑáéíóúÁÉÍÓÚ ]+$/', $_POST["nuevoClienteNombre"]) &&
           preg_match('/^[a-zA-Z0-9ñÑáéíóúÁÉÍÓÚ ]+$/', $_POST["nuevoClienteApellido"]) &&
           preg_match('/^[0-9]+$/', $_POST["nuevoDPI"]) &&
           filter_var($_POST["nuevoEmail"], FILTER_VALIDATE_EMAIL) &&
           preg_match('/^[\+0-9\-\(\)\s]+$/', $_POST["nuevoTelefono"]) &&
           preg_match('/^[\#\.\/a-zA-Z0-9 ]+$/', $_POST["nuevaDireccion"])
       ){
        $table = "clientes";
        
        $data = array(
            "nombre" => $_POST["nuevoClienteNombre"],
            "apellido" => $_POST["nuevoClienteApellido"],
            "dpi" => $_POST["nuevoDPI"],
            "email" => $_POST["nuevoEmail"],
            "telefono" => $_POST["nuevoTelefono"],
            "direccion" => $_POST["nuevaDireccion"]
        );
        
        $response = ClientesModel::createClientModel($table, $data);
  
         if($response === "ok"){
           echo '<script>
                        Swal.fire({
                            icon: "success",
                            title: "¡El cliente ha sido guardado correctamente!",
                            showConfirmButton: true,
                            confirmButtonText: "Cerrar",
                        }).then((result) => {
                            if(result.value){
                                window.location = "clientes";
                            }
                        });
                    
                    </script>';
         }
        
       }else{
         echo '<script>
                  Swal.fire({
                      icon: "error",
                      title: "¡El cliente no puede ir vacío o llevar caracteres especiales!",
                      confirmButtonText: "Cerrar"
                  }).then((result) => {
                      if(result.value){
                          window.location = "clientes";
                      }
                  });
                  
              </script>';
       
       }
     }
    }
    
    public static function showClientsController($item, $valor){
      $table = "clientes";
      return ClientesModel::showClientsModel($table, $item, $valor);
    }
  }
