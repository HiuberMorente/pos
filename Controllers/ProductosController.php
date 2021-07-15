<?php

  class ProductosController{

    // MOSTRAR PRODUCTOS
    public static function controllerMostrarProductos($item, $valor){

      $tabla = "productos";

      return ProductosModel ::modelMostrarProductos($tabla, $item, $valor);

    }

    public static function controllerCreateProduct(){

      if(isset($_POST["nuevaDescripcion"])){
        if(preg_match('/^[a-zA-Z0-9ñÑáéíóúÁÉÍÓÚ ]+$/', $_POST["nuevaDescripcion"]) &&
           preg_match('/^[0-9]+$/', $_POST["nuevoStock"]) &&
           preg_match('/^[0-9]+$/', $_POST["nuevoPrecioCompra"]) &&
           preg_match('/^[0-9]+$/', $_POST["nuevoPrecioVenta"])){

          $ruta = "Views/img/productos/default/anonymous.png";

          $table = "productos";

          $data = array(
             "idCategoria" => $_POST["nuevaCategoria"],
             "codigo" => $_POST["nuevoCodigo"],
             "descripcion" => $_POST["nuevaDescripcion"],
             "stock" => $_POST["nuevoStock"],
             "precioCompra" => $_POST["nuevoPrecioCompra"],
             "precioVenta" => $_POST["nuevoPrecioVenta"],
             "imagen" => $ruta
          );

          $response = ProductosModel::modelIngresarProducto($table, $data);

          if($response === "ok"){
            echo '<script>
                        Swal.fire({
                            icon: "success",
                            title: "¡El producto ha sido guardado correctamente!",
                            confirmButtonText: "Cerrar"
                        }).then((result) => {
                            if(result.value){
                                window.location = "productos";
                            }
                        });     
                    
                    </script>';
          }
        } else{

          echo '<script>
                Swal.fire({
                    icon: "error",
                    title: "¡El producto no puede ir con los campos vacíos o llevar caracteres especiales!",
                    confirmButtonText: "Cerrar"
                }).then((result) => {
                    if(result.value){
                        window.location = "productos";
                    }
                });     
                
                </script>';

        }
      }
    }

  }