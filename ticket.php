<?php
include 'conecta.php';
session_start();
$varsession=$_SESSION['usuario'];
$time = time();

$fecha= date("y-m-d", $time);
$folio=trim($_GET['folio']);

//$nombre=$_GET['nombreCliente'];



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



/*try{
     $logo=EscPosImage::load("impresion/img/logo_opt.png",false);
     $printer->bitImage($logo);
}catch(Exception $e){};*/





    
 


 
  
 
  $plantilla='
  <html>
<head><meta http-equiv="Content-Type" content="text/html; charset=big5">
  <link rel="stylesheet"  href="impresion/estilosImpresin.css">
</head>
  <body>
    <header class="clearfix">
    <div class="division">
      <div id="company">
        <img src="impresion/img/logo_opt.png">
      </div>
     
      <div id="company">
      <h2 class="name">&nbsp&nbsp&nbsp;&nbsp&nbspACEROS 8 DE JULIO</h2>
      <div>av 8 de julio #1671, col morelos </div>
      <div>Tel  36-19-36-63</div>
      <div><a href="">elhierro@live.com.mx</a></div>
  </div>
  
    <div id="company">
        <h2 class="name">Sucursal</h2>
        <div>Camichines #30, col jardines 
      de <br> sta maria</div>
        <div>Tel  38-55-57-83</div>
        <div><a href="">arq.lagos2@gmail.com</a></div>
    </div>
   
    </div>
    <h2 style="text-align:justyfy; margin-top:-30px; margin-bottom:-20px;">Ticket '.$folio.'</h2>
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
          <h1>'."FOLIO ".$folio.'</h1>
      <div class=""> <h3>'."Fecha ".$fecha.'</h3> </div>
      
        </div>
      </div>
      <table border="0" cellspacing="0" cellpadding="0">
        <thead>
          <tr>
            <th class="no">&nbsp;&nbsp;&nbsp;&nbsp&nbsp;&nbsp&nbsp;&nbsp&nbsp;&nbsp&nbsp;&nbsp&nbsp;&nbsp&nbsp;&nbsp&nbsp&nbsp;&nbsp&nbsp;&nbsp&nbsp;&nbsp&nbsp&nbsp</th>
             <th class="no">&nbsp;&nbsp;&nbsp;&nbsp&nbsp;&nbsp&nbsp;&nbsp&nbsp;&nbsp&nbsp;&nbsp&nbsp;&nbsp&nbsp;&nbsp&nbsp&nbsp;&nbsp&nbsp;&nbsp&nbsp;&nbsp&nbsp&nbsp</th>
            <th class="desc">DESCRIPCION&nbsp</th>
            <th class="unit">DE PRODUCTOS&nbsp;</th>
          
            
          </tr>
        </thead>
        <tbody>'
         ;
          $i=1;
          /*'<tr> 
             <td class="qty">Cant.
             '.$querys["cantidad"].'&nbsp;&nbsp;&nbsp;&nbsp&nbsp;&nbsp&nbsp;&nbsp&nbsp;&nbsp&nbsp;&nbsp&nbsp;&nbsp&nbsp;&nbsp&nbsp&nbsp;&nbsp&nbsp;&nbsp&nbsp;&nbsp&nbsp&nbsp</td>
            <td class="desc">'.$querys["descripcion"].'</td>
            <td class="">P/U&nbsp;&nbsp;&nbsp;&nbsp&nbsp;&nbsp&nbsp;&nbsp&nbsp;&nbsp&nbsp;&nbsp&nbsp;&nbsp&nbsp;&nbsp&nbsp'.$querys["precio"].'</td>
           
            <td class="total>'.$querys["subtotal"].'</td>
            </tr>';*/
          foreach ($query as $querys) { 
           
          $total+=$querys["total"];
          $subtotal+=$querys["subtotal"];
          $iva+=$querys["iva"];
          $descuento=floatval($subtotal)*.16;

$datoDes;

if(number_format(floatval($descuento), 2, '.', '')!=$iva){
 $datoDes=" DESCUENTO 8 % ";
 
}else{
  $descuento=0;
  $datoDes="&nbsp;&nbsp&nbsp;&nbsp&nbsp;&nbsp&nbsp;&nbsp&nbsp;&nbsp&nbsp;&nbsp&nbsp;&nbsp";
}
          $plantilla.=
            '<tr> 
            <td class="no">&nbsp;&nbsp&nbsp;&nbsp</td>
            <td class="desc">'.$querys["descripcion"].'<br>CANT&nbsp;&nbsp'.$querys["cantidad"].'<br>P/U '.$querys["precio"].'</td>
            <td class="unit">&nbsp;&nbsp&nbsp;&nbsp</td>
            <td class="qty"></td>
            <td class="total"></td>
            </tr>';
            $i++;
          }
      $plantilla.='
        </tbody>
        <tfoot>
          <tr>
            <td colspan="2"></td>
            <td colspan="2">SUBTOTAL&nbsp;&nbsp;&nbsp;&nbsp&nbsp;&nbsp&nbsp;&nbsp&nbsp;&nbsp&nbsp;&nbsp</td>
            <td>  '.number_format($subtotal, 2, '.', '').'</td>
          </tr>
          <tr>
            <td colspan="2"></td>
            <td colspan="2">IVA'.$datoDes.'&nbsp;&nbsp&nbsp;</td>
            <td> '.number_format(floatval($iva-$descuento), 2, '.', '').'</td>
          </tr>
          <tr>
            <td colspan="2"></td>
            <td colspan="2">TOTAL&nbsp;&nbsp&nbsp;&nbsp&nbsp;&nbsp&nbsp;&nbsp&nbsp;&nbsp&nbsp;&nbsp&nbsp;&nbsp&nbsp</td>
            <td>  '.number_format(floatval($total-$descuento), 2, '.', '').'</td>
          </tr>
        </tfoot>
      </table>
      <div id="thanks">Rapidez es nuestro compromiso</div>
      <div id="notices">
        <h2>NOTA!</h2>
        <div class="notice">La cotizacion solicitada requiere un 50% de anticipo, en caso de envio a domicilio estara sujeta a disponibilidad 
      del vehículo y turno.
      Los tiempos de entrega de placas o cortes serán calculados una vez se haya entregado el anticipo, agradecemos su preferencia.</div>
      </div>
  </main>
   
  </body>
  </html>
  ';
  
  echo $plantilla;
 
  echo '<script>
     alert("imprimiendo ticket....   cierre la pestaña para salir....");
     window.print();
  </script>';
         
  ?>