<?php

  class CategoriasController
  {


    // MOSTRAR CATEGORIAS
    static public function controllerMostrarCategoria($item, $valor){

      $tabla = "categorias";

      $respuesta = CategoriasModel ::modelMostrarCategoria($tabla, $item, $valor);

      return $respuesta;
    }

    // CREAR CATEGORIAS
    static public function controllerCrearCategoria(){
      if(isset($_POST["nuevaCategoria"])){

        if(preg_match('/^[a-zA-Z0-9ñÑáéíóúÁÉÍÓÚ ]+$/', $_POST["nuevaCategoria"])){

          $tabla = "categorias";

          $datos = $_POST["nuevaCategoria"];

          $respuesta = CategoriasModel ::modelCrearCategoria($tabla, $datos);

          if($respuesta == "ok"){
            echo '<script>
                        Swal.fire({
                            icon: "success",
                            title: "La categoría ha sido guardada correctamente!",
                            confirmButtonText: "Cerrar"
                        }).then((result) => {
                            if(result.value){
                                window.location = "categorias";
                            }
                        });     
                    
                    </script>';
          }

        } else{
          echo '<script>
                        Swal.fire({
                            icon: "error",
                            title: "¡La categoría no puede ir vacía o llevar caracteres especiales!",
                            confirmButtonText: "Cerrar"
                        }).then((result) => {
                            if(result.value){
                                window.location = "categorias";
                            }
                        });     
                    
                    </script>';
        }
      }
    }


    // EDITAR CATEGORIAS
    static public function controllerEditarCategoria(){
      if(isset($_POST["editarCategoria"])){

        if(preg_match('/^[a-zA-Z0-9ñÑáéíóúÁÉÍÓÚ ]+$/', $_POST["editarCategoria"])){

          $tabla = "categorias";

          $datos = array("categoria" => $_POST["editarCategoria"], "id" => $_POST["idCategoria"]);

          $respuesta = CategoriasModel ::modelEditarCategoria($tabla, $datos);

          if($respuesta == "ok"){
            echo '<script>
                        Swal.fire({
                            icon: "success",
                            title: "La categoría ha sido cambiada correctamente!",
                            confirmButtonText: "Cerrar"
                        }).then((result) => {
                            if(result.value){
                                window.location = "categorias";
                            }
                        });     
                    
                    </script>';
          }

        } else{
          echo '<script>
                        Swal.fire({
                            icon: "error",
                            title: "¡La categoría no puede ir vacía o llevar caracteres especiales!",
                            confirmButtonText: "Cerrar"
                        }).then((result) => {
                            if(result.value){
                                window.location = "categorias";
                            }
                        });     
                    
                    </script>';
        }
      }
    }

    // BORRAR CATEGORIAS
    static public function controllerBorrarCategoria(){

      if(isset($_GET["idCategoria"])){

        $tabla = "categorias";
        $datos = $_GET["idCategoria"];

        $respuesta = CategoriasModel ::modelBorrarCategoria($tabla, $datos);

        if($respuesta == "ok"){
          echo '<script>
                    Swal.fire({
                        icon: "success",
                        title: "¡La categoría ha sido eliminado correctamente!",
                        confirmButtonText: "Cerrar"
                    }).then((result) => {
                        if(result.value){
                            window.location = "categorias";
                        }
                    });     
                
                </script>';
        }


      }
    }


  }



