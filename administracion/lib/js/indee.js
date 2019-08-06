$(document).on('ready', funcMain);

var array=0;
function funcMain()
{
	$("#add_row").on('click',newRowTable);

	$("loans_table").on('click','.fa-eraser',deleteProduct);
	$("body").on('click',".fa-eraser",deleteProduct);
	$("loans_table").on('click','.fa-edit',editProduct);
	$("loans_table").on('click','.non-margin',calcularNewTotal);
	$("loans_table").on('click','.chek',calculateTotalsBySumColumn);
	
	$("body").on('click',".fa-edit",editProduct);
	$("body").on('click',".non-margin",calcularNewTotal);
	$("body").on('click','.chek',calculateTotalsBySumColumn);
}


function funcEliminarProductosso(){
	//Obteniendo la fila que se esta eliminando
	var a=this.parentNode.parentNode;
	//Obteniendo el array de todos loe elementos columna en esa fila
	//var b=a.getElementsByTagName("td");
	var cantidad=a.getElementsByTagName("td")
	console.log(a);

	$(this).parent().parent().fadeOut("slow",function(){$(this).remove();});
}


function deleteProduct(){
	//Guardando la referencia del objeto presionado
	var _this = this;
	//Obtener las filas los datos de la fila que se va a elimnar
	var array_fila=getRowSelected(_this);

	//Restar esos datos a los totales mostrados al finales
	//calculateTotals(cantidad, precio, subtotal, impuesto, totalneto, accioneliminar)
	calculateTotals(array_fila[0],array_fila[1],array_fila[2],array_fila[3],2);

	$(this).parent().parent().fadeOut("slow",function(){$(this).remove();});
}


function editProduct(){
	var _this = this;;
	var array_fila=getRowSelected(_this);
	//console.log(array_fila[0]+" - "+array_fila[1]+" - "+array_fila[2]+" - "+array_fila[3]+" - "+array_fila[4]+" - "+array_fila[5]+" - "+array_fila[6]+" - "+array_fila[7]);
	//Codigo de editar una fila lo pueden agregar aqui
}

function objeto(objectPressed){
	var a=objectPressed.parentNode.parentNode;
	return a;
}

function getRowSelected(objectPressed){
	//Obteniendo la linea que se esta eliminando
	var a=objectPressed.parentNode.parentNode;
	//b=(fila).(obtener elementos de clase columna y traer la posicion 0).(obtener los elementos de tipo parrafo y traer la posicion0).(contenido en el nodo)
	

	var precio=a.getElementsByTagName("td")[2].getElementsByTagName("p")[0].innerHTML;
	var subtotal=a.getElementsByTagName("td")[3].getElementsByTagName("p")[0].innerHTML;
	var impuesto=a.getElementsByTagName("td")[4].getElementsByTagName("p")[0].innerHTML;
	var total=a.getElementsByTagName("td")[5].getElementsByTagName("p")[0].innerHTML;
    
	var array_fila = [ precio, subtotal, impuesto, total];

	return array_fila;
	//console.log(numero+' '+codigo+' '+descripcion);
}



function calcularNewTotal()
{



	var a=objeto(this);
	var cantidad=a.getElementsByTagName("td")[0].getElementsByTagName("input")[0].value;
	/*var descripcion=document.getElementById("descripcion").value;
	var precio=document.getElementById("precio").value;
	var subtotal=parseFloat(cantidad)*parseFloat(precio);
	var impuesto=parseFloat(subtotal)*0.15;
	var total_n=parseFloat(subtotal)+parseFloat(impuesto);*/
	
	var precio=10;
	var subtotal=cantidad*parseFloat(precio);
	var impuesto=parseFloat(subtotal)*0.16;
	var total_n=parseFloat(subtotal)+parseFloat(impuesto);

	a.getElementsByTagName("td")[3].getElementsByTagName("p")[0].innerHTML= subtotal;
	a.getElementsByTagName("td")[4].getElementsByTagName("p")[0].innerHTML= impuesto;
	a.getElementsByTagName("td")[5].getElementsByTagName("p")[0].innerHTML= total_n;
	calculateTotalsBySumColumn();
	
    
   
	
    
	//a.getElementsByTagName("td")[0].getElementsByTagName("p")[0].innerHTML= '<p name="numero_f[]" class="non-margin"><input type="number" name="des" class="cant" id="cantiti" value="1" min="1" max="1000" style=" color:black"></p>';
	//a.getElementsByTagName("td")[1].getElementsByTagName("p")[0].innerHTML='<p name="descuento_p[]" class="non-margin">'+descripcion+'</p>';
	/*a.getElementsByTagName("td")[2].getElementsByTagName("p")[0].innerHTML= '<p name="precio_p[]" class="non-margin">'+precio+'</p>';
	a.getElementsByTagName("td")[3].getElementsByTagName("p")[0].innerHTML= '<p name="subtotal_p[]" class="non-margin">'+subtotal+'</p>';
	a.getElementsByTagName("td")[4].getElementsByTagName("p")[0].innerHTML= '<p name="impuesto_p[]" class="non-margin">'+impuesto+'</p>';
	a.getElementsByTagName("td")[5].getElementsByTagName("p")[0].innerHTML= '<p name="total_p[]" class="non-margin">'+total_n+'</p>';
	a.getElementsByTagName("td")[6].getElementsByTagName("p")[0].innerHTMl= '<span ">     </span><span class="icon fa-eraser"></span>';
	*/
	//a.getElementsByTagName("td")[6].getElementsByTagName("p")[0].innerHTMl= '<span ">     </span><span class="icon fa-eraser"></span>';

	//cell1.innerHTML = '<input type="number" name="des" class="cant" id=" cantiti" value="1" min="1" max="1000" style=" color:black">';
	/*row.innerHTML = '<p name="numero_f[]" class="non-margin"><input type="number" name="des" class="cant" id="cantiti" value="1" min="1" max="1000" style=" color:black"></p>';
	row.innerHTML = '<p name="descuento_p[]" class="non-margin">'+descripcion+'</p>';
    row.innerHTML = '<p name="precio_p[]" class="non-margin">'+precio+'</p>';
    row.innerHTML = '<p name="subtotal_p[]" class="non-margin">'+subtotal+'</p>';
    row.innerHTML = '<p name="impuesto_p[]" class="non-margin">'+impuesto+'</p>';
    row.innerHTML = '<p name="total_p[]" class="non-margin">'+total_n+'</p>';
    row.innerHTML = '<span ">     </span><span class="icon fa-eraser"></span>';*/
    
	//Para calcular los totales enviando los parametros

    //Para calcular los totales sin enviar los parametros, solo adquiriendo los datos de la columna con mismo tipo de datos
   
}

function newRowTable()
{
	
  
    var nombrex=document.getElementById('selectionName').selectedIndex;
	var nombrey=document.getElementById('selectionName').options;
	var medidaX=document.getElementById('selectionMedida').selectedIndex;		
	var medidaY=document.getElementById('selectionMedida').options;
	var espesorX=document.getElementById('selectionEspesor').selectedIndex;		
	var espesorY=document.getElementById('selectionEspesor').options;	
	var tramosX=document.getElementById('selectionTramos').selectedIndex;		
	var tramosY=document.getElementById('selectionTramos').options;		
	var cantidad=1;
	var precio=10;
	var descripcion=nombrey[nombrex].text+" "+medidaY[medidaX].text+" "+espesorY[espesorX].text;
	var metros=parseFloat(document.getElementById('metros').value);
	var subtotal=cantidad*parseFloat(precio);
	var impuesto=parseFloat(subtotal)*0.16;
	var total_n=parseFloat(subtotal)+parseFloat(impuesto);

	var name_table=document.getElementById("tabla_factura");

    var row = name_table.insertRow(0+1);
    var cell1 = row.insertCell(0);
    var cell2 = row.insertCell(1);
    var cell3 = row.insertCell(2);
    var cell4 = row.insertCell(3);
    var cell5 = row.insertCell(4);
    var cell6 = row.insertCell(5);
    var cell7 = row.insertCell(6);



	//cell1.innerHTML = '<input type="number" name="des" class="cant" id=" cantiti" value="1" min="1" max="1000" style=" color:black">';
	cell1.innerHTML = '<p name="numero_f[]" class="non-margin"><input type="number" name="des" class="cant" id="cantiti" value="1" min="1" max="1000" style=" color:black"></p>';
	cell2.innerHTML = '<p name="descuento_p[]" class="non-margin">'+descripcion+'</p>';
    cell3.innerHTML = '<p name="precio_p[]" class="non-margin">'+precio+'</p>';
    cell4.innerHTML = '<p name="subtotal_p[]" class="non-margin">'+subtotal+'</p>';
    cell5.innerHTML = '<p name="impuesto_p[]" class="non-margin">'+impuesto+'</p>';
    cell6.innerHTML = '<p name="total_p[]" class="non-margin">'+total_n+'</p>';
    cell7.innerHTML = '<span ">     </span><span class="icon fa-eraser"></span>';
   array++;
    //Para calcular los totales enviando los parametros
    calculateTotals( precio, subtotal, impuesto, total_n, 1);
    //Para calcular los totales sin enviar los parametros, solo adquiriendo los datos de la columna con mismo tipo de datos
	//calculateTotalsBySumColumn()
	
}



function calculateTotalsBySumColumn(){
	
	

  

	var total_precios=0;
	var array_precios=document.getElementsByName("precio_p[]");
	//alert('si entro'+array_precios.length);
	for (var i=0; i<array_precios.length; i++) {
		total_precios+=parseFloat(array_precios[i].innerHTML);
	}
	document.getElementById("total_precio").innerHTML=total_precios;


	var subtotales=0;
	var array_subtotales=document.getElementsByName("subtotal_p[]");
	for (var i=0; i<array_subtotales.length; i++) {
		subtotales+=parseFloat(array_subtotales[i].innerHTML);
	}
	document.getElementById("total_subtotales").innerHTML=subtotales;


	var total_impuesto=0;
	var array_impuestos=document.getElementsByName("impuesto_p[]");
	for (var i=0; i<array_impuestos.length; i++) {
		total_impuesto+=parseFloat(array_impuestos[i].innerHTML);
	}
	document.getElementById("total_impuesto").innerHTML=total_impuesto;

	var totales_n=0;
	var array_totalesn=document.getElementsByName("total_p[]");
	for (var i=0; i<array_totalesn.length; i++) {
		totales_n+=parseFloat(array_totalesn[i].innerHTML);
	}
	document.getElementById("total_total").innerHTML=totales_n;
}


function calculateTotals2( precio, subtotal, impuesto, totaln, accion){
	//funcTotalsConParametro(cantidad, precio,subtotal,impuesto,total_n);

	var t_precio=parseFloat(document.getElementById("total_precio").innerHTML);
	var t_subtotal=parseFloat(document.getElementById("total_subtotales").innerHTML);
	var t_impuesto=parseFloat(document.getElementById("total_impuesto").innerHTML);
	var t_total=parseFloat(document.getElementById("total_total").innerHTML);

	//accion=1		Sumarle al los totales
	//accion=2		Restarle al los totales
	if (accion==1) {
		
		
		document.getElementById("total_precio").innerHTML=parseFloat(t_precio)+parseFloat(precio);
		document.getElementById("total_subtotales").innerHTML=parseFloat(t_subtotal)+parseFloat(subtotal);
		document.getElementById("total_impuesto").innerHTML=parseFloat(t_impuesto)+parseFloat(impuesto);
		document.getElementById("total_total").innerHTML=parseFloat(t_total)+parseFloat(totaln);
	}else if(accion==2){
		
		document.getElementById("total_precio").innerHTML=parseFloat(t_precio)-parseFloat(precio);
		document.getElementById("total_subtotales").innerHTML=parseFloat(t_subtotal)-parseFloat(subtotal);
		document.getElementById("total_impuesto").innerHTML=parseFloat(t_impuesto)-parseFloat(impuesto);
		document.getElementById("total_total").innerHTML=parseFloat(t_total)-parseFloat(totaln);
	}else{
		alert('Accion Invalida');
	}
}

function calculateTotals(precio, subtotal, impuesto, totaln, accion){
	//funcTotalsConParametro(cantidad, precio,subtotal,impuesto,total_n);
//	var t_cantidad=parseFloat(document.getElementById("total_catidad").innerHTML);
	var t_precio=parseFloat(document.getElementById("total_precio").innerHTML);
	var t_subtotal=parseFloat(document.getElementById("total_subtotales").innerHTML);
	var t_impuesto=parseFloat(document.getElementById("total_impuesto").innerHTML);
	var t_total=parseFloat(document.getElementById("total_total").innerHTML);

	//accion=1		Sumarle al los totales
	//accion=2		Restarle al los totales
	if (accion==1) {
		
		//document.getElementById("total_catidad").innerHTML=parseFloat(t_cantidad)+parseFloat(cantidad);
		document.getElementById("total_precio").innerHTML=parseFloat(t_precio)+parseFloat(precio);
		document.getElementById("total_subtotales").innerHTML=parseFloat(t_subtotal)+parseFloat(subtotal);
		document.getElementById("total_impuesto").innerHTML=parseFloat(t_impuesto)+parseFloat(impuesto);
		document.getElementById("total_total").innerHTML=parseFloat(t_total)+parseFloat(totaln);
	}else if(accion==2){
		//document.getElementById("total_catidad").innerHTML=parseFloat(t_cantidad)-parseFloat(cantidad);
		document.getElementById("total_precio").innerHTML=parseFloat(t_precio)-parseFloat(precio);
		document.getElementById("total_subtotales").innerHTML=parseFloat(t_subtotal)-parseFloat(subtotal);
		document.getElementById("total_impuesto").innerHTML=parseFloat(t_impuesto)-parseFloat(impuesto);
		document.getElementById("total_total").innerHTML=parseFloat(t_total)-parseFloat(totaln);
	}else{
		alert('Accion Invalida');
	}
}



function format(input)
{
	var num = input.value.replace(/\,/g,'');
	if(!isNaN(num)){
		input.value = num;
	}
	else{ alert('Solo se permiten numeros');
		input.value = input.value.replace(/[^\d\.]*/g,'');
	}
}