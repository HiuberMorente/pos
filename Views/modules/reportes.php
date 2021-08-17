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
        <button type="button" class="btn btn-default" id="daterange-btnReporte">
          <span>
            <i class="fa fa-calendar"></i>
           Rango de fecha
          </span>

          <i class="fa fa-caret-down"></i>
        </button>
      </div>
      
      <div class="card-body">
        <div class="row">
          <div class="col-sm-12">
            <?php
              include 'reportes/graficoVentas.php';
            ?>
          </div>
        </div>
      </div>
      
    </div>
   

  </section>
  
</div>


