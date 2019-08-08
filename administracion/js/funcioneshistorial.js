
$(document).on('ready',funcionMain);

    function funcionMain(){
        ocultarCotizacion();
        ocultarOrden();
        ocultarTikect();
        $('#mostrarCotizacion').on('click',Cotizacion);
        $('#mostrarOrdenes').on('click',ordenes);
        $('#mostrarTickets').on('click',tickets);
     // $('#actualizarProductos').on('click',actualizarProductos);
       //$("loans_table").on('click', '.fa fa-check',actualizarProductos);
       // $("body").on('click', ".fa fa-check",actualizarProductos);



}

function Cotizacion(){
    
    var opcion='cotizaciones';
    var accion='listar';
    var template="";
    $.ajax({
        url:'crud.php',
        type:'POST',
        data:{opcion,accion},
        success:function (respuesta){
           
            var jason=JSON.parse(respuesta);
            jason.forEach(element => {
                template+=`
                <tr>
				
			
				<td><p name="nombreCliente_p[]" class="non-margin">${element.nombre}</p></td>
				<td><p name="fecha_p[]" class="non-margin">   ${element.fecha}</p></td>
				<td><p name="folio_p[]" class="non-margin"> ${element.folio}</p></td>
				<td><p name="estatus_p[]" class="non-margin"> ${element.estatus}</p></td>
				<td><p name="total_p[]" class="non-margin">    ${element.total}</p></td>
				<td class ="arch"style="display:none">${element.nombreArchivo}</td>
                <td> <a href="javascript:void(0);" onclick="ira(this);" >Ver <i class="fa fa-file-pdf-o" aria-hidden="true"></i>  </a> 
                <a href="javascript:void(0);" onclick="actualizarProducto(this);">Aut <i class="fa fa-check" aria-hidden="true"></i>  </a>
                 </td>
                 
				
				</tr>
                `
            });
            $('#content_table').html(template);
            mostrarCotizacion();
        }
    })
     
}
function ordenes(){
    mostrarOrden();
     
}
function tickets(){
    mostrarTikect();
     
}

function fun(i){
   // document.getElementById('tablaCotizaciones').style.display='none';
 
   var l= document.getElementById('contenedorPaginacion');
  
      
     var text=`
     <div class="row uniform" id="contenedor-padrePagina">
     <div class="1u 12u$(xsmall)"  id="padrePagina">
      <input type="button" name="nombre" id="siguientePagina" value="Ant" /> 
     </div>
     <div class="1u 12u$(xsmall)"  id="padrePagina">
    
       <input type="button" name="nombre" id="numeroPagina" value="${i}" /> 
    
     </div>
     <div class="1u 12u$(xsmall)" " id="padrePagina">
    
     <input type="button" name="nombre" id="anteriorPagina" value="Sig" /> 
     
     </div>
     </div>
     `
     //l.appendChild(text); 
     $("#contenedorPaginacion").append(text);
   
  
}



function addRow(){

     var mail=document.getElementById('correoCliente').value;
     var rfc=document.getElementById('rfcCliente').value;
     var direccion=document.getElementById('direccionCliente').value;
     var rfc=document.getElementById('rfcCliente').value;
     var telefono=document.getElementById('telefonoCliente').value;

    /* if(! isValidEmail(mail)||nombre.length()<3||rfc.length()<16){
          alert('verifique que los campos cumplan con dato válidos');
          return;
     }*/

    
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
        function mostrarCotizacion() {
			document.getElementById('tablaCotizaciones').style.display = 'block';
		}
		function mostrarOrden() {
			document.getElementById('tablaOrdenCompra').style.display = 'block';
		}
		function mostrarTikect() {
			document.getElementById('tablaTickets').style.display = 'block';
		}
        function isValidEmail(mail) { 
            return /^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,4})+$/.test(mail); 
        }