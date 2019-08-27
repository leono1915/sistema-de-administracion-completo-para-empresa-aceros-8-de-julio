
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
            
            var nombre=document.getElementById('nombreCliente').value;
            var mail=document.getElementById('correoCliente').value;
            var rfc=document.getElementById('rfcCliente').value;
            var direccion=document.getElementById('direccionCliente').value;
            var telefono=document.getElementById('telefonoCliente').value;
            var nombreAgente=document.getElementById('nombreAgente').value;
            var descripcion=document.getElementById('descripcion').value;
            var puesto=document.getElementById('puestoAgente').value;
            var celular=document.getElementById('celularAgente').value;
            var opcion='clientes';
            var accion='modificar';
    
     $.ajax({
       url:'crud.php',
       type:'POST',
       data:{opcion,accion,id,nombre,
        mail,
        rfc,
        direccion,
        telefono,
        nombreAgente,
        descripcion,
        puesto,
        celular},
       success:function(respuesta){
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
              

               $query="select * from clientes where id='$id' ";
               $sql=$dbConexion->query($query);
                  foreach($sql as $l){
                      ?>
                                    <input type="text" name="nombre" id="nombreCliente" value="<?php 
                                    echo $l['nombre'];
                                    ?>" placeholder="Nombre" />
                               <?php
                  }
                  ?>

								</div>
                                
								<div class="4u 12u$(xsmall)">
                                <?php
               

               $query="select * from clientes where id='$id' ";
               $sql=$dbConexion->query($query);
                  foreach($sql as $l){
                      ?>
									<input type="text" name="nombre" id="direccionCliente" value="<?php 
                                    echo $l['domicilio'];
                                    ?>"
                                        placeholder="direccion" />
                                        <?php
                  }
                  ?>

								</div>
								<div class="4u 12u$(xsmall)">
                                <?php

               $query="select * from clientes where id='$id' ";
               $sql=$dbConexion->query($query);
                  foreach($sql as $l){
                      ?>
									<input type="text" name="nombre" id="telefonoCliente" value="<?php 
                                    echo $l['telefono'];
                                    ?>"
                                        placeholder="telefono empresa" />
                                        <?php
                  }
                  ?>

								</div>
								<div class="4u 12u$(xsmall)">
                                <?php

               $query="select * from clientes where id='$id' ";
               $sql=$dbConexion->query($query);
                  foreach($sql as $l){
                      ?>
									<input type="text" name="nombre" id="rfcCliente" value="<?php 
                                    echo $l['rfc'];
                                    ?>" placeholder="rfc" />
                                      <?php
                  }
                  ?>

								</div>

								<div class="4u 12u$(xsmall)">
                                <?php

               $query="select * from clientes where id='$id' ";
               $sql=$dbConexion->query($query);
                  foreach($sql as $l){
                      ?>
									<input type="text" name="nombre" id="correoCliente" value="<?php 
                                    echo $l['correo'];
                                    ?>" placeholder="correo" />
                                      <?php
                  }
                  ?>



								</div>
								<div class="4u 12u$(xsmall)">
                                <?php

               $query="select * from clientes where id='$id' ";
               $sql=$dbConexion->query($query);
                  foreach($sql as $l){
                      ?>
                                    <input type="text" name="nombre" id="nombreAgente" value="<?php 
                                    echo $l['nombre_agente'];
                                    ?>"
                                     placeholder="Agente" />
                                    <?php
                  }
                  ?>


								</div>

								<div class="4u 12u$(xsmall)">
                                <?php

               $query="select * from clientes where id='$id' ";
               $sql=$dbConexion->query($query);
                  foreach($sql as $l){
                      ?>
									<input type="text" name="nombre" id="puestoAgente" value="<?php 
                                    echo $l['puesto'];
                                    ?>" placeholder="puesto" />
                                      <?php
                  }
                  ?>

								</div>
								<div class="4u 12u$(xsmall)">
                                <?php

               $query="select * from clientes where id='$id' ";
               $sql=$dbConexion->query($query);
                  foreach($sql as $l){
                      ?>
									<input type="text" name="nombre" id="celularAgente" value="<?php 
                                    echo $l['celular'];
                                    ?>"
                                        placeholder="celular" />
                                        <?php
                  }
                  ?>

								</div>
								<div class="4u 12u$(xsmall)">
                                <?php

               $query="select * from clientes where id='$id' ";
               $sql=$dbConexion->query($query);
                  foreach($sql as $l){
                      ?>
									<input type="text" name="nombre" id="descripcion" value="<?php 
                                    echo $l['descripcion'];
                                    ?>"
                                        placeholder="descripcion" />
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