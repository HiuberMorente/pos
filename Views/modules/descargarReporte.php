<?php

require_once "../../Controllers/VentasController.php";
require_once "../../Models/VentasModel.php";

require_once "../../Controllers/ClientesController.php";
require_once "../../Models/ClientesModel.php";

require_once "../../Controllers/UsuariosController.php";
require_once "../../Models/UsuariosModel.php";

$reporte = new VentasController();
$reporte -> downloadReportController();

