$(document).on('ready',principal);

function principal(){
 
 //alert('si leo')
  //fun();
 
  $('#siguientePagina').on('click',listarClientesSiguiente);
  $('#anteriorPagina').on('click',listarClientesAnterior);
  $('#add_row').on('click',agregarClientes);
  $('#buscarCliente').on('click',buscarClientes);
  listarClientes();
  
}



function listarClientes(){

  
  var opcion='clientes';
  var accion='listar';
  var template="";
  var rango=document.getElementById('rango_page').value;
  
  var i=0;
  $.ajax({
      url:'crud.php',
      type:'POST',
      data:{opcion,accion,rango},
      success:function (respuesta){
         i++;
        // alert(respuesta);   <a href="javascript:void(0);" onclick="" >Ver <i class="fas fa-eye"></i>  </a>
          var jason=JSON.parse(respuesta);
          jason.forEach(element => {
           
              template+=`
              <tr>
              <td style="display:none;"> ${element.id} </td>
              <td><p name="nombreCliente_p[]" class="non-margin">${element.nombre}</p></td>
              <td><p name="fecha_p[]" class="non-margin">   ${element.nombre_agente}</p></td>
              <td><p name="folio_p[]" class="non-margin"> ${element.domicilio}</p></td>
              <td><p name="estatus_p[]" class="non-margin"> ${element.telefono}</p></td>
              <td><p name="total_p1[]" class="non-margin">    ${element.celular}</p></td>
              <td>${element.rfc}</td>
              <td><p name="total_p2[]" class="non-margin">    ${element.correo}</p></td>
                <td> 
                <a href="javascript:void(0);" onclick="editar(this);">Editar <i class="far fa-edit"></i>  </a>
                <a href="javascript:void(0);" onclick="eliminar(this);">Borrar <i class="fas fa-trash-alt"></i>  </a>
                </td>
                       
              
              </tr>
              `
          });
          $('#content_table').html(template);
         
         
        
          
      }
  })

  
   
}
var i=0;
function listarClientesSiguiente(){
  if(i==0){
    i=1;
  }
  
 
  var rangoInf=document.getElementById('rango_page').value*i;
  //document.getElementsByName('fecha_p[]').length;
  
  var factorCantidad=(1/6);
  var opcion='clientes';
  var accion='listar';
  var template="";
  var rango=(document.getElementById('rango_page').value*i)/i;
console.log(rangoInf+"  "+rango);
  
  $.ajax({
      url:'crud.php',
      type:'POST',
      data:{opcion,accion,rango,rangoInf},
      success:function (respuesta){
        
        // alert(respuesta);
          var jason=JSON.parse(respuesta);
          jason.forEach(element => {
          
            var metro=parseFloat("."+element.metros);
              template+=`
              <tr>
              <td style="display:none;"> ${element.id} </td>
              <td><p name="nombreCliente_p[]" class="non-margin">${element.nombre}</p></td>
              <td><p name="fecha_p[]" class="non-margin">   ${element.nombre_agente}</p></td>
              <td><p name="folio_p[]" class="non-margin"> ${element.domicilio}</p></td>
              <td><p name="estatus_p[]" class="non-margin"> ${element.telefono}</p></td>
              <td><p name="total_p1[]" class="non-margin">    ${element.celular}</p></td>
              <td>${element.rfc}</td>
              <td><p name="total_p2[]" class="non-margin">    ${element.correo}</p></td>
                <td> 
                <a href="javascript:void(0);" onclick="editar(this);">Editar <i class="far fa-edit"></i>  </a>
                <a href="javascript:void(0);" onclick="eliminar(this);">Borrar <i class="fas fa-trash-alt"></i>  </a>
                </td>
                       
              
              </tr>
              `
          });
         
          $('#content_table').html(template);
         i++;
         document.getElementById('numeroPagina').value=i;
    
      }
      
  })
     
}


function listarClientesAnterior(){
 
  
  var rangoInf;
  if(i==1) rangoInf=0; 
  else
  rangoInf=(document.getElementById('rango_page').value*(i-2));
 if(i==1) return;

  var opcion='clientes';
  var accion='listar';
  var template="";
  var rango=(document.getElementById('rango_page').value);
  
  console.log(rangoInf+"  "+rango)
  
  $.ajax({
      url:'crud.php',
      type:'POST',
      data:{opcion,accion,rango,rangoInf},
      success:function (respuesta){
        
        // alert(respuesta);
          var jason=JSON.parse(respuesta);
          jason.forEach(element => {
          
           
              template+=`
              <tr>
              <td style="display:none;"> ${element.id} </td>
              <td><p name="nombreCliente_p[]" class="non-margin">${element.nombre}</p></td>
              <td><p name="fecha_p[]" class="non-margin">   ${element.nombre_agente}</p></td>
              <td><p name="folio_p[]" class="non-margin"> ${element.domicilio}</p></td>
              <td><p name="estatus_p[]" class="non-margin"> ${element.telefono}</p></td>
              <td><p name="total_p1[]" class="non-margin">    ${element.celular}</p></td>
              <td>${element.rfc}</td>
              <td><p name="total_p2[]" class="non-margin">    ${element.correo}</p></td>
                <td> 
                <a href="javascript:void(0);" onclick="editar(this);">Editar <i class="far fa-edit"></i>  </a>
                <a href="javascript:void(0);" onclick="eliminar(this);">Borrar <i class="fas fa-trash-alt"></i>  </a>
                </td>
                       
              
              </tr>
              `
          });
         
          $('#content_table').html(template);
        i--;
         document.getElementById('numeroPagina').value=i;
        
      }
      
  })
  
 
  
  
   
}

function fun(){

  
   var l= document.getElementById('contenedorPaginacion'),i=1;
  
      
     var text=`
     <div class="row uniform" id="contenedor-padrePagina">
     <div class="1u 12u$(xsmall)"  id="padrePagina">
      <input type="button" name="nombre" id="anteriorPagina" value="Ant" /> 
     </div>
     <div class="1u 12u$(xsmall)"  id="padrePagina">
    
       <input type="button" name="nombre" id="numeroPagina" value="${i}" /> 
    
     </div>
     <div class="1u 12u$(xsmall)" " id="padrePagina">
    
     <input type="button" name="nombre" id="siguientePagina" value="Sig" /> 
     
     </div>
     </div>
     `
     //l.appendChild(text); 
     $("#contenedorPaginacion").append(text);
   
  
}



function agregarClientes(){

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
     var accion='crear';
     if(! isValidEmail(mail)||nombre.length<3||rfc.length<12||telefono.length<8){
          alert('verifique que el email rfc telefono de empresa y nombre de empresa o agente no estén vacios');
          return;
     }
     $.ajax({
       url:'crud.php',
       type:'POST',
       data:{opcion,accion,nombre,
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

function isValidEmail(mail) { 
    return /^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,4})+$/.test(mail); 
  }




function buscarClientes(){
 
   var rfc=document.getElementById('buscar').value.toUpperCase();
   if(rfc.length<12){
     alert('rfc inválido');
     return;
   }
   var opcion='clientes';
   var accion='consultar';
  
    $.ajax({
        url: 'crud.php',
        type: 'POST',
        data: {opcion,accion,rfc},
        success: function(respuesta){
          var template='';
          var jason=JSON.parse(respuesta);
          jason.forEach(element => {
          
            
              template+=`
              <tr>
              <td style="display:none;"> ${element.id} </td>
              <td><p name="nombreCliente_p[]" class="non-margin">${element.nombre}</p></td>
              <td><p name="fecha_p[]" class="non-margin">   ${element.nombre_agente}</p></td>
              <td><p name="folio_p[]" class="non-margin"> ${element.domicilio}</p></td>
              <td><p name="estatus_p[]" class="non-margin"> ${element.telefono}</p></td>
              <td><p name="total_p1[]" class="non-margin">    ${element.celular}</p></td>
              <td>${element.rfc}</td>
              <td><p name="total_p2[]" class="non-margin">    ${element.correo}</p></td>
                <td> 
                <a href="javascript:void(0);" onclick="editar(this);">Editar <i class="far fa-edit"></i>  </a>
                <a href="javascript:void(0);" onclick="eliminar(this);">Borrar <i class="fas fa-trash-alt"></i>  </a>
                </td>
                       
              
              </tr>
              `
          });
         
          $('#content_table').html(template);
        }
    })




}