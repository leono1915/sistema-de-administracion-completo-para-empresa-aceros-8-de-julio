$(document).on('ready',principal);

function principal(){
 
 //alert('si leo')
  //fun();
 
  $('#siguientePagina').on('click',listarProveedoresSiguiente);
  $('#anteriorPagina').on('click',listarProveedoresAnterior);
  $('#add_row').on('click',agregarProveedores);
  $('#buscar').on('click',buscarProveedores);
  listarProveedores();
  
}



function listarProveedores(){

  
  var opcion='proveedores';
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
            
              <td><p name="folio_p[]" class="non-margin"> ${element.domicilio}</p></td>
              <td><p name="estatus_p[]" class="non-margin"> ${element.telefono}</p></td>
              
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
function listarProveedoresSiguiente(){
  if(i==0){
    i=1;
  }
  
 
  var rangoInf=document.getElementById('rango_page').value*i;
  //document.getElementsByName('fecha_p[]').length;
  
  
  var opcion='proveedores';
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
             
              <td><p name="folio_p[]" class="non-margin"> ${element.domicilio}</p></td>
              <td><p name="estatus_p[]" class="non-margin"> ${element.telefono}</p></td>
            
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


function listarProveedoresAnterior(){
 
  
  var rangoInf;
  if(i==1) rangoInf=0; 
  else
  rangoInf=(document.getElementById('rango_page').value*(i-2));
 if(i==1) return;

  var opcion='proveedores';
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
            
              <td><p name="folio_p[]" class="non-margin"> ${element.domicilio}</p></td>
              <td><p name="estatus_p[]" class="non-margin"> ${element.telefono}</p></td>
              
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





function agregarProveedores(){

     var nombre=document.getElementById('nombreProveedores').value;
     var mail=document.getElementById('correoProveedores').value;
     var rfc=document.getElementById('rfcProveedores').value;
     var direccion=document.getElementById('direccionProveedores').value;
     var telefono=document.getElementById('telefonoProveedores').value;
   
     var opcion='proveedores';
     var accion='crear';
     if(! isValidEmail(mail)||nombre.length<3||rfc.length<12||telefono.length<8){
          alert('verifique que el email rfc y telefono  no estén vacíos');
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
       },
       success:function(respuesta){
          alert(respuesta);
          listarProveedores();
       }
     })

    
}

function isValidEmail(mail) { 
    return /^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,4})+$/.test(mail); 
  }




function buscarProveedores(){
 
   var rfc=document.getElementById('buscarP').value.toUpperCase();
   if(rfc.length<12){
     alert('rfc inválido');
     return;
   }
   var opcion='proveedores';
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
              <td><p name="folio_p[]" class="non-margin"> ${element.domicilio}</p></td>
              <td><p name="estatus_p[]" class="non-margin"> ${element.telefono}</p></td>
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