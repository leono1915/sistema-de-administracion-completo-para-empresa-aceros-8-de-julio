

<?php
include '../conecta.php';
session_start();
$varsesion=$_SESSION['usuario'];
  $sqlQuery="select * from  ordenCompra where usuario='$varsesion'";
  $query = $dbConexion->query($sqlQuery);

  if(!$query){
    $dbConexion->error;
    echo 'error';
  }
  $jason=array();
  foreach($query as $l){

    
    $jason[]= array(
        'idCotizacion'=>$l['id_orden'],
        'cantidad'=>$l['cantidad'],
        'descripcion'=>$l['descripcion'],
        'precioUnitario'=>$l['precio'],
        'subtotal'=>$l['subtotal'],
        'iva'=>$l['iva'],
        'total'=>$l['total'],
        'accion'=>$l['accion'],
        'id'=>$l['id'],
        'cantidadDescontar'=>$l['cantidadDescontar'],
        'metros'=>$l['metros'],
        'tramos'=>$l['tramos']
    );
    
  }
          $respuesta=json_encode($jason);
echo $respuesta;







?>