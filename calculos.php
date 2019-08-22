

<?php
include 'conecta.php';


//function  precio(){
  $nombre= $_POST['nombreFinal'];
  $medida= $_POST['medidaFinal'];
  $espesor= $_POST['espesorFinal'];

 // $nombre="ANGULO";
  // $medida="3/4";
  // $espesor="1/8";
  //$sqlQuery="select * from productos where nombre=?  and medida=? and espesor=?";
  $query = $dbConexion->query("select * from productos where nombre='$nombre'  and medida='$medida' and espesor='$espesor'");
  /*prepare($sqlQuery);
  $query->bind_param("sss",$nombre,$medida,$espesor);
  $query->execute();*/
  
  if($query->num_rows==0){
   
    die();
  }
  if(!$query){
    $dbConexion->error;
    echo 'error';
  }
  $jason=array();
  foreach($query as $l){

    
    $jason[]= array(
             'id'=> $l['id'],
             'precio'=> $l['precio'],
            'peso' => $l['peso']
    );
    
  }
          $respuesta=json_encode($jason);
echo $respuesta;



//precio();



?>