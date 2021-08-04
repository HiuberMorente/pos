<?php

  class UsuariosController{

    // INGRESO DE USUARIOS
    static public function controllerUsuarioIngreso(){
      if(isset($_POST["ingUsuario"])){
        if(preg_match('/^[a-zA-Z0-9]+$/', $_POST["ingUsuario"]) && preg_match('/^[a-zA-Z0-9]+$/', $_POST["ingPassword"])){


          $table = "usuarios";

          $encriptar = crypt($_POST["ingPassword"], '$2a$07$usesomesillystringforsalt$');

          $item = "usuario";
          $valor = $_POST["ingUsuario"];

          $respuesta = UsuariosModel ::modelMostrarUsuario($table, $item, $valor);


          if($respuesta["usuario"] == $_POST["ingUsuario"] && $respuesta["password"] == $encriptar){

            if($respuesta["estado"] == 1){

              $_SESSION["iniciarSesion"] = "ok";
              $_SESSION["id"] = $respuesta["id"];
              $_SESSION["nombre"] = $respuesta["nombre"];
              $_SESSION["apellido"] = $respuesta["apellido"];
              $_SESSION["usuario"] = $respuesta["usuario"];
              $_SESSION["foto"] = $respuesta["foto"];
              $_SESSION["perfil"] = $respuesta["perfil"];


              // REGISTRAR ULTIMO LOGIN
              date_default_timezone_set('America/Guatemala');

              $fecha = date('Y-m-d');
              $hora = date('H:i:s');

              $fehcaActual = $fecha . ' ' . $hora;

              $item1 = "ultimoLogin";
              $valor1 = $fehcaActual;

              $item2 = "id";
              $valor2 = $respuesta["id"];

              $ultimo_login = UsuariosModel ::modelActualizarUsuario($table, $item1, $valor1, $item2, $valor2);

              if($ultimo_login === "ok"){

                echo '<script> 
                                window.location.href = "inicio";
                            </script>';

              }

            } else{
              echo '<br><div class="alert alert-danger">El usuario aún no está activado.</div>';
            }
          } else{
            echo '<br><div class="alert alert-danger">Error al ingresar, vuelve a intentarlo.</div>';
          }
        }
      }
    }

    // MOSTRAR USUARIOS
    static public function controllerMostrarUsuario($item, $valor){

      $tabla = "usuarios";

      return UsuariosModel ::modelMostrarUsuario($tabla, $item, $valor);
    }

    // CREAR USUARIOS

    /**
     * @throws Exception
     */
    static public function controllerCrearUsuario(){
      if(isset($_POST["nuevoUsuario"])){
        if(
           preg_match('/^[\w]+$/', $_POST["nuevoNombre"]) &&
           preg_match('/^[a-zA-Z0-9ñÑáéíóúÁÉÍÓÚ ]+$/', $_POST["nuevoApellido"]) &&
           preg_match('/^[a-zA-Z0-9 ]+$/', $_POST["nuevoUsuario"]) &&
           preg_match('/^[a-zA-Z0-9 ]+$/', $_POST["nuevoPassword"])
        ){


          $ruta = "";
          if($_FILES["nuevaFoto"]["tmp_name"] == ""){
            $_FILES["nuevaFoto"]["tmp_name"] = "Views/img/usuarios/default/anonymous.png";
          }
          // VALIDAR IMAGEN
          if(isset($_FILES["nuevaFoto"]["tmp_name"])){


            list($ancho, $alto) = getimagesize($_FILES["nuevaFoto"]["tmp_name"]);

            $nuevoAncho = 500;
            $nuevoAlto = 500;


            // DIRECTORIO FOTO USUARIO
            $directorio = "Views/img/usuarios/" . $_POST["nuevoUsuario"];

            if(!mkdir($directorio, 0755) && !is_dir($directorio)){
              throw new \RuntimeException(sprintf('Directory "%s" was not created', $directorio));
            }


            // VALIDACIONES DE ACUERDO AL TIPO IMAGEN
            if($_FILES["nuevaFoto"]["type"] === "image/jpeg"){

              // GUARDAR IMAGEN EN DIRECTORIO

              $aleatorio = random_int(100, 999);

              $ruta = "Views/img/usuarios/" . $_POST["nuevoUsuario"] . "/" . $aleatorio . ".jpeg";

              $origen = imagecreatefromjpeg($_FILES["nuevaFoto"]["tmp_name"]);

              $destino = imagecreatetruecolor($nuevoAncho, $nuevoAlto);

              imagecopyresized($destino, $origen, 0, 0, 0, 0, $nuevoAncho, $nuevoAlto, $ancho, $alto);

              imagejpeg($destino, $ruta);
            }

            if($_FILES["nuevaFoto"]["type"] === "image/png"){

              // GUARDAR IMAGEN EN DIRECTORIO

              $aleatorio = random_int(100, 999);

              $ruta = "Views/img/usuarios/" . $_POST["nuevoUsuario"] . "/" . $aleatorio . ".png";

              $origen = imagecreatefrompng($_FILES["nuevaFoto"]["tmp_name"]);

              $destino = imagecreatetruecolor($nuevoAncho, $nuevoAlto);

              imagecopyresized($destino, $origen, 0, 0, 0, 0, $nuevoAncho, $nuevoAlto, $ancho, $alto);

              imagepng($destino, $ruta);
            }
          }

          $tabla = "usuarios";

          $encriptar = crypt($_POST["nuevoPassword"], '$2a$07$usesomesillystringforsalt$');

          $datos = array(
             'nombre' => $_POST["nuevoNombre"],
             'apellido' => $_POST["nuevoApellido"],
             'usuario' => $_POST["nuevoUsuario"],
             'password' => $encriptar,
             'perfil' => $_POST["nuevoPerfil"],
             'foto' => $ruta
          );

          $respuesta = UsuariosModel ::modelIngresarUsuario($tabla, $datos);

          if($respuesta === "ok"){
            echo '<script>
                        Swal.fire({
                            icon: "success",
                            title: "¡Usuario ha sido guardado correctamente!",
                            confirmButtonText: "Cerrar"
                        }).then((result) => {
                            if(result.value){
                                window.location = "usuarios";
                            }
                        });     
                    
                    </script>';
          }
        } else{
          echo '<script>
                Swal.fire({
                    icon: "error",
                    title: "¡El usuario no puede ir vacío o llevar caracteres especiales!",
                    confirmButtonText: "Cerrar"
                }).then((result) => {
                    if(result.value){
                        window.location = "usuarios";
                    }
                });     
                
                </script>';
        }
      }
    }

    // EDITAR USUARIOS
    static public function controllerEditarUsuario(){
      if(isset($_POST["editarUsuario"])){
        if(
           preg_match('/^[a-zA-Z0-9ñÑáéíóúÁÉÍÓÚ ]+$/', $_POST["editarNombre"]) &&
           preg_match('/^[a-zA-Z0-9ñÑáéíóúÁÉÍÓÚ ]+$/', $_POST["editarApellido"])
        ){

          // VALIDAR IMAGEN
          $ruta = $_POST["fotoActual"];

          if(isset($_FILES["editarFoto"]["tmp_name"]) && !empty($_FILES["editarFoto"]["tmp_name"])){

            list($ancho, $alto) = getimagesize($_FILES["editarFoto"]["tmp_name"]);

            $nuevoAncho = 500;
            $nuevoAlto = 500;


            // DIRECTORIO FOTO USUARIO
            $directorio = "Views/img/usuarios/" . $_POST["editarUsuario"];

            // VERIFICAR SI EXISTE IMAGEN
            if(!empty($_POST["fotoActual"])){

              unlink($_POST["fotoActual"]);

            } else{

              if(!mkdir($directorio, 0755) && !is_dir($directorio)){
                throw new \RuntimeException(sprintf('Directory "%s" was not created', $directorio));
              }
            }


            // VALIDACIONES DE ACUERDO AL TIPO IMAGEN
            if($_FILES["editarFoto"]["type"] === "image/jpeg"){

              // GUARDAR IMAGEN EN DIRECTORIO

              $aleatorio = mt_rand(100, 999);

              $ruta = "Views/img/usuarios/" . $_POST["editarUsuario"] . "/" . $aleatorio . ".jpeg";

              $origen = imagecreatefromjpeg($_FILES["editarFoto"]["tmp_name"]);

              $destino = imagecreatetruecolor($nuevoAncho, $nuevoAlto);

              imagecopyresized($destino, $origen, 0, 0, 0, 0, $nuevoAncho, $nuevoAlto, $ancho, $alto);

              imagejpeg($destino, $ruta);
            }

            if($_FILES["editarFoto"]["type"] === "image/png"){

              // GUARDAR IMAGEN EN DIRECTORIO

              $aleatorio = mt_rand(100, 999);

              $ruta = "Views/img/usuarios/" . $_POST["editarUsuario"] . "/" . $aleatorio . ".png";

              $origen = imagecreatefrompng($_FILES["editarFoto"]["tmp_name"]);

              $destino = imagecreatetruecolor($nuevoAncho, $nuevoAlto);

              imagecopyresized($destino, $origen, 0, 0, 0, 0, $nuevoAncho, $nuevoAlto, $ancho, $alto);

              imagepng($destino, $ruta);
            }
          }

          $tabla = "usuarios";

          if($_POST["editarPassword"] != ""){

            if(preg_match('/^[a-zA-Z0-9 ]+$/', $_POST["editarPassword"])){

              $encriptar = crypt($_POST["editarPassword"], '$2a$07$usesomesillystringforsalt$');


            } else{

              echo '<script>
                                Swal.fire({
                                    icon: "error",
                                    title: "¡La contraseña no puede ir vacío o llevar caracteres especiales!",
                                    confirmButtonText: "Cerrar"
                                }).then((result) => {
                                    if(result.value){
                                        window.location = "usuarios";
                                    }
                                });     
                                
                            </script>';
            }

          } else{

            $encriptar = $_POST["passwordActual"];

          }


          $datos = array(
             'nombre' => $_POST["editarNombre"],
             'apellido' => $_POST["editarApellido"],
             'usuario' => $_POST["editarUsuario"],
             'password' => $encriptar,
             'perfil' => $_POST["editarPerfil"],
             'foto' => $ruta
          );

          $respuesta = UsuariosModel ::modelEditarUsuario($tabla, $datos);

          if($respuesta === "ok"){
            echo '<script>
                        Swal.fire({
                            icon: "success",
                            title: "¡Usuario ha sido cambiado correctamente!",
                            confirmButtonText: "Cerrar"
                        }).then((result) => {
                            if(result.value){
                                window.location = "usuarios";
                            }
                        });     
                    
                    </script>';
          }

        } else{

          echo '<script>
                Swal.fire({
                    icon: "error",
                    title: "¡La nombre no puede ir vacío o llevar caracteres especiales!",
                    confirmButtonText: "Cerrar"
                }).then((result) => {
                    if(result.value){
                        window.location = "usuarios";
                    }
                });     
                
                </script>';

        }
      }
    }

    // BORRAR USUARIO
    static public function controllerBorrarUsuario(){

      if(isset($_GET["idUsuario"])){

        $tabla = "usuarios";
        $datos = $_GET["idUsuario"];


        if($_GET["fotoUsuario"] != ""){
          unlink($_GET["fotoUsuario"]);
          rmdir('Views/img/usuarios/' . $_GET["usuario"]);
        }

        $respuesta = UsuariosModel ::modelBorrarUsuario($tabla, $datos);

        if($respuesta === "ok"){
          echo '<script>
                    Swal.fire({
                        icon: "success",
                        title: "¡Usuario ha sido eliminado correctamente!",
                        confirmButtonText: "Cerrar"
                    }).then((result) => {
                        if(result.value){
                            window.location = "usuarios";
                        }
                    });     
                
                </script>';
        }


      }
    }


  }
 