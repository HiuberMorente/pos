<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1>
            Administrar usuarios

          </h1>
        </div>
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="inicio" class=" text-dark"></i>Inicio</a></li>
            <li class="breadcrumb-item active">Administrar usuarios</li>
          </ol>
        </div>
      </div>
    </div>
  </section>


  <section class="content">

    <div class="card">
      <div class="card-header with-border">

        <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#modalAgregarUsuario">
          Agregar usuario
        </button>

      </div>

      <div class="card-body">
        <div class="row">
          <div class="col-lg-12">

            <table id="tabla" class="table table-bordered table-striped display nowrap" cellspacing="0" width="100%">
              <thead>
                <tr>

                  <th width="10px">#</th>
                  <th>Nombre</th>
                  <th>Apellido</th>
                  <th>Usuario</th>
                  <th>Foto</th>
                  <th>Perfil</th>
                  <th>Estado</th>
                  <th>Último login</th>
                  <th>Acciones</th>

                </tr>
              </thead>

              <tbody>

                <?php

                $item = null;
                $valor = null;
                $usuarios = UsuariosController::controllerMostrarUsuario($item, $valor);

                foreach ($usuarios as $key => $value) {

                  echo '<tr>
                          <td>'.($key + 1).'</td>
                          <td>' . $value["nombre"] . '</td>
                          <td>' . $value["apellido"] . '</td>
                          <td>' . $value["usuario"] . '</td>';

                  if ($value["foto"] != "") {

                    echo '<td><img src="' . $value["foto"] . '" alt="foto-usuario" class="img-thumbnail" width="40px"></td>';
                  } else {

                    echo '<td><img src="Views/img/usuarios/default/anonymous.png" alt="foto-usuario" class="img-thumbnail" width="40px"></td>';
                  }



                  echo '<td>' . $value["perfil"] . '</td>';

                  if($value["estado"] != 0){

                    echo '<td><button class="btn btn-success btn-xs btnActivar" idUsuario="'.$value["id"].'" estadoUsuario="0" >Activado</button></td>';

                  }else{

                    echo '<td><button class="btn btn-danger btn-xs btnActivar" idUsuario="'.$value["id"].'" estadoUsuario="1" >Desactivado</button></td>';

                  }
                  
                  echo '<td>' . $value["ultimoLogin"] . '</td>
                    <td>
                      <div class="btn-group">
                        
                        <button type="" class="btn btn-warning btnEditarUsuario" idUsuario="' . $value["id"] . '" data-bs-toggle="modal" data-bs-target="#EditarUsuario"><i class="fa fa-pen text-white"></i></button>
                        
                        <button type="" class="btn btn-danger btnEliminarUsuario" idUsuario="'.$value["id"].'" fotoUsuario="'.$value["foto"].'" usuario="'.$value["usuario"].'" ><i class="fa fa-times" ></i></button>

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
MODAL REGISTRO USUARIO
==================================-->
<!-- Modal -->
<div class="modal fade" id="modalAgregarUsuario" role="dialog">

  <div class="modal-dialog">
    <div class="modal-content">

      <form role="form" method="post" enctype="multipart/form-data">
        <!--==================================
        MODAL HEADER
        ==================================-->
        <div class="modal-header bg-secondary">

          <h4 class="modal-title">Agregar usuario</h4>
          <button type="button" class="btn-close quitarAlerta" data-bs-dismiss="modal" aria-label="Close"></button>

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
                <input type="text" class="form-control input-lg" name="nuevoNombre" placeholder="Ingresar nombre" required>
              </div>


              <!-- apellido          -->
              <div class="input-group mb-3">
                <span class="input-group-text">
                  <i class="fa fa-user"></i>
                </span>
                <input type="text" class="form-control input-lg" name="nuevoApellido" placeholder="Ingresar apellido" required>
              </div>



              <!-- usuario -->
              <div class="input-group mb-3">
                <span class="input-group-text">
                  <i class="fa fa-key"></i>
                </span>
                <input type="text" class="form-control input-lg" name="nuevoUsuario" id="nuevoUsuario" placeholder="Ingresar usuario" required>
              </div>


              <!-- password -->
              <div class="input-group mb-3">
                <span class="input-group-text">
                  <i class="fa fa-lock"></i>
                </span>
                <input type="password" class="form-control input-lg" name="nuevoPassword" placeholder="Ingresar contraseña" required>
              </div>


              <!-- perfil -->
              <div class="input-group mb-3">
                <span class="input-group-text">
                  <i class="fa fa-users"></i>
                </span>
                <select name="nuevoPerfil" class="form-select text-gr">
                  <option value="">Selecionar perfil</option>
                  <option value="Administrador">Administrador</option>
                  <option value="Especial">Especial</option>
                  <option value="Vendedor">Vendedor</option>
                </select>
              </div>


              <!-- foto -->
              <div class="input-group mb-3">
                <div class="panel">
                  SUBIR FOTO

                  <br><br>
                  <input type="file" class="nuevaFoto" name="nuevaFoto">
                  <p class="help-block">Peso máximo de la foto 2 MB</p>

                  <img src="Views/img/usuarios/default/anonymous.png" alt="imag-subir" class="img-fluid img-thumbnail previsualizar" width="100px">

                </div>

              </div>

            </div>
          </div>

        </div>

        <!--==================================
        MODAL FOOTER
        ==================================-->
        <div class="modal-footer">
          <button type="button" class="btn btn-default d-flex quitarAlerta" data-bs-dismiss="modal">Salir</button>

          <button type="submit" class="btn btn-primary ml-auto">Guardar usuario</button>

        </div>


        <?php

        $crearUsuario = new UsuariosController();
        $crearUsuario->controllerCrearUsuario();

        ?>

      </form>

    </div>
  </div>
</div>


<!--==================================
MODAL EDITAR USUARIO
==================================-->
<!-- Modal -->
<div id="EditarUsuario" class="modal fade" role="dialog">

  <div class="modal-dialog">
    <div class="modal-content">

      <form role="form" method="post" enctype="multipart/form-data">
        <!--==================================
        MODAL HEADER
        ==================================-->
        <div class="modal-header bg-secondary">

          <h4 class="modal-title">Editar usuario</h4>
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
                <input type="text" class="form-control input-lg" name="editarNombre" id="editarNombre" value="" required>
              </div>


              <!-- apellido          -->
              <div class="input-group mb-3">
                <span class="input-group-text">
                  <i class="fa fa-user"></i>
                </span>
                <input type="text" class="form-control input-lg" name="editarApellido" id="editarApellido" value="" required>
              </div>



              <!-- usuario -->
              <div class="input-group mb-3">
                <span class="input-group-text">
                  <i class="fa fa-key"></i>
                </span>
                <input type="text" class="form-control input-lg" name="editarUsuario" id="editarUsuario" value="" readonly>
              </div>


              <!-- password -->
              <div class="input-group mb-3">
                <span class="input-group-text">
                  <i class="fa fa-lock"></i>
                </span>
                <input type="password" class="form-control input-lg" name="editarPassword" placeholder="Nueva contraseña (opcional)">
                <input type="hidden" id="passwordActual" name="passwordActual">
              </div>


              <!-- perfil -->
              <div class="input-group mb-3">
                <span class="input-group-text">
                  <i class="fa fa-users"></i>
                </span>
                <select name="editarPerfil" class="form-select text-gray">
                  <option value="" id="editarPerfil"></option>
                  <option value="Administrador">Administrador</option>
                  <option value="Especial">Especial</option>
                  <option value="Vendedor">Vendedor</option>
                </select>
              </div>


              <!-- foto -->
              <div class="input-group mb-3">
                <div class="panel">
                  SUBIR FOTO

                  <br><br>
                  <input type="file" class="nuevaFoto" name="editarFoto">
                  <p class="help-block">Peso máximo de la foto 2 MB</p>

                  <img src="Views/img/usuarios/default/anonymous.png" alt="imag-subir" class="img-fluid img-thumbnail previsualizar" width="100px">

                  <input type="hidden" name="fotoActual" id="fotoActual">

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

        <?php

        $crearUsuario = new UsuariosController();
        $crearUsuario->controllerEditarUsuario();

        ?>


      </form>

    </div>
  </div>
</div>

<?php 

  $borrarUsuario = new UsuariosController();
  $borrarUsuario -> controllerBorrarUsuario();

?>