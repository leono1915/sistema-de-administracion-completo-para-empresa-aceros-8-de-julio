<?php



session_start();
if($_SESSION['usuario']!='Jorge2655'&&$_SESSION['usuario']!='Jorge2493'){
	die("usted no tiene autorización para acceder a este panel");
	header("Location:cotizador.php");
}


?>

<!DOCTYPE HTML>
<!--
	Spectral by HTML5 UP
	html5up.net | @ajlkn
	Free for personal and commercial use under the CCA 3.0 license (html5up.net/license)
-->
<html>

<head>
	<title>Estadísticas</title>
	<meta charset="utf-8" />
	<meta name="viewport" content="width=device-width, initial-scale=1" />
	<!--[if lte IE 8]><script src="assets/js/ie/html5shiv.js"></script><![endif]-->
	<link rel="stylesheet" href="assets/./css/main.css" />
	<!--[if lte IE 8]><link rel="stylesheet" href="assets/css/ie8.css" /><![endif]-->
	<!--[if lte IE 9]><link rel="stylesheet" href="assets/css/ie9.css" /><![endif]-->
	<script>

	
    function crearTicket(objectpressed){
		var object=objectpressed.parentNode.parentNode;
	var folio=object.getElementsByTagName('td')[3].getElementsByTagName('p')[0].innerHTML;

	 window.open("../ticket.php"+"?folio=" +folio,"_blank");
    }
	  function ocultar(){
		  document.getElementById('ventana-emergente').style.display='none';
	  }
	    function ira(objectpressed){
			
			var object=objectpressed.parentNode.parentNode;
			 var nombre=object.getElementsByTagName('td')[6].innerHTML;
			 
			 
			
			 window.open('mostrar.php' + "?nombre=" +nombre,"_blank");
		}
		function iraO(objectpressed){
			
			var object=objectpressed.parentNode.parentNode;
			 var nombre=object.getElementsByTagName('td')[6].innerHTML;
			
			 window.open('mostrarOrden.php' + "?nombre=" +nombre,"_blank");
		}
	function actualizarProducto(objectpressed){
        
        var object=objectpressed.parentNode.parentNode;
		var folio=object.getElementsByTagName('td')[3].getElementsByTagName('p')[0].innerHTML;
		var respuesta="consultarEstado";
	//	window.open('../editarCotizacion.php' + "?folio=" +folio,"_blank");
		$.ajax({
			url:'../actualizarInventario.php',
			type:'POST',
			data:{folio,respuesta},
			success:function(respuesta){
				let res=JSON.parse(respuesta);
				console.log();
				if(res[0].pendiente=='autorizado'&&res[0].credito=='no'){
				alert("esta cotización ha sido autorizada y no puede modificarse si desea puede cancelarla para modificarla");
				return;
				}
				window.open('../editarCotizacion.php' + "?folio=" +folio,"_blank");
			}
		})
	
	

	}

 //                              actualizar ticket
 function iraT(objectpressed){
			
	var object=objectpressed.parentNode.parentNode;
		var folio=object.getElementsByTagName('td')[3].getElementsByTagName('p')[0].innerHTML;
		var serie=object.getElementsByTagName('td')[9].getElementsByTagName('p')[0].innerHTML;
		if(!confirm(`cambiará el estatus  a cancelado una vez haciendo esto ya no podrá
	       cambiar el estatus y los productos serán sumados al inventario`)){
			
          return;
		}
		var respuesta='actualizarInventarioSumaTicket';
		//var facturado=prompt("la cotización a autorizar ha sido facturada ? escriba si o no");
		$.ajax({
			url:'../actualizarInventario.php',
			type:'POST',
			data:{folio,respuesta,serie},
			success:function(respuesta){
				alert(respuesta);
				location.href="estadisticas.php";
			}
		})
		}

		function actualizarTicket(objectpressed){
        
        var object=objectpressed.parentNode.parentNode;
		var folio=object.getElementsByTagName('td')[3].getElementsByTagName('p')[0].innerHTML;
		if(!confirm(`cambiará el estatus del ticket a facturado desea continuar`)){
			
          return;
		}
		var respuesta='actualizarEstatusTicket';
		//var facturado=prompt("la cotización a autorizar ha sido facturada ? escriba si o no").toLocaleLowerCase();
	
		$.ajax({
			url:'../actualizarInventario.php',
			type:'POST',
			data:{folio,respuesta},
			success:function(respuesta){
				alert(respuesta);
				location.href="estadisticas.php";
			}
		})

}

function actualizarOrden(objectpressed){
        
        var object=objectpressed.parentNode.parentNode;
		var folio=object.getElementsByTagName('td')[3].getElementsByTagName('p')[0].innerHTML;
		if(!confirm(`cambiará el estatus de la orden a autorizado una vez haciendo esto ya no podrá
	       cambiar el estatus y los productos cotizados serán actualizados del inventario`)){
			
          return;
		}
		
		var serieO=prompt("Elija serie A o B","");
		if(serieO==null){

			return;
		}
		var	serie="serie "+serieO.toLowerCase().trim();	
		alert(serie);
		if(serie!='serie a'&&serie!='serie b'){
        alert("serie incorrecta");
       return;
        }
		
		var respuesta='actualizarInventarioSuma';
		$.ajax({
			url:'../actualizarInventario.php',
			type:'POST',
			data:{folio,respuesta,serie},
			success:function(respuesta){
				alert(respuesta);
			   location.href="estadisticas.php";
			}
		})

}
		function ocultarCotizacion() {
			document.getElementById('tablaCotizaciones').style.display = 'none';
		}
		function ocultarOrden() {
			document.getElementById('tablaOrdenCompra').style.display = 'none';
		}
		function ocultarTikect() {
			document.getElementById('tablaTickets').style.display = 'none';
		}
		function ocultarEstadisticas() {
			document.getElementById('tablaEstadisticas').style.display = 'none';
		}
	</script>
	<style>
		div#menu ul li  ul{
		 display:none;
		 
		
		}
		div#menu ul li:hover > ul {
		  display:block;
		
		}
		</style>
</head>

<body onload="ocultar();">
	<!-- Page Wrapper -->
	<div id="page-wrapper">

		<!-- Header -->
		<header id="header">
			<h1><a href="">Historial</a></h1>
			<nav id="nav">
				<ul>
					<li class="special">
						<a href="#menu" class="menuToggle"><span>Menu</span></a>
						<div id="menu">
							<ul>
								<li><a href="../cotizador.php">Cotizador</a></li>
								<li><a href="clientes.php">Clientes</a></li>
							 <li><a href="proveedores.php">Proveedores</a></li>
							 <li><a href="productos.php">Productos</a>
											
										    <ul>
												<br>
												<li><a href="productosA.php">Serie A</a></li>
												<li><a href="productosB.php">Serie B</a></li>
											</ul>
										   </li>
							   <li><a href="editarusuarios.php">Editar mis datos</a></li>
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
				<p>Estadísticas</p>
				
				<div id="ventana-emergente">
											
												<h2 style="color:black; text-align:center">LLene los campos</h2>							
					<div class="10u$" >		
					<ul class="actions" style="text-align: center">
					   <select name="" id="opcionFacturado" style=" background-color:black">
					    <li><option value="">Facturado</option></li>
						<li><option value="">SI</option></li>
						<li><option value="">NO</option></li>
						
						
					   </select>
					   </ul>
					   </div>	
					   <br>
					   <div class="10u$"  >	
					   <ul class="actions" style="text-align: center">
					   <select name="" id="opcionPago" style=" background-color:black">
					    <li><option value="">Método de pago</option></li>
						<li><option value="">Transferencia</option></li>
						<li><option value="">Tarjeta</option></li>
						<li><option value="">Efectivo</option></li>
						
						
					   </select>
					 </ul>
				        </div>
						<br>
						<div class="10u$" >		
						<ul class="actions" style="text-align: center">
					   <select name="" id="opcionInventario" style=" background-color:black">
					    <li><option value="">Inventario</option></li>
						<li><option value="">Serie A</option></li>
						<li><option value="">Serie B</option></li>
						
					   </select>
					   </ul>
					   </div>
					   <div class="10u$" >		
					   <ul class="actions" style="text-align: center">
				      <select name="" id="opcionCredito" style=" background-color:black">
				       <li><option value="">Crédito</option></li>
				        <li><option value="">SI</option></li>
						<li><option value="">NO</option></li>
				       </select>
			            </ul>
				</div>	
					   <br>
					   <div class="10u$">
									<ul class="actions" style="text-align: center">
										<li><input type="button" id="actualizar" class="principal" value="guardar"></li>
										<li><input type="button" onclick="ocultar();" class="principal" value="cancelar"></li>
										
									</ul>
								</div>
					   
					 
					   
					   </div>
					
			</header>
			<section class="wrapper style5">
				<div class="inner">
					<section>
						<h4 style="text-align: center;">administracion</h4>

						<form method="post" action="conecta.php">
							<div class="row uniform">

								<div class="4u 12u$(xsmall)">
										
									<input type="button" name="nombre" class="principal" id="mostrarCotizacion" value="Cotizaciones"  />

								</div>

								<div class="5u 12u$(xsmall)">
									<input type="button" name="nombre" class="principal" id="mostrarOrdenes" value="Órdenes de compra"  />

								</div>
								
								<div class="3u 12u$(xsmall)">
									<input type="button" name="nombre" class="principal" id="mostrarEstadisticas" value="Estadisticas"  />

								</div>

								<!--<div class="4u 12u$(xsmall)">
									<input type="button" name="nombre" class="principal" id="" value=""  />



								</div>
								<div class="4u 12u$(xsmall)">
									<input type="button" name="nombre" class="principal" id="" value=""  />

								</div>-->

							</div>
							<br>

							<br>
							<br>

							<div class="table-wrapper" id="tablaCotizaciones">
								<h2 style="text-align: center">Historial Cotizaciones</h2>
								<div class="row uniform">
									<div class="2u 12u$(xsmall)">
										<label for="rango_pageCotizaciones"> Listar
											<input type="number" id="rango_pageCotizacion" value="20" step="20"
												style="color: black;" min="20" max="120"></label>



									</div>
									<div class="6u 12u$(xsmall)">







									</div>
									<div class="0u 12u$(xsmall)">

										<input id="buscarC" type="button" value="Buscar" >
													
					
												
														
														
											
											
										</div>
											<div class=" 2u 12u$(xsmall)">



										<input type="text" name="" placeholder="Folio" id="txtCotizacion">



									</div>
								</div>
								<br><br>
								<table id="tabla_factura">
									<thead>
										<tr>

											<th>NOMBRE VENDEDOR</th>
											<th>NOMBRE CLIENTE</th>
											<th>FECHA</th>
											<th>FOLIO</th>
											<th>ESTATUS</th>
											<th>TOTAL</th>
											<th>FACTURADO</th>
											<th>MÉTODO DE PAGO</th>
											<td colspan="4">Acciones</td>


										</tr>
									</thead>
									<tbody id="content_table">
									
									</tbody>
									<!--<tfoot>
													<tr>
														<td colspan="2"></td>
														
														<td id="total_precio">0.00</td>
														<td id="total_subtotales">0.00</td>
														<td id="total_impuesto">0.00</td>
														<td id="total_total">0.00</td>
														<td></td>
													</tr>
												</tfoot>-->
								</table>
								<div class="12u$" id="contenedorPaginacion">
									<div class="row uniform" id="contenedor-padrePagina">
										<div class="1u 12u$(xsmall)"  id="padrePagina">
										 <input type="button" name="nombre" id="anteriorPaginaCotizacion" value="Ant" /> 
										</div>
										<div class="1u 12u$(xsmall)"  id="padrePagina">
									   
										  <input type="button" name="nombre" id="numeroPaginaCotizacion" value="1" /> 
									   
										</div>
										<div class="1u 12u$(xsmall)" " id="padrePagina">
									   
										<input type="button" name="nombre" id="siguientePaginaCotizacion" value="Sig" /> 
										
										</div>
										</div>

								</div>
								<div class="12u$">
									<ul class="actions" style="text-align: center">
										<li><input type="button" value="Ocultar" class="principal" id="add"
												onclick="ocultarCotizacion();"></li>
										<!--<li><input type="button" class="chek" value="Imprimir" ></li>
											-->
									</ul>
								</div>
							</div>
							<!--                    

                          /* aqui comienta la tabla de ordenes de compra */                                      <--------------- tablaOrdenCompra

							-->
							<div class="table-wrapper" id="tablaOrdenCompra">
									<h2 style="text-align: center">Historial Órdenes de compra</h2>
									<div class="row uniform">
										<div class="2u 12u$(xsmall)">
											<label for="rango_pageOrden"> Listar
												<input type="number" id="rango_pageOrden" value="20" step="20"
													style="color: black;" min="20" max="120"></label>
	
	
	
										</div>
										<div class="6u 12u$(xsmall)">
	
	
	
	
	
	
	
										</div>
										<div class="0u 12u$(xsmall)">

											<input id="buscarO" type="button" value="Buscar" >
														
						
													
															
															
												
												
											</div>
												<div class=" 2u 12u$(xsmall)">
	
	
	
											<input type="text" name="" placeholder="Folio" id="txtOrden">
	
	
	
										</div>
									</div>
									<br><br>
									<table id="tabla_orden">
										<thead>
											<tr>
                                                <th>NOMBRE SOLICITANTE</th>
												<th>NOMBRE PROVEEDOR</th>
												<th>FECHA</th>
												<th>FOLIO</th>
												<th>ESTATUS</th>
												<th>TOTAL</th>
												<td colspan="2">Acciones</td>
	
	
											</tr>
										</thead>
										<tbody id="content_tableOrden">
											
										</tbody>
										<!--<tfoot>
														<tr>
															<td colspan="2"></td>
															
															<td id="total_precio">0.00</td>
															<td id="total_subtotales">0.00</td>
															<td id="total_impuesto">0.00</td>
															<td id="total_total">0.00</td>
															<td></td>
														</tr>
													</tfoot>-->
									</table>
									<div class="12u$" id="contenedorPaginacionCompra">
										<div class="row uniform" id="contenedor-padrePagina">
											<div class="1u 12u$(xsmall)"  id="padrePagina">
											 <input type="button" name="nombre" id="anteriorPaginaOrden" value="Ant" /> 
											</div>
											<div class="1u 12u$(xsmall)"  id="padrePagina">
										   
											  <input type="button" name="nombre" id="numeroPaginaOrden" value="1" /> 
										   
											</div>
											<div class="1u 12u$(xsmall)" " id="padrePagina">
										   
											<input type="button" name="nombre" id="siguientePaginaOrden" value="Sig" /> 
											
											</div>
											</div>
	
									</div>
									<div class="12u$">
										<ul class="actions" style="text-align: center">
											<li><input type="button" value="Ocultar" class="principal" id="add"
													onclick="ocultarOrden();"></li>
											<!--<li><input type="button" class="chek" value="Imprimir" ></li>
												-->
										</ul>
									</div>
								</div>
								<!--          
									aqui comienza la tabla de tickets                                         <----------- tablaTickets


								-->
								
						<!--	<div class="table-wrapper" id="tablaTickets">
									<h2 style="text-align: center">Historial Tickets</h2>
									<div class="row uniform">
										<div class="2u 12u$(xsmall)">
											<label for="rango_pageTickets"> Listar
												<input type="number" id="rango_pageTickets" value="20" step="20"
													style="color: black;" min="20" max="120"></label>
	
	
	
										</div>
										<div class="6u 12u$(xsmall)">
	
	
	
	
	
	
	
										</div>
										<div class="0u 12u$(xsmall)">

											<input id="buscarT" type="button" value="Buscar" >
														
						
													
															
															
												
												
											</div>
												<div class=" 2u 12u$(xsmall)">
	
	
	
											<input type="text" name="" placeholder="Folio" id="txtTicket">
	
	
	
										</div>
									</div>
									<br><br>
									<table id="tabla_Ticket">
										<thead>
											<tr>
											<th>NOMBRE VENDEDOR</th>
											<th>NOMBRE CLIENTE</th>
											<th>FECHA</th>
											<th>FOLIO</th>
											<th>ESTATUS</th>
											<th>TOTAL</th>
											<th>FACTURADO</th>
											<td colspan="2">Acciones</td>
	
	
											</tr>
										</thead>
										<tbody id="content_tableTicket">
										
										</tbody>
										<!--<tfoot>
														<tr>
															<td colspan="2"></td>
															
															<td id="total_precio">0.00</td>
															<td id="total_subtotales">0.00</td>
															<td id="total_impuesto">0.00</td>
															<td id="total_total">0.00</td>
															<td></td>
														</tr>
													</tfoot>
									</table>
									<div class="12u$" id="contenedorPaginacionTickets">
										<div class="row uniform" id="contenedor-padrePagina">
											<div class="1u 12u$(xsmall)"  id="padrePagina">
											 <input type="button" name="nombre" id="anteriorPaginaTicket" value="Ant" /> 
											</div>
											<div class="1u 12u$(xsmall)"  id="padrePagina">
										   
											  <input type="button" name="nombre" id="numeroPaginaTicket" value="1" /> 
										   
											</div>
											<div class="1u 12u$(xsmall)" " id="padrePagina">
										   
											<input type="button" name="nombre" id="siguientePaginaTicket" value="Sig" /> 
											
											</div>
											</div>
	
									</div>
									<div class="12u$">
										<ul class="actions" style="text-align: center">
											<li><input type="button" value="Ocultar" class="principal" id="add"
													onclick="ocultarTikect();"></li>
											<!--<li><input type="button" class="chek" value="Imprimir" ></li>
												
										</ul>
									</div>
								</div>
								       -->     
									
								<div class="table-wrapper" id="tablaEstadisticas">
										<h2 style="text-align: center">Estadisticas</h2>
										<h4 style="text-align: center"> <script> var date=new Date(); 
										document.write("año "+date.getFullYear());
										</script> </h4>
										<h3 id="ventaDia"> Venta del día </h3>
										<br>
										<TABLE id="tabla1">
											
												<TR ALIGN="center">
												<TD>Cotizaciones</TD>
										
												
												</TR>
												
												<tbody id="contenido-estadisticas">

												</tbody>
											
												
												
											
												
												</TABLE>
												<TABLE id="tabla2">

													<TR ALIGN="center">
												
													<TD>Desglose</TD>
													
													
													</TR>
													
													<tbody id="contenido-estadisticas2">
	
													</tbody>
												
													
													
												
													
													</TABLE>
													<TABLE id="tabla3">

											
														<TR ALIGN="center">
														
														<td >Órdenes de compra</td>
														
														</TR>
														
														<tbody id="contenido-estadisticas3">
		
														</tbody>
													
														
														
													
														
														</TABLE>

										<div class="12u$">
											<ul class="actions" style="text-align: center">
												<li><input type="button" value="Ocultar Estadisticas" class="principal" id="add"
														onclick="ocultarEstadisticas();"></li>
												<!--<li><input type="button" class="chek" value="Imprimir" ></li>
													-->
											</ul>
										</div>
									</div>
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
	<script src="js/funcioneshistorial.js"></script>

</body>

</html>