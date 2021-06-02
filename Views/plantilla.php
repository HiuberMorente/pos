<?php
  session_start();
?>

<!DOCTYPE html>
<html lang="">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">

  <title>Ferreteria</title>

  <link rel="icon" href="/Views/img/plantilla/icono-blanco.png">

  <!-- Google Font: Source Sans Pro -->
  <link rel="stylesheet"
        href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">

  <!-- bootstrap -->
  <link rel="stylesheet" href="/Views/plugins/bootstrap/css/bootstrap.min.css">

  <!-- Font Awesome -->
  <link rel="stylesheet" href="/Views/plugins/fontawesome-free/css/all.min.css">

  <!-- Theme style -->
  <link rel="stylesheet" href="/Views/dist/css/adminlte.css">

  <!-- AdminLTE Skins -->
  <link rel="stylesheet" href="/Views/dist/css/skins/_all-skins.min.css">

  <!-- DataTables -->
  <link rel="stylesheet" href="/Views/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css">
  <link rel="stylesheet" href="/Views/plugins/datatables-responsive/css/responsive.bootstrap4.min.css">
  <link rel="stylesheet" href="/Views/plugins/datatables-buttons/css/buttons.bootstrap4.min.css">

  <!-- Sweet Alert -->
  <script src="/Views/plugins/sweetalert2/sweetalert2.all.js"></script>

  <!-- iCheck for checkboxes and radio inputs -->
<!--  <link rel="stylesheet" href="/Views/plugins/icheck-bootstrap/icheck-bootstrap.min.css">-->
  <link href="/Views/plugins/icheck-1.0.3/skins/all.css" rel="stylesheet">


</head>

<!--==================================
  CUERPO DOCUMENTO
  ==================================-->

<body class="hold-transition sidebar-collapse sidebar-mini">


<?php

  if(isset($_SESSION["iniciarSesion"]) && $_SESSION["iniciarSesion"] === "ok"){


    echo '<div class="wrapper">';

    // Header
    include "modules/header.php";

    // Menu
    include "modules/menu.php";

    // contenido
    if(isset($_GET["ruta"])){
      if(
        $_GET["ruta"] === "inicio" ||
        $_GET["ruta"] === "usuarios" ||
        $_GET["ruta"] === "categorias" ||
        $_GET["ruta"] === "productos" ||
        $_GET["ruta"] === "clientes" ||
        $_GET["ruta"] === "ventas" ||
        $_GET["ruta"] === "crear_venta" ||
        $_GET["ruta"] === "reportes_venta" ||
        $_GET["ruta"] === "salir"
      ){

        include "modules/" . $_GET["ruta"] . ".php";

      } else{

        include "modules/404.php";

      }
    } else{

      include "modules/inicio.php";

    }

    // footer
    include "modules/footer.php";

    echo '</div>';

  } else{

    include "modules/login.php";

  }

?>


<!--==================================
  JAVASCRIPT
  ==================================-->
<!-- jQuery -->
<script src="/Views/plugins/jquery/jquery.min.js"></script>

<!-- Bootstrap 4 -->
<script src="/Views/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>

<!-- AdminLTE App -->
<script src="/Views/dist/js/adminlte.min.js"></script>

<!-- DataTables  & Plugins -->
<script src="/Views/plugins/datatables/jquery.dataTables.min.js"></script>
<script src="/Views/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js"></script>
<script src="/Views/plugins/datatables-responsive/js/dataTables.responsive.min.js"></script>
<script src="/Views/plugins/datatables-responsive/js/responsive.bootstrap4.min.js"></script>
<script src="/Views/plugins/datatables-buttons/js/dataTables.buttons.min.js"></script>
<script src="/Views/plugins/datatables-buttons/js/buttons.bootstrap4.min.js"></script>
<script src="/Views/plugins/jszip/jszip.min.js"></script>
<script src="/Views/plugins/pdfmake/pdfmake.min.js"></script>
<script src="/Views/plugins/pdfmake/vfs_fonts.js"></script>
<script src="/Views/plugins/datatables-buttons/js/buttons.html5.min.js"></script>
<script src="/Views/plugins/datatables-buttons/js/buttons.print.min.js"></script>
<script src="/Views/plugins/datatables-buttons/js/buttons.colVis.min.js"></script>

<!--icheck-->
<script src="/Views/plugins/icheck-1.0.3/icheck.js"></script>

<!-- plantilla -->
<script src="/Views/js/plantilla.js"></script>

<script src="/Views/js/usuarios.js"></script>
<script src="/Views/js/categorias.js"></script>
<script src="/Views/js/productos.js"></script>


</body>
</html>