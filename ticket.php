<?php
include 'conecta.php';
require __DIR__ . '/libreria_ticket/vendor/mike42/escpos-php/autoload.php';
session_start();
$varsession=$_SESSION['usuario'];
use Mike42\Escpos\Printer;
use Mike42\Escpos\EscPosImage;
use Mike42\Escpos\PrintConnectors\WindowsPrintConnector;
$nombre   =$_GET['nombreCliente']; 

$descuento=$_GET['descuento'];
$datoDes;
if($descuento!='0'){
 $datoDes="Descuento 8 % ".$descuento;
}else{
  $datoDes=" ";
}
$nombreImpresora="Generica-tickets";
$queryUsuario=$dbConexion->query("select * from usuarios where usuario='$varsession'");

 foreach($queryUsuario  as $user){
         $idUser=$user['id'];
 }
$conecctor = new WindowsPrintConnector($nombreImpresora);
$printer = new Printer($conecctor);


$time = time();

$fecha= date("y-m-d", $time);
/*try{
     $logo=EscPosImage::load("impresion/img/logo_opt.png",false);
     $printer->bitImage($logo);
}catch(Exception $e){};*/

if($nombre=='Nombre Cliente'){
  die('<h1>se necesita elegir un cliente para generar la cotización</h1>');
}
$sqlQuery="select * from  cotizacionTemporal where eliminado='no'";
  $query = $dbConexion->query($sqlQuery);
  if($query->num_rows==0){
    die('<h1>no hay datos para generar ticket asegurese de generar la tabla de productos</h1>');
  }
  $queryCliente=$dbConexion->query("select *from clientes where nombre='$nombre' or nombre_agente='$nombre'");
  
  $result2=$dbConexion->query('select * from  tickets order by numero desc limit 1');
  foreach($result2 as $r){
    $numero= $r['numero']+1;
  }
  if(empty($numero)){
    $numero=1;
  }
 
  $folio='T0'.$numero;



    
 
     //throw $th;

 
  //https://github.com/mike42/escpos-php link 
  $printer->setJustification(Printer::JUSTIFY_CENTER);
  //$printer->text("FOLIO ".$folio);
  $printer->text("\nMatriz \n");
  $printer->text("Aceros 8 de Julio \n");
  $printer->text("Av 8 de Julio #1671 \n");
  $printer->text("Col. Morelos \n");
  $printer->text("Tel. 36-19-36-63 \n");
  $printer->text("Sucursal\n");
  
  $printer->text("Camichines #30 \n");
  $printer->text("Col. Jardines de Sta María \n");
  $printer->text("Tel. 38-55-57-83 \n");
  $printer->setJustification(Printer::JUSTIFY_LEFT);
  $printer->text("FECHA ".date("d-m-Y")."     FOLIO ".$folio." \n");
  $printer->setJustification(Printer::JUSTIFY_LEFT);
  foreach($queryCliente as $query_cliente){
    $idCliente=$query_cliente["id"];
    $nombreFinal=$query_cliente["nombre"];
    if(empty($nombreFinal)){
      $nombreFinal=$nombreFinal.$query_cliente["nombre_agente"];
    }
    $printer->text("CLIENTE:".$nombreFinal."\n");
    /*$printer->text("Domicilio ".$query_cliente["domicilio"]."\n");
    $printer->text("Telefono ".$query_cliente["telefono"]."\n");
    $printer->text(" Correo ".$query_cliente["correo"]."\n");*/
     
     
     
    
     
  }
  $printer->setJustification(Printer::JUSTIFY_CENTER);
  $printer->text("Descripción de productos\n");
  $i=1; 

  $printer->setJustification(Printer::JUSTIFY_LEFT);
  foreach ($query as $querys) { 
    $pieza;
    if(intval($querys['cantidad'])>1){
      $pieza=" pzas ";
    } else{
      $pieza=" pza ";
    }
    $total+=$querys["total"];
    $subtotal+=$querys["subtotal"];
    $iva+=$querys["iva"];
    //$printer->text("Producto #".$i."\n");
    $printer->text($querys["cantidad"].$pieza.$querys["descripcion"]."\n");
    //$printer->text("Precio ".$querys["precio"]."\n");
   // $printer->text("Cantidad ".$querys["cantidad"]."\n");
   $printer->setJustification(Printer::JUSTIFY_RIGHT);
    $printer->text("Precio -------------------------\n");
    $printer->text($querys["total"]);
   
      $i++;
    }
 $printer->setJustification(Printer::JUSTIFY_RIGHT);
 $printer->text("\n ".$datoDes);
  $printer->text("\n Total ".floatval($total-$descuento));
  $printer->feed(5);
  $printer->cut();

  $printer->close();
  $facturado='no';

$pendiente='autorizado';
$eliminado='no';
  $pst=$dbConexion->prepare("insert into tickets values(null,?,?,?,?,?,?,?,?,?,?,?)");
foreach($query as $que){
$pst->bind_param('siissisddsi',$fecha,$idCliente,$que['id'],$folio,$pendiente,$numero,$eliminado,$que['cantidadDescontar'],$total,
$facturado,$idUser);
$query= $pst->execute();
  
}

$sql3=" update productos join tickets set cantidad=cantidad-tickets.cantidadDescontar
where productos.id=tickets.id_producto and tickets.folio=? and estatus='autorizado'";
$stmt=$dbConexion->prepare($sql3);
 $stmt->bind_param("s",trim($folio));
 $stmt->execute();
 
 if($stmt->affected_rows==0){
    echo 'este ticket ya fue cancelado o facturado';
    
    die();
 }
if($stmt){
    $stmt->close();
   
    echo'actualizacion exitosa';

}else{
    echo 'no quedo';
    $sql->error;
}
$delete =$dbConexion->query("update cotizacionTemporal set eliminado='si' where eliminado='no'");
  if(!$query||!$delete){
    $dbConexion->error;
    echo 'error';
  }else{
      echo 'dato insertado exitosamente';
      $pst->close();
      $dbConexion->close();
  }
  
  echo '<script>
    alert("ticket generdo exitosamente cierre la ventana del nvegador para continuar");
  </script>';
  exit();
?>