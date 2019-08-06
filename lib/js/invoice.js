$(document).on('ready', funcMain);


function funcMain()
{
	$("#imprimir").on('click',impresion);
	alert('here');
}	

function impresion(){
	alert('here');
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