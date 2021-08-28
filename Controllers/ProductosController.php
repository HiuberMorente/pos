<?php

class ProductosController
{
  
  // MOSTRAR PRODUCTOS
  public static function showProductsController($item, $valor, $order)
  {
    
    $tabla = "productos";
    
    return ProductosModel::showProductsModel($tabla, $item, $valor, $order);
    
  }
  
  /**
   * @throws Exception
   */
  public static function createProductController()
  {
    
    if(isset($_POST["nuevaDescripcion"])){
      if(preg_match('/^[a-zA-Z0-9ñÑáéíóúÁÉÍÓÚ\"\,\/\*\-\ ]+$/', $_POST["nuevaDescripcion"]) &&
          preg_match('/^[0-9]+$/', $_POST["nuevoStock"]) &&
          preg_match('/^[0-9.]+$/', $_POST["nuevoPrecioCompra"]) &&
          preg_match('/^[0-9.]+$/', $_POST["nuevoPrecioVenta"])){
        
        $ruta = "Views/img/productos/default/anonymous.png";
        
        // VALIDAR IMAGEN
  
        if($_FILES["nuevaImagen"]["tmp_name"] == ""){
          $_FILES["nuevaImagen"]["tmp_name"] = "Views/img/productos/default/anonymous.png";
        }

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
            "descripcion" => limpiarDatos($_POST["nuevaDescripcion"]),
            "stock" => $_POST["nuevoStock"],
            "precioCompra" => $_POST["nuevoPrecioCompra"],
            "precioVenta" => $_POST["nuevoPrecioVenta"],
            "imagen" => $ruta
        );
        
        $response = ProductosModel::createProductModel($table, $data);
        
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
  
  
  public static function editProductController(){
    if(isset($_POST["editarDescripcion"])){
      if(preg_match('/^[a-zA-Z0-9ñÑáéíóúÁÉÍÓÚ\"\,\/\*\-\ ]+$/', $_POST["editarDescripcion"]) &&
          preg_match('/^[0-9]+$/', $_POST["editarStock"]) &&
          preg_match('/^[0-9.]+$/', $_POST["editarPrecioCompra"]) &&
          preg_match('/^[0-9.]+$/', $_POST["editarPrecioVenta"])){
      
        $ruta = $_POST["imagenActual"];
        // VALIDAR IMAGEN
        if(isset($_FILES["editarImagen"]["tmp_name"]) && !empty($_FILES["editarImagen"]["tmp_name"])){
          
          list($ancho, $alto) = getimagesize($_FILES["editarImagen"]["tmp_name"]);
        
          $nuevoAncho = 500;
          $nuevoAlto = 500;
        
        
          // DIRECTORIO FOTO USUARIO
          $directorio = "Views/img/productos/" . $_POST["editarCodigo"];
          
          if(!empty($_POST["imagenAcutal"]) && $_POST["imagenActual"] != "Views/img/products/default/anonymous.png"){
            unlink($_POST["imagenActual"]);
          }else{
            if(!mkdir($directorio, 0755) && !is_dir($directorio)){
              throw new \RuntimeException(sprintf('Directory "%s" was not created', $directorio));
            }
          }
          
        
          // VALIDACIONES DE ACUERDO AL TIPO IMAGEN
          if($_FILES["editarImagen"]["type"] === "image/jpeg"){
          
            // GUARDAR IMAGEN EN DIRECTORIO
  
            try{
              $aleatorio = random_int(100, 999);
            } catch(Exception $e){
            }
  
            $ruta = "Views/img/productos/" . $_POST["editarCodigo"] . "/" . $aleatorio . ".jpeg";
          
            $origen = imagecreatefromjpeg($_FILES["editarImagen"]["tmp_name"]);
          
            $destino = imagecreatetruecolor($nuevoAncho, $nuevoAlto);
          
            imagecopyresized($destino, $origen, 0, 0, 0, 0, $nuevoAncho, $nuevoAlto, $ancho, $alto);
          
            imagejpeg($destino, $ruta);
          }
        
          if($_FILES["editarImagen"]["type"] == "image/png"){
          
            // GUARDAR IMAGEN EN DIRECTORIO
          
            $aleatorio = random_int(100, 999);
          
            $ruta = "Views/img/productos/" . $_POST["editarCodigo"] . "/" . $aleatorio . ".png";
          
            $origen = imagecreatefrompng($_FILES["editarImagen"]["tmp_name"]);
          
            $destino = imagecreatetruecolor($nuevoAncho, $nuevoAlto);
          
            imagecopyresized($destino, $origen, 0, 0, 0, 0, $nuevoAncho, $nuevoAlto, $ancho, $alto);
          
            imagepng($destino, $ruta);
          }
        }
      
      
        $table = "productos";
      
        $data = array(
            "idCategoria" => $_POST["editarCategoria"],
            "codigo" => $_POST["editarCodigo"],
            "descripcion" => limpiarDatos($_POST["editarDescripcion"]),
            "stock" => $_POST["editarStock"],
            "precioCompra" => $_POST["editarPrecioCompra"],
            "precioVenta" => $_POST["editarPrecioVenta"],
            "imagen" => $ruta
        );
      
        $response = ProductosModel::editProductModel($table, $data);
      
        if($response == "ok"){
          echo '<script>
                        Swal.fire({
                            icon: "success",
                            title: "¡El producto ha sido editado correctamente!",
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
  
  //borrar producto
  public static function deleteProductController(){
     if(isset($_GET["idProducto"])){
       $table = "productos";
       $data = $_GET["idProducto"];
       
       if($_GET["imagen"] !== "" && $_GET["imagen"] !== "Views/img/products/default/anonymous.png"){
        unlink($_GET["image"]);
        rmdir('Views/img/products/'.$_GET["codigo"]);
       }
       
       $response = ProductosModel::deleteProductModel($table, $data);
       
       if($response === "ok"){
         echo'<script>
                Swal.fire({
                        icon: "success",
                        title: "¡El producto ha sido eliminado correctamente!",
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
  
  /**
   * Mostrar suma de ventas
   */
  public static function showSumOfSalesController(){
  
    $tabla = 'productos';
    
    return ProductosModel::showSumOfSalesModel($tabla);
    
  }
  
  public static function showSumOfProductsController($valor){
    $tabla ='productos';
    
    return ProductosModel::showSumOfProductosModel($tabla, $valor);
  }
  
}