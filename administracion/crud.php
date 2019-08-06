<?php


include 'conecta.php';



 $opcion=$_POST['opcion'];   
 
          $case=$opcion;
           
          switch($case){
          case 'crear':
          $r=12;
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
            
          }
          
          break;
           
           
           default: die('no existe opcion');  break;


        }
?>


