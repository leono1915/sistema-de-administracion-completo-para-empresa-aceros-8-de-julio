$(document).on('ready', funcMain);


function funcMain() {
	$("#add_row").on('click', newRowTable);
	$("#descuentos").on('click', calculateTotalsBySumColumnDescuento);
	$("#add_concepto").on('click', abrirVentana);
	$("#cotizar_placas").on('click', abrirCotizadorPlacas);
	$("#cerrar-placas").on('click', closeCotizadorPlacas);
	$("#cerrar-popup").on('click', closeConcepto);
	$("#enviar-popup").on('click', newConcepto);
	$("#enviar-placas").on('click', calculoDePlacas);
	$("loans_table").on('click', '.fa-eraser', deleteProduct);
	$("body").on('click', ".fa-eraser", deleteProduct);
	$('#imprimir').on('click',imprimir);
	$('#generarTicket').on('click',imprimirTicket);
	$("loans_table").on('click', '.non-margin', calcularNewTotal);
	$("loans_table").on('click', '.fa-window-close', calculateTotalsBySumColumn);

	
	$("body").on('click', ".non-margin", calcularNewTotal);
	$("body").on('click', '.fa-window-close', calculateTotalsBySumColumn);
    listarTablaTemporal();

}



function newConcepto() {
   

	var cantidad = parseInt(document.getElementById('cantidadConcepto').value);
	var nombre = document.getElementById('nombreConcepto').value;
	var medida = document.getElementById('medidaConcepto').value;
	var espesor = document.getElementById('espesorConcepto').value;
	var precio = parseFloat(document.getElementById('precioConcepto').value);
	var bandera = false;
	var descripcion = nombre + " " + medida + " " + espesor;
	if (cantidad != 1) {
		alert('por defecto la cantidad es uno, puede modificarla en la caja de incremento');

	}
	else if (nombre.length < 2 || medida.length < 1 || espesor.length < 1) {
		alert('debe ingresar datos validos');
	}
	else if (isNaN(precio)) {
		alert('el precio no es valido');
	}
	else {
		bandera = true;
	}
	if (bandera) {
		var subtotal = cantidad * parseFloat(precio);
		var impuesto = parseFloat(subtotal) * 0.16;
		var total_n = parseFloat(subtotal) + parseFloat(impuesto);

	
		calculateTotals(precio, subtotal, impuesto, total_n, 1);
		tablaParametros(cantidad,descripcion,an=  Math.round(precio * 100) / 100,
		subtotal= Math.round(subtotal * 100) / 100 ,iva=Math.round(impuesto * 100) / 100,total= Math.round(total_n* 100) / 100,
		accion='<span ">     </span><span class="icon fa-eraser"></span>',250,0,0,0);
		closeConcepto();
	}


}
function abrirVentana() {
	document.getElementById('ventana-emergente').style.display = 'block';
}
function abrirCotizadorPlacas() {
	document.getElementById('cotizador-placas').style.display = "block";
}
function closeCotizadorPlacas() {
	document.getElementById('cotizador-placas').style.display = "none";
}
function closeConcepto() {

	document.getElementById('ventana-emergente').style.display = 'none';


}

function funcEliminarProductosso() {
	//Obteniendo la fila que se esta eliminando
	var a = this.parentNode.parentNode;
	$(this).parent().parent().fadeOut("slow", function () { $(this).remove(); });
}


function deleteProduct() {
	
	//Guardando la referencia del objeto presionado
	var _this = this;
	var idProducto= objeto(_this).getElementsByTagName("td")[7].getElementsByTagName("input")[0].value;
	var cantidad=objeto(_this).getElementsByTagName("td")[8].getElementsByTagName("input")[0].value;
	var idCotizacion=objeto(_this).getElementsByTagName('td')[9].getElementsByTagName('input')[0].value;
	console.log(idProducto+" "+cantidad+" "+idCotizacion);
	//Obtener las filas los datos de la fila que se va a elimnar
	var respuesta=prompt(
	`El producto a eliminar ha sido vendido ? si es así, 
	este se actualizará del inventario, en caso contrario
	solo se eliminara de la lista`,'SI');
	$.ajax({
		url:'actualizarInventario.php',
		type:'POST',
		data:{idCotizacion,cantidad,respuesta,idProducto},
		success:function(respuesta){
			 
		listarTablaTemporal();	

	alert(respuesta);
		}
		
	})
	var array_fila = getRowSelected(_this);
     
	calculateTotals(array_fila[0], array_fila[1], array_fila[2], array_fila[3], 2);
	$(this).parent().parent().fadeOut("fast", function () { $(this).remove(); });
}


function objeto(objectPressed) {
	var a = objectPressed.parentNode.parentNode;
	return a;
}

function getRowSelected(objectPressed) {
	//Obteniendo la linea que se esta eliminando
	var a = objectPressed.parentNode.parentNode;
	var precio = a.getElementsByTagName("td")[2].getElementsByTagName("p")[0].innerHTML;
	var subtotal = a.getElementsByTagName("td")[3].getElementsByTagName("p")[0].innerHTML;
	var impuesto = a.getElementsByTagName("td")[4].getElementsByTagName("p")[0].innerHTML;
	var total = a.getElementsByTagName("td")[5].getElementsByTagName("p")[0].innerHTML;
	var array_fila = [precio, subtotal, impuesto, total];

	return array_fila;

}



function calcularNewTotal() {
    
	var a = objeto(this);
	var idCotizacion= a.getElementsByTagName("td")[9].getElementsByTagName("input")[0].value;
	var tramos= parseFloat(a.getElementsByTagName("td")[11].getElementsByTagName("input")[0].value);
	var metros= parseFloat(a.getElementsByTagName("td")[10].getElementsByTagName("input")[0].value);
	var cantidad = parseInt(a.getElementsByTagName("td")[0].getElementsByTagName("input")[0].value);
	var auxMetros=(metros*(1/6));
	
	if(tramos>1&&metros!=0){
		alert('solo puede incrementar unidades');
		return;
	}else if(tramos!=0&&metros>0){
		alert('solo puede incrementar unidades');
		return;
	}else if(tramos>1){
		alert('solo puede incrementar unidades');
		return;
	}
	
	var cantidadT;
	cantidadT=(tramos+auxMetros)*cantidad;
	var precio = a.getElementsByTagName("td")[2].getElementsByTagName("p")[0].innerHTML;
	var subtotal = cantidad * parseFloat(precio);
	var impuesto = parseFloat(subtotal) * 0.16;
	var total_n = parseFloat(subtotal) + parseFloat(impuesto);
    var respuesta='calcularNuevoTotal';
	a.getElementsByTagName("td")[3].getElementsByTagName("p")[0].innerHTML = Math.round(subtotal * 100) / 100;
	a.getElementsByTagName("td")[4].getElementsByTagName("p")[0].innerHTML = Math.round(impuesto * 100) / 100;
	a.getElementsByTagName("td")[5].getElementsByTagName("p")[0].innerHTML = Math.round(total_n * 100) / 100;
	$.ajax({
		url:'actualizarInventario.php',
		type:'POST',
		data:{cantidad,cantidadT,idCotizacion,subtotal,impuesto,total_n,respuesta},
		success:function(respuesta){
			
			listarTablaTemporal();
			calculateTotalsBySumColumn();
		}
	})
	


}

function newRowTable() {
	var pulgadas;
	var check=document.getElementById('pulgadasMaterial');
	if(check.checked==true){
		pulgadas=check.value;
	}else{
		pulgadas=1;
	}
	var factorTramo;
	var costoPerdida = .16;
	var nombrex = document.getElementById('selectionName').selectedIndex;
	var nombrey = document.getElementById('selectionName').options;
	var medidaX = document.getElementById('selectionMedida').selectedIndex;
	var medidaY = document.getElementById('selectionMedida').options;
	var espesorX = document.getElementById('selectionEspesor').selectedIndex;
	var espesorY = document.getElementById('selectionEspesor').options;
	var tramosX = document.getElementById('selectionTramos').selectedIndex;
	var tramosY = document.getElementById('selectionTramos').options;
	var cantidad = tramosY[tramosX].text;
	var metros = document.getElementById('metros').value*pulgadas;
	var impuestoCredito = document.getElementById('numero').value;
	if (impuestoCredito.length == 0) {
		impuestoCredito = 0;
	}
	var nombreFin = nombrey[nombrex].text;
	var medidaFin = medidaY[medidaX].text;
	var espesorFin = espesorY[espesorX].text;

	if ((metros.length == 0) && (cantidad == 'Tramos')) {
		alert("debe ingresar cantidad a ser cotizada");
		return;
	}
	$.ajax({
		url: 'calculos.php',
		type: 'POST',
		data: { 'nombreFinal': nombreFin, 'medidaFinal': medidaFin, 'espesorFinal': espesorFin },
		success: function (respuesta) {
			
			
				
			let res = JSON.parse(respuesta);
            
			let precio = parseFloat(res[0].precio) + parseFloat(impuestoCredito);
			let peso = parseFloat(res[0].peso);
			let id = parseInt(res[0].id);
			if (id < 82 && id > 58) {
				factorTramo = (1 / 3);
			} else if (id > 240) {
				factorTramo = (1 / 12.2);
				costoPerdida = 0;
			}
			else if (id > 36 && id < 43) {
				factorTramo = (1 / 12.2);
				costoPerdida = 0;
			} else {
				factorTramo = (1 / 6);
			}
			


			

			if ((metros.length == 0)) {
				metros = 0;
			}
			if (cantidad == 'Tramos') {
				cantidad = 0;
			}
            var descripcion = nombrey[nombrex].text + " " + medidaY[medidaX].text + " " + espesorY[espesorX].text+" tramos :"+ cantidad+" metros :"
			+ Math.round(parseFloat(metros)*100)/100;
			var nombreBaseDatos=nombrey[nombrex].text + " " + medidaY[medidaX].text + " " + espesorY[espesorX].text;
			var costoMetros = ((parseFloat(metros) * (factorTramo)) * peso) * precio;
			var cantidadDescontar=parseInt(cantidad)+(parseFloat(metros) * factorTramo);
			var subtotalMetros = costoMetros * costoPerdida;
			costoMetros += subtotalMetros;
		

			var subtotal = cantidad * peso * parseFloat(precio) + costoMetros;
			var impuesto = parseFloat(subtotal) * 0.16;
			var total_n = parseFloat(subtotal) + parseFloat(impuesto);
			var aux=1;
			tramos=cantidad;
			if(cantidad==0){
				cantidad=1;
				
			}
		   
		
			//Para calcular los totales enviando los parametros
			
			
			 tablaParametros(aux,descripcion,an= Math.round((subtotal / cantidad) * 100) / 100,
			subtotal= Math.round(subtotal * 100) / 100 ,iva=Math.round(impuesto * 100) / 100,total= Math.round(total_n * 100) / 100,
			accion='<span ">     </span><span class="icon fa-eraser"></span>',id,cantidadDescontar, Math.round(parseFloat(metros)*100)/100,tramos);
		
			calculateTotals(precio, subtotal, impuesto, total_n, 1);
		
			
			

		}
		



	})

    
			

}

function tablaCotizacionTemporal(){
	var cantidad=this.document.getElementsByTagName('td')[1].getElementsByTagName('input')[0].value;
	var descripcion=this.document.getElementsByTagName('td')[2].getElementsByTagName('p')[0].innerHTML;
	var precioUnitario=this.document.getElementsByTagName('td')[3].getElementsByTagName('p')[0].innerHTML;
	var subtotal=this.document.getElementsByTagName('td')[4].getElementsByTagName('p')[0].innerHTML;
	var iva=this.document.getElementsByTagName('td')[5].getElementsByTagName('p')[0].innerHTML;
	var total=this.document.getElementsByTagName('td')[6].getElementsByTagName('p')[0].innerHTML;
	var accion='<span ">     </span><span class="icon fa-eraser"></span>';
	var id=this.document.getElementsByTagName('td')[8].getElementsByTagName('input')[0].value;
	var cantidadDescontar=this.document.getElementsByTagName('td')[9].getElementsByTagName('input')[0].value;
	//alert(cantidad+descripcion+precioUnitario+subtotal+iva+total+accion+id+cantidadDescontar);
	$.ajax({
		url:'tablaTemporal.php',
		type:'POST',
		data:{cantidad,descripcion,precioUnitario,subtotal,iva,total,accion,id,cantidadDescontar},
		success:function(respuesta){
			listarTablaTemporal();
		}
	})

}

function calculateTotalsBySumColumn() {

	var total_precios = 0;
	var array_precios = document.getElementsByName("precio_p[]");
	for (var i = 0; i < array_precios.length; i++) {
		total_precios += parseFloat(array_precios[i].innerHTML);
	}
	document.getElementById("total_precio").innerHTML = Math.round(total_precios * 100) / 100;


	var subtotales = 0;
	var array_subtotales = document.getElementsByName("subtotal_p[]");
	for (var i = 0; i < array_subtotales.length; i++) {
		subtotales += parseFloat(array_subtotales[i].innerHTML);
	}
	document.getElementById("total_subtotales").innerHTML = Math.round(subtotales * 100) / 100;


	var total_impuesto = 0;
	var array_impuestos = document.getElementsByName("impuesto_p[]");
	for (var i = 0; i < array_impuestos.length; i++) {
		total_impuesto += parseFloat(array_impuestos[i].innerHTML);
	}
	document.getElementById("total_impuesto").innerHTML = Math.round(total_impuesto * 100) / 100;

	var totales_n = 0;
	var array_totalesn = document.getElementsByName("total_p[]");
	for (var i = 0; i < array_totalesn.length; i++) {
		totales_n += parseFloat(array_totalesn[i].innerHTML);
	}
	document.getElementById("total_total").innerHTML = Math.round(totales_n * 100) / 100;
	document.getElementById("descuento").innerHTML = 0.0;
}


function calculateTotalsBySumColumnDescuento() {
	var total_precios = 0;
	var array_precios = document.getElementsByName("precio_p[]");
	for (var i = 0; i < array_precios.length; i++) {
		total_precios += parseFloat(array_precios[i].innerHTML);
	}
	document.getElementById("total_precio").innerHTML = Math.round(total_precios * 100) / 100;


	var subtotales = 0;
	var array_subtotales = document.getElementsByName("subtotal_p[]");
	for (var i = 0; i < array_subtotales.length; i++) {
		subtotales += parseFloat(array_subtotales[i].innerHTML);
	}
	document.getElementById("total_subtotales").innerHTML = Math.round(subtotales * 100) / 100;


	var total_impuesto = 0;
	var array_impuestos = document.getElementsByName("impuesto_p[]");
	for (var i = 0; i < array_impuestos.length; i++) {
		total_impuesto += parseFloat(array_impuestos[i].innerHTML);
	}
	document.getElementById("total_impuesto").innerHTML = Math.round(total_impuesto * 100) / 100;
	var descuento = (total_impuesto / 2);
	document.getElementById("descuento").innerHTML = Math.round(descuento * 100) / 100;
	var totales_n = 0;
	var array_totalesn = document.getElementsByName("total_p[]");
	for (var i = 0; i < array_totalesn.length; i++) {
		totales_n += parseFloat(array_totalesn[i].innerHTML);
	}
	document.getElementById("total_total").innerHTML = Math.round((totales_n - descuento) * 100) / 100;

}

function calculateTotals(precio, subtotal, impuesto, totaln, accion) {

	var t_precio = parseFloat(document.getElementById("total_precio").innerHTML);
	var t_subtotal = parseFloat(document.getElementById("total_subtotales").innerHTML);
	var t_impuesto = parseFloat(document.getElementById("total_impuesto").innerHTML);
	var t_total = parseFloat(document.getElementById("total_total").innerHTML);

	//accion=1		Sumarle al los totales
	//accion=2		Restarle al los totales
	if (accion == 1) {

		document.getElementById("total_precio").innerHTML = Math.round((parseFloat(t_precio) + parseFloat(precio)) * 100) / 100;
		document.getElementById("total_subtotales").innerHTML = Math.round((parseFloat(t_subtotal) + parseFloat(subtotal)) * 100) / 100;

		document.getElementById("total_impuesto").innerHTML = Math.round((parseFloat(t_impuesto) + parseFloat(impuesto)) * 100) / 100;

		document.getElementById("total_total").innerHTML = Math.round((parseFloat(t_total) + parseFloat(totaln)) * 100) / 100;

	} else if (accion == 2) {
		document.getElementById("total_precio").innerHTML = Math.round((parseFloat(t_precio) - parseFloat(precio)) * 100) / 100;

		document.getElementById("total_subtotales").innerHTML = Math.round((parseFloat(t_subtotal) - parseFloat(subtotal)) * 100) / 100;

		document.getElementById("total_impuesto").innerHTML = Math.round((parseFloat(t_impuesto) - parseFloat(impuesto)) * 100) / 100;

		document.getElementById("total_total").innerHTML = Math.round((parseFloat(t_total) - parseFloat(totaln)) * 100) / 100;

	} else {
		alert('Accion Invalida');
	}
}
function validacion() {
	var constantePesoPlaca = $("input[name='gender']:checked").val();
	var medida1 = parseFloat(document.getElementById('medida1').value);
	var medida2 = parseFloat(document.getElementById('medida2').value);
	var precioCorte = parseFloat(document.getElementById('precioCorte').value);
	var precio = parseFloat(document.getElementById('precio').value);
	if (constantePesoPlaca == null || isNaN(medida1) || isNaN(medida2) || isNaN(precioCorte) || isNaN(precio)) {
		alert('debe llenar los campos requeridos');
		return false;
	} else {
		return true;
	}
}
function calculoDePlacas() {
	var pulgadas;
	var check=document.getElementById('pulgadas');
	if(check.checked==true){
		pulgadas=check.value;
	}else{
		pulgadas=1;
	}
	const pi = 3.141596, iva = .16;
	var auxiliarCorteBrida = 0;
	var auxiliarCorte = 0;
	var auxiliarPeso = 1;
	var constantePesoPlaca = $("input[name='gender']:checked").val();
	var medida1 = parseFloat(document.getElementById('medida1').value)*pulgadas;
	var medida2 = parseFloat(document.getElementById('medida2').value)*pulgadas;
	var precioCorte = parseFloat(document.getElementById('precioCorte').value);
	var precio = parseFloat(document.getElementById('precio').value);
	var medidaBrida = parseFloat(document.getElementById('medidaBrida').value)*pulgadas;
	var total, subtotal, impuesto;
	var tipoPlacax = document.getElementById('selectionNamePlaca').selectedIndex;
	var tipoPlacay = document.getElementById('selectionNamePlaca').options;

	if (isNaN(medidaBrida)) {
		if (tipoPlacay[tipoPlacax].text == 'Brida') {
			alert('se necesita un diametro interior para calcular la brida');
			return;
		}
		medidaBrida = 0;


	}


	if (tipoPlacay[tipoPlacax].text == 'Disco') {
		auxiliarCorte = ((medida1 * pi) / 2.54) * precioCorte;
	}
	if (tipoPlacay[tipoPlacax].text == 'Cartabon') {
		auxiliarPeso = 2;
		auxiliarCorte = ((medida1 + medida2) / 2.54) * precioCorte;
	}
	if (tipoPlacay[tipoPlacax].text == 'Brida') {

		auxiliarCorteBrida = (medidaBrida * pi) * precioCorte;
		auxiliarCorte = ((medida1 * pi) / 2.54) * precioCorte;
	}
	var precioCorteFinal = (((medida1 + medida2) / 2.54) * precioCorte) + auxiliarCorte + auxiliarCorteBrida;
	var pesoPlacaFinal = (medida1 * medida2 * constantePesoPlaca) / auxiliarPeso;
	var precioPlaca = precio * pesoPlacaFinal;
	subtotal = precioPlaca + precioCorteFinal;
	impuesto = subtotal * iva;
	total = impuesto + subtotal;
	var id = $("input[name='gender']:checked").parent().find('.spana').text();
	var descripcion = tipoPlacay[tipoPlacax].text + " DE " + id + " " + medida1 + "x" + medida2 + " KG " + Math.round(pesoPlacaFinal * 100) / 100;


	if (validacion()) {
		document.getElementById('txtPesoPlaca').value = Math.round(pesoPlacaFinal * 100) / 100;
		document.getElementById('txtCortePlaca').value = Math.round(precioCorteFinal * 100) / 100;
		document.getElementById('txtSubTotalPlaca').value = Math.round(subtotal * 100) / 100;
		document.getElementById('txtIvaPlaca').value = Math.round(impuesto * 100) / 100;
		document.getElementById('txtTotalPlaca').value = Math.round(total * 100) / 100;
		/*var name_table = document.getElementById("tabla_factura");

		var row = name_table.insertRow(0 + 1);
		var cell1 = row.insertCell(0);
		var cell2 = row.insertCell(1);
		var cell3 = row.insertCell(2);
		var cell4 = row.insertCell(3);
		var cell5 = row.insertCell(4);
		var cell6 = row.insertCell(5);
		var cell7 = row.insertCell(6);
		var cell8 = row.insertCell(7);
		var cell9 = row.insertCell(8);


		cell1.innerHTML = '<p name="numero_f[]" class="non-margin"><input type="number" name="des" class="cant" id="cantiti" value="1" min="1" max="1000" style=" color:black"></p>';
		cell2.innerHTML = '<p name="descuento_p[]" class="non-margin">' + descripcion + '</p>';
		cell3.innerHTML = '<p name="precio_p[]" class="non-margin">' + Math.round(subtotal * 100) / 100 + '</p>';
		cell4.innerHTML = '<p name="subtotal_p[]" class="non-margin">' + Math.round(subtotal * 100) / 100 + '</p>';
		cell5.innerHTML = '<p name="impuesto_p[]" class="non-margin">' + Math.round(impuesto * 100) / 100 + '</p>';
		cell6.innerHTML = '<p name="total_p[]" class="non-margin">' + Math.round(total * 100) / 100 + '</p>';
		cell7.innerHTML = '<span ">     </span><span class="icon fa-eraser"></span>';
		cell8.innerHTML = '<p name="id_f[]" class="non-margin"><input type="hidden" name="des" class="cant" id="concepto" value="0" ></p>';
		cell9.innerHTML = '<p name="cantidad_f[]" class="non-margin"><input type="hidden" name="des" class="cant" id="" value="0" ></p>';
*/
		
		tablaParametros(1,descripcion,an= Math.round(subtotal * 100) / 100 ,
		subtotal1= Math.round(subtotal * 100) / 100 ,iva1=Math.round(impuesto * 100) / 100,total1= Math.round(total* 100) / 100,
		accion='<span ">    </span><span class="icon fa-eraser"></span>',250,0,0,0);
		calculateTotals(subtotal, subtotal, impuesto, total, 1);
	}
}
function imprimir() {
	var nombrey=document.getElementById('selectionNameCliente').selectedIndex;
	var nombrex=document.getElementById('selectionNameCliente').options;
	var nombreCliente=nombrex[nombrey].text;
	var descuento=parseFloat(document.getElementById('descuento').innerHTML);
	if(nombreCliente=='Nombre Cliente'){
		 alert('debe escoger un Cliente');
		 return;
	}
	window.open("plantilla.php?nombreCliente=" + nombreCliente + "&descuento="+ descuento +""); 
	var start = new Date().getTime();
	for (var i = 0; i < 1e7; i++) {
	 if ((new Date().getTime() - start) > 3000) {
	  break;
	 }
	}
	location.href= "cotizador.php";
	//location.href ='plantilla.php' + "?nombreCliente=" +nombreCliente;

		
	

}
function imprimirTicket() {
	var nombrey=document.getElementById('selectionNameCliente').selectedIndex;
	var nombrex=document.getElementById('selectionNameCliente').options;
	var nombreCliente=nombrex[nombrey].text;
	if(nombreCliente=='Nombre Cliente'){
		 alert('debe escoger un Cliente');
		 return;
	}
	//window.open('ticket.php' + "?nombreCliente=" +nombreCliente,"_blank");
	var descuento=parseFloat(document.getElementById('descuento').innerHTML);
    window.open("ticket.php?nombreCliente=" + nombreCliente + "&descuento="+ descuento +""); 
	var start = new Date().getTime();
	for (var i = 0; i < 1e7; i++) {
	 if ((new Date().getTime() - start) > 3000) {
	  break;
	 }
	}
	location.href= "cotizador.php";
	//location.href ='plantilla.php' + "?nombreCliente=" +nombreCliente;

		
	

}

function listarTablaTemporal(){
  

	$.ajax({
		url: 'listartabla.php',
		type: 'GET',
		success: function (respuesta) {
			let res = JSON.parse(respuesta);
			let template=' ';
			res.forEach(element => {
				template +=
                  `
				<tr>
				
				<td><p name="numero_f[]" class="non-margin"><input type="number" name="des" class="cant" id="cantiti" value=${element.cantidad} min="1" max="1000" style=" color:black"></p></td>
				<td><p name="descuento_p[]" class="non-margin">${element.descripcion}</p></td>
				<td><p name="precio_p[]" class="non-margin">   ${element.precioUnitario}</p></td>
				<td><p name="subtotal_p[]" class="non-margin"> ${element.subtotal}</p></td>
				<td><p name="impuesto_p[]" class="non-margin"> ${element.iva}</p></td>
				<td><p name="total_p[]" class="non-margin">    ${element.total}</p></td>
				<td><span ">     </span><span class="icon fa-eraser"></span></td>
				<td><p name="id_f[]" class="non-margin"><input type="hidden" name="des" class="cant" id="concepto" value=${element.id}></p></td>
				<td><p name="cantidad_f[]" class="non-margin"><input type="hidden" name="des" class="cant" id="" value=${element.cantidadDescontar}></p></td>
				<td ><p name="cantidad2_f[]" class="non-margin"><input type="hidden" name="des" class="cant" id="" value=${element.idCotizacion}></p></td>
				<td><p name="cantidad3_f[]" class="non-margin"><input type="hidden" name="des" class="cant" id="" value=${element.metros}></p></td>
				<td><p name="cantidad3_f[]" class="non-margin"><input type="hidden" name="des" class="cant" id="" value=${element.tramos}></p></td>
				</tr>
				`
			});
			$('#content_table').html(template);
			calculateTotalsBySumColumn();
		}
	})
}
function tablaParametros(cantidad,descripcion,precioUnitario,subtotal,iva,total,accion,id,cantidadDescontar,metros,tramos){
    var eliminado='no';
	$.ajax({
		url:'tablaTemporal.php',
		type:'POST',
		data:{cantidad,descripcion,precioUnitario,subtotal,iva,total,accion,id,cantidadDescontar,metros,tramos,eliminado},
		success:function(respuesta){
			//alert(respuesta);
			listarTablaTemporal();
		}
	})

}
function format(input) {
	var num = input.value.replace(/\,/g, '');
	if (!isNaN(num)) {
		input.value = num;
	}
	else {
		alert('Solo se permiten numeros');
		input.value = input.value.replace(/[^\d\.]*/g, '');
		return
	}
}