
$(document).on('ready',funMain);





function funMain(){
  
    $('#add_row').on('click',listarProductos);
    $('precioUpdate').on('click',updateTotal);
    //es mas rapido usar jquery que la forma de javascript nativo
   // document.getElementById('add_row').addEventListener('click',fun);
    
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