<?php


 $opcion=$_POST['opcion'];
 $accion=$_POST['accion'];   
 $rango=$_POST['rango'];
     
           
          switch($opcion){
          case 'clientes':
          switch($accion){
            case 'listar': listarClientes();   break;
            case 'crear':  agregarClientes();  break;
            case 'consultar': buscarClientes();   break;
            case 'modificar': modificarClientes();   break;
            case 'eliminar': eliminarCliente();    break;
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

        function agregarClientes(){
          include '../conecta.php';
          $nombre       =$_POST['nombre'];
          $mail=$_POST['mail'];
          $rfc=$_POST['rfc'];
          $direccion=$_POST['direccion'];
          $telefono=$_POST['telefono'];
          $nombreAgente=$_POST['nombreAgente'];
          $descripcion=$_POST['descripcion'];
          $puesto=$_POST['puesto'];
          $celular=$_POST['celular'];
          $query='insert into clientes values (null,?,?,?,?,?,?,?,?,?)';
          $stm=$dbConexion->prepare($query);
          $stm->bind_param("sssssssss",$nombre,$mail,$rfc,$direccion,$telefono,$nombreAgente,$descripcion,$puesto,$celular);
          $stm->execute();
          if($stm->affected_rows==0){
            echo 'no se pudo realizar el registro';
            die();
          }
          if(!stm){
            echo 'no se pudo registrar';
            die();
          }
          echo 'cliente registrado exitosamente';
          $stm->close();
          $dbConexion->close();
        }

  function  buscarClientes(){
          include '../conecta.php';
          $rfc=$_POST['rfc'];
          $query="select * from clientes where rfc='$rfc' ";
          $sql=$dbConexion->query($query);
         
          if(!$sql||$sql->num_rows==0){
            echo 'no se existe cliente con ese rfc';
            die();
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
         function  eliminarCliente(){
          include '../conecta.php';
          $id=$_POST['id'];
          $query="delete from clientes where id='$id' ";
          $sql=$dbConexion->query($query);
         
          if(!$sql){
            echo 'no se eliminó el registro';
            die();
          } 
          echo 'registro eliminado';
         
         } 

      function modificarClientes(){
        include '../conecta.php';
        $id=$_POST['id'];
        $nombre =$_POST['nombre'];
        $mail=$_POST['mail'];
        $rfc=$_POST['rfc'];
        $direccion=$_POST['direccion'];
        $telefono=$_POST['telefono'];
        $nombreAgente=$_POST['nombreAgente'];
        $descripcion=$_POST['descripcion'];
        $puesto=$_POST['puesto'];
        $celular=$_POST['celular'];
        //,correo=?,rfc=?,direccion=?,telefono=?,nombre_agente=?,descripcion=?,puesto=?,celular=?
        //,$mail,$rfc,$direccion,$telefono,$nombreAgente,$descripcion,$puesto,$celular
        $sql="update clientes set nombre= ?,correo=?,rfc=?,domicilio=?,telefono=?,nombre_agente=?,descripcion=?,puesto=?,celular=?
         where id=$id";
        $stmt=$dbConexion->prepare($sql);
        $stmt->bind_param("sssssssss",$nombre,$mail,$rfc,$direccion,$telefono,$nombreAgente,$descripcion,$puesto,$celular);
        $stmt->execute();
        
        if($stmt->affected_rows==0){
           echo 'no se pudo modificar'.$id.$nombre.$nombreAgente;
          // echo $stmt->affected_rows;
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
      }


?>


