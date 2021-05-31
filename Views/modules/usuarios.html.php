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
      <div class="card-header">

        <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#modalAgregarUsuario">
          Agregar usaurio
        </button>

      </div>
      <div class="card-body">

        <table class="table table-bordered table-striped tabla dt-responsive ">
          <thead>
            <tr>

              <th width="10px" >#</th>
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
            <tr>
              <td>1</td>
              <td>Usuairo</td>
              <td>Administador</td>
              <td>Admin</td>
              <td><img src="Views/img/usuarios/default/anonymous.png" alt="foto-usuario" class="img-thumbnail" width="40px"></td>
              <td>Administrador</td>
              <td><button class="btn btn-success btn-xs">Activado</button></td>
              <td>2021-05-13 6:54:12</td>
              <td>
                <div class="btn-group">
                  <button type="" class="btn btn-warning"><i class="fa fa-pen text-white"></i></button>
                  <button type="" class="btn btn-danger"><i class="fa fa-times"></i></button>
                </div>
              </td>
            </tr>
            <tr>
              <td>1</td>
              <td>Usuairo</td>
              <td>Administador</td>
              <td>Admin</td>
              <td><img src="Views/img/usuarios/default/anonymous.png" alt="foto-usuario" class="img-thumbnail" width="40px"></td>
              <td>Administrador</td>
              <td><button class="btn btn-success btn-xs">Activado</button></td>
              <td>2021-05-13 6:54:12</td>
              <td>
                <div class="btn-group">
                  <button type="" class="btn btn-warning"><i class="fa fa-pen text-white"></i></button>
                  <button type="" class="btn btn-danger"><i class="fa fa-times"></i></button>
                </div>
              </td>
            </tr>
            <tr>
              <td>1</td>
              <td>Usuairo</td>
              <td>Administador</td>
              <td>Admin</td>
              <td><img src="Views/img/usuarios/default/anonymous.png" alt="foto-usuario" class="img-thumbnail" width="40px"></td>
              <td>Administrador</td>
              <td><button class="btn btn-danger btn-xs">Desactivado</button></td>
              <td>2021-05-13 6:54:12</td>
              <td>
                <div class="btn-group">
                  <button class="btn btn-warning"><i class="fa fa-pen text-white"></i></button>
                  <button class="btn btn-danger"><i class="fa fa-times"></i></button>
                </div>
              </td>
            </tr>
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
<div class="modal fade" id="modalAgregarUsuario" tabindex="-1" aria-labelledby="ModalLabel" aria-hidden="true">

  <div class="modal-dialog">
    <div class="modal-content">

      <form action="" role="form" method="post" enctype="multipart/form-data">
        <!--==================================
        MODAL HEADER
        ==================================-->
        <div class="modal-header bg-secondary">

          <h5 class="modal-title" id="ModalLabel">
            Agregar usuario
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
                <input type="text" class="form-control input-lg" name="nuevoNombre" placeholder="Ingresar nombre" require>
              </div>


              <!-- apellido          -->
              <div class="input-group mb-3">
                <span class="input-group-text">
                  <i class="fa fa-user"></i>
                </span>
                <input type="text" class="form-control input-lg" name="nuevoApellido" placeholder="Ingresar apellido" require>
              </div>



              <!-- usuario -->
              <div class="input-group mb-3">
                <span class="input-group-text">
                  <i class="fa fa-key"></i>
                </span>
                <input type="text" class="form-control input-lg" name="nuevoUsuario" placeholder="Ingresar usuario" require>
              </div>


              <!-- password -->
              <div class="input-group mb-3">
                <span class="input-group-text">
                  <i class="fa fa-lock"></i>
                </span>
                <input type="password" class="form-control input-lg" name="nuevoPassword" placeholder="Ingresar contraseña" require>
              </div>


              <!-- perfil -->
              <div class="input-group mb-3">
                <span class="input-group-text">
                  <i class="fa fa-users"></i>
                </span>
                <select name="nuevoPerfil" class="form-select text-gray">
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
                  <input type="file" id="nuevaFoto" name="nuevaFoto">
                  <p class="help-block">Peso máximo de la foto 200 MB</p>

                  <img src="Views/img/usuarios/default/anonymous.png" alt="imag-subir" class="img-fluid img-thumbnail" width="100px">
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

          <button type="submit" class="btn btn-primary ml-auto">Guardar usuario</button>

        </div>

      </form>
    </div>
  </div>

</div>