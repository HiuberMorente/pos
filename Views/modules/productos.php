<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1>
            Administrar productos

          </h1>
        </div>
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="inicio" class=" text-dark"></i>Inicio</a></li>
            <li class="breadcrumb-item active">Administrar productos</li>
          </ol>
        </div>
      </div>
    </div>
  </section>


  <section class="content">

    <div class="card">
      <div class="card-header">

        <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#modalAgregarProducto">
          Agregar producto
        </button>

      </div>
      <div class="card-body">

        <table id="tabla" class="table table-bordered table-striped display nowrap" width="100%">
          <thead>
          <tr>

            <th width="10px" class="text-center">#</th>
            <th class="text-center">Imagen</th>
            <th class="text-center">Código</th>
            <th class="text-center">Descripción</th>
            <th class="text-center">Categoría</th>
            <th class="text-center">Stock/Existencias</th>
            <th class="text-center">Precio de compra</th>
            <th class="text-center">Precio de venta</th>
            <th class="text-center">Agregado</th>
            <th class="text-center">Acciones</th>

          </tr>
          </thead>

          <tbody>

          <?php

            $item = null;
            $valor = null;
            $productos = ProductosController::controllerMostrarProductos($item, $valor);

            foreach ($productos as $key => $value) {

              echo ' <tr>
                        <td class="text-center">' . ($key + 1) . '</td>
                        <td class="text-center">
                          <img
                          	src="Views/img/productos/default/anonymous.png"
                          	class=" img-thumbnail"
                          	alt="imagen-producto"
                          	width="40px">
                        </td>
                        <td class="text-center">' . $value["codigo"] . '</td>
                        <td>' . $value["descripcion"] . '</td>';

              $item = "id";
              $valor = $value["idCategoria"];

              $categoria = CategoriasController::controllerMostrarCategoria($item, $valor);


              echo '<td>' . $categoria["categoria"] . '</td>
                        <td class="text-center">' . $value["stock"] . '</td>
                        <td class="text-right"><strong>Q. </strong>' . $value["precioCompra"] . '</td>
                        <td class="text-right"><strong>Q. </strong>' . $value["precioVenta"] . '</td>
                        <td class="text-center">' . $value["fecha"] . '</td>
                        <td>
                          <div class="btn-group">
                            <button type="" class="btn btn-warning"><i class="fa fa-pen text-white"></i></button>
                            <button type="" class="btn btn-danger"><i class="fa fa-times"></i></button>
                          </div>
                        </td>
                      </tr>';

            }
          ?>

          </tbody>

        </table>

      </div>

    </div>

  </section>
</div>


<!--==================================
MODAL
==================================-->
<!-- Modal -->
<div
  class="modal fade"
  id="modalAgregarProducto"
  tabindex="-1"
  aria-labelledby="ModalLabel"
  aria-hidden="true">

  <div class="modal-dialog">
    <div class="modal-content">

      <form action="" role="form" method="post" enctype="multipart/form-data">
        <!--==================================
MODAL HEADER
==================================-->
        <div class="modal-header bg-secondary">

          <h5 class="modal-title" id="ModalLabel">
            Agregar producto
          </h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>

        </div>

        <!--==================================
MODAL BODY
==================================-->
        <div class="modal-body">
          <div class="box-body">

            <div class="form-group">


              <!-- codigo -->
              <div class="input-group mb-3">
                <span class="input-group-text">
                  <i class="fa fa-code"></i>
                </span>
                <input
                  type="text"
                  class="form-control input-lg"
                  name="nuevoCodigo"
                  placeholder="Ingresar código" required>
              </div>

              <!-- Descripción -->

              <div class="input-group mb-3">
                <span class="input-group-text">
                  <i class="fa fa-product-hunt"></i>
                </span>
                <input
                  type="text"
                  class="form-control input-lg"
                  name="nuevaDescripcion"
                  placeholder="Ingresar descripción" required>
              </div>

              <!-- Categoría -->

              <div class="input-group mb-3">
                <span class="input-group-text">
                  <i class="fa fa-th"></i>
                </span>
                <select name="nuevaCategoria" class="form-select text-gray">
                  <option value="">Selecionar categoría</option>
                  <option value="Talados">Talados</option>
                  <option value="Andamios">Andamios</option>
                  <option value="Equipo de construccion">Equipo de construccion</option>
                </select>
              </div>

              <!-- Stock -->

              <div class="input-group mb-3">
                <span class="input-group-text">
                  <i class="fa fa-check"></i>
                </span>
                <input type="number" class="form-control input-lg" name="nuevoStock" min="0"
                       placeholder="Stock" required>
              </div>

              <div class="row">

                <!-- precio de compra -->
                <div class="col-lg-6">
                  <div class="input-group mb-3 ">
                    <span class="input-group-text">
                      <i class="fa fa-money-bill-wave"></i>
                    </span>
                    <input type="number" class="form-control input-lg" name="nuevoPrecioCompra"
                           min="0" placeholder="Precio de compra" required>
                  </div>
                </div>

                <!-- Precio de venta -->
                <div class="col-lg-6">
                  <div class="input-group mb-3 ">
                    <span class="input-group-text">
                      <i class="fa fa-money-bill-wave"></i>
                    </span>
                    <input type="number" class="form-control input-lg" name="nuevoPrecioVenta"
                           min="0" placeholder="Precio de venta" required>
                  </div>


                  <div class="row">
                    <div class="col-lg-6">
                      <!-- checkbox -->
                      <div class="input-group mb-3">

                        <div class="icheck-primary d-inline">
                          <input type="checkbox" id="" checked>
                          <label for="">
                            Utilizar porcentaje
                          </label>
                        </div>

                      </div>


                    </div>

                    <!-- Entrada Porcentaje -->
                    <div class="col-lg-6">
                      <div class="input-group mb-3" style="padding: 0;">
                        <span class="input-group-text"> <i class="fa fa-percent"></i> </span>

                        <input type="number" class="form-control inpug-lg nuevoPorcentaje"
                               min="0" value="20" required>
                      </div>
                    </div>


                  </div>


                </div>

              </div>


              <!-- imagen -->
              <div class="input-group mb-3">
                <div class="panel">
                  SUBIR IMAGEN
                  <br><br>
                  <input type="file" id="nuevaImagen" name="nuevaImagen">
                  <p class="help-block">Peso máximo de la imagen 2MB</p>

                  <img src="Views/img/productos/default/anonymous.png" alt="imag-subir"
                       class="img-fluid img-thumbnail" width="100px">
                </div>
              </div>

            </div>

          </div>
        </div>

        <!--==================================
MODAL FOOTER
==================================-->
        <div class="modal-footer">
          <button type="button" class="btn btn-default d-flex" data-bs-dismiss="modal">Salir</button>

          <button type="submit" class="btn btn-primary ml-auto">Guardar producto</button>

        </div>

      </form>
    </div>
  </div>

</div>

