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
            <li class="breadcrumb-item"><a href="inicio" class=" text-dark"></i>Inicio</a></li>
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

      </div>
      <div class="card-body">
        <div class="row">
          <div class="col-lg-12">

            <table id="tabla" class="table table-bordered table-striped display nowrap" style="width: 100%">
              <thead>
                <tr>

                  <th style="width: 10px" >#</th>
                  <th>Código de Factura</th>
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
                $item = null;
                $valor = null;
                
                $response = VentasController::showSalesController($item, $valor);
                
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
                  
                  $userResponse = UsuariosController::controllerMostrarUsuario($itemUser, $userValue);
                  
                  echo '  <td>'.$userResponse['nombre']." ".$userResponse['apellido'].'</td>
                          <td>'.$value['metodoPago'].'</td>
                          <td>Q '.number_format($value['neto'], 2).'</td>
                          <td>Q '.number_format($value['total'], 2).'</td>
                          <td>'.$value['fecha'].'</td>
                          <td>
                            <div class="btn-group">
                              <button type=""
                                      class="btn btn-info">
                                <i class="fa fa-print text-white"></i>
                              </button>
                              <a href="index.php?ruta=editar_venta&idVenta='.$value["id"].'">
                                <button type=""
                                        class="btn btn-warning">
                                  <i class="fa fa-pen text-white text-white"></i>
                                </button>
                              </a>
                              <button type=""
                                      class="btn btn-danger">
                                <i class="fa fa-times"></i></button>
                            </div>
                          </td>
                        </tr>';
                }
                
              ?>
              
              
                
              </tbody>

            </table>

          </div>
        </div>
      </div>

    </div>

  </section>
</div>


