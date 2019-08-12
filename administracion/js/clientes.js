$(document).on('ready',principal);

function principal(){
 
 //alert('si leo')
  //fun();
 
  $('#siguientePagina').on('click',listarClientesSiguiente);
  $('#anteriorPagina').on('click',listarClientesAnterior);
 listarClientes();
  
}



function listarClientes(){

  var factorCantidad=(1/6);
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
                <a href="javascript:void(0);" onclick="">Editar <i class="far fa-edit"></i>  </a>
                <a href="javascript:void(0);" onclick="">Borrar <i class="fas fa-trash-alt"></i>  </a>
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
                <a href="javascript:void(0);" onclick="">Editar <i class="far fa-edit"></i>  </a>
                <a href="javascript:void(0);" onclick="">Borrar <i class="fas fa-trash-alt"></i>  </a>
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
 
  console.log(" ante"+i);
  
  var rangoInf;
  if(i==1) rangoInf=0; 
  else
  rangoInf=(document.getElementById('rango_page').value*(i-2));
 if(i==1) return;
  

  //document.getElementsByName('fecha_p[]').length;
 
  var factorCantidad=(1/6);
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
                <a href="javascript:void(0);" onclick="">Editar <i class="far fa-edit"></i>  </a>
                <a href="javascript:void(0);" onclick="">Borrar <i class="fas fa-trash-alt"></i>  </a>
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

function isValidEmail(mail) { 
    return /^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,4})+$/.test(mail); 
  }


  function crearClientes(){
    const factorCantidad=(1/6.1);

    var nombre=document.getElementById('nombreProducto').value;
    var medida=document.getElementById('medidaProducto').value;
    var espesor=document.getElementById('espesorProducto').value;
    var peso=document.getElementById('pesoProducto').value;
    var precio=document.getElementById('precioProducto').value;
    var tramos=document.getElementById('tramosProducto').value;
    var metros=document.getElementById('metrosProducto').value;
    var cantidad=parseFloat(parseFloat(tramos)+(metros*factorCantidad));
    var opcion='crear';
    console.log(cantidad);
    if(nombre.length<3){
        //alert('ingrese datos validos');
        //return;
    }

   const datos= {
    nombre:nombre,medida:medida,espesor:espesor,peso:peso,precio:precio,cantidad:cantidad,opcion:opcion
   };

    $.ajax({
        url: 'crud.php',
        type: 'POST',
        data: {nombre,medida,espesor,peso,precio,cantidad,opcion},
        success: function(respuesta){
            alert(respuesta);

        }
    })
  /* $.post('crud.php',datos,function (response){
        console.log(response);
    })*/
   // e.preventDefault();

}


function updateTotal(){
   
    var nombre=document.getElementById('nombreUpdate').value;
    var rango1=document.getElementById('rango1').value;
    var rango2=document.getElementById('rango2').value;
    var precio=document.getElementById('precioUpdate').value;

    $.ajax({
        url: 'crud.php',
        type: 'POST',
        data: {nombre,rango1,rango2,precio},
        success: function(respuesta){

               alert(respuesta);
        }
    })




}