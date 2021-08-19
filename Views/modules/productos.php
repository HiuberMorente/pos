<?php

if($_SESSION['perfil'] === "Vendedor"){
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
            Administrar productos
          </h1>
        </div>
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="inicio" class=" text-dark">Inicio</a></li>
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
        <div class="row">
          <div class="col-lg-12">
            <table class="table table-bordered table-striped productTable display nowrap"
                   cellspacing="0";
                   style="width: 100%">
              <thead>
              <tr>

                <th style="width: 10px%" class="text-center">#</th>
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
              
            </table>

            <input type="hidden" value="<?php echo $_SESSION['perfil']; ?>" id="perfilHidden">
            
          </div>
        </div>
      

      </div>

    </div>

  </section>
</div>


<!--==================================
MODAL INGRESO PRODUCTO
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


              <!-- Categoría -->

              <div class="input-group mb-3">
                <span class="input-group-text">
                  <i class="fa fa-th"></i>
                </span>
                <select
                  name="nuevaCategoria"
                  class="form-select text-gray"
                  id="nuevaCategoria"
                  aria-label="nuevaCategoria"
                  required>
                  <option value="">Selecionar categoría</option>

                  <?php

                    $categories = CategoriasController::showCategories(null, null);

                    foreach($categories as $key => $category){
                      echo '<option value="' . $category["id"] . '">' . $category["categoria"] . '</option>';
                    }

                  ?>


                </select>
              </div>


              <!-- codigo -->
              <div class="input-group mb-3">
                <span class="input-group-text">
                  <i class="fa fa-code"></i>
                </span>
                <input
                  type="text"
                  class="form-control input-lg"
                  name="nuevoCodigo"
                  id="nuevoCodigo"
                  placeholder="Ingresar código"
                  aria-label="nuevoCodigo"
                  readonly>
              </div>

              <!-- Descripción -->

              <div class="input-group mb-3">
                <span class="input-group-text">
                  <i class="fab fa-product-hunt"></i>
                </span>
                <input
                  type="text"
                  class="form-control input-lg"
                  name="nuevaDescripcion"
                  placeholder="Ingresar descripción"
                  aria-label="nuevaDescripcion" required>
              </div>


              <!-- Stock -->

              <div class="input-group mb-3">
                <span class="input-group-text">
                  <i class="fa fa-check"></i>
                </span>

                <input
                  type="number"
                  class="form-control input-lg"
                  name="nuevoStock"
                  min="0"
                  placeholder="Stock"
                  aria-label="nuevoStock" required>

              </div>

              <div class="row">

                <!-- precio de compra -->
                <div class="col-lg-6">
                  <div class="input-group mb-3 ">
                    <span class="input-group-text">
                      <i class="fa fa-money-bill-wave"></i>
                    </span>

                    <input
                      type="number"
                      class="form-control input-lg"
                      name="nuevoPrecioCompra"
                      id="nuevoPrecioCompra"
                      min="0"
                      step="any"
                      placeholder="Precio de compra"
                      aria-label="nuevoPrecioCompra" required>

                  </div>
                </div>

                <!-- Precio de venta -->
                <div class="col-lg-6">
                  <div class="input-group mb-3 ">
                    <span class="input-group-text">
                      <i class="fa fa-money-bill-wave"></i>
                    </span>

                    <input
                      type="number"
                      class="form-control input-lg"
                      name="nuevoPrecioVenta"
                      id="nuevoPrecioVenta"
                      min="0"
                      step="any"
                      placeholder="Precio de venta"
                      aria-label="nuevoPrecioVenta"
                      required>

                    

                  </div>


                  <div class="row">
                    <div class="col-sm-6">

                      <!-- checkbox -->
                      <div class="input-group mb-3">


                        <label for="percentage">
                          <input
                            type="checkbox"
                            class="icheckbox_minimal-blue percentage"
                            id="percentage"
                            onclick="checkboxSelected()"
                            checked>

                          Utilizar porcentaje
                        </label>


                      </div>


                    </div>

                    <!-- Entrada Porcentaje -->
                    <div class="col-sm-6">
                      <div class="input-group mb-3">
                        <span class="input-group-text">
                          <i class="fa fa-percent"></i> </span>

                        <input
                          type="number"
                          class="form-control inpug-lg nuevoPorcentaje"
                          min="0"
                          value="20"
                          aria-label="porcentaje"
                          style="padding: 0 0 0 10px;"
                          required>

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
                  <input type="file" class="nuevaImagen" name="nuevaImagen">
                  <p class="help-block">Peso máximo de la imagen 2MB</p>

                  <img src="/Views/img/productos/default/anonymous.png" alt="imag-subir"
                       class="img-fluid img-thumbnail previsualizar" style="width: 100px">
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

      <?php
        $createProduct = new ProductosController();
        $createProduct -> createProductController();
      ?>

    </div>
  </div>

</div>





<!--==================================
MODAL EDITAR PRODUCTO
==================================-->
<!-- Modal -->
<div
  class="modal fade"
  id="modalEditProduct"
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
            Editar producto
          </h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>

        </div>

        <!--==================================
MODAL BODY
==================================-->
        <div class="modal-body">
          <div class="box-body">

            <div class="form-group">


              <!-- Categoría -->

              <div class="input-group mb-3">
                <span class="input-group-text">
                  <i class="fa fa-th"></i>
                </span>
                <select
                  name="editarCategoria"
                  class="form-select text-gray"
                  id="editarCategoria"
                  aria-label="editarCategoria"
                  readonly
                  required>
                  <option id="categoryEdit"></option>
                </select>
              </div>


              <!-- codigo -->
              <div class="input-group mb-3">
                <span class="input-group-text">
                  <i class="fa fa-code"></i>
                </span>
                <input
                  type="text"
                  class="form-control input-lg"
                  name="editarCodigo"
                  id="editarCodigo"
                  aria-label="editarCodigo"
                  readonly
                  required
                >
              </div>

              <!-- Descripción -->

              <div class="input-group mb-3">
                <span class="input-group-text">
                  <i class="fab fa-product-hunt"></i>
                </span>
                <input
                  type="text"
                  class="form-control input-lg"
                  name="editarDescripcion"
                  id="editarDescripcion"
                  aria-label="editarDescripcion" required>
              </div>


              <!-- Stock -->

              <div class="input-group mb-3">
                <span class="input-group-text">
                  <i class="fa fa-check"></i>
                </span>

                <input
                  type="number"
                  class="form-control input-lg"
                  name="editarStock"
                  id="editarStock"
                  min="0"
                  aria-label="editarStock" required>

              </div>

              <div class="row">

                <!-- precio de compra -->
                <div class="col-lg-6">
                  <div class="input-group mb-3 ">
                    <span class="input-group-text">
                      <i class="fa fa-money-bill-wave"></i>
                    </span>

                    <input
                      type="number"
                      class="form-control input-lg"
                      name="editarPrecioCompra"
                      id="editarPrecioCompra"
                      min="0"
                      step="any"
                      aria-label="editarPrecioCompra" required>

                  </div>
                </div>

                <!-- Precio de venta -->
                <div class="col-lg-6">
                  <div class="input-group mb-3 ">
                    <span class="input-group-text">
                      <i class="fa fa-money-bill-wave"></i>
                    </span>

                    <input
                      type="number"
                      class="form-control input-lg"
                      name="editarPrecioVenta"
                      id="editarPrecioVenta"
                      min="0"
                      step="any"
                      aria-label="editarPrecioVenta"
                      readonly
                      required>
                    
                    
                  </div>


                  <div class="row">
                    <div class="col-sm-6">

                      <!-- checkbox -->
                      <div class="input-group mb-3">


                        <label for="percentageEdit">
                          <input
                              type="checkbox"
                              class="icheckbox_minimal-blue percentage"
                              id="percentageEdit"
                              onclick="checkboxSelectedEdit()"
                              checked>
                          Utilizar porcentaje
                        </label>


                      </div>


                    </div>

                    <!-- Entrada Porcentaje -->
                    <div class="col-sm-6">
                      <div class="input-group mb-3">
                        <span class="input-group-text"> <i class="fa fa-percent"></i> </span>

                        <input
                          type="number"
                          class="form-control inpug-lg nuevoPorcentaje"
                          min="0"
                          value="20"
                          aria-label="porcentaje"
                          style="padding: 0 0 0 10px;"
                          required>

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
                  <input type="file" class="nuevaImagen" name="editarImagen">
                  <p class="help-block">Peso máximo de la imagen 2MB</p>

                  <img src="/Views/img/productos/default/anonymous.png" alt="imag-subir"
                       class="img-fluid img-thumbnail previsualizar" style="width: 100px">
                  <input type="hidden" name="imagenActual" id="imagenActual">
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

          <button type="submit" class="btn btn-primary ml-auto">Guardar cambios</button>

        </div>

      </form>

      <?php
        $editarProducto = new ProductosController();
        $editarProducto -> editProductController() ;
      ?>

    </div>
  </div>

</div>

<?php
  $deleteProduct = new ProductosController();
  $deleteProduct -> deleteProductController();
?>