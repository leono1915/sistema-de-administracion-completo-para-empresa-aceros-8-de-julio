<?php
include 'conecta.php';
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
$no='no';
$cantidadDescontar=$_POST['cantidadDescontar'];
$pst=$dbConexion->prepare("insert into cotizacionTemporal values(null,?,?,?,?,?,?,?,?,?,?,?,?)");
$pst->bind_param('isddddsissdd',$cantidad,$descripcion,$precioUnitario,$subtotal,$iva,$total,$accion,$id,$cantidadDescontar,$no,$metros,$tramos);
$query= $pst->execute();
  

  if(!$query){
    $dbConexion->error;
    echo 'error';
  }else{
      echo 'dato insertado exitosamente';
      $pst->close();
      $dbConexion->close();
  }




?>