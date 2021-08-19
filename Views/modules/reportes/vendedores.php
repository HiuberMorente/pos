<?php

$item = null;
$valor = null;

$ventas = VentasController::showSalesController($item, $valor);

$usuarios = UsuariosController::showUsersController($item, $valor);

$arrayvendedores = array();
$listaVendedores = array();
$sumaTotalvendedores = array();

foreach($ventas as $key => $venta){
  
  foreach($usuarios as $key => $usuario){
    
    if($usuario['id'] === $venta['idVendedor']){
    
      //captura de vendedor
      $arrayvendedores[] = $usuario['nombre'] ." " . $usuario['apellido'];
      
      //captura del vendedor y los valores netos
      $listaVendedores = array($usuario['nombre'] ." " . $usuario['apellido'] => $venta['neto']);
  
  
      //sumar los netos de cada vendedor
      foreach($listaVendedores as $key => $listaVendedor){
    
        $sumaTotalvendedores[$key] += $listaVendedor;
    
      }
  
    }
    
  }
  
}


$noRepetirNombres = array_unique($arrayvendedores);



?>


<div class="card card-success">
  <div class="card-header width-border">
    <h3 class="card-title">
      Vendedores
    </h3>
  </div>
  
  <div class="card-body">
    <div class="chart">
      <div id="bar-example" style="min-height: 250px; height: 250px; max-height: 250px; max-width: 100%;"></div>
    </div>
  </div>
</div>


<script>
    
    
    var sellerData = [<?php
      foreach($noRepetirNombres as $key){
        echo '{y:"' . $key . '", a:' . $sumaTotalvendedores[$key] . '},';
      }
      ?>
    ]
    
    
    Morris.Bar({
        element: 'bar-example',
        data: sellerData,
        xkey: 'y',
        ykeys: ['a'],
        barColors: ['#219EBC'],
        preUnits: 'Q',
        labels: ['Ventas'],
        gridTextSize: 16,
    });
    
</script>