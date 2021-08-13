<?php

  class VentasController{
    
    public static function showSalesController($item, $value){
      
      $table = "ventas";
      return VentasModel::showSalesModel($table, $item, $value);
    
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

          $traerProductos = ProductosModel::modelMostrarProductos($tablaProductos, $item, $id);

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
  
        $tablaVenta = "ventas";
  
        $saleItem = "codigo";
        $saleValue = $_POST['editarVenta'];
        
        $traerVenta = VentasModel::showSalesModel($tablaVenta, $saleItem, $saleValue);
        
  
        //validar si vienen productos editados
        
        $cambioProducto = false;
  
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
  
          foreach($productos as $key => $producto){
    
            $totalProductosComprados[] = $producto['cantidad'];
    
            $tablaProductos = "productos";
    
            $item = "id";
            $id = $producto["id"];
    
            $traerProductos = ProductosModel::modelMostrarProductos($tablaProductos, $item, $id);
    
    
            $ventas = "ventas"; //item1
            $valorVenta = $traerProductos["ventas"] - $producto["cantidad"]; //valor 1
    
            $nuevaVenta = ProductosModel::updateProductModel($tablaProductos, $ventas, $valorVenta, $id);
    
    
            $stock = 'stock'; //item 2
            $valorStock = $producto['cantidad'] + $traerProductos['stock']; //valor 2
    
            $nuevoStock = ProductosModel::updateProductModel($tablaProductos, $stock, $valorStock, $id);
    
    
          }
  
  
          $tablaClientes = "clientes";
  
          $itemCliente = "id";
  
          $valorCliente = $_POST['selectClient'];
  
          $traerCliente = ClientesModel::showClientsModel($tablaClientes, $itemCliente, $valorCliente);
  
          $item1 = 'compras';
  
          $valor1 = $traerCliente['compras'] - array_sum($totalProductosComprados);
  
          $comprasCliente = ClientesModel::updateClientModel($tablaClientes, $item1, $valor1, $id);
  
  
          //acutalizar compas del clliente y reducir stock y aumenar ventas de los productos
  
  
          $listaProductos2 = json_decode($listaProductos, true);
  
          $totalProductosComprados2 = array();
  
          foreach($listaProductos2 as $key => $value){
    
            $totalProductosComprados2[] = $value['cantidad'];
    
            $tablaProductos2 = "productos";
    
            $item2 = "id";
            $id2 = $value["id"];
    
            $traerProductos2 = ProductosModel::modelMostrarProductos($tablaProductos2, $item2, $id2);
    
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

        $response = VentasModel::editSaleModel($tablaVenta, $datos);

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
    
  }