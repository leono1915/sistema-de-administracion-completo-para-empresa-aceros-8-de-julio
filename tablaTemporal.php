<?php
include 'conecta.php';
session_start();
$time=time();
$hora=$time;
$fecha= date("y-m-d", $time);
$facturado=$_POST['facturado'];
$serie=trim($_POST['serie']);
$credito=$_POST['credito'];
$pago=$_POST['pago'];
$estatus=$_POST['estatus'];
$folio=trim($_POST['folio']);
$idC=$_POST['idC'];
$varsesion=$_SESSION['usuario'];
$cantidad  =$_POST['cantidad'];
$metros  =$_POST['metros'];
$tramos  =$_POST['tramos'];
$descripcion=$_POST['descripcion'];
$precioUnitario=$_POST['precioUnitario'];
$subtotal=$_POST['subtotal'];
$iva=$_POST['iva'];
$total=$_POST['total'];
$accion=$_POST['accion'];
$id=$_POST['id'];
$no=$_POST['eliminado'];
$eliminado='no';
$cantidadDescontar=$_POST['cantidadDescontar'];

$queryUsuario=$dbConexion->query("select * from usuarios where usuario='$varsesion'");

 foreach($queryUsuario  as $user){
         $idUser=$user['id'];
 }

$pst=$dbConexion->prepare("insert into cotizacionTemporal values(null,?,?,?,?,?,?,?,?,?,?,?,?,?)");
$pst->bind_param('isddddsissdds',$cantidad,$descripcion,$precioUnitario,$subtotal,$iva,$total,$accion,$id,$cantidadDescontar,$no,$metros,$tramos,$varsesion);
$query= $pst->execute();
 

  if(!$query){
    $dbConexion->error;
    echo 'error';
  }else{
      echo 'dato insertado exitosamente';
      $pst->close();
     
  }

  if($no=='si'){
    $q=$dbConexion->query("select * from historialVentas where folio='$folio' group by folio");
    foreach($q as $l){
      $numero=$l['numero'];
    }
    $pst2=$dbConexion->prepare("insert into historialVentas values(null,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?)");
    $pst2->bind_param('siissisddsissss',$fecha,$idC,$id,$folio,$estatus,$numero,$eliminado,$cantidadDescontar,$total,
  $facturado,$idUser,$pago,$hora,$credito,$serie);
  $query1= $pst2->execute();
    
   } 
   $q->close();
   $dbConexion->close();

?>