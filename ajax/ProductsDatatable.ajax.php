<?php

class ProductsDatatable{

    // MOSTRAR TABLA PRODUCTOS
    public function showProductsTable():void{
        echo 'hola';
    }
}


// ACTIVAR TABLA PRODUCTOS
$activateProducts = new ProductsDatatable();
$activateProducts -> showProductsTable();