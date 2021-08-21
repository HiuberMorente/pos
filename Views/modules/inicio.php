<?php

$totalVentas = ProductosController::showSumOfSalesController();


?>


<div class="content-wrapper">

  <section class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1>
              Tablero
            <small class="text-gray">Panel de Control</small>
          </h1>
        </div>
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="inicio" class=" text-dark">Inicio</a></li>
            <li class="breadcrumb-item active">Tablero</li>
          </ol>
        </div>
      </div>
    </div>
  </section>



  <section class="content">
   
    <div class="row">

      <?php
      
      if($_SESSION['perfil'] === 'Administrador'){
        
        include "inicio/cajasSuperiores.php";
        
      }
      
      
      ?>
      
    </div>
    
    <div class="row">
      <div class="col-lg-12">
        <?php
        if($_SESSION['perfil'] === 'Administrador'){
          include "reportes/graficoVentas.php";
        }
        ?>
      </div>
      
      
      <?php
      if($totalVentas['total'] !== '0' && $totalVentas['total'] !== null){
  
        echo '<div class="col-lg-6">';
        if($_SESSION['perfil'] === 'Administrador'){
          include "reportes/productosMasVendidos.php";
        }
        
        echo '</div>';
        
        
      }else {
        
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
      
      
      <div class="col-lg-6">
        <?php
        if($_SESSION['perfil'] === 'Administrador'){
          include "inicio/productosRecientes.php";
        }
        ?>
      </div>
      
      <div class="col-lg-12">
        <?php
        if($_SESSION['perfil'] === 'Vendedor' || $_SESSION['perfil'] === 'Especial'){
          
          
          echo ' <div class="" style="text-align: center">
              <h1>Bienvenid@ '. $_SESSION['nombre'] .' '. $_SESSION['apellido'] .'</h1>
              <br>
              <div>
                <img src="/Views/img/plantilla/ferreteria-png.jpg" alt="homeImage" style="width: 50%; border-radius: 50px">
              </div>
            </div>';
        
        }
        ?>
      </div>
      
    </div>

    <div class="row">
      <div class="col-lg-6">
        <?php
        if($_SESSION['perfil'] === 'Administrador'){
          include "inicio/productosPorTerminarse.php";
        }
        ?>
      </div>
      <div class="col-lg-6">
        <?php
        if($_SESSION['perfil'] === 'Administrador'){
          include "inicio/productosWarningTerminarse.php";
        }
        ?>
      </div>

    </div>
    

  </section>

</div>

