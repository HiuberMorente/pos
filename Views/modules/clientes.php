<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1>
            Administrar clientes

          </h1>
        </div>
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="inicio" class=" text-dark"></i>Inicio</a></li>
            <li class="breadcrumb-item active">Administrar clientes</li>
          </ol>
        </div>
      </div>
    </div>
  </section>


  <section class="content">

    <div class="card">
      <div class="card-header">

        <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#modalAgregarCliente">
          Agregar cliente
        </button>

      </div>
      <div class="card-body">
        
        <div class="row">
          <div class="col-lg-12">
            <table id="tabla"
                   class="table table-bordered table-striped display nowrap"
                   cellspacing="0";
                   style="width: 100%">
              <thead>
                <tr>

                  <th style="width: 10px" >#</th>
                  <th>Nombre</th>
                  <th>Apellido</th>
                  <th>DPI</th>
                  <th>Email</th>
                  <th>Teléfono</th>
                  <th>Dirección</th>
                  <th>Total de Compras</th>
                  <th>Última Compra</th>
                  <th>Ingreso al Sistema</th>
                  <th>Acciones</th>

                </tr>
              </thead>

              <tbody>
              
              <?php
                $item = null;
                $valor = null;
                $clients = ClientesController::showClientsController($item, $valor);
              foreach($clients as $key => $client){
                  echo '<tr>
                          <td>'.($key + 1).'</td>
                          <td>'.$client["nombre"].'</td>
                          <td>'.$client["apellido"].'</td>
                          <td>'.$client["dpi"].'</td>
                          <td>'.$client["email"].'</td>
                          <td>'.$client["telefono"].'</td>
                          <td>'.$client["direccion"].'</td>
                          <td>'.$client["compras"].'</td>
                          <td>0000</td>
                          <td>'.$client["fechaRegistro"].'</td>
                          <td>
                            <div class="btn-group">
                              <button type=""
                                class="btn btn-warning btnEditClient"
                                data-bs-toggle="modal"
                                data-bs-target="#modalEditarCliente"
                                idClient="'.$client["id"].'">
                                  <i class="fa fa-pen text-white"></i>
                              </button>
                              <button type=""
                              class="btn btn-danger btnEliminarCliente"
                              idClient="'.$client["id"].'">
                                <i class="fa fa-times"></i>
                                </button>
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



<!--==================================
MODAL
==================================-->
<!-- Modal -->
<div class="modal fade" id="modalAgregarCliente" tabindex="-1" aria-labelledby="ModalLabel" aria-hidden="true">

  <div class="modal-dialog">
    <div class="modal-content">

      <form action="" role="form" method="post">
        <!--==================================
        MODAL HEADER
        ==================================-->
        <div class="modal-header bg-secondary">

          <h5 class="modal-title" id="ModalLabel">
            Agregar cliente
          </h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>

        </div>

        <!--==================================
        MODAL BODY
        ==================================-->
        <div class="modal-body">
          <div class="box-body">

            <div class="form-group">

              <!-- nombre -->
              <div class="input-group mb-3">
                <span class="input-group-text">
                  <i class="fa fa-user"></i>
                </span>
                <input type="text"
                       class="form-control input-lg"
                       name="nuevoClienteNombre"
                       placeholder="Ingresar nombre"
                       required>
              </div>
              
              <!-- apellido -->
              <div class="input-group mb-3">
                <span class="input-group-text">
                  <i class="fa fa-user"></i>
                </span>
                <input type="text"
                       class="form-control input-lg"
                       name="nuevoClienteApellido"
                       placeholder="Ingresar apellido"
                       required>
              </div>
              
              <!-- dpi -->
              <div class="input-group mb-3">
                <span class="input-group-text">
                  <i class="fa fa-key"></i>
                </span>
                <input type="number"
                       min="0"
                       class="form-control input-lg"
                       name="nuevoDPI"
                       placeholder="Ingresar DPI"
                       required>
              </div>
              
              <!-- email -->
              <div class="input-group mb-3">
                <span class="input-group-text">
                  <i class="fa fa-envelope"></i>
                </span>
                <input type="email"
                       class="form-control input-lg"
                       name="nuevoEmail"
                       placeholder="Ingresar correo electrónico"
                       required>
              </div>
              
              <!-- telefono -->
              <div class="input-group mb-3">
                <span class="input-group-text">
                  <i class="fas fa-phone"></i>
                </span>
                <input type="text"
                       min="0"
                       class="form-control input-lg"
                       name="nuevoTelefono"
                       placeholder="Ingresar teléfono"
                       data-inputmask='"mask": "(999) 9999-9999"'
                       data-mask
                       required>
              </div>
              
              <!-- direccion -->
              <div class="input-group mb-3">
                <span class="input-group-text">
                  <i class="fa fa-map-marker"></i>
                </span>
                <input type="text"
                       class="form-control input-lg"
                       name="nuevaDireccion"
                       placeholder="Ingresar dirección"
                       required>
              </div>
              
              
              <!-- fecha -->
              <div class="input-group mb-3">
                <span class="input-group-text">
                  <i class="far fa-calendar-alt"></i>
                </span>
                <input type="text"
                       class="form-control input-lg"
                       name="nuevaUltimaCompra"
                       placeholder="Ingresar ultima compra"
                       data-inputmask-alias="datetime"
                       data-inputmask-inputformat="dd/mm/yyyy"
                       data-mask
                       required>
              </div>
              

            </div>

          </div>
        </div>

        <!--==================================
        MODAL FOOTER
        ==================================-->
        <div class="modal-footer">
          <button type="button" class="btn btn-default d-flex" data-bs-dismiss="modal">Salir</button>

          <button type="submit" class="btn btn-primary ml-auto">Guardar cliente</button>

        </div>

      </form>
      
      <?php
        $createClient = new ClientesController();
        $createClient -> createClientController();
      ?>
      
    </div>
  </div>

</div>



<!--==================================
MODAL EDITAR
==================================-->
<!-- Modal -->
<div class="modal fade" id="modalEditarCliente" tabindex="-1" aria-labelledby="ModalLabel" aria-hidden="true">

  <div class="modal-dialog">
    <div class="modal-content">

      <form action="" role="form" method="post">
        <!--==================================
        MODAL HEADER
        ==================================-->
        <div class="modal-header bg-secondary">

          <h5 class="modal-title" id="ModalLabel">
            Editar cliente
          </h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>

        </div>

        <!--==================================
        MODAL BODY
        ==================================-->
        <div class="modal-body">
          <div class="box-body">

            <div class="form-group">

              <!-- nombre -->
              <div class="input-group mb-3">
                <span class="input-group-text">
                  <i class="fa fa-user"></i>
                </span>
                <input type="text"
                       class="form-control input-lg"
                       name="editarClienteNombre"
                       id="editarClienteNombre"
                       required>
                <input type="hidden" id="idClient" name="idClient">
              </div>

              <!-- apellido -->
              <div class="input-group mb-3">
                <span class="input-group-text">
                  <i class="fa fa-user"></i>
                </span>
                <input type="text"
                       class="form-control input-lg"
                       name="editarClienteApellido"
                       id="editarClienteApellido"
                       required>
              </div>

              <!-- dpi -->
              <div class="input-group mb-3">
                <span class="input-group-text">
                  <i class="fa fa-key"></i>
                </span>
                <input type="number"
                       min="0"
                       class="form-control input-lg"
                       name="editarDPI"
                       id="editarDPI"
                       required>
              </div>

              <!-- email -->
              <div class="input-group mb-3">
                <span class="input-group-text">
                  <i class="fa fa-envelope"></i>
                </span>
                <input type="email"
                       class="form-control input-lg"
                       name="editarEmail"
                       id="editarEmail"
                       required>
              </div>

              <!-- telefono -->
              <div class="input-group mb-3">
                <span class="input-group-text">
                  <i class="fas fa-phone"></i>
                </span>
                <input type="text"
                       min="0"
                       class="form-control input-lg"
                       name="editarTelefono"
                       id="editarTelefono"
                       data-inputmask='"mask": "(999) 9999-9999"'
                       data-mask
                       required>
              </div>

              <!-- direccion -->
              <div class="input-group mb-3">
                <span class="input-group-text">
                  <i class="fa fa-map-marker"></i>
                </span>
                <input type="text"
                       class="form-control input-lg"
                       name="editarDireccion"
                       id="editarDireccion"
                       required>
              </div>


              <!-- fecha -->
              <div class="input-group mb-3">
                <span class="input-group-text">
                  <i class="far fa-calendar-alt"></i>
                </span>
                <input type="text"
                       class="form-control input-lg"
                       name="editarFechaRegistro"
                       id="editarFechaRegistro"
                       data-inputmask-alias="datetime"
                       data-inputmask-inputformat="yyyy/mm/dd"
                       data-mask
                       required>
              </div>


            </div>

          </div>
        </div>

        <!--==================================
        MODAL FOOTER
        ==================================-->
        <div class="modal-footer">
          <button type="button"
                  class="btn btn-default d-flex"
                  data-bs-dismiss="modal">Salir</button>

          <button type="submit" class="btn btn-primary ml-auto">Guardar cambios</button>

        </div>

      </form>
      
      <?php
      $editClient = new ClientesController();
      $editClient -> editClientController();
      ?>

    </div>
  </div>

</div>

 <?php
  $deleteClient = new ClientesController();
  $deleteClient -> deleteClientController();
 ?>