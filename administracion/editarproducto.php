
<?php
 
 
 include '../conecta.php';
 $id=$_GET['id'];

?>
<!DOCTYPE HTML>
<!--
	Spectral by HTML5 UP
	html5up.net | @ajlkn
	Free for personal and commercial use under the CCA 3.0 license (html5up.net/license)
-->
<html>

<head>
	<title>clientes</title>
	<meta charset="utf-8" />
	<meta name="viewport" content="width=device-width, initial-scale=1" />
	<!--[if lte IE 8]><script src="assets/js/ie/html5shiv.js"></script><![endif]-->
	<link rel="stylesheet" href="assets/./css/main.css" />
	<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.6.3/css/all.css">

	<!--[if lte IE 8]><link rel="stylesheet" href="assets/css/ie8.css" /><![endif]-->
	<!--[if lte IE 9]><link rel="stylesheet" href="assets/css/ie9.css" /><![endif]-->
	<script>
	function editar(id) {
    const factorCantidad=(1/6.1);
    //alert(12);
    var nombre=document.getElementById('nombreProducto').value;
    var medida=document.getElementById('medidaProducto').value;
    var espesor=document.getElementById('espesorProducto').value;
    var peso=document.getElementById('pesoProducto').value;
    var precio=document.getElementById('precioProducto').value;
    var tramos=document.getElementById('tramosProducto').value;
    var metros=document.getElementById('metrosProducto').value;
    var cantidad=parseFloat(parseFloat(tramos)+(metros*factorCantidad));
    var opcion='productos';
    var accion='modificar';
   
   

   

    $.ajax({
        url: 'crud.php',
        type: 'POST',
        data: {nombre,medida,espesor,peso,precio,cantidad,opcion,accion,id},
        success: function(respuesta){
            alert(respuesta);

        }
    })
  

		
		}
		
	</script>
</head>

<body>
	<!-- Page Wrapper -->
	<div id="page-wrapper">

		<!-- Header -->
		<header id="header">
			<h1><a href="">Clientes</a></h1>
			<nav id="nav">
				<ul>
					<li class="special">
						<a href="#menu" class="menuToggle"><span>Menu</span></a>
						<div id="menu">
							<ul>
								<li><a href="../index.php">Inicio</a></li>
								<li><a href="historial.html">Administración</a></li>
								<li><a href="productos.html">Productos</a></li>
								<li><a href="proveedores.html">proveedores</a></li>
								<li><a href="../index.php">cerrar sesión</a></li>
							</ul>
						</div>
					</li>
				</ul>
			</nav>
		</header>
		<!-- Main -->
		<article id="main">
			<header style="padding-top: 50px; padding-bottom: 50px;">
				<h2>Aceros 8 de julio</h2>
				<p>Clientes</p>
			</header>
			<section class="wrapper style5">
				<div class="inner">
					<section>
						<h4 style="text-align: center;">Datos Iniciales</h4>

						<form method="post" action="">
							<div class="row uniform">
                
								<div class="4u 12u$(xsmall)">
                                <?php
              

               $query="select * from productos where id='$id' ";
               $sql=$dbConexion->query($query);
                  foreach($sql as $l){
                      ?>
                                    <input type="text" name="nombre" id="nombreProducto" value="<?php 
                                    echo $l['nombre'];
                                    ?>" placeholder="Nombre" />
                               <?php
                  }
                  ?>

								</div>
                                
								<div class="4u 12u$(xsmall)">
                                <?php
               

               $query="select * from productos where id='$id' ";
               $sql=$dbConexion->query($query);
                  foreach($sql as $l){
                      ?>
									<input type="text" name="nombre" id="medidaProducto" value="<?php 
                                    echo $l['medida'];
                                    ?>"
                                        placeholder="medida" />
                                        <?php
                  }
                  ?>

								</div>
								<div class="4u 12u$(xsmall)">
                                <?php

               $query="select * from productos where id='$id' ";
               $sql=$dbConexion->query($query);
                  foreach($sql as $l){
                      ?>
									<input type="text" name="nombre" id="espesorProducto" value="<?php 
                                    echo $l['espesor'];
                                    ?>"
                                        placeholder="espesor" />
                                        <?php
                  }
                  ?>

								</div>
								<div class="4u 12u$(xsmall)">
                                <?php

               $query="select * from productos where id='$id' ";
               $sql=$dbConexion->query($query);
                  foreach($sql as $l){
                      ?>
									<input type="text" name="nombre" id="pesoProducto" value="<?php 
                                    echo $l['peso'];
                                    ?>" placeholder="rfc" />
                                      <?php
                  }
                  ?>

								</div>

								<div class="4u 12u$(xsmall)">
                                <?php

               $query="select * from productos where id='$id' ";
               $sql=$dbConexion->query($query);
                  foreach($sql as $l){
                      ?>
									<input type="text" name="nombre" id="precioProducto" value="<?php 
                                    echo $l['precio'];
                                    ?>" placeholder="precio" />
                                      <?php
                  }
                  ?>



								</div>
								<div class="4u 12u$(xsmall)">
                                <?php

               $query="select * from productos where id='$id' ";
               $sql=$dbConexion->query($query);
                  foreach($sql as $l){
                      ?>
                                    <input type="text" name="nombre" id="tramosProducto" value="<?php 
                                    $tramos=explode('.',$l['cantidad']);
                                    echo $tramos[0];
                                    ?>
                                    " placeholder="tramos" />
                                    <?php
                  }
                  ?>


								</div>

								<div class="4u 12u$(xsmall)">
                                <?php

               $query="select * from productos where id='$id' ";
               $sql=$dbConexion->query($query);
                  foreach($sql as $l){
                      ?>
                                    <input type="text" name="nombre" id="metrosProducto" value="<?php 
                                      $tramos=explode('.',$l['cantidad']);
                                      $metros=floatval(".".$tramos[1])/(1/6.1);
                                      echo round($metros,2);
                                 
                                    ?>" placeholder="metros" />
                                      <?php
                  }
                  ?>

								</div>
								
                    
							</div>
							<br>
							<div class="12u$">
								<ul class="actions" style="text-align: center">
									<li><input type="button" value="guardar cambios" class="principal" onclick="editar(
                                        <?php   echo $id; ?>
                                    );" /></li>
									<!--<li><input type="button" class="chek" value="Imprimir" ></li>
											-->
								</ul>
							</div>
							<br>
							<br>

							
						</form>
					</section>
					<br>
					<br>
					<br>
				</div>
			</section>
		</article>

		<!-- Footer -->
		<footer id="footer">
			<ul class="icons">

			</ul>
			<ul class="copyright">

		</footer>
	</div>

	<!-- Scripts -->
	<script src="assets/js/jquery.min.js"></script>
	<script src="assets/js/jquery.scrollex.min.js"></script>
	<script src="assets/js/jquery.scrolly.min.js"></script>
	<script src="assets/js/skel.min.js"></script>
	<script src="assets/js/util.js"></script>
	<!--[if lte I]><script src="assets/js/ie/respond.min.js"></script><![endif]-->
	<script src="assets/js/main.js"></script>
	

</body>

</html>