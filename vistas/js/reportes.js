$(document).ready(function()
{
	mostrarTablaCredito(0);
});

//SECCION PARA CAMBIAR EL TIPO

var elementsArrayConcept = new Object([
	{"elemento": "proveedor", "valor": "0","grupo":1},
	{"elemento": "table-proveedor", "valor": "0","grupo":1},
	{"elemento": "cliente", "valor": "1","grupo":0},
	{"elemento": "table-cliente", "valor": "1","grupo":0},
	{"elemento": "abonos", "valor": "1","grupo":0},
	{"elemento": "ventas", "valor": "0","grupo":3},
	{"elemento": "tabla_contado", "valor": "0","grupo":2}]);

$("#concepto").change(function()
{
	var valor = $(this).val();
	if (valor == "compras")
	{
		hideOrShowElement(elementsArrayConcept,1);
	}
	else if (valor=="credito")
	{
		hideOrShowElement(elementsArrayConcept,0);
	}
	else if (valor=="contado")
	{
		hideOrShowElement(elementsArrayConcept,2);
		mostrarTablaContado(null);
	}
	else if (valor=="ventas")
	{
		hideOrShowElement(elementsArrayConcept,3);
		traerTodasLasVentas();
	}
})



//SECCION DE LAS TABLAS
function mostrarTablaCredito(Folio)
{
	$('.tableCredito tbody').remove();
	$(".tableCredito").dataTable(
	{
		"destroy":true,
		"deferRender": true,
		"processing": true,
		"bFilter": true,
		"bLengthChange" : true,
		"lengthMenu":[[5, 10, 20, 25, 50, -1], [5, 10, 20, 25, 50, "Todos"]],
		"ajax":
		{
			url: "ajax/reportes/dataTable-reporte-credito-ajax.php",
			type: "POST",
			data: {Folio:Folio}
	    },
		"language": {

			"sProcessing":     "Procesando...",
			"sLengthMenu":     "Mostrar _MENU_ registros",
			"sZeroRecords":    "No se encontraron resultados",
			"sEmptyTable":     "Ningún dato disponible en esta tabla",
			"sInfo":           "Mostrando registros del _START_ al _END_ de un total de _TOTAL_",
			"sInfoEmpty":      "Mostrando registros del 0 al 0 de un total de 0",
			"sInfoFiltered":   "(filtrado de un total de _MAX_ registros)",
			"sInfoPostFix":    "",
			"sSearch":         "Buscar:",
			"sUrl":            "",
			"sInfoThousands":  ",",
			"sLoadingRecords": "Cargando...",
			"oPaginate": {
			"sFirst":    "Primero",
			"sLast":     "Último",
			"sNext":     "Siguiente",
			"sPrevious": "Anterior"
			},
			"oAria": {
				"sSortAscending":  ": Activar para ordenar la columna de manera ascendente",
				"sSortDescending": ": Activar para ordenar la columna de manera descendente"
			}

		}
	});
}

function mostrarTablaRetrasos()
{
	$(".tableRetrasos").dataTable(
	{
		"destroy":true,
		"deferRender": true,
		"processing": true,
		"bFilter": true,
		"ajax":"ajax/reportes/dataTable-reporte-retrasos-ajax.php",
		"language": {

			"sProcessing":     "Procesando...",
			"sLengthMenu":     "Mostrar _MENU_ registros",
			"sZeroRecords":    "No se encontraron resultados",
			"sEmptyTable":     "Ningún dato disponible en esta tabla",
			"sInfo":           "Mostrando registros del _START_ al _END_ de un total de _TOTAL_",
			"sInfoEmpty":      "Mostrando registros del 0 al 0 de un total de 0",
			"sInfoFiltered":   "(filtrado de un total de _MAX_ registros)",
			"sInfoPostFix":    "",
			"sSearch":         "Buscar:",
			"sUrl":            "",
			"sInfoThousands":  ",",
			"sLoadingRecords": "Cargando...",
			"oPaginate": {
			"sFirst":    "Primero",
			"sLast":     "Último",
			"sNext":     "Siguiente",
			"sPrevious": "Anterior"
			},
			"oAria": {
				"sSortAscending":  ": Activar para ordenar la columna de manera ascendente",
				"sSortDescending": ": Activar para ordenar la columna de manera descendente"
			}

		}
	});
}

function mostrarTablaContado(rango)
{
	$('.tablaContado tbody').remove();
	$(".tablaContado").dataTable(
	{
		"destroy":true,
		"deferRender": true,
		"processing": true,
		"bFilter": true,
		"bLengthChange" : true,
		"lengthMenu":[[5, 10, 20, 25, 50, -1], [5, 10, 20, 25, 50, "Todos"]],
		"ajax":
		{
			url: "ajax/reportes/dataTable-reporte-contado-ajax.php",
			type: "POST",
			data: {rango:rango}
	    },
		"language": {

			"sProcessing":     "Procesando...",
			"sLengthMenu":     "Mostrar _MENU_ registros",
			"sZeroRecords":    "No se encontraron resultados",
			"sEmptyTable":     "Ningún dato disponible en esta tabla",
			"sInfo":           "Mostrando registros del _START_ al _END_ de un total de _TOTAL_",
			"sInfoEmpty":      "Mostrando registros del 0 al 0 de un total de 0",
			"sInfoFiltered":   "(filtrado de un total de _MAX_ registros)",
			"sInfoPostFix":    "",
			"sSearch":         "Buscar:",
			"sUrl":            "",
			"sInfoThousands":  ",",
			"sLoadingRecords": "Cargando...",
			"oPaginate": {
			"sFirst":    "Primero",
			"sLast":     "Último",
			"sNext":     "Siguiente",
			"sPrevious": "Anterior"
			},
			"oAria": {
				"sSortAscending":  ": Activar para ordenar la columna de manera ascendente",
				"sSortDescending": ": Activar para ordenar la columna de manera descendente"
			}

		}
	});
}

function mostrarTablaProveedor(folio)
{
	$('.tableProveedor tbody').remove();
	$(".tableProveedor").dataTable(
	{
		"destroy":true,
		"deferRender": true,
		"processing": true,
		"bFilter": true,
		"bLengthChange" : true,
		"lengthMenu":[[5, 10, 20, 25, 50, -1], [5, 10, 20, 25, 50, "Todos"]],
		"ajax":
		{
			url: "ajax/reportes/dataTable-reporte-proveedor-ajax.php",
			type: "POST",
			data: {folio:folio}
	    },
		"language": {

			"sProcessing":     "Procesando...",
			"sLengthMenu":     "Mostrar _MENU_ registros",
			"sZeroRecords":    "No se encontraron resultados",
			"sEmptyTable":     "Ningún dato disponible en esta tabla",
			"sInfo":           "Mostrando registros del _START_ al _END_ de un total de _TOTAL_",
			"sInfoEmpty":      "Mostrando registros del 0 al 0 de un total de 0",
			"sInfoFiltered":   "(filtrado de un total de _MAX_ registros)",
			"sInfoPostFix":    "",
			"sSearch":         "Buscar:",
			"sUrl":            "",
			"sInfoThousands":  ",",
			"sLoadingRecords": "Cargando...",
			"oPaginate": {
			"sFirst":    "Primero",
			"sLast":     "Último",
			"sNext":     "Siguiente",
			"sPrevious": "Anterior"
			},
			"oAria": {
				"sSortAscending":  ": Activar para ordenar la columna de manera ascendente",
				"sSortDescending": ": Activar para ordenar la columna de manera descendente"
			}

		}
	});
}

//AREA PARTE VENTAS A CREDITO Y ABONOS
$("#credito-abono-cliente").change(function()
{
	var ClientId = $(this).val();
	if (ClientId.length>1)
	{
		$('.select-ventas-credito-cliente').css("display","block");
		var data = new FormData();
		data.append("clientId",ClientId);
		$.ajax({
			url:"ajax/reportes.ajax.php",
			method: "POST",
			data:data,
			cache: false,
			contentType: false,
			processData: false,
			dataType: "json",
			success: function(respuesta)
			{
				$('#ventas-credito-cliente').empty().append('whatever');
				$('#ventas-credito-cliente').prepend("<option value='' >Seleccione un item</option>")
	 			for (var i = 0; i < respuesta.length; i++) {
					$('#ventas-credito-cliente').prepend("<option value='"+respuesta[i]["Folio"]+"' >"+respuesta[i]["Folio"]+"</option>");
				}
			}
		});
	}
	else
	{
		$('.select-ventas-credito-cliente').css("display","none");
		$('#ventas-credito-cliente').empty().append('whatever');
	}
})

$('#ventas-credito-cliente').change(function()
{
	mostrarTablaCredito($(this).val());
})

//AREA PARTDE DE CREDITO Y VENCIDOS
var elementsArray = new Object([
	{"elemento": "cliente", "valor": "1"},
	{"elemento": "table-cliente", "valor": "1"},
	{"elemento": "table-cliente-retrasos", "valor": "0"}]);

$('#select-modalidad').change(function()
{
	var modalidad = $(this).val();

	if (modalidad == "abonos")
	{
		hideOrShowElement(elementsArray,null);
	}
	else
	{
		hideOrShowElement(elementsArray,null);
		mostrarTablaRetrasos();
	}
})

$("#fechaFinalContado").change(function(){
	var fechaInicial = $("#fechaInicialContado").val();
	var fechaFinal = $("#fechaFinalContado").val();
	if (fechaInicial.length>1)
	{
		mostrarTablaContado(fechaInicial+"|"+fechaFinal);
	}
	else
	{
		swal.fire({
			title: "Tiene que elejir una fecha inicial",
			type: "error",
			confirmButtonText: "¡Cerrar!"
		});
		$("#fechaFinalContado").val("");
	}
});

$("#provider").change(function()
{
	var data = new FormData();
	data.append("id_proveedor",$(this).val());
	$.ajax({
		url:"ajax/reportes.ajax.php",
		method: "POST",
		data:data,
		cache: false,
		contentType: false,
		processData: false,
		dataType: "json",
		success: function(respuesta)
		{
			$("#ejecutivo").html(respuesta["Ejecutivo"]);
			$("#cuenta").html(respuesta["Cuenta_bancaria"]);
			var dataCompra = new FormData();
			dataCompra.append("idProveedor", respuesta["Id_proveedor"]);
			dataCompra.append("item_compras", "Id_proveedor");
			$.ajax({
				url:"ajax/reportes.ajax.php",
				method: "POST",
				data:dataCompra,
				cache: false,
				contentType: false,
				processData: false,
				dataType: "json",
				success: function(respuesta2)
				{
					$('#compras').empty().append('whatever');
					for (var i = 0; i < respuesta2.length; i++)
					{
						var folio = respuesta2[i]["Folio"];
						$('#compras').prepend("<option value='"+folio+"' >"+folio+"</option>");
					}
				}
			});
		}
	});
})

$("#compras").change(function()
{
	var id = $(this).val();
	var data = new FormData();
	data.append("idProveedor", id);
	data.append("item_compras", "Folio");
	$.ajax({
		url:"ajax/reportes.ajax.php",
		method: "POST",
		data:data,
		cache: false,
		contentType: false,
		processData: false,
		dataType: "json",
		success: function(respuesta)
		{
			$("#fecha").html(respuesta["Fecha"]);
			$("#monto").html(respuesta["TotalVenta"]);
			mostrarTablaProveedor(respuesta["Folio"]);
		}
	});
})


//GRAFICA DE VENTAS DE TODA LA COMPAÑIA

var nfEn = new Intl.NumberFormat('en-EU');
var salesGraphChartCanvas = $('#line-chart').get(0).getContext('2d');

$("#modo").change(function()
{
	if ($(this).val() == "rango")
	{
		$(".ocultar-div").css("display","block");
	}
	else
	{
		$(".ocultar-div").css("display","none");
		traerTodasLasVentas();
	}
})

$("#fechaFinal").change(function()
{
	var fechaInicial = $("#fechaInicial").val();
	var fechaFinal = $("#fechaFinal").val();
	MostrarPorRangos(fechaInicial,fechaFinal);
})

function MostrarPorRangos(fechaInicial,fechaFinal)
{
	var arrayVentas = [];
	var arrayLabels = [];
	var data = new FormData();
	data.append("fechaInicial",fechaInicial);
	data.append("fechaFinal",fechaFinal);

	$.ajax({
		url:"ajax/reportes.ajax.php",
		method: "POST",
		data:data,
		cache: false,
		contentType: false,
		processData: false,
		dataType: "json",
		success: function(respuesta)
		{
			var total = 0;
			for (var i = 0; i < respuesta.length; i++)
			{
				total+= parseInt(respuesta[i]["TotalVenta"]);
				arrayVentas.push(parseInt(respuesta[i]["TotalVenta"]));
				arrayLabels.push(respuesta[i]["Fecha"]);
			}
			$("#totalVentas").val(nfEn.format(total));			
			imprimirGrafico(arrayVentas,arrayLabels);
		}
	});
}

function traerTodasLasVentas()
{
	var arrayVentas = [];
	var arrayLabels = [];
	var data = new FormData();
	data.append("activar","ok");
	$.ajax({
		url:"ajax/reportes.ajax.php",
		method: "POST",
		data:data,
		cache: false,
		contentType: false,
		processData: false,
		dataType: "json",
		success: function(respuesta)
		{
			var total = 0;
			for (var i = 0; i < respuesta.length; i++)
			{
				total+= parseInt(respuesta[i]["TotalVenta"]);
				arrayVentas.push(parseInt(respuesta[i]["TotalVenta"]));
				arrayLabels.push(respuesta[i]["Fecha"]);
			}
			$("#totalVentas").val(nfEn.format(total));			
			imprimirGrafico(arrayVentas,arrayLabels)
		}
	});
}


//GRAFICO A IMPRIMIR
function imprimirGrafico(datos,labels)
{
  	var salesGraphChartData = 
  	{
    	labels  : labels,
	    datasets: [
	      {
	        label               : 'Ventas',
	        fill                : false,
	        borderWidth         : 2,
	        lineTension         : 0,
	        spanGaps : true,
	        borderColor         : '#efefef',
	        pointRadius         : 3,
	        pointHoverRadius    : 7,
	        pointColor          : '#efefef',
	        pointBackgroundColor: '#efefef',
	        data                : datos
	      }
	    ]
  	}

 	var salesGraphChart = new Chart(salesGraphChartCanvas, { 
      type: 'line', 
      data: salesGraphChartData, 
    }
  )
}


//METODOS AUXILIARES
function hideOrShowElement(array,grupo)
{
	changeElementsArray(array,grupo);
	for (var i = 0; i < array.length; i++)
	{
		if(array[i].valor == 1)
		{
			$("#"+array[i].elemento).css("display","block");
		}
		else
		{
			$("#"+array[i].elemento).css("display","none");
		}
	}
}

function changeElementsArray(array,grupo)
{
	if (grupo == null)
	{
		for (var i = 0; i < array.length; i++)
		{
			if (array[i].valor=="1")
			{
				array[i].valor="0";
			}
			else
			{
				array[i].valor="1";
			}
		}
	}
	else
	{
		for (var i = 0; i < array.length; i++) 
		{
			if (array[i].grupo == grupo)
			{
				array[i].valor = 1;
			}
			else
			{
				array[i].valor=0;
			}
		}
	}
	return array;
}
