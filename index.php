<?php

require_once "funciones/funciones.php";

require_once "Controllers/PlantillaController.php";
require_once "Controllers/CategoriasController.php";
require_once "Controllers/ClientesController.php";
require_once "Controllers/ProductosController.php";
require_once "Controllers/UsuariosController.php";
require_once "Controllers/VentasController.php";

require_once "Models/CategoriasModel.php";
require_once "Models/ClientesModel.php";
require_once "Models/ProductosModel.php";
require_once "Models/UsuariosModel.php";
require_once "Models/VentasModel.php";

$plantilla = new PlantillaController();
$plantilla -> controllerPlantilla();