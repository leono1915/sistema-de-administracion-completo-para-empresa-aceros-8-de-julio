<?php


 



/*$r=12;
$s=5001;
$a='awwwwww';
$b='bwwwww';
$c='cwwwwww';
$d='dwwwwwww';
$e='ewwwwwww';
$f='fwwwwwww';
$nombre =$_POST['nombre'];
$medida=$_POST['medida'];
$espesor=$_POST['espesor'];
$peso=$_POST['peso'];
$precio=$_POST['precio'];
$cantidad=$_POST['cantidad'];
$pst = $mysqli->prepare("INSERT INTO customer values (? ,?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");

$pst->bind_param('iisssssssss',$s,$r,$nombre,$medida,$espesor,$a,$b,$c,$d,$e,$f);

$resu=$pst->execute();
//
//printf("%d Fila insertada.\n", $pst->affected_rows);

if($resu){
  echo 'logrado';
  $pst->close();
$mysqli->close();
}else{
  die('no se pudo ingresar '.$mysqli->error);
  
}*/

 $opcion=$_POST['opcion'];
 $accion=$_POST['accion'];   
 $rango=$_POST['rango'];
     
           
          switch($opcion){
          case 'clientes':
          switch($accion){
            case 'listar': listarClientes();   break;
            case 'crear':    break;
            case 'consultar':    break;
            case 'modificar':    break;
            case 'eliminar':    break;
            break; default: die('no existe opcion');  break;
           }
          
          break;
            case 'proveedores':
            switch($accion){
              case 'listar':   break;
              case 'crear':    break;
              case 'consultar':    break;
              case 'modificar':    break;
              case 'eliminar':    break;
              break; default: die('no existe opcion');  break;
             }
            
            break;
          case 'productos':
          switch($accion){
            case 'listar': listarProductos();  break;
            case 'crear':    break;
            case 'consultar':    break;
            case 'modificar':    break;
            case 'eliminar':    break;
            break; default: die('no existe opcion');  break;
           }
          
          break;
          case 'cotizaciones':
          switch($accion){
            case 'listar': listarCotizaciones();  break;
            case 'crear':    break;
            case 'consultar':    break;
            case 'modificar':    break;
            case 'eliminar':    break;
            break; default: die('no existe opcion');  break;
           }
          
          break;
          case 'ordenes':
          switch($accion){
            case 'listar': listarordenes();  break;
            case 'crear':    break;
            case 'consultar':    break;
            case 'modificar':    break;
            case 'eliminar':    break;
            break; default: die('no existe opcion');  break;
           }
          
          break;
          case 'tickets':
          switch($accion){
            case 'listar':   break;
            case 'crear':    break;
            case 'consultar':    break;
            case 'modificar':    break;
            case 'eliminar':    break;
            break; default: die('no existe opcion');  break;
           }
          
          break;
           
           
           default: die('no existe opcion');  break;


        }


        
   function  listarCotizaciones(){
          include '../conecta.php';
          $rango=$_POST['rango'];
       
       $limitInf=$_POST['rangoInf'];
       if(empty($limitInf)){
         $limitInf=0;
       } 
          //aqui hago mis uniones de la base de datos
     $sql=$dbConexion->query("select clientes.nombre, historialVentas.* from historialVentas 
     join clientes where clientes.id=historialVentas.id_cliente group by folio limit $limitInf,$rango;");
          if(!$sql){
            die( 'error');
          } 
          $jason= array();
          foreach($sql as $l){
            $jason[]= array(
              'nombre'=>$l['nombre'],
              'fecha'=>$l['fecha'],
              'folio'=>$l['folio'],
              'estatus'=>$l['estatus'],
              'total'=>$l['total'],
              'nombreArchivo'=>$l['folio'].$l['nombre'].'.pdf',
              'facturado'=>$l['facturado']
            );
             
          }
          $respuesta=json_encode($jason);
          echo $respuesta;
         }  
  function  listarClientes(){
          include '../conecta.php';
      $rango=$_POST['rango'];
       
       $limitInf=$_POST['rangoInf'];
       if(empty($limitInf)){
         $limitInf=0;
       } 
          //aqui hago mis uniones de la base de datos
     $sql=$dbConexion->query("select * from clientes limit $limitInf,$rango;");
          if(!$sql){
            die( 'error');
          } 
          $jason= array();
          foreach($sql as $l){
            $jason[]= array(
              'id'=>$l['id'],
              'nombre'=>$l['nombre'],
              'nombre_agente'=>$l['nombre_agente'],
              'domicilio'=>$l['domicilio'],
              'telefono'=>$l['telefono'],
              'celular'=>$l['celular'],
              'rfc'=>$l['rfc'],
              'correo'=>$l['correo']
            );
             
          }
          $respuesta=json_encode($jason);
          echo $respuesta;
         }  
         function  listarProductos(){
          include '../conecta.php';
       $rango=$_POST['rango'];
       
       $limitInf=$_POST['rangoInf'];
       if(empty($limitInf)){
         $limitInf=0;
       } 
          //aqui hago mis uniones de la base de datos
     $sql=$dbConexion->query("select * from productos limit $limitInf,$rango;");
  
          if(!$sql){
            die( 'error'.$rango);
           
          } 
          $jason= array();
          foreach($sql as $l){
            $metros=explode(".",$l['cantidad']);
            $jason[]= array(
              'id'=>$l['id'],
              'nombre'=>$l['nombre'],
              'medida'=>$l['medida'],
              'espesor'=>$l['espesor'],
              'peso'=>$l['peso'],
              'precio'=>$l['precio'],
              'cantidad'=>$metros[0],
              'metros'=>$metros[1]
            );
             
          }
          $respuesta=json_encode($jason);
          echo $respuesta;
         }  
         function  listarProveedores(){
          include '../conecta.php';
          $rango=$_POST['rango'];
       
       $limitInf=$_POST['rangoInf'];
       if(empty($limitInf)){
         $limitInf=0;
       } 
          //aqui hago mis uniones de la base de datos
     $sql=$dbConexion->query("select clientes.nombre, historialVentas.* from historialVentas 
     join clientes where clientes.id=historialVentas.id_cliente group by folio limit $limitInf,$rango;");
          if(!$sql){
            die( 'error');
          } 
          $jason= array();
          foreach($sql as $l){
            $jason[]= array(
              'nombre'=>$l['nombre'],
              'fecha'=>$l['fecha'],
              'folio'=>$l['folio'],
              'estatus'=>$l['estatus'],
              'total'=>$l['total'],
              'nombreArchivo'=>$l['folio'].$l['nombre'].'.pdf'
            );
             
          }
          $respuesta=json_encode($jason);
          echo $respuesta;
         }  
         function  listarordenes(){
          include '../conecta.php';
          $rango=$_POST['rango'];
       
       $limitInf=$_POST['rangoInf'];
       if(empty($limitInf)){
         $limitInf=0;
       } 
          //aqui hago mis uniones de la base de datos
     $sql=$dbConexion->query("select clientes.nombre, historialCompras.* from historialCompras 
     join clientes where clientes.id=historialCompras.id_cliente group by folio limit $limitInf,$rango;");
          if(!$sql){
            die( 'error');
          } 
          $jason= array();
          foreach($sql as $l){
            $jason[]= array(
              'nombre'=>$l['nombre'],
              'fecha'=>$l['fecha'],
              'folio'=>$l['folio'],
              'estatus'=>$l['estatus'],
              'total'=>$l['total'],
              'nombreArchivo'=>$l['folio'].$l['nombre'].'.pdf'
            );
             
          }
          $respuesta=json_encode($jason);
          echo $respuesta;
         }  







?>


