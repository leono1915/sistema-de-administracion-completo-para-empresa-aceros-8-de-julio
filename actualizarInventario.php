<?php

include 'conecta.php';

$id=$_POST['idCotizacion'];
$idProducto=$_POST['idProducto'];
$cantidad=$_POST['cantidad'];
$facturado=$_POST['facturado'];
$folio=trim($_POST['folio']);
$respuesta=$_POST['respuesta'];
$update="update  ";
$subtotal=$_POST['subtotal'];
$iva=$_POST['impuesto'];
$total=$_POST['total_n'];
switch($respuesta){
    case '':

    $sql=$dbConexion->query("delete from cotizacionTemporal where id_cotizacion='$id'");
    if($sql){
        $dbConexion->close();
        echo'Eliminado sin actualizar';
    }

   
    break;
    case 'SI':
    $sql=$dbConexion->query("update productos set cantidad=cantidad-'$cantidad' where id='$idProducto'");
    $sql2=$dbConexion->query("delete from cotizacionTemporal where id_cotizacion='$id'");
    if($sql&&$sql2){
        $dbConexion->close();
        echo 'Producto actualizado exitosamente';
    }
   
    break;
    case 'indefinido':
    $sql=$dbConexion->query("delete from ordenCompra where id_orden='$id'");
    if($sql){
        $dbConexion->close();
        echo 'Producto eliminado exitosamente';
    }
    break;
    case 'calcularNuevoTotal':
    $sql=$dbConexion->query("update cotizacionTemporal set cantidad='$cantidad', subtotal='$subtotal', iva='$iva',
     total='$total' where id_cotizacion='$id'");
    if($sql){
        $dbConexion->close();
        echo'Eliminado sin actualizar';
    }else{
        echo 'no quedo';
    }
    break;
    case 'calcularNuevoTotalCompras':
    $sql=$dbConexion->query("update ordenCompra set cantidad='$cantidad', subtotal='$subtotal', iva='$iva',
     total='$total' where id_orden='$id'");
    if($sql){
        $dbConexion->close();
        echo'Eliminado sin actualizar';
    }else{
        echo 'no quedo';
    }
    break;
    case 'actualizarInventarioSuma':
    echo $folio;
    $sql=" update productos join historialCompras set cantidad=cantidad+historialCompras.cantidadDescontar, estatus='autorizado', 
    where productos.id=historialCompras.id_producto and historialCompras.folio=? and estatus='pendiente'";
    $stmt=$dbConexion->prepare($sql);
     $stmt->bind_param("s",$folio);
     $stmt->execute();
     
     if($stmt->affected_rows==0){
        echo 'esa cotizacion ya fue autorizada';
        echo $stmt->affected_rows;
        die();
     }
    if($stmt){
        $stmt->close();
        $dbConexion->close();
        echo'actualizacion exitosa';

    }else{
        echo 'no quedo';
        $sql->error;
    }
    break;
    case 'actualizarInventarioResta':
   
    $sql=" update productos join historialVentas set cantidad=cantidad-historialVentas.cantidadDescontar, estatus='autorizado', 
     facturado=? where productos.id=historialVentas.id_producto and historialVentas.folio=? and estatus='pendiente'";
     $stmt=$dbConexion->prepare($sql);
     $stmt->bind_param("ss", $facturado,$folio);
     $stmt->execute();
     
     if($stmt->affected_rows==0){
        echo 'esa cotizacion ya fue autorizada';
        echo $stmt->affected_rows;
        die();
     }
    if($sql){
        $stmt->close();
        $dbConexion->close();
        echo'actualizacion exitosa';

    }else{
        echo 'no quedo';
        $sql->error;
    }
    break;
}
/*$query=$dbConexion->query();

if(!$query){
    $dbConexion->error;
    echo 'error';
  }else{
      echo 'dato insertado exitosamente';
      $pst->close();
      $dbConexion->close();
  }*/






?>