<?php


include 'conecta.php';
$time = time();

$fecha= date("d-m-Y", $time);

$nombre=$_GET['nombreCliente'];
$sqlQuery="select * from  cotizacionTemporal where eliminado='no'";

  $query = $dbConexion->query($sqlQuery);
  if($query->num_rows==0){
    die('<h1>no hay datos para generar cotizacion asegurese de generar la tabla de productos</h1>');
  }
 $result=$dbConexion->query('select * from  cotizacionTemporal order by id asc limit 1');
  foreach($result as $r){
    $id_orden= $r['id'];
  }
 if($nombre=='Nombre Cliente'){
   die('<h1>se necesita elegir un cliente para generar la cotización</h1>');
 }
  $queryCliente=$dbConexion->query("select *from clientes where nombre='$nombre' or nombre_agente='$nombre'");

  if(!$query||!$queryCliente){
    $dbConexion->error;
    echo 'error';
  }
$plantilla='
<body>
  <header class="clearfix">
  <div class="division">
    <div id="company">
      <img src="impresion/img/logo_opt.png">
    </div>
   
    <div id="company">
    <h2 class="name">Matriz</h2>
    <div>av 8 de julio #1671, col morelos </div>
    <div>36-19-36-63</div>
    <div><a href="">elhierro@live.com.mx</a></div>
</div>

  <div id="company">
      <h2 class="name">Sucursal</h2>
      <div>Camichines #30, col jardines 
    de <br> sta maría</div>
      <div>38-55-57-83</div>
      <div><a href="">arq.lagos2@gmail.com</a></div>
  </div>
 
  </div>
  <h2 style="text-align:justyfy; margin-top:-30px; margin-bottom:-20px;">COTIZACIÓN</h2>
  </header>
  <main>
    <div id="details" class="clearfix">
      <div id="CLIENTE:">';
      foreach($queryCliente as $query_cliente){
      $plantilla.='
        <div class="to">CLIENTE:</div>
        <h2 class="name">'.$query_cliente["nombre"].'</h2>
        <div class="address">'.$query_cliente["domicilio"].'</div>
        <div class="address">'.$query_cliente["telefono"].'</div>
        <div class="email"><a href="">'.$query_cliente["correo"].'</a></div>
      </div>';
      }
     $plantilla.=' <div id="invoice">
        <h1>ACEROS 8 DE JULIO</h1>
    <div class=""> <h3>'."Fecha ".$fecha.'</h3> </div>
    
      </div>
    </div>
    <table border="0" cellspacing="0" cellpadding="0">
      <thead>
        <tr>
          <th class="no">#</th>
          <th class="desc">DESCRIPCION</th>
          <th class="unit">PRECIO UNITARIO</th>
          <th class="qty">CANTIDAD</th>
          <th class="total">TOTAL</th>
        </tr>
      </thead>
      <tbody>'
       ;
        $i=1;
        foreach ($query as $querys) { 
         
        $total+=$querys["total"];
        $subtotal+=$querys["subtotal"];
        $iva+=$querys["iva"];
        $plantilla.=
        '<tr> 
          <td class="no">'.$i.'</td>
          <td class="desc">'.$querys["descripcion"].'</td>
          <td class="unit">'.$querys["precio"].'</td>
          <td class="qty">'.$querys["cantidad"].'</td>
          <td class="total">'.$querys["subtotal"].'</td>
          </tr>';
          $i++;
        }
    $plantilla.='
      </tbody>
      <tfoot>
        <tr>
          <td colspan="2"></td>
          <td colspan="2">SUBTOTAL</td>
          <td>'.$subtotal.'</td>
        </tr>
        <tr>
          <td colspan="2"></td>
          <td colspan="2">IVA 16%</td>
          <td>'.$iva.'</td>
        </tr>
        <tr>
          <td colspan="2"></td>
          <td colspan="2">TOTAL</td>
          <td>'.$total.'</td>
        </tr>
      </tfoot>
    </table>
    <div id="thanks">Rapidez es nuestro compromiso</div>
    <div id="notices">
      <h2>NOTA!</h2>
      <div class="notice">La cotizacion solicitada requiere un 50% de anticipo, en caso de envío a domicilio estará sujeta a disponibilidad 
    del vehículo y turno.
    Los tiempos de entrega de placas o cortes serán calculados una vez se haya entregado el anticipo, agradecemos su preferencia.</div>
    </div>
</main>
 
</body>
<h3> firma o sello de aceptacion  </h3>
';
require_once 'libreria_pdf/vendor/autoload.php' ;



  
  $mpdf = new Mpdf\Mpdf([]);
  
$css =file_get_contents('impresion/estilosImpresin.css');
$mpdf->SetProtection(array('extract'));
$mpdf->SetHTMLHeader('FOLIO 00'.$id_orden);
$mpdf->writeHTML($css,\Mpdf\HTMLParserMode::HEADER_CSS);
$mpdf->setTitle('Cotización');
$mpdf->writeHTML($plantilla,\Mpdf\HTMLParserMode::HTML_BODY);
$mpdf->setFooter('
<footer>

Precios sujetos a cambios sin previo aviso
</footer>');
$mpdf->Output("aa",'I');
exit;
?>


