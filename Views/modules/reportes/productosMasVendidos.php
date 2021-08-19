<?php

$item = null;
$valor = null;
$order = 'ventas';

$productos = ProductosController::showProductsController($item, $valor, $order);

$colors = array(
    '#277da1',
    '#577590',
    '#4d908e',
    '#43aa8b',
    '#90be6d',
    '#f9c74f',
    '#f9844a',
    '#f8961e',
    '#f3722c',
    '#f94144',
);

$colorsPercentage = array('#264653', '#2A9D8F', '#E9C46A', '#F4A261', '#E76F51');


$totalVentas = ProductosController::showSumOfSalesController();


?>

<div class="card card-primary">
  
  <div class="card-header">
    <h3 class="card-title">Productos más Vendidos</h3>
    
  </div>
  
  <div class="card-body">
    <div class="row">
      
      <div class="col-md-7">
        <div class="chart-responsive">
          <canvas id="pieChart" height="150"></canvas>
        </div>
      </div>
     
      <div class="col-md-5">
        <ul class="chart-legend clearfix">
          
          <?php
          for($i = 0; $i <10; $i++){
            echo '<li><i class="far fa-circle" style="color: '.$colors[$i].'; background-color: '.$colors[$i].';  border-radius: 10px;"></i> '
                .$productos[$i]["descripcion"]
                .'</li>';
          }
          ?>
          
        </ul>
      </div>
     
    </div>
  </div>
  

  <div class="card-footer bg-light p-0">
    <ul class="nav nav-pills flex-column">
      
      <?php
      for($i = 0; $i < 5; $i++){
      
        echo '<li class="nav-item">
                <h6 class="nav-link">
                  <img src="'.$productos[$i]['imagen'].'" alt="" width="50px" class="img-thumbnail">
                
                  '.$productos[$i]["descripcion"].'
                  <span class="float-right" style="color: '.$colorsPercentage[$i].'; font-size: 20px; font-weight: bold;">
                    '. ceil(($productos[$i]["ventas"] * 100) / $totalVentas["total"]) .'%
                  </span>
                </h6>
              </li>';
      
      }
      ?>
      
    </ul>
  </div>

  
</div>
<!-- /.card -->




<script>

    var color = [
        '#f94144',
        '#f3722c',
        '#f8961e',
        '#f9844a',
        '#f9c74f',
        '#90be6d',
        '#43aa8b',
        '#4d908e',
        '#577590',
        '#277da1'
    ];
    
    var colors = [
        '#277da1',
        '#577590',
        '#4d908e',
        '#43aa8b',
        '#90be6d',
        '#f9c74f',
        '#f9844a',
        '#f8961e',
        '#f3722c',
        '#f94144',
    ]

    var productsLabel = [<?php
      for($i = 0; $i <10; $i++){
    
        echo '"'.$productos[$i]['descripcion'] . '",';
    
      }
      ?>
    ];
    
    var  productsData = [<?php
      for($i = 0; $i < 10; $i++){
  
        echo $productos[$i]['ventas'] . ',';
    
      }
      ?>
      
    ]
    
    // Get context with jQuery - using jQuery's .get() method.
    var pieChartCanvas = $('#pieChart').get(0).getContext('2d')
    var pieData = {
        labels: productsLabel,
        datasets: [
            {
                data: productsData,
                backgroundColor: colors
            }
        ]
    }
    var pieOptions = {
        legend: {
            display: false
        }
    }
    // Create pie or doughnut chart
    // You can switch between pie and douhnut using the method below.
    // eslint-disable-next-line no-unused-vars
    var pieChart = new Chart(pieChartCanvas, {
        type: 'doughnut',
        data: pieData,
        options: pieOptions
    })
  
  
</script>
