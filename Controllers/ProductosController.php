<?php

class ProductosController
{
  
  // MOSTRAR PRODUCTOS
  public static function controllerMostrarProductos($item, $valor)
  {
    
    $tabla = "productos";
    
    return ProductosModel::modelMostrarProductos($tabla, $item, $valor);
    
  }
  
  /**
   * @throws Exception
   */
  public static function controllerCreateProduct()
  {
    
    if(isset($_POST["nuevaDescripcion"])){
      if(preg_match('/^[a-zA-Z0-9ñÑáéíóúÁÉÍÓÚ ]+$/', $_POST["nuevaDescripcion"]) &&
          preg_match('/^[0-9]+$/', $_POST["nuevoStock"]) &&
          preg_match('/^[0-9.]+$/', $_POST["nuevoPrecioCompra"]) &&
          preg_match('/^[0-9.]+$/', $_POST["nuevoPrecioVenta"])){
        
        $ruta = "Views/img/productos/default/anonymous.png";
        
        // VALIDAR IMAGEN
        if(isset($_FILES["nuevaImagen"]["tmp_name"])){
          
          
          list($ancho, $alto) = getimagesize($_FILES["nuevaImagen"]["tmp_name"]);
          
          $nuevoAncho = 500;
          $nuevoAlto = 500;
          
          
          // DIRECTORIO FOTO USUARIO
          $directorio = "Views/img/productos/" . $_POST["nuevoCodigo"];
          
          if(!mkdir($directorio, 0755) && !is_dir($directorio)){
            throw new \RuntimeException(sprintf('Directory "%s" was not created', $directorio));
          }
          
          
          // VALIDACIONES DE ACUERDO AL TIPO IMAGEN
          if($_FILES["nuevaImagen"]["type"] === "image/jpeg"){
            
            // GUARDAR IMAGEN EN DIRECTORIO
            
            $aleatorio = random_int(100, 999);
            
            $ruta = "Views/img/productos/" . $_POST["nuevoCodigo"] . "/" . $aleatorio . ".jpeg";
            
            $origen = imagecreatefromjpeg($_FILES["nuevaImagen"]["tmp_name"]);
            
            $destino = imagecreatetruecolor($nuevoAncho, $nuevoAlto);
            
            imagecopyresized($destino, $origen, 0, 0, 0, 0, $nuevoAncho, $nuevoAlto, $ancho, $alto);
            
            imagejpeg($destino, $ruta);
          }
          
          if($_FILES["nuevaImagen"]["type"] === "image/png"){
            
            // GUARDAR IMAGEN EN DIRECTORIO
            
            $aleatorio = random_int(100, 999);
            
            $ruta = "Views/img/productos/" . $_POST["nuevoCodigo"] . "/" . $aleatorio . ".png";
            
            $origen = imagecreatefrompng($_FILES["nuevaImagen"]["tmp_name"]);
            
            $destino = imagecreatetruecolor($nuevoAncho, $nuevoAlto);
            
            imagecopyresized($destino, $origen, 0, 0, 0, 0, $nuevoAncho, $nuevoAlto, $ancho, $alto);
            
            imagepng($destino, $ruta);
          }
        }
        
        
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