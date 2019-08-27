<?php
 
 
 include '../conecta.php';
 session_start();
if($_SESSION['usuario']!='Jorge2655'&&$_SESSION['usuario']!='Jorge2493'){
	die("usted no tiene autorización para acceder a este panel");
	header("Location:cotizador.php");
}
$id=$_SESSION['usuario'];

?>
<!DOCTYPE HTML>
<!--
	Spectral by HTML5 UP
	html5up.net | @ajlkn
	Free for personal and commercial use under the CCA 3.0 license (html5up.net/license)
-->
<html>

<head>
	<title>usuario </title>
	<meta charset="utf-8" />
	<meta name="viewport" content="width=device-width, initial-scale=1" />
	<!--[if lte IE 8]><script src="assets/js/ie/html5shiv.js"></script><![endif]-->
	<link rel="stylesheet" href="assets/./css/main.css" />
	<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.6.3/css/all.css">

	<!--[if lte IE 8]><link rel="stylesheet" href="assets/css/ie8.css" /><![endif]-->
	<!--[if lte IE 9]><link rel="stylesheet" href="assets/css/ie9.css" /><![endif]-->
	<script>
		function editar(id) {
            alert(id);
            var nombre=document.getElementById('nombre').value;
            var mail=document.getElementById('correo').value;
            var password=document.getElementById('password').value;
           
            var opcion='usuarios';
            
    
     $.ajax({
       url:'crud.php',
       type:'POST',
       data:{opcion,id,nombre,
        mail,
       password},
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
			<h1><a href="">Usuario </a></h1>
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
				<p>Bienvenido <?php  echo $_SESSION['usuario']; ?> </p>
			</header>
			<section class="wrapper style5">
				<div class="inner">
					<section>
						<h4 style="text-align: center;">Datos Iniciales</h4>

						<form method="post" action="">
							<div class="row uniform">
                
								<div class="4u 12u$(xsmall)">
                                <?php
              

               $query="select * from usuarios where usuario='$id' ";
               $sql=$dbConexion->query($query);
                  foreach($sql as $l){
                      ?>
                                    <input type="text" name="nombre" id="nombre" value="<?php 
                                    echo $l['nombre'];
                                    ?>" placeholder="Nombre" />
                               <?php
                  }
                  ?>

								</div>
                                
								<div class="4u 12u$(xsmall)">
                                <?php
               

               $query="select * from usuarios where usuario='$id' ";
               $sql=$dbConexion->query($query);
                  foreach($sql as $l){
                      ?>
									<input type="text" name="nombre" id="correo" value="<?php 
                                    echo $l['correo'];
                                    ?>"
                                        placeholder="correo" />
                                        <?php
                  }
                  ?>

								</div>
								<div class="4u 12u$(xsmall)">
                                <?php

               $query="select * from usuarios where usuario='$id' ";
               $sql=$dbConexion->query($query);
                  foreach($sql as $l){
                      ?>
									<input type="text" name="nombre" id="password" value="<?php 
                                    echo $l['password'];
                                    ?>"
                                        placeholder="password" />
                                        <?php
                  }
                  ?>

								</div>
							

							
                    
							</div>
                            <br>
                            <?php

               $query="select * from usuarios where usuario='$id' ";
               $sql=$dbConexion->query($query);
                  foreach($sql as $l){
                      ?>
							<div class="12u$">
								<ul class="actions" style="text-align: center">
									<li><input type="button" value="guardar cambios" class="principal" onclick="editar(
                                        <?php   echo $l['id']; ?>
                                    );" /></li>
									<!--<li><input type="button" class="chek" value="Imprimir" ></li>
											-->
                                </ul>
                                <?php
                  }
                  ?>
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