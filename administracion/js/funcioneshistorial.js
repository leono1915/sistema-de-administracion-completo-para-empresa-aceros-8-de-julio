$(document).on('ready',funcionMain);

    function funcionMain(){
        ocultarCotizacion();
        ocultarOrden();
        ocultarTikect();
        
        $('#mostrarCotizacion').on('click',Cotizacion);
        $('#mostrarOrdenes').on('click',ordenes);
        $('#mostrarTickets').on('click',tickets);
        $('#siguientePaginaCotizacion').on('click',listarCotizacionSiguiente);
        $('#anteriorPaginaCotizacion').on('click',listarCotizacionAnterior);
        $('#siguientePaginaOrden').on('click',listarOrdenSiguiente);
        $('#anteriorPaginaOrden').on('click',listarOrdenAnterior);
       // $('#siguientePaginaTicket').on('click',listarTicketSiguiente);
       // $('#anteriorPaginaTicket').on('click',listarTicketAnterior);
     // $('#actualizarProductos').on('click',actualizarProductos);
       //$("loans_table").on('click', '.fa fa-check',actualizarProductos);
       // $("body").on('click', ".fa fa-check",actualizarProductos);



}

function Cotizacion(){
    
    var opcion='cotizaciones';
    var accion='listar';
    var template="";
    var rango=document.getElementById('rango_pageCotizacion').value;
    $.ajax({
        url:'crud.php',
        type:'POST',
        data:{opcion,accion,rango},
        success:function (respuesta){
           
            var jason=JSON.parse(respuesta);
            jason.forEach(element => {
                template+=`
                <tr>
				
			
				<td><p name="nombreCliente_p[]" class="non-margin">${element.nombre}</p></td>
				<td><p name="fecha_p[]" class="non-margin">   ${element.fecha}</p></td>
				<td><p name="folio_p[]" class="non-margin"> ${element.folio}</p></td>
				<td><p name="estatus_p[]" class="non-margin"> ${element.estatus}</p></td>
				<td><p name="total_p[]" class="non-margin">   ${"$"+element.total}</p></td>
                <td class ="arch"style="display:none">${element.nombreArchivo}</td>
                <td><p name="facturado_p[]" class="non-margin">    ${element.facturado}</p></td>
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
var i=0,j=0,k=0,l=0;
function listarCotizacionSiguiente(){
    if(i==0){
        i=1;
      }
    var rangoInf=document.getElementById('rango_pageCotizacion').value*i;
    var opcion='cotizaciones';
    var accion='listar';
    var template="";
    var rango=(document.getElementById('rango_pageCotizacion').value*i)/i;
    $.ajax({
        url:'crud.php',
        type:'POST',
        data:{opcion,accion,rango,rangoInf},
        success:function (respuesta){
           
            var jason=JSON.parse(respuesta);
            jason.forEach(element => {
                template+=`
                <tr>
				
			
				<td><p name="nombreCliente_p[]" class="non-margin">${element.nombre}</p></td>
				<td><p name="fecha_p[]" class="non-margin">   ${element.fecha}</p></td>
				<td><p name="folio_p[]" class="non-margin"> ${element.folio}</p></td>
				<td><p name="estatus_p[]" class="non-margin"> ${element.estatus}</p></td>
				<td><p name="total_p[]" class="non-margin">   ${"$"+element.total}</p></td>
                <td class ="arch"style="display:none">${element.nombreArchivo}</td>
                <td><p name="facturado_p[]" class="non-margin">    ${element.facturado}</p></td>
                <td> <a href="javascript:void(0);" onclick="ira(this);" >Ver <i class="fa fa-file-pdf-o" aria-hidden="true"></i>  </a> 
                <a href="javascript:void(0);" onclick="actualizarProducto(this);">Aut <i class="fa fa-check" aria-hidden="true"></i>  </a>
                 </td>
                 
				
				</tr>
                `
            });
            $('#content_table').html(template);
            i++;
            document.getElementById('numeroPaginaCotizacion').value=i;
            mostrarCotizacion();
        }
    })
     
}
function listarCotizacionAnterior(){
    var rangoInf;
    if(i==1) rangoInf=0; 
    else
    rangoInf=(document.getElementById('rango_pageCotizacion').value*(i-2));
   if(i==1) return;
    var opcion='cotizaciones';
    var accion='listar';
    var template="";
    var rango=document.getElementById('rango_pageCotizacion').value;
    $.ajax({
        url:'crud.php',
        type:'POST',
        data:{opcion,accion,rango,rangoInf},
        success:function (respuesta){
           
            var jason=JSON.parse(respuesta);
            jason.forEach(element => {
                template+=`
                <tr>
				
			
				<td><p name="nombreCliente_p[]" class="non-margin">${element.nombre}</p></td>
				<td><p name="fecha_p[]" class="non-margin">   ${element.fecha}</p></td>
				<td><p name="folio_p[]" class="non-margin"> ${element.folio}</p></td>
				<td><p name="estatus_p[]" class="non-margin"> ${element.estatus}</p></td>
				<td><p name="total_p[]" class="non-margin">   ${"$"+element.total}</p></td>
                <td class ="arch"style="display:none">${element.nombreArchivo}</td>
                <td><p name="facturado_p[]" class="non-margin">    ${element.facturado}</p></td>
                <td> <a href="javascript:void(0);" onclick="ira(this);" >Ver <i class="fa fa-file-pdf-o" aria-hidden="true"></i>  </a> 
                <a href="javascript:void(0);" onclick="actualizarProducto(this);">Aut <i class="fa fa-check" aria-hidden="true"></i>  </a>
                 </td>
                 
				
				</tr>
                `
            });
            $('#content_table').html(template);
            i--;
            document.getElementById('numeroPaginaCotizacion').value=i;
            mostrarCotizacion();
            
        }
    })
     
}
function ordenes(){
       
    var opcion='ordenes';
    var accion='listar';
    var template="";
    var rango=document.getElementById('rango_pageOrden').value;
    $.ajax({
        url:'crud.php',
        type:'POST',
        data:{opcion,accion,rango},
        success:function (respuesta){
           
            var jason=JSON.parse(respuesta);
            jason.forEach(element => {
                template+=`
                <tr>
                
            
                <td><p name="nombreCliente_p[]" class="non-margin">${element.nombre}</p></td>
                <td><p name="fecha_p[]" class="non-margin">   ${element.fecha}</p></td>
                <td><p name="folio_p[]" class="non-margin"> ${element.folio}</p></td>
                <td><p name="estatus_p[]" class="non-margin"> ${element.estatus}</p></td>
                <td><p name="total_p[]" class="non-margin"> ${"$"+element.total}</p></td>
                <td class ="arch"style="display:none">${element.nombreArchivo}</td>
                <td> <a href="javascript:void(0);" onclick="iraO(this);" >Ver <i class="fa fa-file-pdf-o" aria-hidden="true"></i>  </a> 
                <a href="javascript:void(0);" onclick="actualizarOrden(this);">Aut <i class="fa fa-check" aria-hidden="true"></i>  </a>
                 </td>
                 
                
                </tr>
                `
            });
            $('#content_tableOrden').html(template);
            mostrarOrden();
        }
    })
     
}
  function listarOrdenSiguiente(){
    if(j==0){
        j=1;
      }
    var rangoInf=document.getElementById('rango_pageOrden').value*j;
        var opcion='ordenes';
        var accion='listar';
        var template="";
        var rango=(document.getElementById('rango_pageOrden').value*j)/j;
        $.ajax({
            url:'crud.php',
            type:'POST',
            data:{opcion,accion,rango,rangoInf},
            success:function (respuesta){
               
                var jason=JSON.parse(respuesta);
                jason.forEach(element => {
                    template+=`
                    <tr>
                    
                
                    <td><p name="nombreCliente_p[]" class="non-margin">${element.nombre}</p></td>
                    <td><p name="fecha_p[]" class="non-margin">   ${element.fecha}</p></td>
                    <td><p name="folio_p[]" class="non-margin"> ${element.folio}</p></td>
                    <td><p name="estatus_p[]" class="non-margin"> ${element.estatus}</p></td>
                    <td><p name="total_p[]" class="non-margin"> ${"$"+element.total}</p></td>
                    <td class ="arch"style="display:none">${element.nombreArchivo}</td>
                    <td> <a href="javascript:void(0);" onclick="iraO(this);" >Ver <i class="fa fa-file-pdf-o" aria-hidden="true"></i>  </a> 
                    <a href="javascript:void(0);" onclick="actualizarOrden(this);">Aut <i class="fa fa-check" aria-hidden="true"></i>  </a>
                     </td>
                     
                    
                    </tr>
                    `
                });
                $('#content_tableOrden').html(template);
                j++;
                document.getElementById('numeroPaginaOrden').value=j;
                mostrarOrden();
            }
        })
         
    }
   
    function listarOrdenAnterior(){
        var rangoInf;
    if(j==1) rangoInf=0; 
    else
    rangoInf=(document.getElementById('rango_pageOrden').value*(j-2));
   if(j==1) return;
        var opcion='ordenes';
        var accion='listar';
        var template="";
        var rango=document.getElementById('rango_pageOrden').value;
        $.ajax({
            url:'crud.php',
            type:'POST',
            data:{opcion,accion,rango,rangoInf},
            success:function (respuesta){
               
                var jason=JSON.parse(respuesta);
                jason.forEach(element => {
                    template+=`
                    <tr>
                    
                
                    <td><p name="nombreCliente_p[]" class="non-margin">${element.nombre}</p></td>
                    <td><p name="fecha_p[]" class="non-margin">   ${element.fecha}</p></td>
                    <td><p name="folio_p[]" class="non-margin"> ${element.folio}</p></td>
                    <td><p name="estatus_p[]" class="non-margin"> ${element.estatus}</p></td>
                    <td><p name="total_p[]" class="non-margin"> ${"$"+element.total}</p></td>
                    <td class ="arch"style="display:none">${element.nombreArchivo}</td>
                    <td> <a href="javascript:void(0);" onclick="iraO(this);" >Ver <i class="fa fa-file-pdf-o" aria-hidden="true"></i>  </a> 
                    <a href="javascript:void(0);" onclick="actualizarOrden(this);">Aut <i class="fa fa-check" aria-hidden="true"></i>  </a>
                     </td>
                     
                    
                    </tr>
                    `
                });
                $('#content_tableOrden').html(template);
                j--;
                document.getElementById('numeroPaginaOrden').value=j;
                mostrarOrden();
                
            }
        })
         
    }
function tickets(){
    mostrarTikect();
     
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