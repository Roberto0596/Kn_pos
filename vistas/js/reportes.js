var globalRangoContado = null;

$("#select-concepto").change(function(){
	var concepto = $(this).val();
	console.log(concepto);
	if (concepto == "abonos")
	{
		hideOrShowElement(elementsArrayConcept,1);
	}
	else if(concepto == "compras")
	{
		hideOrShowElement(elementsArrayConcept,2);
	}
	else if(concepto == "credito")
	{
		hideOrShowElement(elementsArrayConcept,5);
	}
	else if (concepto=="contado")
	{
		hideOrShowElement(elementsArrayConcept,3);
		mostrarTablaContado(null);
	}
	else if (concepto=="atrasos")
	{
		hideOrShowElement(elementsArrayConcept,4);
		mostrarTablaRetrasos();
	}
});

var elementsArrayConcept = new Object([
	{"elemento": "tabla-abonos", "valor": "1","grupo":1},
	{"elemento": "tabla-compras", "valor": "0","grupo":2},
	{"elemento": "tabla_contado", "valor": "0","grupo":3},
	{"elemento": "tabla-retrasos", "valor": "0","grupo":4},
	{"elemento": "tabla_credito", "valor": "0","grupo":5}]);

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

	const options = { style: 'currency', currency: 'USD' };
    const money = new Intl.NumberFormat('en-US', options);
	var datos = new FormData();
	datos.append("rango",rango);
	$.ajax({
		url:"ajax/reportes.ajax.php",
		method: "POST",
		data:datos,
		cache: false,
		contentType: false,
		processData: false,
		dataType: "json",
		success: function(respuesta)
		{
			$("#total-contado").html(money.format(respuesta));
		}
	});

	$(".tablaContado tbody").on("click","button.verProductos", function(){
		$("#body-table-products").empty();
		var folio = $(this).attr("folio");
		var data = new FormData();
		data.append("folio",folio);
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
				var lista = JSON.parse(respuesta);
				for (var i = 0; i < lista.length; i++) {
					 $("#body-table-products").append("<tr>"+
			           	"<td>"+lista[i]["id"]+"</td>"+
			           	"<td>"+lista[i]["descripcion"]+"</td>"+
			           	"<td>"+lista[i]["cantidad"]+"</td>"+
			           	"<td>"+lista[i]["existencia"]+"</td>"+
			           	"<td>"+lista[i]["precio"]+"</td>"+
			           	"<td>"+lista[i]["total"]+"</td>"+
			            "</tr>");
				}
			}
		});
	});
}

$("#fechaFinalContado").change(function(){
	var fechaInicial = $("#fechaInicialContado").val();
	var fechaFinal = $("#fechaFinalContado").val();
	if (fechaInicial.length>1)
	{
		globalRangoContado = fechaInicial+"|"+fechaFinal;
		mostrarTablaContado(fechaInicial+"|"+fechaFinal);
	}
	else
	{
		globalRangoContado = null;
		swal.fire({
			title: "Tiene que elegir una fecha inicial",
			type: "error",
			confirmButtonText: "¡Cerrar!"
		});
		$("#fechaFinalContado").val("");
	}
});

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

$('#imprimir-ventas-contado').click(function() {
	var tipoAbonos = "Reporte de ventas al contado";
	window.open("extenciones/mpdf/reporte/reporte-ventas-contado.php?tipo="+tipoAbonos+"&rango="+globalRangoContado,"_blank");
});