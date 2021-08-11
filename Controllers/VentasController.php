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
    
  }