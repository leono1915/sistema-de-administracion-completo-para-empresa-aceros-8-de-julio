<?php


 $opcion=$_POST['opcion'];
 $accion=$_POST['accion'];   
 $rango=$_POST['rango'];
     
           
          switch($opcion){
          case 'clientes':
          switch($accion){
            case 'listar':    listarClientes();   break;
            case 'crear':     agregarClientes();  break;
            case 'consultar': buscarClientes();   break;
            case 'modificar': modificarClientes();   break;
            case 'eliminar':  eliminarCliente();    break;
            break; default: die('no existe opcion');  break;
           }
          
          break;
            case 'proveedores':
            switch($accion){
              case 'listar': listarProveedores();   break;
              case 'crear':   agregarProveedores(); break;
              case 'consultar': buscarProveedores();   break;
              case 'modificar': modificarProveedores();  break;
              case 'eliminar':  eliminarProveedores();  break;
              break; default: die('no existe opcion');  break;
             }
            
            break;
          case 'productos':
          switch($accion){
            case 'listar':    listarProductos();  break;
            case 'crear':     agregarProductos();    break;
            case 'consultar': buscarProductos();   break;
            case 'modificar': modificarProductos();   break;
            case 'modificarPrecios': modificarProductosRango();   break;
            case 'eliminar':  eliminarProductos();  break;
            break; default: die('no existe opcion');  break;
           }
          
          break;
          case 'cotizaciones':
          switch($accion){
            case 'listar': listarCotizaciones();  break;
            case 'consultar':  buscarCotizaciones();  break;
            break; default: die('no existe opcion');  break;
           }
          
          break;
          case 'ordenes':
          switch($accion){
            case 'listar': listarordenes();  break;           
            case 'consultar': buscarOrdenes();   break;
            break; default: die('no existe opcion');  break;
           }
          
          break;
          case 'tickets':
          switch($accion){
            case 'listar': listarTickets();  break;
            case 'consultar':buscarTickets();    break;
            break; default: die('no existe opcion');  break;
           }
          
          break;
          case 'historial':
          switch($accion){
            case 'listar': listarHistorial();  break;
            case 'listarTickets': listarHistorialTickets(); break;
            case 'listarCompras':listarHistorialCompras(); break;
            break; default: die('no existe opcion');  break;
           }
           break;
           case 'usuarios':
           include '../conecta.php';
           $password=$_POST['password'];
           $id=$_POST['id'];
           $nombre =$_POST['nombre'];
           $mail=$_POST['mail'];
           $sql="update usuarios set nombre= ?,correo=?, password=?
           where id=$id";
          $stmt=$dbConexion->prepare($sql);
          $stmt->bind_param("sss",$nombre,$mail,$password);
          $stmt->execute();
         
          if($stmt->affected_rows==0){
             echo 'no se pudo modificar'.$id.$nombre;
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
        
           break;
           default: die('no existe opcion');  break;


        }
  /*---------------------------------------------- AQUI EMPIEZAN LAS FUNCIONES DEL SWITCH CASE -----------------------------------*/
             //                                         funcion listar cotizaciones

        
   function  listarCotizaciones(){
          include '../conecta.php';
          $rango=$_POST['rango'];
       
       $limitInf=$_POST['rangoInf'];
       if(empty($limitInf)){
         $limitInf=0;
       } 
          //aqui hago mis uniones de la base de datos
     $sql=$dbConexion->query("select clientes.nombre,clientes.nombre_agente,usuarios.nombre as nombreU, historialVentas.* from historialVentas 
     join clientes join usuarios where clientes.id=historialVentas.id_cliente and usuarios.id=historialventas.id_usuario
     group by folio limit $limitInf,$rango;");
          if(!$sql){
            die( 'error');
          } 
          $jason= array();
          foreach($sql as $l){
            $nombreFinal=$l['nombre'];
            if(empty($nombreFinal)){
              $nombreFinal=$nombreFinal.$l['nombre_agente'];
            }
            $jason[]= array(
              'nombreU'=>$l['nombreU'],
              'nombre'=>$nombreFinal,
             
              'fecha'=>$l['fecha'],
              'folio'=>$l['folio'],
              'estatus'=>$l['estatus'],
              'total'=>$l['total'],
              'nombreArchivo'=>$l['folio'].$nombreFinal.'.pdf',
              'facturado'=>$l['facturado']
            );
             
          }
          $respuesta=json_encode($jason);
          echo $respuesta;
         }  
         
         //                                                    funcion buscar cotizaciones
     function  buscarCotizaciones(){
          include '../conecta.php';
         $folio=$_POST['folio'];
          //aqui hago mis uniones de la base de datos
     $sql=$dbConexion->query("select clientes.nombre,clientes.nombre_agente,usuarios.nombre as nombreU historialVentas.* from historialVentas 
     join clientes join usuarios where clientes.id=historialVentas.id_cliente and usuario.id=historialventas.id_usuario 
     and folio = '$folio' group by folio;");
          if(!$sql){
            die( 'error');
          } 
          if($sql->num_rows==0){
            return;
          }
          $jason= array();
          foreach($sql as $l){
            $nombreFinal=$l['nombre'];
            if(empty($nombreFinal)){
              $nombreFinal=$nombreFinal.$l['nombre_agente'];
            }
            $jason[]= array(
              'nombreU'=>$l['nombreU'],
              'nombre'=>$nombreFinal,
              'fecha'=>$l['fecha'],
              'folio'=>$l['folio'],
              'estatus'=>$l['estatus'],
              'total'=>$l['total'],
              'nombreArchivo'=>$l['folio'].$nombreFinal.'.pdf',
              'facturado'=>$l['facturado']
            );
             
          }
          $respuesta=json_encode($jason);
          echo $respuesta;
         }  
         //                                                      funcion listar tickets
         function  listarTickets(){
          include '../conecta.php';
          $rango=$_POST['rango'];
       
       $limitInf=$_POST['rangoInf'];
       if(empty($limitInf)){
         $limitInf=0;
       } 
          //aqui hago mis uniones de la base de datos
     $sql=$dbConexion->query("select clientes.nombre,clientes.nombre_agente,usuarios.nombre as nombreU, tickets.* from tickets 
     join clientes join usuarios where clientes.id=tickets.id_cliente and usuarios.id=tickets.id_usuario group by folio limit $limitInf,$rango ;");
          if(!$sql){
            die( 'error');
          } 
          $jason= array();
          foreach($sql as $l){
            $nombreFinal=$l['nombre'];
            if(empty($nombreFinal)){
              $nombreFinal=$nombreFinal.$l['nombre_agente'];
            }
            $jason[]= array(
              'nombreU'=>$l['nombreU'],
              'nombre'=>$nombreFinal,
              'fecha'=>$l['fecha'],
              'folio'=>$l['folio'],
              'estatus'=>$l['estatus'],
              'total'=>$l['total'],
              'nombreArchivo'=>$l['folio'].$nombreFinal.'.pdf',
              'facturado'=>$l['facturado']
            );
             
          }
          $respuesta=json_encode($jason);
          echo $respuesta;
         } 
         //                                                      funcion buscar tickets
         function  buscarTickets(){
          include '../conecta.php';
         $folio=$_POST['folio'];
          //aqui hago mis uniones de la base de datos
     $sql=$dbConexion->query("select clientes.nombre,clientes.nombre_agente,usuarios.nombre as nombreU, tickets.* from tickets 
     join clientes join usuarios where clientes.id=tickets.id_cliente and usuarios.id=tickets.id_usuario and folio = '$folio' group by folio;");
          if(!$sql){
            die( 'error');
          } 
          if($sql->num_rows==0){
            return;
          }
          $jason= array();
          foreach($sql as $l){
            $nombreFinal=$l['nombre'];
            if(empty($nombreFinal)){
              $nombreFinal=$nombreFinal.$l['nombre_agente'];
            }
            $jason[]= array(
              'nombreU'=>$l['nombreU'],
              'nombre'=>$nombreFinal,
              'fecha'=>$l['fecha'],
              'folio'=>$l['folio'],
              'estatus'=>$l['estatus'],
              'total'=>$l['total'],
              'nombreArchivo'=>$l['folio'].$nombreFinal.'.pdf',
              'facturado'=>$l['facturado']
            );
             
          }
          $respuesta=json_encode($jason);
          echo $respuesta;
         }  
         //                                                      funcion buscar ordenes de compra
         function  buscarOrdenes(){
          include '../conecta.php';
         $folio=$_POST['folio'];
          //aqui hago mis uniones de la base de datos
     $sql=$dbConexion->query("select proveedores.nombre,usuarios.nombre as nombreU, historialcompras.* from historialcompras
     join proveedores join usuarios where proveedores.id=historialcompras.id_cliente and usuarios.id=hitorialcompras.id_usuario and folio = '$folio' group by folio;");
          if(!$sql){
            die( 'error');
          } 
          if($sql->num_rows==0){
            return;
          }
          $jason= array();
          foreach($sql as $l){
            
            $jason[]= array(
              'nombreU'=>$l['nombreU'],
              'nombre'=>$l['nombre'],
              'fecha'=>$l['fecha'],
              'folio'=>$l['folio'],
              'estatus'=>$l['estatus'],
              'total'=>$l['total'],
              'nombreArchivo'=>$l['folio'].$nombreFinal.'.pdf',
              'facturado'=>$l['facturado']
            );
             
          }
          $respuesta=json_encode($jason);
          echo $respuesta;
         }  
                      //                                         funcion listar clientes

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
                      //                                         funcion listar productos

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
//                                              funcion listarHistorial
  function listarHistorial(){
          include '../conecta.php';
         
          $anio=date('Y');
  $sql=$dbConexion->query("
  SELECT Mes,no_facturado,facturado,no_facturado+facturado as total,autorizado,pendiente
  FROM (SELECT MONTH(Fecha) AS Mes,
count(if(estatus='autorizado',1,null)) as autorizado,
count(if(estatus='pendiente',1,null)) as pendiente
 ,SUM(IF(YEAR(Fecha)=$anio&&facturado='si',Total,0)) As 'facturado'
,SUM(IF(YEAR(Fecha)=$anio&&facturado='no'&&estatus='autorizado' ,Total,0)) As 'no_facturado'
 FROM  (select * from historialVentas group by folio) as nu group by mes) as ventas;
  ");
 
  if(!$sql){
   die( 'error');
  
 } 
 $jason= array();
 foreach($sql as $l){
  
   $jason[]= array(
     'autorizado'=>$l['autorizado'],
     'pendiente'=>$l['pendiente'],
     'mes'=>$l['Mes'],
     'no_facturado'=>$l['no_facturado'],
     'facturado'=>$l['facturado'],
     'total'=>$l['total']
    
   );
    
 }
 $respuesta=json_encode($jason);
 echo $respuesta;
}  
function listarHistorialTickets(){
  include '../conecta.php';
  $anio=date('Y');
$sql=$dbConexion->query("
SELECT Mes,no_facturado,facturado,no_facturado+facturado as total,autorizado,pendiente
FROM (SELECT MONTH(Fecha) AS Mes,
count(if(estatus='autorizado',1,null)) as autorizado,
count(if(estatus='cancelado',1,null)) as pendiente
,SUM(IF(YEAR(Fecha)=$anio&&facturado='si',Total,0)) As 'facturado'
,SUM(IF(YEAR(Fecha)=$anio&&facturado='no'&&estatus='autorizado' ,Total,0)) As 'no_facturado'
FROM  (select * from tickets group by folio) as nu group by mes) as ventas;
");

if(!$sql){
die( 'error');

} 
$jason= array();
foreach($sql as $l){

$jason[]= array(
'autorizado'=>$l['autorizado'],
'pendiente'=>$l['pendiente'],
'mes'=>$l['Mes'],
'no_facturado'=>$l['no_facturado'],
'facturado'=>$l['facturado'],
'total'=>$l['total']

);

}
$respuesta=json_encode($jason);
echo $respuesta;
} 
function listarHistorialCompras(){
  include '../conecta.php';
  $anio=date('Y');
$sql=$dbConexion->query("
SELECT Mes,facturado,autorizado,pendiente
FROM (SELECT MONTH(Fecha) AS Mes,
count(if(estatus='autorizado',1,null)) as autorizado,
count(if(estatus='pendiente',1,null)) as pendiente
,SUM(IF(YEAR(Fecha)=$anio&&estatus='autorizado',Total,0)) As 'facturado'
FROM  (select * from historialCompras group by folio) as nu group by mes) as ventas;
");

if(!$sql){
die( 'error');

} 
$jason= array();
foreach($sql as $l){

$jason[]= array(
'autorizado'=>$l['autorizado'],
'pendiente'=>$l['pendiente'],
'mes'=>$l['Mes'],
'facturado'=>$l['facturado']

);

}
$respuesta=json_encode($jason);
echo $respuesta;
} 
             //                                         funcion listar proveedores

   function  listarProveedores(){
    include '../conecta.php';
    $rango=$_POST['rango'];
     
     $limitInf=$_POST['rangoInf'];
     if(empty($limitInf)){
       $limitInf=0;
     } 
        //aqui hago mis uniones de la base de datos
   $sql=$dbConexion->query("select * from proveedores limit $limitInf,$rango;");
        if(!$sql){
          die( 'error');
        } 
        $jason= array();
        foreach($sql as $l){
          $jason[]= array(
            'id'=>$l['id'],
            'nombre'=>$l['nombre'],
            'domicilio'=>$l['direccion'],
            'telefono'=>$l['telefono'],
            'rfc'=>$l['rfc'],
            'correo'=>$l['correo']
          );
           
        }
        $respuesta=json_encode($jason);
        echo $respuesta;
         }  

                      //                                         funcion listar ordenes de compra

  function  listarordenes(){
          include '../conecta.php';
          $rango=$_POST['rango'];
       
       $limitInf=$_POST['rangoInf'];
       if(empty($limitInf)){
         $limitInf=0;
       } 
          //aqui hago mis uniones de la base de datos
     $sql=$dbConexion->query("select proveedores.nombre,usuarios.nombre as nombreU, historialCompras.* from historialCompras 
     join  proveedores join usuarios where  proveedores.id=historialCompras.id_cliente and usuarios.id=historialcompras.id_usuario
      group by folio limit $limitInf,$rango;");
          if(!$sql){
            die( 'error');
          } 
          $jason= array();
          foreach($sql as $l){
            $jason[]= array(
              'nombreU'=>$l['nombreU'],
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

  /*---------------------------------   AQUI INICIAN LAS FUNCIONES DEL CRUD DE CLIENTES -----------------------------------------------*/

    //                                         funcion agregar clientes

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
          $stm->bind_param("sssssssss",$nombre,$nombreAgente,$direccion,$puesto,$telefono,$celular,$rfc,$mail,$descripcion);
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
    //                                         funcion buscar clientes

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
    //                                         funcion eliminar clientes
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
    //                                         funcion modificar clientes

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

 /*---------------------------------   AQUI INICIAN LAS FUNCIONES DEL CRUD DE PRODUCTOS -----------------------------------------------*/

    //                                         funcion agregar productos
    function agregarProductos(){
      include '../conecta.php';
      $nombre=$_POST['nombre'];
      $medida=$_POST['medida'];
      $espesor=$_POST['espesor'];
      $peso=$_POST['peso'];
      $precio=$_POST['precio'];
      $cantidad=$_POST['cantidad'];
      $query='insert into productos values (null,?,?,?,?,?,?)';
      $stm=$dbConexion->prepare($query);
      $stm->bind_param("sssddd",$nombre,$medida,$espesor,$peso,$precio,$cantidad);
      $stm->execute();
      if($stm->affected_rows==0){
        echo 'no se pudo realizar el registro';
        die();
      }
      if(!stm){
        echo 'no se pudo registrar';
        die();
      }
      echo 'producto registrado exitosamente';
      $stm->close();
      $dbConexion->close();
    }
//                                         funcion buscar productos

function  buscarProductos(){
      include '../conecta.php';
      $nombre=$_POST['nombre'];
      $query="select * from productos where nombre='$nombre' ";
      $sql=$dbConexion->query($query);
     
      if(!$sql||$sql->num_rows==0){
        echo 'no se existe producto';
        die();
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
//                                         funcion eliminar productos
     function  eliminarProductos(){
      include '../conecta.php';
      $id=$_POST['id'];
      $query="delete from productos where id='$id' ";
      $sql=$dbConexion->query($query);
     
      if(!$sql){
        echo 'no se eliminó el registro';
        die();
      } 
      echo 'registro eliminado';
     
     } 
//                                         funcion modificar productos

  function modificarProductos(){
    include '../conecta.php';
      $id=$_POST['id'];
      $nombre=$_POST['nombre'];
      $medida=$_POST['medida'];
      $espesor=$_POST['espesor'];
      $peso=$_POST['peso'];
      $precio=$_POST['precio'];
      $cantidad=$_POST['cantidad'];
      $query="update productos set nombre=?, medida=?,espesor=?,peso=?,precio=?,cantidad=? where id='$id'";
      $stm=$dbConexion->prepare($query);
      $stm->bind_param("sssddd",$nombre,$medida,$espesor,$peso,$precio,$cantidad);
      $stm->execute();
      if($stm->affected_rows==0){
        echo 'no se pudo realizar la modificacion';
        die();
      }
      if(!stm){
        echo 'no se pudo registrar';
        die();
      }
      echo 'producto modificado exitosamente';
      $stm->close();
      $dbConexion->close();
    }
    //                                         funcion modificar precio de productos por rango de id

    function modificarProductosRango(){
      include '../conecta.php';
        
        $precio=$_POST['precio'];
        $rango1=$_POST['rango1'];
        $rango2=$_POST['rango2'];
        $query="update productos set precio=? where id between '$rango1' and '$rango2'";
        $stm=$dbConexion->prepare($query);
        $stm->bind_param("d",$precio);
        $stm->execute();
        if($stm->affected_rows==0){
          echo 'no se pudo realizar la modificacion';
          die();
        }
        if(!stm){
          echo 'no se pudo registrar';
          die();
        }
        echo 'productos modificados exitosamente';
        $stm->close();
        $dbConexion->close();
      }



      // ------------------------------------- aqui empiezan las funciones de crud de proveedores      -----------------------------                
                                               //        funcion agregar proveedor
      function agregarProveedores(){
        include '../conecta.php';
        $nombre       =$_POST['nombre'];
        $mail=$_POST['mail'];
        $rfc=$_POST['rfc'];
        $direccion=$_POST['direccion'];
        $telefono=$_POST['telefono'];
        $query='insert into proveedores values (null,?,?,?,?,?)';
        $stm=$dbConexion->prepare($query);
        $stm->bind_param("sssss",$nombre,$direccion,$telefono,$rfc,$mail);
        $stm->execute();
        if($stm->affected_rows==0){
          echo 'no se pudo realizar el registro';
          die();
        }
        if(!stm){
          echo 'no se pudo registrar';
          die();
        }
        echo 'proveedor registrado exitosamente';
        $stm->close();
        $dbConexion->close();
      }
  //                                         funcion buscar Proveedores

function  buscarProveedores(){
        include '../conecta.php';
        $rfc=$_POST['rfc'];
        $query="select * from proveedores where rfc='$rfc' ";
        $sql=$dbConexion->query($query);
       
        if(!$sql||$sql->num_rows==0){
          echo 'no se existe proveedor con ese rfc';
          die();
        } 
        $jason= array();
        foreach($sql as $l){
          $jason[]= array(
            'id'=>$l['id'],
            'nombre'=>$l['nombre'],
            'domicilio'=>$l['direccion'],
            'telefono'=>$l['telefono'],
            'rfc'=>$l['rfc'],
            'correo'=>$l['correo']
          );
           
        }
        $respuesta=json_encode($jason);
       
        echo $respuesta;
       } 
  //                                         funcion eliminar Proveedores
       function  eliminarProveedores(){
        include '../conecta.php';
        $id=$_POST['id'];
        $query="delete from proveedores where id='$id' ";
        $sql=$dbConexion->query($query);
       
        if(!$sql){
          echo 'no se eliminó el registro';
          die();
        } 
        echo 'registro eliminado';
       
       } 
  //                                         funcion modificar Proveedores

    function modificarProveedores(){
      include '../conecta.php';
      $id=$_POST['id'];
      $nombre =$_POST['nombre'];
      $mail=$_POST['mail'];
      $rfc=$_POST['rfc'];
      $direccion=$_POST['direccion'];
      $telefono=$_POST['telefono'];
      //,correo=?,rfc=?,direccion=?,telefono=?,nombre_agente=?,descripcion=?,puesto=?,celular=?
      //,$mail,$rfc,$direccion,$telefono,$nombreAgente,$descripcion,$puesto,$celular
      $sql="update proveedores set nombre= ?,direccion=?,telefono=?,rfc=?,correo=?
       where id='$id'";
      $stmt=$dbConexion->prepare($sql);
      $stmt->bind_param("sssss",$nombre,$direccion,$telefono,$rfc,$mail);
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


