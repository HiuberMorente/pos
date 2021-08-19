
<?php

$item = null;
$valor = null;

$ventas = VentasController::showSalesController($item, $valor);

$clientes = ClientesController::showClientsController($item, $valor);


$arrayClientes = array();
$listaClientes = array();
$sumaTotalClientes = array();

foreach($ventas as $key => $venta){
  
  foreach($clientes as $key => $cliente){
    
   
    
    if($cliente['id'] === $venta['idCliente']){

      //captura de vendedor
      $arrayClientes[] = $cliente['nombre'] ." " . $cliente['apellido'];

      //captura del vendedor y los valores netos
      $listaClientes = array($cliente['nombre'] ." " . $cliente['apellido'] => $venta['neto']);
  
      //    sumar los netos de cada vendedor
      foreach($listaClientes as $key => $listaCliente){
    
        $sumaTotalClientes[$key] += $listaCliente;
    
      }

    }
    
  }
  
}


$noRepetirNombres = array_unique($arrayClientes);

?>


<div class="card card-secondary">
  <div class="card-header width-border">
    <h3 class="card-title">
      Clientes con más compras
    </h3>
  </div>

  <div class="card-body">
    <div class="chart">
      <div id="bar-compradores" style="min-height: 250px; height: 250px; max-height: 250px; max-width: 100%;"></div>
    </div>
  </div>
</div>

<script>

    var clientData = [<?php
      foreach($noRepetirNombres as $key){
        echo '{y:"' . $key . '", a:' . $sumaTotalClientes[$key] . '},';
      }
      ?>
    ]
    
    Morris.Bar({
       element: 'bar-compradores',
       data: clientData,
       xkey: 'y',
       ykeys: ['a'],
       barColors: ['#94D2BD'],
       preUnits: 'Q',
       labels: ['Ventas']
    });

</script>