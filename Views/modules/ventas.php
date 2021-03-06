<?php

if($_SESSION['perfil'] === "Especial"){
  echo '<script>
          window.location = "inicio";
        </script>';
  
  return;
}

?>

<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1>
            Administrar venta

          </h1>
        </div>
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item">
              <a href="inicio" class=" text-dark">
                Inicio
              </a>
            </li>
            <li class="breadcrumb-item active">Administrar ventas</li>
          </ol>
        </div>
      </div>
    </div>
  </section>


  <section class="content">

    <div class="card">
      <div class="card-header">
        <a href="crear_venta">
          <button class="btn btn-primary">
            Agregar venta
          </button>
        </a>
        
        <button type="button" class="btn btn-default float-end" id="daterange-btn">
          <span>
            <i class="fa fa-calendar"></i>
           Rango de fecha
          </span>
          
          <i class="fa fa-caret-down"></i>
        </button>

      </div>
      <div class="card-body">
        <div class="row">
          <div class="col-lg-12">

            <table id="tabla" class="table table-bordered table-striped display nowrap hover tablas" style="width: 100%">
              <thead>
                <tr>

                  <th style="width: 10px" >#</th>
                  <th>Código Factura</th>
                  <th>Cliente</th>
                  <th>Vendedor</th>
                  <th>Forma de Pago</th>
                  <th>Neto</th>
                  <th>Total</th>
                  <th>Fecha</th>
                  <th>Acciones</th>

                </tr>
              </thead>

              <tbody>
              
              <?php
              
                if(isset($_GET['fechaInicial'])){
                  
                  $fechaInicial = $_GET['fechaInicial'];
                  $fechaFinal = $_GET['fechaFinal'];
                  
                }else{
                  
                  $fechaInicial = null;
                  $fechaFinal = null;
                  
                }
                
                $response = VentasController::showRangeSalesDateController($fechaInicial, $fechaFinal);
                
                foreach($response as $key => $value){
                
                  echo '<tr>
                          <td>'.($key + 1).'</td>
                          <td>'.$value['codigo'].'</td>';
                  
                  $itemClient = 'id';
                  $valorClient = $value['idCliente'];
                  
                  $clientResponse = ClientesController::showClientsController($itemClient, $valorClient);
                  
                  
                  echo '  <td>'.$clientResponse['nombre']." ".$clientResponse['apellido'].'</td>';
                  
                  $itemUser = 'id';
                  $userValue = $value['idVendedor'];
                  
                  $userResponse = UsuariosController::showUsersController($itemUser, $userValue);
                  
                  echo '  <td>'.$userResponse['nombre']." ".$userResponse['apellido'].'</td>
                          <td>'.$value['metodoPago'].'</td>
                          <td>Q '.number_format($value['neto'], 2).'</td>
                          <td>Q '.number_format($value['total'], 2).'</td>
                          <td>'.$value['fecha'].'</td>
                          <td>
                            <div class="btn-group">
                              <button type=""
                                      class="btn btn-info btnImprimirFactura"
                                      codigoVenta="'.$value["codigo"].'">
                                <i class="fa fa-print text-white"></i>
                              </button>';
  
                  if($_SESSION['perfil'] === 'Administrador'){
                    
                    echo '<a href = "index.php?ruta=editar_venta&idVenta='.$value["id"].'">
                            <button type = ""
                                    class="btn btn-warning btnEditarVenta"
                                    idVenta = "'.$value["id"].'">
                              <i class="fa fa-pen text-white text-white" ></i >
                            </button >
                          </a >
                          <button type = ""
                                  class="btn btn-danger btnEliminarVenta"
                                  idVenta = "'.$value["id"].'">
                            <i class="fa fa-times" ></i >
                          </button >';
                  }
                  
                  echo '</div>
                      </td>
                    </tr>';
                }
                
              ?>
              
              </tbody>

            </table>
  
  
            <?php
            $deleteSale = new VentasController();
            $deleteSale -> deleteSaleController();
  
            ?>

          </div>
        </div>
      </div>

    </div>

  </section>
</div>




