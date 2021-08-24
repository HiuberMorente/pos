<?php

require_once "../../../Controllers/VentasController.php";
require_once "../../../Models/VentasModel.php";

require_once "../../../Controllers/ClientesController.php";
require_once "../../../Models/ClientesModel.php";

require_once "../../../Controllers/UsuariosController.php";
require_once "../../../Models/UsuariosModel.php";

require_once "../../../Controllers/ProductosController.php";
require_once "../../../Models/ProductosModel.php";

class Factura{

public $codigo;

public function traerImpresionFactura(){

//traer informacion de la venta

$itemVenta = 'codigo';
$valorVenta = $this -> codigo;

$responseSale = VentasController::showSalesController($itemVenta, $valorVenta);

$fecha = substr($responseSale['fecha'], 0, -8);
$productos = json_decode($responseSale['productos'], true);
$neto = number_format($responseSale['neto'], 2);
$impuesto = number_format($responseSale['impuesto'], 2);
$total = number_format($responseSale['total'], 2);


if($valorVenta > 0 && $valorVenta < 10){
  $nuevoValorVenta = '00' . $valorVenta;
}elseif($valorVenta > 100 && $valorVenta < 1000){
  $nuevoValorVenta = '0' . $valorVenta;
}else{
  $nuevoValorVenta = $valorVenta;
}

//TRAER INFORMACION DEL CLIENTE

$itemCliente = 'id';
$valorcliente = $responseSale['idCliente'];

$responseCliente = ClientesController::showClientsController($itemCliente, $valorcliente);


//TRAER INFORMACION DEL VENDEDOR

$itemVendedor = 'id';
$valorVendedor = $responseSale['idVendedor'];

$responseVendedor = UsuariosController::showUsersController($itemVendedor, $valorVendedor);


//REQERIMIENTOS DE LA FACTURA (TCPDF)

require_once('tcpdf_include.php');

$pdf = new TCPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);
  
  
  $pdf->SetTitle('Factura' . $_GET['codigo']);
$pdf->startPageGroup();

$pdf->AddPage();

$bloque1 = <<<EOF
<table>
<tr>

<!--<td style="width: 150px;">-->
<!--<img src="images/logo-negro-bloque.png" alt="">-->
<!--</td>-->
<td style="width: 150px;">
<p style="text-align: center">Ferretería Multiservicio <br>
<img src="images/imagelog.jpg" alt="" width="50px" style="text-align: center">
<br>
<strong style="font-size: 20px">La Casa</strong></p>
</td>


<td style="background-color: white; width: 140px;">
<div style="font-size: 9px; text-align: right; line-height: 15px;">
<br>
NIT: 86124589-9

<br>
Dirección: Calle 5b-12
</div>
</td>

<td style="background-color: white; width: 140px;">
<div style="font-size: 9px; text-align: right; line-height: 15px;">
<br>
Teléfono: 86124589

<br>
hiuberr@gmail.com
</div>
</td>

<td style="background-color: white; width: 110px; text-align: center; color: red">
<br><br>
FACTURA No.
<br>
$nuevoValorVenta
</td>

</tr>
</table>
EOF;

$pdf->writeHTML($bloque1, false, false, false,false, '');


$bloque2 = <<<EOF
<table>
<tr>
<td style="width: 540px;"><img src="images/back.jpg"></td>
</tr>
</table>

<table style="font-size: 10px; padding: 5px 10px;">
<tr>
<td style="border: 1px solid #666; background-color: white; width: 260px"><strong>Cliente:</strong>
$responseCliente[nombre]
$responseCliente[apellido]</td>
<td style="border: 1px solid #666; background-color: white; width: 150px"><strong>NIT:</strong>
$responseCliente[nit]</td>
<td style="border: 1px solid #666; background-color: white; width: 130px"><strong>Fecha:</strong> $fecha</td>
</tr>

<tr>
<td style="border: 1px solid #666; background-color: white; width: 540px"><strong>Vendedor:</strong>
$responseVendedor[nombre]
$responseVendedor[apellido]</td>
</tr>
<tr>
<td style="border-bottom: 1px solid #666; background-color: white; width: 540px"></td>
</tr>
</table>

EOF;

$pdf->writeHTML($bloque2, false, false, false,false, '');


$bloque3 = <<<EOF
<table style="font-size: 10px; padding: 5px 10px;">
<tr>
<td style="border: 1px solid #666; background-color: white; width: 260px; text-align: center"><strong>Producto</strong></td>
<td style="border: 1px solid #666; background-color: white; width: 80px; text-align: center"><strong>Cantidad</strong></td>
<td style="border: 1px solid #666; background-color: white; width: 100px; text-align: center"><strong>Valor Unitario</strong></td>
<td style="border: 1px solid #666; background-color: white; width: 100px; text-align: center"><strong>Valor Total</strong></td>
</tr>
</table>
EOF;
  

$pdf->writeHTML($bloque3, false, false, false,false, '');


foreach($productos as $key => $item){

$itemProducto = 'descripcion';
$valorProducto = $item['descripcion'];
$orden = null;

$responseProducto = ProductosController::showProductsController($itemProducto, $valorProducto, $orden);

$valorUnitario = number_format($responseProducto['precioVenta'], 2);

$precioTotal = number_format($item['total'], 2);

$bloque4 = <<<EOF
<table style="font-size: 10px; padding: 5px 10px;">
<tr>
<td style="border: 1px solid #666; color: #333; background-color: white; width: 260px; text-align:
center">$item[descripcion]</td>
<td style="border: 1px solid #666; color: #333; background-color: white; width: 80px; text-align:center">$item[cantidad]</td>
<td style="border: 1px solid #666; color: #333; background-color: white; width: 100px;text-align:center">Q $valorUnitario</td>
<td style="border: 1px solid #666; color: #333; background-color: white; width: 100px;text-align:center">Q $precioTotal</td>
</tr>
</table>
EOF;


$pdf->writeHTML($bloque4, false, false, false, false, '');
}


$bloque5 = <<<EOF
<table style="font-size: 10px; padding: 5px 10px;">
<tr>
<td style="color: #333; background-color: white; width: 340px;text-align:center"></td>
<td style="border-bottom: 1px solid #666; color: #333; background-color: white; width: 100px;text-align:center"></td>
<td style="border-bottom: 1px solid #666; color: #333; background-color: white; width: 100px;text-align:center"></td>
</tr>
<tr>
<td style="border-right: 1px solid #666; color: #333; background-color: white; width: 340px;text-align:center"></td>
<td style="border: 1px solid #666; color: #333; background-color: white; width: 100px; text-align:center;"><strong>Neto</strong></td>
<td style="border: 1px solid #666; color: #333; background-color: white; width: 100px; text-align:center;
">$neto</td>
</tr>
<tr>
<td style="border-right: 1px solid #666; color: #333; background-color: white; width: 340px;text-align:center"></td>
<td style="border: 1px solid #666; color: #333; background-color: white; width: 100px; text-align:center;
"><strong>Impuesto</strong></td>
<td style="border: 1px solid #666; color: #333; background-color: white; width: 100px; text-align:center;
">$impuesto</td>
</tr>
<tr>
<td style="border-right: 1px solid #666; color: #333; background-color: white; width: 340px;text-align:center"></td>
<td style="border: 1px solid #666; color: #333; background-color: white; width: 100px; text-align:center;
"><strong>Total</strong></td>
<td style="border: 1px solid #666; color: #333; background-color: white; width: 100px; text-align:center;
">$total</td>
</tr>
</table>
EOF;

$pdf->writeHTML($bloque5, false, false, false, false, '');


//salida de la factura

$pdf->Output('factura'. $_GET['codigo'] .'.pdf');

}

}


$factura = new Factura();
$factura -> codigo = $_GET['codigo'];
$factura ->traerImpresionFactura();


?>
  


