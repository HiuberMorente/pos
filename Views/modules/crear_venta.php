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
              Crear venta
           
          </h1>
        </div>
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="inicio" class=" text-dark">Inicio</a></li>
            <li class="breadcrumb-item active">Crear venta</li>
          </ol>
        </div>
      </div>
    </div>
  </section>


  <!-- Main content -->
  <section class="content">
    
    <div class="row">
      
      <!-- form-->
      <div class="col-lg-5 col-12">
        <div class="card card-success card-outline">
          <div class="card-header with-border">
            <form role="form" method="post" class="formularioVenta">
              <div class="card-body">
                  <div class="card">
                  
                    <!--vendedor-->
                    <div class="form-group">
                      <div class="input-group">
                        <span class="input-group-text">
                          <i class="fa fa-user"></i>
                        </span>
                        <input type="text"
                               class="form-control"
                               id="nuevoVendedor"
                               name="nuevoVendedor"
                               value="<?php echo $_SESSION["nombre"] ." ". $_SESSION["apellido"];?>"
                               readonly>
                        <input type="hidden"
                               name="idVendedor"
                               id="idVendedor"
                               value="<?php echo $_SESSION["id"];?>">
                      </div>
                    </div>
                    
                    <!--codigo-->
                    <div class="form-group">
                      <div class="input-group">
                        <span class="input-group-text">
                          <i class="fa fa-key"></i>
                        </span>
                        <?php
                        
                          $item = null;
                          $value = null;
                          $sales = VentasController::showSalesController($item, $value);
                          if(!$sales){
                            echo '<input type="text"
                                         class="form-control"
                                         id="nuevaVenta"
                                         name="nuevaVenta"
                                         value="0001"
                                         readonly>';
                          }else{
                            foreach($sales as $key => $value){
                            
                            }
                            $codigo = $value["codigo"] + 1;
                            
                            echo '<input type="text"
                                         class="form-control"
                                         id="nuevaVenta"
                                         name="nuevaVenta"
                                         value="'.$codigo.'"
                                         readonly>';
                          }
                        ?>
                        
                      </div>
                    </div>
                    
                    
                  

<!--                    cliente2-->
                    <div class="form-group">
                      <div class="input-group">
                        <span class="input-group-text">
                          <i class="fa fa-users"></i>
                        </span>
                        <div class="form-control" style="padding: 4px 0 2px 0px">
                          <select class="selectData col-sm-12 col-12"
                                  id="selectClient"
                                  name="selectClient"
                                  required>
                            <option value="">Seleccionar cliente</option>
    
                            <?php
                            $item = null;
                            $value = null;
    
                            $clients = ClientesController::showClientsController($item, $value);
                            foreach($clients as $key => $client){
                              echo '<option value="'.$client["id"].'">' .$client["nombre"]. " " .$client["apellido"].
                                  ". NIT: ".$client["nit"].'</option>';
                            }
                            ?>
                          </select>
                        </div>
                      
                        
                        <span class="input-group-text">
                          <button type="button"
                                  class="btn btn-secondary btn-xs"
                                  data-bs-toggle="modal"
                                  data-bs-target="#addClientModal">
                            Agregar cliente
                          </button>
                        </span>
                      </div>
                    </div>
                    
                    <div class="form-group row newProduct"></div>

                    <input type="hidden"
                           name="listaProductos"
                           id="listaProductos">
                    
                    <button type="button"
                            class="btn btn-secondary d-block d-sm-block d-md-none d-md-block d-lg-none d-xl-none
                            btnAgregarProducto">
                      Agregar Producto
                    </button>
  
                    <hr>
  <!--                  impuesto y total-->
                    <div class="row">
                      <div class="col-sm-6 col-12 ml-auto">
                        <table class="table">
                          <thead>
                            <tr>
                              <th>Total con Impuestos (12% IVA)</th>
                            </tr>
                          </thead>
                          <tbody>
                            <tr>
  <!--                            impuesto-->
<!--                              <td>-->
                                <div class="input-group">
                                
                                
                                </div>
<!--                              </td>-->
  <!--                            total-->
                              <td>
                                <input type="hidden"
                                       class="form-control"
                                       id="nuevoImpuestoVenta"
                                       name="nuevoImpuestoVenta"
                                       value="12"
                                       required>
                                       
                                <input type="hidden"
                                       name="nuevoPrecioImpuesto"
                                       id="nuevoPrecioImpuesto" required>
                                
                                <input type="hidden"
                                       name="nuevoPrecioNeto"
                                       id="nuevoPrecioNeto" required>
                                
                                <div class="input-group input-group-lg">
                                  <span class="input-group-text">
                                    <i class="fab fa-quora"></i>
                                  </span>
                                  <input type="text"
                                         class="form-control"
                                         id="nuevoTotalVenta"
                                         name="nuevoTotalVenta"
                                         total=""
                                         min="0"
                                         placeholder="0000"
                                         readonly
                                         required>

                                  <input type="hidden"
                                         name="totalVenta"
                                         id="totalVenta">
                                  
                                </div>
                              </td>
                            </tr>
                          </tbody>
                        </table>
                      </div>
                    </div>
  
                    <hr>
  <!--                    metodo de pago-->
                    
                    <div class="form-group row">
                      <div class="col-sm-6 col-4">
                          <select class="form-select"
                                  id="nuevoMetodoPago"
                                  name="nuevoMetodoPago"
                                  required>
                            <option value="">Método de pago</option>
                            <option value="Efectivo">Efectivo</option>
<!--                            <option value="TC">Tarjeta Crédito</option>-->
<!--                            <option value="TD">Tarjeta Débito</option>-->
                          </select>
                       
                      </div>
                      
       
                      
                      <div class="cajasMetodoPago col-sm-8 row"></div>

                      <input type="hidden"
                             name="listaMetodoPago"
                             id="listaMetodoPago">
                    </div>
                    
                    
                  </div>
                <br>
              </div>
              
              <div class="card-footer">
                <div class="row">
                  <button type="submit" class="btn btn-primary">
                    Guardar venta
                  </button>
                </div>
              </div>
              <br>
              
              
            </form>
            
            <?php
            
              $guardarVenta = new VentasController();
              $guardarVenta -> createSaleController();
            
            ?>
            
            
          </div>
        </div>
        
      </div>
<!--      d-md-none d-lg-block d-sm-none d-md-block d-none d-sm-block-->
        <!-- table productos-->
        <div class="col-lg-7 d-none d-sm-none d-xl-block d-lg-block">
        <div class="card card-warning card-outline">
          <div class="card-header with-border">
            <div class="card-body">
              
              <div class="row">
                <div class="col-lg-12">
                  <table class="table table-bordered table-striped display nowrap tableSales"
                        style="width: 100%">
                    <thead>
                    <tr>
                      <th style="width: 10px;" class="text-center">#</th>
                      <th class="text-center">Imagen</th>
                      <th class="text-center">Código</th>
                      <th style="width:10%;"class="text-center">Descripción</th>
                      <th class="text-center">Stock</th>
                      <th class="text-center">Acciones</th>
                    </tr>
                    </thead>
                    
                  </table>
                </div>
              </div>
             
            </div>
          </div>
        </div>
      </div>
    </div>
  
  </section>
  
</div>


<!--==================================
MODAL AGREGAR CLIENTE
==================================-->

<div class="modal fade" id="addClientModal" tabindex="-1" aria-labelledby="ModalLabel" aria-hidden="true">

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
                       name="nuevoNIT"
                       placeholder="Ingresar NIT"
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

