

<?php
include '../conecta.php';

/*${element.cantidad
    ${element.descripcion
    ${element.precioUnitario
    ${element.subtotal
    ${element.iva
    ${element.total
    ${element.accion
    ${element.id
    ${element.cantidadDescontar*/
//function  precio(){
  

 //$nombre=$_POST['tabla'];
  // $medida="3/4";
  // $espesor="1/8";
  $sqlQuery="select * from  ordenCompra ";
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
        'cantidadDescontar'=>$l['cantidadDescontar']
    );
    
  }
          $respuesta=json_encode($jason);
echo $respuesta;



//precio();



?>