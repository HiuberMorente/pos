<?php

$item = null;
$valor = null;
$order = 'id';

$productos = ProductosController::showProductsController($item, $valor, $order);

$countProductos = count($productos);

?>

<div class="card card-success">
  <div class="card-header">
    <h3 class="card-title">Productos Recientemente Agregados</h3>
    
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


      if(!empty($productos)){
        for($i = 0; $i < 10; $i++){
          
            
            echo '<li class="item">
              <div class="product-img">
                <img src="'. $productos[$i]["imagen"] .'" alt="Product Image" class="img-size-50">
              </div>
              
              <div class="product-info">
              
                <a href="productos" class="product-title">
                
               '. $productos[$i]["descripcion"] .'
                  <span class="badge badge-success float-right" style="font-size: 16px">
                    Q '. number_format($productos[$i]["precioVenta"],2) .'
                  </span>
                </a>
                
              </div>
              
            </li>';
        }
      }else{
  
        echo '<li class="item">
            <div class="product-img">
            </div>
            
            <div class="product-info">
            
            </div>
            
          </li>';
        
      }
      ?>
      
    </ul>
  </div>

  <div class="card-footer text-center">
    <a href="productos" class="uppercase">Ver Todos los Productos</a>
  </div>

</div>

