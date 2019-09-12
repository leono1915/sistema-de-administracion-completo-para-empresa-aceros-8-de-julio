$(document).on('ready', principal);

function principal() {

  //alert('si leo')
  fun();

  $('#siguientePagina').on('click', listarProductosSiguiente);
  $('#anteriorPagina').on('click', listarProductosAnterior);
  $('#add_row').on('click', crearProductos);
  $('#buscarProducto').on('click', buscarProductos);
  $('#update-precio').on('click', actualizarProductos);
  listarProductos();

}



function listarProductos() {

  var factorTramo;
  var opcion = 'productosb';
  var accion = 'listar';
  var template = "";
  var rango = document.getElementById('rango_page').value;

  var i = 0;
  $.ajax({
    url: 'crud.php',
    type: 'POST',
    data: { opcion, accion, rango },
    success: function (respuesta) {
      i++;
      // alert(respuesta);   <a href="javascript:void(0);" onclick="" >Ver <i class="fas fa-eye"></i>  </a>
      var jason = JSON.parse(respuesta);
      var color;
      jason.forEach(element => {
        if (element.cantidad > 3) {
          color = '#ffffff';
        } else {
          color = 'red';
        }
        if (element.id < 82 && element.id > 58) {
          factorTramo = (1 / 3);
        } else if (element.id > 240) {
          factorTramo = (1 / 12.2);

        }
        else if (element.id > 36 && element.id < 43) {
          factorTramo = (1 / 12.2);

        } else {
          factorTramo = (1 / 6.1);
        }

        var metro = parseFloat("." + element.metros);
        template += `
              <tr style="background-color:${color}">
      
             
      <td><p name="nombreCliente_p[]" class="non-margin">${element.id}</p></td>
      <td><p name="fecha_p[]" class="non-margin">   ${element.nombre}</p></td>
      <td><p name="folio_p[]" class="non-margin"> ${element.medida}</p></td>
      <td><p name="estatus_p[]" class="non-margin"> ${element.espesor}</p></td>
      <td><p name="total_p1[]" class="non-margin">    ${element.peso}</p></td>
      <td>${element.precio}</td>
      <td><p name="total_p2[]" class="non-margin">    ${element.cantidad}</p></td>
      <td><p name="total_p3[]" class="non-margin"> ${Math.round((metro / factorTramo) * 100) / 100} </p></td>
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
var i = 0;
function listarProductosSiguiente() {
  if (i == 0) {
    i = 1;
  }


  var rangoInf = document.getElementById('rango_page').value * i;
  //document.getElementsByName('fecha_p[]').length;

  var factorTramo;
  var opcion = 'productosb';
  var accion = 'listar';
  var template = "";
  var rango = (document.getElementById('rango_page').value * i) / i;
  console.log(rangoInf + "  " + rango);

  $.ajax({
    url: 'crud.php',
    type: 'POST',
    data: { opcion, accion, rango, rangoInf },
    success: function (respuesta) {
  
      // alert(respuesta);
      var jason = JSON.parse(respuesta);
      var color;
      jason.forEach(element => {
        if (element.cantidad > 3) {
          color = '#ffffff';
        } else {
          color = 'red';
        }
        if (element.id < 82 && element.id > 58) {
          factorTramo = (1 / 3);
        } else if (element.id > 240) {
          factorTramo = (1 / 12.2);

        }
        else if (element.id > 36 && element.id < 43) {
          factorTramo = (1 / 12.2);

        } else {
          factorTramo = (1 / 6.1);
        }
        var metro = parseFloat("." + element.metros);
        template += `
              <tr style="background-color:${color}">
      
             
      <td><p name="nombreCliente_p[]" class="non-margin">${element.id}</p></td>
      <td><p name="fecha_p[]" class="non-margin">   ${element.nombre}</p></td>
      <td><p name="folio_p[]" class="non-margin"> ${element.medida}</p></td>
      <td><p name="estatus_p[]" class="non-margin"> ${element.espesor}</p></td>
      <td><p name="total_p[]" class="non-margin">    ${element.peso}</p></td>
      <td>${element.precio}</td>
      <td><p name="total_p[]" class="non-margin">    ${element.cantidad}</p></td>
      <td><p name="total_p[]" class="non-margin"> ${Math.round((metro / factorTramo) * 100) / 100} </p></td>
      <td><a href="javascript:void(0);" onclick="editar(this);">Editar <i class="far fa-edit"></i>  </a>
      <a href="javascript:void(0);" onclick="eliminar(this);">Borrar <i class="fas fa-trash-alt"></i>  </a>
               </td>
               
      
      </tr>
              `
      });

      $('#content_table').html(template);
      i++;
      document.getElementById('numeroPagina').value = i;

    }

  })

}


function listarProductosAnterior() {

  console.log(" ante" + i);

  var rangoInf;
  if (i == 1) rangoInf = 0;
  else
    rangoInf = (document.getElementById('rango_page').value * (i - 2));
  if (i == 1) return;


  //document.getElementsByName('fecha_p[]').length;

  var factorTramo;
  var opcion = 'productosb';
  var accion = 'listar';
  var template = "";
  var rango = (document.getElementById('rango_page').value);

  console.log(rangoInf + "  " + rango)

  $.ajax({
    url: 'crud.php',
    type: 'POST',
    data: { opcion, accion, rango, rangoInf },
    success: function (respuesta) {

      // alert(respuesta);
      var jason = JSON.parse(respuesta);
      var color;
      jason.forEach(element => {
        if (element.cantidad > 3) {
          color = '#ffffff';
        } else {
          color = 'red';
        }
        if (element.id < 82 && element.id > 58) {
          factorTramo = (1 / 3);
        } else if (element.id > 240) {
          factorTramo = (1 / 12.2);

        }
        else if (element.id > 36 && element.id < 43) {
          factorTramo = (1 / 12.2);

        } else {
          factorTramo = (1 / 6.1);
        }
        var metro = parseFloat("." + element.metros);
        template += `
              <tr style="background-color:${color}">
      
             
      <td><p name="nombreCliente_p[]" class="non-margin">${element.id}</p></td>
      <td><p name="fecha_p[]" class="non-margin">   ${element.nombre}</p></td>
      <td><p name="folio_p[]" class="non-margin"> ${element.medida}</p></td>
      <td><p name="estatus_p[]" class="non-margin"> ${element.espesor}</p></td>
      <td><p name="total_p[]" class="non-margin">    ${element.peso}</p></td>
      <td>${element.precio}</td>
      <td><p name="total_p[]" class="non-margin">    ${element.cantidad}</p></td>
      <td><p name="total_p[]" class="non-margin"> ${Math.round((metro / factorTramo) * 100) / 100} </p></td>
              <td> <a href="javascript:void(0);" onclick="editar(this);">Editar <i class="far fa-edit"></i>  </a>
              <a href="javascript:void(0);" onclick="eliminar(this);">Borrar <i class="fas fa-trash-alt"></i>  </a>
               </td>
               
      
      </tr>
              `
      });

      $('#content_table').html(template);
      i--;
      document.getElementById('numeroPagina').value = i;

    }

  })





}

function fun() {


  var l = document.getElementById('contenedorPaginacion'), i = 1;


  var text = `
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






function crearProductos() {
  const factorCantidad = (1 / 6.1);
  //alert(12);
  var nombre = document.getElementById('nombreProducto').value;
  var medida = document.getElementById('medidaProducto').value;
  var espesor = document.getElementById('espesorProducto').value;
  var peso = document.getElementById('pesoProducto').value;
  var precio = document.getElementById('precioProducto').value;
  var tramos = document.getElementById('tramosProducto').value;
  var metros = document.getElementById('metrosProducto').value;
  var cantidad = parseFloat(parseFloat(tramos) + (metros * factorCantidad));
  var opcion = 'productosb';
  var accion = 'crear';





  $.ajax({
    url: 'crud.php',
    type: 'POST',
    data: { nombre, medida, espesor, peso, precio, cantidad, opcion, accion },
    success: function (respuesta) {
      alert(respuesta);
      listarProductos();

    }
  })


}



function buscarProductos() {

  var nombre = document.getElementById('buscar').value.toUpperCase();

  var opcion = 'productosb';
  var accion = 'consultar';

  $.ajax({
    url: 'crud.php',
    type: 'POST',
    data: { opcion, accion, nombre },
    success: function (respuesta) {
      var template = '';
      // alert(respuesta);
      var jason = JSON.parse(respuesta);
      var color;
      jason.forEach(element => {
        if (element.cantidad > 3) {
          color = '#ffffff';
        } else {
          color = 'red';
        }
        if (element.id < 82 && element.id > 58) {
          factorTramo = (1 / 3);
        } else if (element.id > 240) {
          factorTramo = (1 / 12.2);

        }
        else if (element.id > 36 && element.id < 43) {
          factorTramo = (1 / 12.2);

        } else {
          factorTramo = (1 / 6.1);
        }
        var metro = parseFloat("." + element.metros);
        template += `
              <tr style="background-color:${color}">
      
             
      <td><p name="nombreCliente_p[]" class="non-margin">${element.id}</p></td>
      <td><p name="fecha_p[]" class="non-margin">   ${element.nombre}</p></td>
      <td><p name="folio_p[]" class="non-margin"> ${element.medida}</p></td>
      <td><p name="estatus_p[]" class="non-margin"> ${element.espesor}</p></td>
      <td><p name="total_p[]" class="non-margin">    ${element.peso}</p></td>
      <td>${element.precio}</td>
      <td><p name="total_p[]" class="non-margin">    ${element.cantidad}</p></td>
      <td><p name="total_p[]" class="non-margin"> ${Math.round((metro / factorTramo) * 100) / 100} </p></td>
      <td><a href="javascript:void(0);" onclick="editar(this);">Editar <i class="far fa-edit"></i>  </a>
      <a href="javascript:void(0);" onclick="eliminar(this);">Borrar <i class="fas fa-trash-alt"></i>  </a>
               </td>
               
      
      </tr>
              `
      });

      $('#content_table').html(template);

    }
  })


}
/*SELECT Mes,no_facturado,facturado,no_facturado+facturado as total,
    historialCompras.total,
  FROM (SELECT MONTH(Fecha) AS Mes
 ,SUM(IF(YEAR(Fecha)=2019&&facturado='si',Total,0)) As 'facturado'
,SUM(IF(YEAR(Fecha)=2019&&facturado='no'&&estatus='autorizado' ,Total,0)) As 'no_facturado'
 FROM  (select * from historialVentas group by folio) as nu group by mes) as nuevo,
 ;*/
    function actualizarProductos() {
     var rango1=document.getElementById('rango1').value;
     var rango2=document.getElementById('rango2').value;
     var precio=document.getElementById('precioUpdate').value;
     var accion='modificarPrecios';
     var opcion='productosb';
     if(!Number.isInteger(parseInt(rango1))||!Number.isInteger(parseInt(rango2))){
       alert('debe llenar los rangos a actualizar');
       return;
     }
     $.ajax({
       url:'crud.php',
       type:'POST',
       data:{rango1,rango2,precio,accion,opcion},
       success:function(respuesta){
         alert(respuesta);
         listarProductos();
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