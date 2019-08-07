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
 
          
           
          switch($opcion){
          case 'clientes':
          switch($accion){
            case 'crear':  mostrar();  break;
            case 'consultar':    break;
            case 'modificar':    break;
            case 'eliminar':    break;
            break; default: die('no existe opcion');  break;
           }
          
          break;
          case 'productos':
          switch($accion){
            case 'crear':    break;
            case 'consultar':    break;
            case 'modificar':    break;
            case 'eliminar':    break;
            break; default: die('no existe opcion');  break;
           }
          
          break;
           
           
           default: die('no existe opcion');  break;


        }


        
        function  mostrar(){
          include_once '../conecta.php';
          //aqui hago mis uniones de la base de datos
     $sql=$dbConexion->query("select clientes.nombre, historialVentas.* from historialVentas 
     join clientes where clientes.id=historialVentas.id_cliente group by folio;");
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


