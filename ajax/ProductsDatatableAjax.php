<?php

class ProductsDatatableAjax{

    // MOSTRAR TABLA PRODUCTOS
    public function showProductsTable():void{
        echo 'hola';
    }
}


// ACTIVAR TABLA PRODUCTOS
$activateProducts = new ProductsDatatableAjax();
$activateProducts -> showProductsTable();