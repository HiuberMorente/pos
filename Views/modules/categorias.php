<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1>
            Administrar categorías

          </h1>
        </div>
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="inicio" class=" text-dark"></i>Inicio</a></li>
            <li class="breadcrumb-item active">Administrar categorías</li>
          </ol>
        </div>
      </div>
    </div>
  </section>


  <section class="content">

    <div class="card">
      <div class="card-header">

        <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#modalAgregarCategoria">
          Agregar categoría
        </button>

      </div>
      <div class="card-body">
        <div class="row">
          <div class="col-lg-12">

            <table id="tabla" class="table table-bordered table-striped display nowrap" width="100%">
              <thead>
                <tr>

                  <th width="10px" >#</th>
                  <th>Categoría</th>
                  <th>Acciones</th>

                </tr>
              </thead>

              <tbody>

                <?php 

                  $item = null;
                  $valor = null;

                  $categorias = CategoriasController::controllerMostrarCategoria($item, $valor);

                  foreach ($categorias as $key => $value) {

                    echo '<tr>
                            <td>'.($key + 1).'</td>
                            <td class="text-uppercase">' . $value["categoria"] . '</td>

                            <td>                    
                              <div class="btn-group">
                                
                                <button type="" class="btn btn-warning btnEditarCategoria" idCategoria="'.$value["id"].'"  data-bs-toggle="modal" data-bs-target="#EditarCategoria"><i class="fa fa-pen text-white"></i></button>
                                
                                <button type="" class="btn btn-danger btnEliminarCategoria" idCategoria="'.$value["id"].'" ><i class="fa fa-times" ></i></button>
        
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
MODAL AGREGAR CATEGORÍA
==================================-->
<!-- Modal -->
<div class="modal fade" id="modalAgregarCategoria" tabindex="-1" aria-labelledby="ModalLabel" aria-hidden="true">

  <div class="modal-dialog">
    <div class="modal-content">

      <form action="" role="form" method="post">
        <!--==================================
        MODAL HEADER
        ==================================-->
        <div class="modal-header bg-secondary">

          <h5 class="modal-title" id="ModalLabel">
            Agregar categoría
          </h5>
          <button type="button" class="btn-close quitarAlerta" data-bs-dismiss="modal" aria-label="Close"></button>

        </div>

        <!--==================================
        MODAL BODY
        ==================================-->
        <div class="modal-body">
          <div class="box-body">

            <div class="form-group">

              <!-- categoria -->
              <div class="input-group mb-3">
                <span class="input-group-text">
                  <i class="fa fa-th"></i>
                </span>
                <input type="text" class="form-control input-lg" name="nuevaCategoria" id="nuevaCategoria" placeholder="Ingresar categoría" required>
              </div>

            </div>

          </div>
        </div>

        <!--==================================
        MODAL FOOTER
        ==================================-->
        <div class="modal-footer">
          <button type="button" class="btn btn-default d-flex quitarAlerta" data-bs-dismiss="modal">Salir</button>

          <button type="submit" class="btn btn-primary ml-auto">Guardar categoría</button>

        </div>

        <?php 
          $crearCategoria = new CategoriasController();
          $crearCategoria -> controllerCrearCategoria(); 
        ?>

      </form>
    </div>
  </div>

</div>



<!--==================================
MODAL EDITAR CATEGORÍA
==================================-->
<!-- Modal -->
<div id="EditarCategoria" class="modal fade" role="dialog">

  <div class="modal-dialog">
    <div class="modal-content">

      <form role="form" method="post" enctype="multipart/form-data">
        <!--==================================
        MODAL HEADER
        ==================================-->
        <div class="modal-header bg-secondary">

          <h4 class="modal-title">Editar categoría</h4>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>

        </div>

        <!--==================================
        MODAL BODY
        ==================================-->
        <div class="modal-body">
          <div class="box-body">

            <div class="form-group">

              <!-- categoria -->
              <div class="input-group mb-3">
                <span class="input-group-text">
                  <i class="fa fa-th"></i>
                </span>

                <input type="text" class="form-control input-lg" name="editarCategoria" id="editarCategoria" required>
                
                <input type="hidden" name="idCategoria" id="idCategoria">

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

        <?php

          $editarCategoria = new CategoriasController();
          $editarCategoria->controllerEditarCategoria();

        ?>


      </form>

    </div>
  </div>
</div>

<?php 
  $eliminarCategoria = new CategoriasController();
  $eliminarCategoria -> controllerBorrarCategoria();
?>