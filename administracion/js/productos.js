
$(document).on('ready',fun(1));





function fun(i){

   $('#add_row').on('click',addRow);
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

function isValidEmail(mail) { 
    return /^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,4})+$/.test(mail); 
  }


  function listarProductos(){
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