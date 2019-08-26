$(document).on('ready',funcionMain);

    function funcionMain(){
        ocultarCotizacion();
        ocultarOrden();
        ocultarTikect();
        ocultarEstadisticas();
        $('#mostrarCotizacion').on('click',Cotizacion);
        $('#mostrarEstadisticas').on('click',mostrarEsta);
        $('#mostrarOrdenes').on('click',ordenes);
        $('#mostrarTickets').on('click',tickets);
        $('#siguientePaginaCotizacion').on('click',listarCotizacionSiguiente);
        $('#anteriorPaginaCotizacion').on('click',listarCotizacionAnterior);
        $('#siguientePaginaOrden').on('click',listarOrdenSiguiente);
        $('#anteriorPaginaOrden').on('click',listarOrdenAnterior);
        $('#buscarC').on('click',buscarCotizacion);
        $('#buscarT').on('click',buscartickets);
        $('#buscarO').on('click',buscarOrdenes);
       // $('#siguientePaginaTicket').on('click',listarTicketSiguiente);
       // $('#anteriorPaginaTicket').on('click',listarTicketAnterior);
     // $('#actualizarProductos').on('click',actualizarProductos);
       //$("loans_table").on('click', '.fa fa-check',actualizarProductos);
       // $("body").on('click', ".fa fa-check",actualizarProductos);

      /* var start = new Date().getTime();
	for (var i = 0; i < 1e7; i++) {
	 if ((new Date().getTime() - start) > 3000) {
	  break;
	 }
	}*/
        

}
function mostrarEsta(){
    mostrarEstadisticas();
    listarEstadisticas();
        listarEstadistica();
        listarEstadistica2();
}
/*                          varibles globales contadoras de paginacion                              */
var i=0,j=0,k=0;

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
function buscarCotizacion(){
    
    var opcion='cotizaciones';
    var accion='consultar';
    var template="";
    var folio=document.getElementById('txtCotizacion').value;
    $.ajax({
        url:'crud.php',
        type:'POST',
        data:{opcion,accion,folio},
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
function buscarOrdenes(){
       
    var opcion='ordenes';
    var accion='consultar';
    var template="";
    var folio=document.getElementById('txtOrden').value;
    $.ajax({
        url:'crud.php',
        type:'POST',
        data:{opcion,accion,folio},
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
    
    var opcion='tickets';
    var accion='listar';
    var template="";
    var rango=document.getElementById('rango_pageTickets').value;
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
                <td> <a href="javascript:void(0);" onclick="iraT(this);" >Cancelar</a> 
                <a href="javascript:void(0);" onclick="actualizarTicket(this);">Facturar  </a>
                 </td>
                 
				
				</tr>
                `
            });
            $('#content_tableTicket').html(template);
            mostrarTikect();
        }
    })
     
}
function buscartickets(){
    
    var opcion='tickets';
    var accion='consultar';
    var template="";
    var folio=document.getElementById('txtTicket').value;
    $.ajax({
        url:'crud.php',
        type:'POST',
        data:{opcion,accion,folio},
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
                <td> <a href="javascript:void(0);" onclick="iraT(this);" >Ver <i class="fa fa-file-pdf-o" aria-hidden="true"></i>  </a> 
                <a href="javascript:void(0);" onclick="actualizarTicket(this);">Aut <i class="fa fa-check" aria-hidden="true"></i>  </a>
                 </td>
                 
				
				</tr>
                `
            });
            $('#content_tableTicket').html(template);
            mostrarTikect();
        }
    })
     
}
function listarTicketSiguiente(){
    if(k==0){
        k=1;
      }
    var rangoInf=document.getElementById('rango_pageTickets').value*k;
    var opcion='tickets';
    var accion='listar';
    var template="";
    var rango=(document.getElementById('rango_pageTickets').value*k)/k;
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
                <td> <a href="javascript:void(0);" onclick="iraT(this);" >Cancelar  </a> 
                <a href="javascript:void(0);" onclick="actualizarTicket(this);">Facturar  </a>
                 </td>
                 
				
				</tr>
                `
            });
            $('#content_tableTicket').html(template);
            k++;
            document.getElementById('numeroPaginaTicket').value=k;
            mostrarTikect();
        }
    })
     
}
function listarTicketAnterior(){
    var rangoInf;
    if(k==1) rangoInf=0; 
    else
    rangoInf=(document.getElementById('rango_pageTickets').value*(k-2));
   if(k==1) return;
    var opcion='tickets';
    var accion='listar';
    var template="";
    var rango=document.getElementById('rango_pageTickets').value;
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
                <td> <a href="javascript:void(0);" onclick="iraT(this);" >Cancelar  </a> 
                <a href="javascript:void(0);" onclick="actualizarTicket(this);">Facturar </a>
                 </td>
                 
				
				</tr>
                `
            });
            $('#content_tableTicket').html(template);
            k--;
            document.getElementById('numeroPaginaTicket').value=k;
            mostrarTikect();
            
        }
    })
     
}
var aux2="";
  function listarEstadisticas(){
   
   var opcion='historial';
   var accion='listar';
  
   $.ajax({
       url:'crud.php',
       type:'POST',
       data:{opcion,accion},
       success:function (respuesta){
        var template="";
        var mes="";
        var aux1="";
       
           var jason=JSON.parse(respuesta);
           jason.forEach(element => {

          switch(parseInt(element.mes)){
              case 1: mes='ENERO'; break;
              case 2: mes='FEBRERO'; break;
              case 3: mes='MARZO'; break;
              case 4: mes='ABRIL'; break;
              case 5: mes='MAYO'; break;
              case 6: mes='JUNIO'; break;
              case 7: mes='JULIO'; break;
              case 8: mes='AGOSTO'; break;
              case 9: mes='SEPTIEMPRE'; break;
              case 10: mes='OCTUBRE'; break;
              case 11: mes='NOVIEMBRE'; break;
              case 12: mes='DICIEMBRE'; break;
          }
           template+=` <th> ${mes} </th>
           <tr>
            <TD>
                     
            <TABLE WIDTH=100%>
                    
            <TR>
            <TD>Pendientes ${element.pendiente}</TD>
            <TD>Autorizadas ${element.autorizado}</TD>
            </TR>
            <TD>Facturado</TD>
            <TD>No Facturado</TD>
            <TR>
                <Td>${element.facturado}</Td>
                <Td>${element.no_facturado}</Td>
                
            </TR>
                 <Td>Total</Td>
                 <td>${element.total}</td>
            </TABLE>
            </TD> 
           
            
            </tr>`
            ;

                     
                     }
                     
                    
                    
             
           
                            );
        
           
           document.getElementById("contenido-estadisticas").innerHTML=template;
          
       }
   })
   
  }
 
  function listarEstadistica(){
   
    var opcion='historial';
    var accion='listarTickets';
    $.ajax({
        url:'crud.php',
        type:'POST',
        data:{opcion,accion},
        success:function (respuesta){
         var template="";
         var fecha=" ";
            var jason=JSON.parse(respuesta);
            jason.forEach(element => {
                template+=` <th>|</th>
                <tr>
                 <TD>
                          
                 <TABLE WIDTH=100%>
                         
                 <TR>
                 <TD>Cancelados ${element.pendiente}</TD>
                 <TD>Autorizados ${element.autorizado}</TD>
                 </TR>
                 <TD>Facturado</TD>
                 <TD>No Facturado</TD>
                 <TR>
                     <Td>${element.facturado}</Td>
                     <Td>${element.no_facturado}</Td>
                     
                 </TR>
                      <Td>Total</Td>
                      <td>${element.total}</td>
                 </TABLE>
                 </TD> 
                
                 
                 </tr>
     
                         
                         
                         `;
                       
            });
            //$('#contenido-estadisticas').html(template);
           
            document.getElementById("contenido-estadisticas2").innerHTML=template;
        }
    })
    
   }  

   function listarEstadistica2(){
   
    var opcion='historial';
    var accion='listarCompras';
    $.ajax({
        url:'crud.php',
        type:'POST',
        data:{opcion,accion},
        success:function (respuesta){
         var template="";
         var fecha="";
            var jason=JSON.parse(respuesta);
            jason.forEach(element => {
                template+=` <th>|      </th>
                <tr>
                 <TD>
                          
                 <TABLE WIDTH=100%>
                         
                 <TR>
                 <TD>Pendientes ${element.pendiente}</TD>
                 <TD>Autorizadas ${element.autorizado}</TD>
                 </TR>
                 <TD>Total</TD>
                 <TD>Compras</TD>
                 <TR>
                     <Td>Total</Td>
                     <Td>${element.facturado}</Td>
                     
                 </TR>
                      <Td>Total</Td>
                      <td>${element.facturado}</td>
                 </TABLE>
                 </TD> 
                
                 
                 </tr>
     
                         
                         
                         `;
                       
            });
        
           
            document.getElementById("contenido-estadisticas3").innerHTML=template;
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
        function mostrarCotizacion() {
			document.getElementById('tablaCotizaciones').style.display = 'block';
		}
		function mostrarOrden() {
			document.getElementById('tablaOrdenCompra').style.display = 'block';
		}
		function mostrarTikect() {
			document.getElementById('tablaTickets').style.display = 'block';
        }
        function ocultarEstadisticas() {
			document.getElementById('tablaEstadisticas').style.display = 'none';
        }
        function mostrarEstadisticas() {
			document.getElementById('tablaEstadisticas').style.display = 'block';
		}
        function isValidEmail(mail) { 
            return /^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,4})+$/.test(mail); 
        }