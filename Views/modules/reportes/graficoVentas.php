<?php

error_reporting(0);

if(isset($_GET['fechaInicial'])){
  
  $fechaInicial = $_GET['fechaInicial'];
  $fechaFinal = $_GET['fechaFinal'];
  
}else{
  
  $fechaInicial = null;
  $fechaFinal = null;
  
}

$response = VentasController::showRangeSalesDateController($fechaInicial, $fechaFinal);

$arrayFechas = array();
$arrayVentas = array();
$sumaPagosMes = array();

foreach($response as $key => $item){
  
  //obtener anio, mes y dia
  $fecha = substr($item['fecha'], 0 ,7);
  
  //introducir fechas en el array
  $arrayFechas[] = $fecha;
  
  //capturar las ventas
  $arrayVentas = array($fecha => $item['total']);
  
  //sumar las ventas de un mismo mes
  foreach($arrayVentas as $key => $value){
    
    $sumaPagosMes[$key] += $value;
    
  }
  
}

$noRepetirFechas = array_unique($arrayFechas);




?>


<div class="card bg-gradient-info">
 
  <div class="card-header border-0">
    <h3 class="card-title">
      <i class="fas fa-th mr-1"></i>
      Gráfica de Ventas
    </h3>
  </div>
  
  <div class="card-body">
    <div id="myfirstchart" style="height: 250px;"></div>
  </div>
</div>


<!-- solid sales graph -->
<!--<div class="card bg-gradient-info">-->
<!--  -->
<!--  <div class="card-header border-0">-->
<!--    <h3 class="card-title">-->
<!--      <i class="fas fa-th mr-1"></i>-->
<!--      Sales Graph-->
<!--    </h3>-->
<!--  </div>-->
<!--  -->
<!--  <div class="card-body">-->
<!--    <canvas class="chart" id="line-chart" style="min-height: 250px; height: 250px; max-height: 250px; max-width: 100%;"></canvas>-->
<!--  </div>-->
<!---->
<!--</div>-->





<script>

    var fechasLabel = [<?php
      foreach($noRepetirFechas as $key){
        echo '"'. $key .'",';
      }
      ?>
    ];


    var ventasData = [<?php
      foreach($noRepetirFechas as $key){
        echo  $sumaPagosMes[$key] .',';
      }
      ?>
    ];

    var datosD = [<?php
      foreach($noRepetirFechas as $key){
        echo '{y:"' . $key . '"  , ventas: ' . $sumaPagosMes[$key] . ' },';
      }
      ?>
    
    ];
    

    
    
    //MORRIS GRAPH
  
  new Morris.Line({
      element: 'myfirstchart',
      resize: true,
      data: datosD,
      
      xkey: 'y',
      ykeys: ['ventas'],
      labels: ['Ventas'],
      lineColors: ['#efefef'],
      lineWidth: 4,
      hideHover: 'auto',
      gridTextColor:'#efefef',
      gridStrokeWidth: 0.4,
      pointSize: 4,
      pointStrokeColors: ['#efefef'],
      gridLineColor: '#efefef',
      gridTextFamily: 'Open Sans',
      preUnits: 'Q ',
      gridTextSize: 18
    });





  
  

  // // Sales graph chart
  // var salesGraphChartCanvas = $('#line-chart').get(0).getContext('2d')
  // // $('#revenue-chart').get(0).getContext('2d');
  //
  // var salesGraphChartData = {
  //     labels: fechasLabel,
  //     datasets: [
  //         {
  //             label: 'Ventas',
  //             fill: false,
  //             borderWidth: 4,
  //             lineTension: 0,
  //             spanGaps: true,
  //             borderColor: '#000',
  //             pointRadius: 5,
  //             pointHoverRadius: 10,
  //             pointColor: '#efefef',
  //             pointBackgroundColor: '#efefef',
  //             data: ventasData
  //         }
  //     ]
  // }
  //
  // var salesGraphChartOptions = {
  //     maintainAspectRatio: false,
  //     responsive: true,
  //     legend: {
  //         display: false
  //     },
  //     scales: {
  //         xAxes: [{
  //             ticks: {
  //                 fontColor: '#efefef'
  //             },
  //             gridLines: {
  //                 display: false,
  //                 color: '#efefef',
  //                 drawBorder: true
  //             }
  //         }],
  //         yAxes: [{
  //             ticks: {
  //                 stepSize: 50000,
  //                 fontColor: '#efefef'
  //             },
  //             gridLines: {
  //                 display: true,
  //                 color: '#efefef',
  //                 drawBorder: true
  //             }
  //         }]
  //     }
  // }
  //
  // // This will get the first returned node in the jQuery collection.
  // // eslint-disable-next-line no-unused-vars
  // var salesGraphChart = new Chart(salesGraphChartCanvas, { // lgtm[js/unused-local-variable]
  //     type: 'line',
  //     data: salesGraphChartData,
  //     options: salesGraphChartOptions
  // })

  
  
  
</script>




