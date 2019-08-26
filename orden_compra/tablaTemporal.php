<?php
include '../conecta.php';
$tramos=$_POST['tramos'];
$cantidad  =$_POST['cantidad'];
$metros=$_POST['metros'];
$descripcion=$_POST['descripcion'];
$precioUnitario=$_POST['precioUnitario'];
$subtotal=$_POST['subtotal'];
$iva=$_POST['iva'];
$total=$_POST['total'];
$accion=$_POST['accion'];
$id=$_POST['id'];
$cantidadDescontar=$_POST['cantidadDescontar'];
$pst=$dbConexion->prepare("insert into ordenCompra values(null,?,?,?,?,?,?,?,?,?,?,?)");
$pst->bind_param('isddddsisdd',$cantidad,$descripcion,$precioUnitario,$subtotal,$iva,$total,$accion,$id,$cantidadDescontar,$metros,$tramos);
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