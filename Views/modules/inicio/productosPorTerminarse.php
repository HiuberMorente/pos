<?php

$item = null;
$valor = null;
$order = 'id';

$productos = ProductosController::showProductsController($item, $valor, $order);





?>

<div class="card card-danger">
  <div class="card-header">
    <h3 class="card-title">Productos por Terminarse</h3>
    
    <div class="card-tools">
      <button type="button" class="btn btn-tool" data-card-widget="collapse">
        <i class="fas fa-minus"></i>
      </button>
      <button type="button" class="btn btn-tool" data-card-widget="remove">
        <i class="fas fa-times"></i>
      </button>
    </div>
  </div>

  <div class="card-body p-0">
    <ul class="products-list product-list-in-card pl-2 pr-2">
      
      <?php
      foreach($productos as $key => $producto){
        if($producto['stock'] > 0 && $producto['stock'] <= 10){
          
          
          echo '<li class="item">
            <div class="product-img">
              <img src="'. $producto["imagen"] .'" alt="Product Image" class="img-size-50">
            </div>
            
            <div class="product-info">
            
              <a href="productos" class="product-title">
              
             '. $producto["descripcion"] .'
                <span class="badge badge-danger float-right" style="font-size: 16px">
                  '. number_format($producto["stock"]) .'
                </span>
              </a>
              
            </div>
            
          </li>';
  
        }
  
      }
      ?>
      
      
  
     
    </ul>
  </div>

  <div class="card-footer text-center">
    <a href="productos" class="uppercase">Ver Todos los Productos</a>
  </div>

</div>

