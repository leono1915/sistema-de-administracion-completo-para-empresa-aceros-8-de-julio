<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>
    
<?php
  $nombre=$_GET['nombre'];
  $ubicacion='../orden_compra/ordenes_compra/';
  $direccion=$ubicacion.trim($nombre);
?>
  <embed src="<?php  echo $direccion; ?>" type="application/pdf" width="100% " height="1000px" >
</body>
</html>