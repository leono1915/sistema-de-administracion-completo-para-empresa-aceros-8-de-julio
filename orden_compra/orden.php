<?php

include '../conecta.php';

?>
<!DOCTYPE HTML>
<!--
	Spectral by HTML5 UP
	html5up.net | @ajlkn
	Free for personal and commercial use under the CCA 3.0 license (html5up.net/license)
-->
<html>
	<head>
		<title>Orden de compra</title>
		<meta charset="utf-8" />
		<meta name="viewport" content="width=device-width, initial-scale=1" />
		<!--[if lte IE 8]><script src="assets/js/ie/html5shiv.js"></script><![endif]-->
		<link rel="stylesheet" href="../assets/css/main.css" />
		<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.6.3/css/all.css" >
	  
		<!--[if lte IE 8]><link rel="stylesheet" href="assets/css/ie8.css" /><![endif]-->
		<!--[if lte IE 9]><link rel="stylesheet" href="assets/css/ie9.css" /><![endif]-->
		<script>

	function mensaje2() {

		var ar=mensaje();
	   console.log(ar[0]);	
	}
	function mensaje(){
		var nombrey=document.getElementById('selectionNameCliente').selectedIndex;
	var nombrex=document.getElementById('selectionNameCliente').options;
	var nombreCliente=nombrex[nombrey].text;

	window.open('imprimir.php' + "?nombreCliente=" +nombreCliente,"_blank");

	}
	
		</script>
	</head>
	<body onload="closeConcepto(),closeCotizadorPlacas();">
		<!-- Page Wrapper -->
			<div id="page-wrapper">

				<!-- Header -->
					<header id="header">
						<h1><a href="index.html">Orden de compra</a></h1>
						<nav id="nav">
							<ul>
								<li class="special">
									<a href="#menu" class="menuToggle"><span>Menu</span></a>
									<div id="menu">
										<ul>
											<li><a href="../administracion/historial.html">Administración</a></li>
											
											<li><a href="../index.php">Cotizador</a></li>
											
										</ul>
									</div>
								</li>
							</ul>
						</nav>
					</header>
				<!-- Main -->
				
					<article id="main">
						<header style="padding-top: 50px; padding-bottom: 50px;" >
							<h2>Aceros 8 de julio</h2>
							<p>Cotizador</p>
						</header>
						<section class="wrapper style5">
							<div class="inner">
								<section>
									<h4 style="text-align: center;">Datos Iniciales</h4>

									<form method="post" action="" >
										<div class="row uniform">
										<div class="12u$">
											<ul class="actions" style="text-align: center">
												<li><input type="button" value="Agregar concepto" class="principal" id="add_concepto"/></li>
												<li><input type="button" class="principal" id="cotizar_placas" value="Placas" ></li>
											</ul>
										</div>
										<div id="ventana-emergente">
												<h2>Agregue el nuevo concepto</h2>
												<div class="popup">
										
					  Cantidad<input type="text" value="1" id="cantidadConcepto">
					  Nombre<input type="text" id="nombreConcepto">
					  Medida<input type="text" id="medidaConcepto">
					  Espesor<input type="text" id="espesorConcepto">
					   Precio<input type="text" id="precioConcepto">
					   <br>
					   <input type="button" id="enviar-popup" class="principal" value="guardar">
					   <input type="button" id="cerrar-popup" class="principal" value="cancelar">
					   </div>
										</div>
										<div class="cotizador-placas" id="cotizador-placas">
											<div class="captura-datos">
													<div class="2u 5u$(xsmall)" id="placeholder">	
                                            <select name="" id="selectionNamePlaca">
												
																
												<option >Placa</option>
												<option >Disco</option>
												<option >Brida</option>
												<option >Cartabon</option>
											 
											</select>
											
											<input type="text" id="medidaBrida" placeholder="Diametro Interior" style="margin-top:10px;">
											</div>
											   <div class="2u 5u$(xsmall)" id="placeholder">
												<input type="text" id="medida1" class="2u 5u$(xsmall)" placeholder="Medida 1">
												<input type="text" id="medida2" class="2u 5u$(xsmall)" placeholder="Medida 2">
											</div>
												<div class="2u 5u$(xsmall)" id="placeholder">
												<input type="text" id="precio" class="2u 5u$(xsmall)" placeholder="Precio">
												<input type="text" id="precioCorte" class="2u 5u$(xsmall)" placeholder="Corte">
											</div>
											
											</div>
											<div class="separador">
                                        <div class="espesores">
																<div class="contenidoRadio">
																<label class="label-radio item-content">
																		<input type="radio" name="gender" id="1/8" value=".0025"> 
																		<span class="spana">1/8</span>
																	</label>
																	<label class="label-radio item-content">
																		<input type="radio" name="gender" id="3/16" value=".00375">
																		<span class="spana">3/16</span>
																	</label>
																	<label class="label-radio item-content">
																		<input type="radio" name="gender" id="1/4" value=".0050">
																		<span class="spana">1/4</span> 
																	</label>
																	<label class="label-radio item-content">
																		<input type="radio" name="gender" id="5/16" value=".00625"/> 
																		<span class="spana">5/16</span>
																	</label>
																	<label class="label-radio item-content">
																		<input type="radio" name="gender" id="3/8" value=".0075">
																		<span class="spana">3/8</span>
																		</label>
																		<label class="label-radio item-content">
																		<input type="radio" name="gender" id="7/16" value=".00875">
																		<span class="spana">7/16</span>
																		</label>
																		
																		
																</div>
																<div class="contenidoRadio">
																<label class="label-radio item-content">
																<input type="radio" name="gender" id="1/2" value=".0100">
																		<span class="spana">1/2</span>
																		</label>
																		<label class="label-radio item-content">
																		<input type="radio" name="gender" id="5/8" value=".0125">
																		<span class="spana">5/8</span>
																		</label>
																		<label class="label-radio item-content">
																		<input type="radio" name="gender" id="3/4" value=".0150">
																		<span class="spana">3/4</span>
																		</label>
																		<label class="label-radio item-content">
																		<input type="radio" name="gender" id="7/8" value=".0175">
																		<span class="spana">7/8</span>
																		</label>
																		<label class="label-radio item-content">
																		<input type="radio" name="gender" id="1" value=".0200">
																		<span class="spana">1</span>
																		</label>
																		<label class="label-radio item-content">
																		<input type="radio" name="gender" id="13/16" value=".02375">
																		<span class="spana">1 3/16</span>
																		</label>
																</div>
																<div class="contenidoRadio">
																<label class="label-radio item-content">
																<input type="radio" name="gender" id="11/4" value=".0250">
																		<span class="spana">1 1/4</span>
																		</label>
																		<label class="label-radio item-content">
																		<input type="radio" name="gender" id="13/8" value=".0275">
																		<span class="spana">1 3/8</span>
																		</label>
																		<label class="label-radio item-content">
																		<input type="radio" name="gender" id="11/2" value=".0300">
																		<span class="spana">1 1/2</span>
																		</label>
																		<label class="label-radio item-content">
																		<input type="radio" name="gender" id="15/8" value=".0325">
																		<span class="spana">1 5/8</span>
																		</label>
																		<label class="label-radio item-content">
																		<input type="radio" name="gender" id="13/4" value=".0350">
																		<span class="spana">1 3/4</span>
																		</label>
																		<label class="label-radio item-content">
																		<input type="radio" name="gender" id="2" value=".0400">
																		<span class="spana">2</span>
																		</label>
																	
																</div>
																<div class="contenidoRadio">
																<label class="label-radio item-content">
																<input type="radio" name="gender" id="21/4" value=".0450">
																		<span class="spana">2 1/4</span>
																		</label>
																		<label class="label-radio item-content">
																		<input type="radio" name="gender" id="21/2" value=".0500">
																		<span class="spana">2 1/2</span>
																		</label>
																		<label class="label-radio item-content">
																		<input type="radio" name="gender" id="3" value=".0600">
																		<span class="spana">3</span>
																		</label>
																		<label class="label-radio item-content">
																		<input type="radio" name="gender" id="4" value=".0800">
																		<span class="spana">4</span>
																		</label>
																		<label class="label-radio item-content">
																		<input type="radio" name="gender" id="5" value=".100">
																		<span class="spana">5</span>
																		</label>
																		<label class="label-radio item-content">
																		<input type="radio" name="gender" id="6" value=".120">
																		<span class="spana">6</span>
																		</label>
																		
																</div>

													

															
														
													

										</div>
										<div class="informacion-placas">
											
											<label for="">Peso</label>
											<input type="text" id="txtPesoPlaca" value="">
											<label for="">Corte</label>
											<input type="text" id="txtCortePlaca" value="">
											<label for="">SubTotal</label>
											<input type="text" id="txtSubTotalPlaca" value="">
											<label for="">Iva</label>
											<input type="text" id="txtIvaPlaca" value="">
											<label for="">Total</label>
											<input type="text" id="txtTotalPlaca" value="">
										 
										</div>
										</div>
										<br>
										<div class="botones-placas">
												<input type="button" id="enviar-placas" class="principal" value="Calcular">
												<input type="button" id="cerrar-placas" class="principal" value="Cerrar">
										 
										</div>

										</div>
					  
											<div class="8u 12u$(xsmall)">
											
											

											<select name="" id="selectionNameCliente">
                                            <option value=""> Nombre Proveedor</option>
												<?php
											$query= $dbConexion->query('select id, nombre from clientes');
                                            foreach($query as $result){
												?>
												
											 
											<option><?php echo $result['nombre'] ;  ?></option>
												
												<?php

												
											 }
											 ?>
											 </select>
										
										 
												
											</div>

											<div class="2u$ 12u$(xsmall)">
                                       
									 <input type="text" name="numero" id="numero" value="" placeholder="I.C°" onkeyup="format(this)" onchange="format(this)" />
									
											</div>
										

											<div class="2u 12u$(xsmall)">
											<select name="" id="selectionName" default="nombre">

											<option>Nombre</option>
												<?php
							          $query1=$dbConexion->query("select distinct nombre from productos");

                                             foreach($query1 as $query){
												?>
												
											 <!-- <input type="button" name="numero" id="numero" value="" placeholder="N°" />-->
											<option><?php echo $query['nombre'] ;  ?></option>
												
												<?php

												$i++;
											 }
											 ?>
											 </select>
											</div>
                                            <div class="2u 12u$(xsmall)">
											<select name="" id="selectionMedida">
												<option id="">Medida</option>
												<?php
											 $query1=$dbConexion->query("select distinct medida from productos");

                                             foreach($query1 as $query){
												?>
												
											 <!-- <input type="button" name="numero" id="numero" value="" placeholder="N°" />-->
											<option id=""><?php echo $query['medida'] ;  ?></option>
												
												<?php

												$i++;
											 }
											 ?>
											 </select>
											</div>
											<div class="2u 12u$(xsmall)">
											<select name="" id="selectionEspesor">
												<option id="">Espesor</option>
												<?php
											 $query1=$dbConexion->query("select distinct espesor from productos");

                                             foreach($query1 as $query){
												?>
												
											 <!-- <input type="button" name="numero" id="numero" value="" placeholder="N°" />-->
											<option id=""><?php echo $query['espesor'] ;  ?></option>
												
												<?php

												$i++;
											 }
											 ?>
											 </select>
											</div>

											<div class="2u 12u$(xsmall)">
											<select name="" id="selectionTramos">
												<option id="">Tramos</option>
												<?php
										    $i=1;
                                            while($i<=1000){
												?>
												
											 <!-- <input type="button" name="numero" id="numero" value="" placeholder="N°" />-->
											<option id=""><?php echo $i ;  ?></option>
												
												<?php

												$i++;
											 }
											 ?>
											 </select>

											</div>

											<div class="2u$ 12u$(xsmall)">
												<input type="text" name="cantidad" id="metros" value="" placeholder="Metros" onkeyup="format(this)" onchange="format(this)"/>
												
											</div>								
										</div>
										<br>
										<div class="12u$">
											<ul class="actions" style="text-align: center">
											  <!--<input type="button" value="Cotizar" class="principal" id="add_row"/>-->
												<li><a href="javascript:void(0);" class="principal" id="add_row" ">
												<input type="button" class="principal" value="Cotizar"></a></li>
												<li><input type="button" id="imprimir" class="" value="Imprimir" ></li>
												<li><a href="javascript:void(0);" target="_blank" onclick="mensaje();">
												<input type="button" id="vista" class="principal" value="vista previa" onclick="location.reload();" ></a></li>
											</ul>
										</div>
										<br>
										<br>

										<div class="table-wrapper">
											<table id="tabla_factura">
												<thead>
													<tr>
									                   
														<th>Cantidad</th>
														<th>Descripción</th>														
														<th>Precio unitario</th>
														<th>Subtotal</th>
														<th>Iva</th>
														<th>Total</th>
														<td>Acción</td>
														
													</tr>
												</thead>
												<tbody id="content_table">
													
												</tbody>
												<tfoot>
													<tr>
														<td colspan="4"></td>
														<td style="font-weight: bold">Descuento</td>
														
														<td id="descuento">0.00</td>
														<td><i class="fas fa-tags" id="descuentos"></i>
														<i class="fas fa-window-close"></i></td>
													</tr>
													<tr>
														<td colspan="3"></td>
														
														<td style=" display:none"id="total_precio">0.00</td>
														<td id="total_subtotales">0.00</td>
														<td id="total_impuesto">0.00</td>
														<td id="total_total">0.00</td>
													   
														</td>	
													</tr>
												</tfoot>
											</table>
										</div>
									</form>
									
								</section>
								<br> 
								<br>
								<br>
							</div>
						</section>
					</article>
					<section id="conte"></section>
				<!-- Footer -->
					<footer id="footer">
						<ul class="icons">
							
						</ul>
						<ul class="copyright">
							
					</footer>
			</div>

		<!-- Scripts -->
			<script src="../assets/js/jquery.min.js"></script>
			<script src="../assets/js/jquery.scrollex.min.js"></script>
			<script src="../assets/js/jquery.scrolly.min.js"></script>
			
			<script src="../assets/js/skel.min.js"></script>
			<script src="../assets/js/util.js"></script>
			<!--[if lte I../E 8]><script src="assets/js/ie/respond.min.js"></script><![endif]-->
			<script src="../assets/js/main.js"></script>
			<script src="calculos.js"></script>
    
	</body>
</html>