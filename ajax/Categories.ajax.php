<?php 

require_once "../Controllers/CategoriasController.php";
require_once "../Models/CategoriasModel.php";

class Categories{
    
    // VALIDAR SI CATEGORÍA ESTA REGISTRADA 
    public $validarCategoria;

    public function ajaxValidarCategoria(){

        $item = "categoria";
        $valor = $this -> validarCategoria;
        $respuesta = CategoriasController::showCategories($item, $valor);

        echo json_encode($respuesta);   
        
    }

    // EDITAR USUARIOS
    public $idCategoria;

    public function ajaxEditarCategoria(){

        $item = "id";
        $valor = $this -> idCategoria;
        $respuesta = CategoriasController::showCategories($item, $valor);

        echo json_encode($respuesta);        
    }

}


// VALIDAR CATEGORÍA NO SE REPETITE
if(isset($_POST["validarCategoria"])){

    $validarCategoria = new Categories();
    $validarCategoria -> validarCategoria = $_POST['validarCategoria'];
    $validarCategoria -> ajaxValidarCategoria();

}


// EDITAR USUARIOS
if(isset($_POST["idCategoria"])){

    $editar = new Categories();
    $editar -> idCategoria = $_POST['idCategoria'];
    $editar -> ajaxEditarCategoria();

}