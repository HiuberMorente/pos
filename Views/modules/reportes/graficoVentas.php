<?php

if(isset($_GET['fechaInicial'])){
  
  $fechaInicial = $_GET['fechaInicial'];
  $fechaFinal = $_GET['fechaFinal'];
  
}else{
  
  $fechaInicial = null;
  $fechaFinal = null;
  
}

$response = VentasController::showRangeSalesDateController($fechaInicial, $fechaFinal);

foreach($response as $key => $item){

}

?>

<!--<div class="card bg-gradient-info">-->
<!--  -->
<!--  <div class="card-header border-0">-->
<!--    <div class="card-title">-->
<!--      <h3 class="card-title">-->
<!--        <i class="fa fa-th mr-1"></i>-->
<!--        Gráfico de Ventas-->
<!--      </h3>-->
<!--    </div>-->
<!--  </div>-->
<!--  -->
<!--  <div class="card-body border-radius-none nuevoGraficoVentas">-->
<!--      <canvas class="chart"-->
<!--              id="line-chart"-->
<!--              style="min-height: 250px; height: 250px; max-height: 250px; max-width:-->
<!--    100%;"></canvas>-->
<!--  </div>-->
<!--  -->
<!--</div>-->


<!-- solid sales graph -->
<div class="card bg-gradient-info">
 
  <div class="card-header border-0">
    <h3 class="card-title">
      <i class="fas fa-th mr-1"></i>
      Sales Graph
    </h3>
  </div>
  
  <div class="card-body">
<!--    <canvas class="chart" id="line-chart" style="min-height: 250px; height: 250px; max-height: 250px; max-width: 100%;"></canvas>-->
    <div id="myfirstchart" style="height: 250px;"></div>
  </div>
  
</div>

 <script src="//ajax.googleapis.com/ajax/libs/jquery/1.9.0/jquery.min.js"></script>
 <script src="//cdnjs.cloudflare.com/ajax/libs/raphael/2.1.0/raphael-min.js"></script>
 <script src="//cdnjs.cloudflare.com/ajax/libs/morris.js/0.5.1/morris.min.js"></script>


<!--<script>-->
<!--    // Sales graph chart-->
<!--    // var salesGraphChartCanvas = $('#line-chart').get(0).getContext('2d')-->
<!--    var salesGraphChartCanvas = document.getElementById('line-chart').getContext('2d')-->
<!---->
<!--    var datos = [2666, 2778, 4912, 3767];-->
<!--    -->
<!--    -->
<!---->
<!--    var salesGraphChartData = {-->
<!--        labels: ['2018', '2019', '2020', '2021'],-->
<!--        datasets: [-->
<!--            {-->
<!--                label: 'Ventas',-->
<!--                fill: false,-->
<!--                borderWidth: 4,-->
<!--                lineTension: 0,-->
<!--                spanGaps: true,-->
<!--                borderColor: '#efefef',-->
<!--                pointRadius: 5,-->
<!--                pointHoverRadius: 12,-->
<!--                pointColor: '#efefef',-->
<!--                pointBackgroundColor: '#efefef',-->
<!--                data: datos-->
<!--                -->
<!--            }-->
<!--        ]-->
<!--    }-->
<!---->
<!--    var salesGraphChartOptions = {-->
<!--        maintainAspectRatio: false,-->
<!--        responsive: true,-->
<!--        legend: {-->
<!--            display: false-->
<!--        },-->
<!--        scales: {-->
<!--            xAxes: [{-->
<!--                ticks: {-->
<!--                    -->
<!--                    fontColor: '#efefef'-->
<!--                },-->
<!--                gridLines: {-->
<!--                    display: false,-->
<!--                    color: '#efefef',-->
<!--                    drawBorder: false-->
<!--                }-->
<!--            }],-->
<!--            yAxes: [{-->
<!--                ticks: {-->
<!--                    stepSize: 5000,-->
<!--                    fontColor: '#efefef',-->
<!--                    -->
<!--                },-->
<!--                gridLines: {-->
<!--                    display: true,-->
<!--                    color: '#efefef',-->
<!--                    drawBorder: false-->
<!--                }-->
<!--            }]-->
<!--        },-->
<!--    }-->
<!---->
<!--    // This will get the first returned node in the jQuery collection.-->
<!--    // eslint-disable-next-line no-unused-vars-->
<!--    var salesGraphChart = new Chart(salesGraphChartCanvas, { // lgtm[js/unused-local-variable]-->
<!--        type: 'line',-->
<!--        data: salesGraphChartData,-->
<!--        options: salesGraphChartOptions-->
<!--    })-->
<!---->
<!--</script>-->

<script>
  new Morris.Line({
      element: 'myfirstchart',
      resize: true,
      data: [
          
          { y: '2015', ventas: 2666},
          { y: '2016', ventas: 2879},
          { y: '2017', ventas: 2666},
          { y: '2018', ventas: 2456},
      ],
      
      xkey: 'y',
      ykeys: ['ventas'],
      labels: ['ventas'],
      lineColors: ['#efefef'],
      lineWidth: 4,
      hideHover: 'auto',
      gridTextColor:'#fff',
      gridStrokeWidth: 0.4,
      pointSize: 4,
      pointStrokeColors: ['#fff'],
      gridLineColor: '#efefef',
      gridTextFamily: 'Open Sans',
      preUnits: 'Q ',
      gridTextSize: 10
    });
</script>



