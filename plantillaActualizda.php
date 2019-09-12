<?php

include 'conecta.php';
session_start();
$varsession=$_SESSION['usuario'];
$time = time();
$serie=trim($_GET['serie']);
$fecha= date("y-m-d", $time);
$facturado=$_GET['facturado'];
$folio=trim($_GET['folio']);
$credito=$_GET['credito'];
$pago=$_GET['pago'];
$estatus=$_GET['estatus'];
//$nombre=$_GET['nombreCliente'];
$descuento=$_GET['descuento'];
$hora=$time;
$datoDes;
echo $folio;
if($descuento!='0'){
 $datoDes="8 %";
}else{
  $datoDes=" ";
}
$queryUsuario=$dbConexion->query("select * from usuarios where usuario='$varsession'");

 foreach($queryUsuario  as $user){
         $idUser=$user['id'];
 }

$sqlQuery="select cotizacionTemporal.* from cotizacionTemporal join usuarios where usuarios.usuario=
cotizacionTemporal.usuario and eliminado='si'  and cotizacionTemporal.id in(select id_producto from
historialVentas where folio='$folio')";
  $query = $dbConexion->query($sqlQuery);
  if($query->num_rows==0){
    die('<h1>no hay datos para generar cotización asegurese de generar la tabla de productos</h1>');
  }
  $queryCliente=$dbConexion->query("select *from clientes where id in(select id_cliente from historialVentas where folio='$folio' group by folio)");
  $result2=$dbConexion->query("select * from  historialVentas where folio='$folio'");
  foreach($result2 as $r){
    $numero= $r['numero'];
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
        $idCliente=$query_cliente["id"];
        $nombreFinal=$query_cliente["nombre"];
        if(empty($nombreFinal)){
          $nombreFinal=$nombreFinal.$query_cliente["nombre_agente"];
        }
      $plantilla.='
        <div class="to">CLIENTE:</div>
        <h2 class="name">'.$nombreFinal.'</h2>
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
          <td colspan="2">IVA '.$datoDes.'</td>
          <td>'.floatval($iva-$descuento).'</td>
        </tr>
        <tr>
          <td colspan="2"></td>
          <td colspan="2">TOTAL</td>
          <td>'.floatval($total-$descuento).'</td>
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
' ;
require_once 'libreria_pdf/vendor/autoload.php' ;



  
  $mpdf = new Mpdf\Mpdf([]);

$css =file_get_contents('impresion/estilosImpresin.css');
$mpdf->SetHTMLHeader('FOLIO '.$folio);
$mpdf->writeHTML($css,\Mpdf\HTMLParserMode::HEADER_CSS);
$mpdf->setTitle('COTIZACIÓN');
$mpdf->writeHTML($plantilla,\Mpdf\HTMLParserMode::HTML_BODY);
$mpdf->setFooter('
<footer>

Precios sujetos a cambios sin previo aviso
</footer>');
$cadena='cotizaciones/';
$eliminado='no';
$nombreArchivo= $folio.$nombreFinal.'.pdf';
unlink($cadena.$nombreArchivo);
$mpdf->Output($cadena.$nombreArchivo,'F');
$pst1=$dbConexion->query("delete from historialVentas where folio='$folio'");
/*$pst=$dbConexion->prepare("update historialVentas set id_producto=?, estatus=?,cantidadDescontar=?, total=?,
facturado=?,pago=?,credito=? where folio='$folio'");

foreach($query as $que){
  echo $que['id'];
$pst->bind_param('isddsss',$que['id'],$estatus,$que['cantidadDescontar'],$total,
$facturado,$pago,$credito);*/
$pst=$dbConexion->prepare("insert into historialVentas values(null,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?)");
foreach($query as $que){
  echo $que['id_producto'];
$pst->bind_param('siissisddsissss',$fecha,$idCliente,$que['id'],$folio,$estatus,$numero,$eliminado,$que['cantidadDescontar'],$total,
$facturado,$idUser,$pago,$hora,$credito,$serie);
$query= $pst->execute();
  
}
/*$delete =$dbConexion->query("update cotizacionTemporal set eliminado='si' where eliminado='no'");
  
  if(!$query||!$pst1){
    $dbConexion->error;
    echo 'error';
  }else{
      echo 'acturalizado exitosamente';
      $pst->close();
      $dbConexion->close();
  }*/
 

$mpdf->Output($nombreArchivo,'I');
  


?>
