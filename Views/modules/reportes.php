<?php

if($_SESSION['perfil'] === "Especial" || $_SESSION['perfil'] === "Vendedor"){
  echo '<script>
          window.location = "inicio";
        </script>';
  
  return;
}

$totalVentas = ProductosController::showSumOfSalesController();

?>

<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1>
              Reporte de ventas
            
          </h1>
        </div>
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="inicio" class=" text-dark">Inicio</a></li>
            <li class="breadcrumb-item active">Reporte de ventas</li>
          </ol>
        </div>
      </div>
    </div>


 
  <section class="content">


    <div class="card">
      
      <div class="card-header">
        <div class="card-title">
          <button type="button" class="btn btn-default" id="daterange-btnReporte">
            <span>
              <i class="fa fa-calendar"></i>
             Rango de fecha
            </span>
  
            <i class="fa fa-caret-down"></i>
          </button>
        </div>
        
        <div class="card-tools" style="margin-right: 3px">
          
          <?php
          
          if(isset($_GET['fechaInicial'])){
            
            echo '<a href="/Views/modules/descargarReporte.php?reporte=reporte&fechaInicial='. $_GET["fechaInicial"]
                .'&fechaFinal='.$_GET["fechaFinal"].'" >';
            
          }else{
  
            echo '<a href="/Views/modules/descargarReporte.php?reporte=reporte">';
            
          }
          
          ?>
          
            <button class="btn btn-success" >Descargar Reporte en Excel</button>
          
          </a>
          
        </div>
          
       
        
        

        
      
      </div>
      
      <div class="card-body">
        <div class="row">
          
          <div class="col-sm-12">
            <?php
              include 'reportes/graficoVentas.php';
            ?>
          </div>
          
          
         
          
          <?php
          if($totalVentas['total'] !== '0' && $totalVentas['total'] !== null){
            echo '<div class="col-md-6 col-sm-12">';
            include 'reportes/productosMasVendidos.php';
            echo '</div>';
          
          }else{
  
            echo '<div class="card card-primary col-lg-6">
  
              <div class="card-header">
                <h3 class="card-title">Productos más Vendidos</h3>
                
              </div>
              
              <div class="card-body">
                <div class="row">
                  
                  <div class="col-md-7">
                    <div class="chart-responsive">
                    
                    </div>
                  </div>
                 
                  <div class="col-md-5">
                    <ul class="chart-legend clearfix">
                    
                    </ul>
                  </div>
                 
                </div>
              </div>
              
            
              <div class="card-footer bg-light p-0">
                <ul class="nav nav-pills flex-column">
                
                
                </ul>
              </div>
            
              
            </div>
            ';
            
          }
          
          
          
          ?>
          
          
          <div class="col-md-6 col-sm-12">
            <?php
            include 'reportes/vendedores.php';

            include 'reportes/compradores.php';
            ?>
            
          </div>
          
         
          
        </div>
      </div>
      
    </div>
   

  </section>
  
</div>


