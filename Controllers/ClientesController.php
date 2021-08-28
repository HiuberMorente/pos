<?php
  class ClientesController{


    
    public static function createClientController(){
     if(isset($_POST["nuevoClienteNombre"])){
       if(preg_match('/^[a-zA-Z0-9ñÑáéíóúÁÉÍÓÚ ]+$/', $_POST["nuevoClienteNombre"]) &&
           preg_match('/^[a-zA-Z0-9ñÑáéíóúÁÉÍÓÚ ]+$/', $_POST["nuevoClienteApellido"]) &&
           preg_match('/^[a-zA-Z0-9]+$/', $_POST["nuevoNIT"]) &&
           filter_var($_POST["nuevoEmail"], FILTER_VALIDATE_EMAIL) &&
           preg_match('/^[\+0-9\-\(\)\s]+$/', $_POST["nuevoTelefono"]) &&
           preg_match('/^[\#\.\-\,\/a-zA-Z0-9 ]+$/', $_POST["nuevaDireccion"])
       ){
        $table = "clientes";
        
        $data = array(
            "nombre" => $_POST["nuevoClienteNombre"],
            "apellido" => $_POST["nuevoClienteApellido"],
            "nit" => $_POST["nuevoNIT"],
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

    
    public static function editClientController(){
    if(isset($_POST["editarClienteNombre"])){
      if(preg_match('/^[a-zA-Z0-9ñÑáéíóúÁÉÍÓÚ ]+$/', $_POST["editarClienteNombre"]) &&
          preg_match('/^[a-zA-Z0-9ñÑáéíóúÁÉÍÓÚ ]+$/', $_POST["editarClienteApellido"]) &&
          preg_match('/^[a-zA-Z0-9]+$/', $_POST["editarNIT"]) &&
          filter_var($_POST["editarEmail"], FILTER_VALIDATE_EMAIL)&&
          preg_match('/^[\+0-9\-\(\)\s]+$/', $_POST["editarTelefono"]) &&
          preg_match('/^[\#\.\,\-\/a-zA-Z0-9 ]+$/', $_POST["editarDireccion"])
      ){
        $table = "clientes";
        
        $data = array(
            "id" => $_POST["idClient"],
            "nombre" => $_POST["editarClienteNombre"],
            "apellido" => $_POST["editarClienteApellido"],
            "nit" => $_POST["editarNIT"],
            "email" => $_POST["editarEmail"],
            "telefono" => $_POST["editarTelefono"],
            "direccion" => $_POST["editarDireccion"]
        );
        
        $response = ClientesModel::editClientModel($table, $data);
        
        if($response === "ok"){
          echo '<script>
                        Swal.fire({
                            icon: "success",
                            title: "¡El cliente ha sido acutalizado correctamente!",
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
  
    public static function deleteClientController(){
      if(isset($_GET["idCliente"])){
        $table = "clientes";
        $data = $_GET["idCliente"];
        
        $response = ClientesModel::deleteClientModel($table, $data);
        if($response === "ok"){
          echo '<script>
                    Swal.fire({
                        icon: "success",
                        title: "¡El cliente ha sido eliminado correctamente!",
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
  
  }
