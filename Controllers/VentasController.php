<?php

  class VentasController{
    
    public static function showSalesController($item, $value){
      
      $table = "ventas";
      return VentasModel::showSalesModel($table, $item, $value);
    
    }
    
    public static function showRangeSalesDateController($fechaInicial, $fechaFinal){
  
      $table = "ventas";
      
      return VentasModel::showRangeSalesDateModel($table, $fechaInicial, $fechaFinal);
    
    }
    
    public static function createSaleController(){
      
      if(isset($_POST['nuevaVenta'])){
        
        //acutalizar compas del clliente y reducir stock y aumenar ventas de los productos
        
        
        $listaProductos = json_decode($_POST['listaProductos'], true);
        
        $totalProductosComprados = array();
        
        foreach($listaProductos as $key => $value){
          
          $totalProductosComprados[] = $value['cantidad'];
          
          $tablaProductos = "productos";

          $item = "id";
          $id = $value["id"];
          $order ='id';

          $traerProductos = ProductosModel::showProductsModel($tablaProductos, $item, $id, $order);

          $ventas = "ventas"; //item1

          $valorVenta = $value["cantidad"] + $traerProductos["ventas"]; //valor 1

          $nuevaVenta = ProductosModel::updateProductModel($tablaProductos, $ventas, $valorVenta, $id);

          $stock = 'stock'; //item 2

          $valorStock = $value['stock']; //valor 2

          $nuevoStock = ProductosModel::updateProductModel($tablaProductos, $stock, $valorStock, $id);
          
          
        }
        
        
        $tablaClientes = "clientes";
        
        $item = "id";
        
        $valor = $_POST['selectClient'];
        
        $traerCliente = ClientesModel::showClientsModel($tablaClientes, $item, $valor);
        
        $item1 = 'compras';
        
        $valor1 = array_sum($totalProductosComprados) + $traerCliente['compras'];
        
        $comprasCliente = ClientesModel::updateClientModel($tablaClientes, $item1, $valor1, $valor);
  
        $item1b = 'fechaUltimaCompra';
  
  
        date_default_timezone_set('America/Guatemala');
        $fecha = date('Y-m-d');
        $hora = date('H:i:s');
        
        $valor1b = $fecha . ' ' . $hora;
  
        $comprasCliente = ClientesModel::updateClientModel($tablaClientes, $item1b, $valor1b, $valor);
        
        
        //guardar la compra
        
        $tabla = "ventas";
        
        $datos = array(
            'idVendedor' => $_POST['idVendedor'],
            'idCliente' => $_POST['selectClient'],
            'codigo' => $_POST['nuevaVenta'],
            'productos' => $_POST['listaProductos'],
            'impuesto' =>  $_POST['nuevoPrecioImpuesto'],
            'neto' =>  $_POST['nuevoPrecioNeto'],
            'total' =>  $_POST['totalVenta'],
            'metodoPago' => $_POST['listaMetodoPago']);
        
        $response = VentasModel::createSaleModel($tabla, $datos);
  
        if($response === "ok"){
          echo '<script>
                        Swal.fire({
                            icon: "success",
                            title: "¡La venta ha sido guardado correctamente!",
                            confirmButtonText: "Cerrar"
                        }).then((result) => {
                            if(result.value){
                                window.location = "ventas";
                            }
                        });
                    
                    </script>';
        }
        
      }
      
    }
  
  
    public static function editSaleController(){
    
      if(isset($_POST['editarVenta'])){
        
        //Formatear la tabla productos y clientes
  
        $tabla = "ventas";
  
        $saleItem = "codigo";
        $saleValue = $_POST['editarVenta'];
        
        $traerVenta = VentasModel::showSalesModel($tabla, $saleItem, $saleValue);
        
  
        //validar si vienen productos editados
        
  
        if($_POST['listaProductos'] == ""){
    
          $listaProductos = $traerVenta['productos'];
          $cambioProducto = false;
          
        }else{
  
          $listaProductos = $_POST['listaProductos'];
          $cambioProducto = true;
          
        }
        
        if($cambioProducto){
  
          $productos = json_decode($traerVenta['productos'], true);
  
          $totalProductosComprados = array();
  
          foreach($productos as $key => $value){
    
            $totalProductosComprados[] = $value['cantidad'];
    
            $tablaProductos = "productos";
    
            $item = "id";
            $id = $value["id"];
            $order = "id";
    
            $traerProductos = ProductosModel::showProductsModel($tablaProductos, $item, $id, $order);
    
    
            $ventas = "ventas"; //item1
            $valorVenta = $traerProductos["ventas"] - $value["cantidad"]; //valor 1
    
            $nuevaVenta = ProductosModel::updateProductModel($tablaProductos, $ventas, $valorVenta, $id);
    
    
            $stock = 'stock'; //item 2
            $valorStock = $value['cantidad'] + $traerProductos['stock']; //valor 2
    
            $nuevoStock = ProductosModel::updateProductModel($tablaProductos, $stock, $valorStock, $id);
    
    
          }
  
  
          $tablaClientes = "clientes";
  
          $itemCliente = "id";
  
          $valorCliente = $_POST['selectClient'];
  
          $traerCliente = ClientesModel::showClientsModel($tablaClientes, $itemCliente, $valorCliente);
  
          $item1 = 'compras';
  
          $valor1 = $traerCliente['compras'] - array_sum($totalProductosComprados);
  
          $comprasCliente = ClientesModel::updateClientModel($tablaClientes, $item1, $valor1, $valorCliente);
  
  
          //acutalizar compas del clliente y reducir stock y aumenar ventas de los productos
  
  
          $listaProductos2 = json_decode($listaProductos, true);
  
          $totalProductosComprados2 = array();
  
          foreach($listaProductos2 as $key => $value){
    
            $totalProductosComprados2[] = $value['cantidad'];
    
            $tablaProductos2 = "productos";
    
            $item2 = "id";
            $id2 = $value["id"];
            $order = "id";
    
            $traerProductos2 = ProductosModel::showProductsModel($tablaProductos2, $item2, $id2, $order);
    
            $ventas2 = "ventas"; //item1
    
            $valorVenta2 = $value["cantidad"] + $traerProductos2["ventas"]; //valor 1
    
            $nuevaVenta2 = ProductosModel::updateProductModel($tablaProductos2, $ventas2, $valorVenta2, $id2);
    
            $stock2 = 'stock'; //item 2
    
            $valorStock2 = $value['stock']; //valor 2
    
            $nuevoStock2 = ProductosModel::updateProductModel($tablaProductos2, $stock2, $valorStock2, $id2);
    
    
          }
  
  
          $tablaClientes2 = "clientes";
  
          $item2 = "id";
  
          $valor2 = $_POST['selectClient'];
  
          $traerCliente2 = ClientesModel::showClientsModel($tablaClientes2, $item2, $valor2);
  
          $item1a2 = 'compras';
  
          $valor1a2 = array_sum($totalProductosComprados2) + $traerCliente2['compras'];
  
          $comprasCliente2 = ClientesModel::updateClientModel($tablaClientes2, $item1a2, $valor1a2, $valor2);
  
          $item1b = 'fechaUltimaCompra';
  
  
          date_default_timezone_set('America/Guatemala');
          $fecha = date('Y-m-d');
          $hora = date('H:i:s');
  
          $valor1b = $fecha . ' ' . $hora;
  
          $comprasCliente2 = ClientesModel::updateClientModel($tablaClientes2, $item1b, $valor1b, $valor2);
        }
//
//        //guardar cambios de la compra
//
//
        $datos = array(
            'idVendedor' => $_POST['idVendedor'],
            'idCliente' => $_POST['selectClient'],
            'codigo' => $_POST['editarVenta'],
            'productos' => $listaProductos,
            'impuesto' =>  $_POST['nuevoPrecioImpuesto'],
            'neto' =>  $_POST['nuevoPrecioNeto'],
            'total' =>  $_POST['totalVenta'],
            'metodoPago' => $_POST['listaMetodoPago']);

        $response = VentasModel::editSaleModel($tabla, $datos);

        if($response === "ok"){
          echo '<script>
                        Swal.fire({
                            icon: "success",
                            title: "¡La venta ha sido editada correctamente!",
                            confirmButtonText: "Cerrar"
                        }).then((result) => {
                            if(result.value){
                                window.location = "ventas";
                            }
                        });

                    </script>';
        }
      
      }
    
    }
  
    public static function deleteSaleController(){
      
      if(isset($_GET['idVenta'])){
      
        $tabla = 'ventas';
        
        $item = 'id';
        $valor = $_GET['idVenta'];
        
        $traerVenta = VentasModel::showSalesModel($tabla, $item, $valor);
        
        
        //actualizar fecha ultima compra
  
        $tablaClientes = 'clientes';
        
        $itemVentas = null;
        $valorVentas = null;
        
        $traerVentas = VentasModel:: showSalesModel($tabla, $itemVentas, $valorVentas);
        
        $guardarFechas = array();
  
        foreach($traerVentas as $key => $value){
        
          if($value['idCliente'] == $traerVenta['idCliente']){
            
            $guardarFechas[] = $value['fecha'];
            
            
          }
          
        }
        
        
        if(count($guardarFechas ) > 1){
        
          if($traerVenta['fecha'] > $guardarFechas[count($guardarFechas) - 2] ){
  
            $item = "fechaUltimaCompra";
            $valor = $guardarFechas[count($guardarFechas) - 2];
            $valorIdCliente = $traerVenta['idCliente'];
  
            $comprasCliente = ClientesModel::updateClientModel($tablaClientes, $item, $valor, $valorIdCliente);
          
          }else {
  
            $item = "fechaUltimaCompra";
            $valor = $guardarFechas[count($guardarFechas) - 1];
            $valorIdCliente = $traerVenta['idCliente'];
  
            $comprasCliente = ClientesModel::updateClientModel($tablaClientes, $item, $valor, $valorIdCliente);
            
          }
          
        }else{
  
          $item = "fechaUltimaCompra";
          $valor = "0000-00-00 00:00:00";
          $valorIdCliente = $traerVenta['idCliente'];
  
          $comprasCliente = ClientesModel::updateClientModel($tablaClientes, $item, $valor, $valorIdCliente);
          
        }
        
        
        //FORMATEAR TABLA DE PRODUCTOS
  
        $productos = json_decode($traerVenta['productos'], true);
  
        $totalProductosComprados = array();
  
        foreach($productos as $key => $producto){
    
          $totalProductosComprados[] = $producto['cantidad'];
    
          $tablaProductos = "productos";
    
          $item = "id";
          $id = $producto["id"];
          $order = "id";
    
          $traerProductos = ProductosModel::showProductsModel($tablaProductos, $item, $id, $order);
    
    
          $ventas = "ventas"; //item1
          $valorVenta = $traerProductos["ventas"] - $producto["cantidad"]; //valor 1
    
          $nuevaVenta = ProductosModel::updateProductModel($tablaProductos, $ventas, $valorVenta, $id);
    
    
          $stock = 'stock'; //item 2
          $valorStock = $producto['cantidad'] + $traerProductos['stock']; //valor 2
    
          $nuevoStock = ProductosModel::updateProductModel($tablaProductos, $stock, $valorStock, $id);
    
    
        }
  
  
        $tablaClientes = "clientes";
  
        $itemCliente = "id";
  
        $valorCliente = $traerVenta['idCliente'];
  
        $traerCliente = ClientesModel::showClientsModel($tablaClientes, $itemCliente, $valorCliente);
  
        $item1 = 'compras';
  
        $valor1 = $traerCliente['compras'] - array_sum($totalProductosComprados);
        
        
        $comprasCliente = ClientesModel::updateClientModel($tablaClientes, $item1, $valor1, $valorCliente);
  
      
        
        /**
         *ELIMINAR VENTA
         *
         */
    
//
         $response = VentasModel::deleteSaleModel($tabla, $_GET['idVenta']);

        if($response === "ok"){
          echo '<script>
                        Swal.fire({
                            icon: "success",
                            title: "¡La venta ha sido eliminada correctamente!",
                            confirmButtonText: "Cerrar"
                        }).then((result) => {
                            if(result.value){
                                window.location = "ventas";
                            }
                        });

                    </script>';
        }
    
      }
      
    }
  
    public static function downloadReportController()
    {
      
      if(isset($_GET['reporte'])){
        
        $table = 'ventas';
      
        if(isset($_GET['fechaInicial']) && isset($_GET['fechaFinal'])){
        
          $ventas = VentasModel::showRangeSalesDateModel($table,$_GET['fechaInicial'],$_GET['fechaFinal'] );
        
        }else {
        
          $item = null;
          $valor = null;
          
          $ventas = VentasModel::showSalesModel($table, $item, $valor);
        
        }
        
        
        //CREAR ARCHIVO DE EXCEL
        
        $NAME_FILE = $_GET['reporte'];
        
        header('Expires: 0');
        header('Cache-control: private');
        header('Content-type: application/vnd.ms-excel');
        header('Cache-Control: cache, must-revalidate');
        header('Content-Description: File Transfer');
        header('Last-Modified:'. date('D, d M Y H:i:s'));
        header('Pragma: public');
        header('Content-Disposition: filename="'. $NAME_FILE .'"');
        header('Content-Transfer-Encoding: binary');
        
        echo utf8_decode("<table style='border: 0'>
                <tr>
                  <td style='font-weight: bold; border: 1px solid #eee;'>Código</td>
                  <td style='font-weight: bold; border: 1px solid #eee;'>Cliente</td>
                  <td style='font-weight: bold; border: 1px solid #eee;'>Vendedor</td>
                  <td style='font-weight: bold; border: 1px solid #eee;'>Cantidad</td>
                  <td style='font-weight: bold; border: 1px solid #eee;'>Productos</td>
                  <td style='font-weight: bold; border: 1px solid #eee;'>Impuesto</td>
                  <td style='font-weight: bold; border: 1px solid #eee;'>Neto</td>
                  <td style='font-weight: bold; border: 1px solid #eee;'>Total</td>
                  <td style='font-weight: bold; border: 1px solid #eee;'>Método de Pago</td>
                  <td style='font-weight: bold; border: 1px solid #eee;'>Fecha</td>
                </tr>");
  
  
        foreach($ventas as $row => $venta){
          
          $cliente = ClientesController::showClientsController('id', $venta['idCliente']);
          $vendedor = UsuariosController::showUsersController('id', $venta['idVendedor']);
          
          echo utf8_decode("<tr>
                  <td style='border: 1px solid #eee;'>". $venta['codigo']."</td>
                  <td style='border: 1px solid #eee;'>". $cliente['nombre'].' '. $cliente['apellido']."</td>
                  <td style='border: 1px solid #eee;'>". $vendedor['nombre'].' '. $vendedor['apellido']."</td>
                  <td style='border: 1px solid #eee;'>");
          
          $productos = json_decode($venta['productos'], true);
  
          foreach($productos as $key => $valueProducto){
          
            echo utf8_decode($valueProducto['cantidad']. '<br>');
          
          }
          
          echo utf8_decode("</td> <td style='border: 1px solid #eee'>");
  
          foreach($productos as $key => $valueProducto){
            
            echo utf8_decode($valueProducto['descripcion'] . '<br>');
            
          }
          
          echo utf8_decode("</td>
                  <td style='border: 1px solid #eee;'>Q ". number_format( $venta['impuesto'], 2)."</td>
                  <td style='border: 1px solid #eee;'>Q ". number_format( $venta['neto'], 2)."</td>
                  <td style='border: 1px solid #eee;'>Q ". number_format( $venta['total'], 2)."</td>
                  <td style='border: 1px solid #eee;'>" .$venta['metodoPago']."</td>
                  <td style='border: 1px solid #eee;'>". substr($venta['fecha'], 0, 10)."</td>
 
 
 
                </tr>");
          
          
        }
        
        
        echo "</table>";
        
        
      
      }
    }
  
  
  
    public static function showSumOfSalesController($valor){
    
      $tabla = 'ventas';
    
      return VentasModel::showSumOfSalesModel($tabla, $valor);
    
    }
    
    
  
  }