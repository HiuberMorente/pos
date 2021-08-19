<?php

$item = null;
$valor = null;
$order = 'id';
$valorTotal = 'total';
$valorNeto = 'neto';
$valorProductos = 'precioCompra';


$ventasTotal = VentasController::showSumOfSalesController($valorTotal);
$ventasNeto = VentasController::showSumOfSalesController($valorNeto);



$categorias = CategoriasController::showCategories($item, $valor);

$totalCategorias = count($categorias);

$clientes = ClientesController::showClientsController($item, $valor);

$totalClientes = count($clientes);

$productos = ProductosController::showProductsController($item, $valor, $order);
$totalProductos = count($productos);

$productosSumaTotal = ProductosController::showSumOfProductsController($valorProductos);




?>


<div class="col-lg-3 col-6">

  <div class="small-box bg-info">
    
    <div class="inner">
      <h3>Q <?php echo number_format($ventasTotal['total'],2); ?></h3>

      <p>Total con Impuesto</p>
      
      
    </div>
    
    <div class="icon">
      <i class="fab fa-quora"></i>
    </div>
    
    <a href="ventas" class="small-box-footer">
      Más info
      <i class="fas fa-arrow-circle-right"></i>
    </a>
    
  </div>
  
</div>

<div class="col-lg-3 col-6">

  <div class="small-box bg-info">

    <div class="inner">
      <h3>Q <?php echo number_format($ventasNeto['neto'],2); ?></h3>

      <p>Total Neto</p>
      
      
    </div>

    <div class="icon">
      <i class="fab fa-quora"></i>
    </div>

    <a href="ventas" class="small-box-footer">
      Más info
      <i class="fas fa-arrow-circle-right"></i>
    </a>

  </div>
  
</div>


<div class="col-lg-3 col-6">

  <div class="small-box bg-info">

    <div class="inner">
      <h3>Q <?php echo number_format($productosSumaTotal['precioCompra'],2); ?></h3>

      <p>Total Invertido</p>
    </div>

    <div class="icon">
      <i class="fab fa-quora"></i>
    </div>

    <a href="productos" class="small-box-footer">
      Más info
      <i class="fas fa-arrow-circle-right"></i>
    </a>

  </div>



</div>



<div class="col-lg-3 col-6">
 
  <div class="small-box bg-success">
    <div class="inner">
      <h3><?php echo number_format($totalCategorias); ?></h3>

      <p>Categorías</p>
    </div>
    <div class="icon">
      <i class="fas fa-clipboard-list"></i>
    </div>
    <a href="categorias" class="small-box-footer">
      Más info
      <i class="fas fa-arrow-circle-right"></i>
    </a>
  </div>
  
</div>


<div class="col-lg-3 col-6">

  <div class="small-box bg-warning">
    <div class="inner">
      <h3><?php echo number_format($totalClientes); ?></h3>

      <p>Clientes</p>
    </div>
    <div class="icon">
      <i class="fas fa-user-plus"></i>
    </div>
    <a href="clientes" class="small-box-footer">
      Más info
      <i class="fas fa-arrow-circle-right"></i>
    </a>
  </div>
  
</div>


<div class="col-lg-3 col-6">

  <div class="small-box bg-danger">
    <div class="inner">
      <h3><?php echo number_format($totalProductos); ?></h3>

      <p>Productos</p>
    </div>
    
    <div class="icon">
      <i class="fas fa-shopping-cart"></i>
    </div>
    
    <a href="productos" class="small-box-footer">
      Más info
      <i class="fas fa-arrow-circle-right"></i>
    </a>
    
  </div>
  
</div>

