const options2 = { style: 'currency', currency: 'USD' };
const numberFormat2 = new Intl.NumberFormat('en-US', options2);
var globalDate = null;
var globalFolio = null;

$(document).ready(function(){
	cargarTablaCorteAbono(null);
	cargarTablaAbonoPorCliente(null);
})
$("#concepto-abonos").change(function(){
	var concepto = $(this).val();
	if (concepto == 0)
	{
		$(".hide-element").fadeOut(1000,function()
		{
			$("#tabla-abonos-2").fadeIn(1000);
			$(".caja").fadeIn(1000);

		});
		$("#tabla-abonos-1").fadeOut(1000,function()
		{
			$("#tabla-abonos-2").fadeIn(1000);
			$(".caja").fadeIn(1000);

		});
		$(".rango-fechas").fadeOut(1000,function()
		{
			$("#tabla-abonos-2").fadeIn(1000);
			$(".caja").fadeIn(1000);
		});
		cargarTablaCorteAbono(null);
		globalDate = null;
	}else if(concepto==1){
		$(".hide-element").fadeOut(1000,function()
		{
			$(".rango-fechas").fadeIn(1000);
			$("#tabla-abonos-2").fadeIn(1000);
			$(".caja").fadeIn(1000);

		});
		$("#tabla-abonos-1").fadeOut(1000,function()
		{
			$(".rango-fechas").fadeIn(1000);
			$("#tabla-abonos-2").fadeIn(1000);
			$(".caja").fadeIn(1000);

		});
	}else if(concepto==2){
		$("#tabla-abonos-2").fadeOut(1000,function()
		{
			$(".hide-element").fadeIn(1000);
		    $("#tabla-abonos-1").fadeIn(1000);
		});
		$(".rango-fechas").fadeOut(1000,function()
		{
			$(".hide-element").fadeIn(1000);
		    $("#tabla-abonos-1").fadeIn(1000);
		});
		$(".caja").fadeOut(1000);
	}
});

function cargarTablaCorteAbono(fecha)
{
	$('.tablaCorteAbonostbody').remove();
	$(".tablaCorteAbonos").dataTable(
	{
		"destroy":true,
		"deferRender": true,
		"processing": true,
		"bFilter": true,
		"bLengthChange" : true,
		"lengthMenu":[[5, 10, 20, 25, 50, -1], [5, 10, 20, 25, 50, "Todos"]],
		"ajax":
		{
			url: "ajax/reportes/dataTable-reporte-abono-corte.php",
			type: "POST",
			data: {fecha:fecha}
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

	var datos = new FormData();
	datos.append("fechas",fecha);
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
			$("#total").html(numberFormat2.format(respuesta));
		}
	});
}

$('#imprimir-abonos-corte').click(function() {
	var tipoAbonos = "Corte de abonos";
	window.open("extenciones/mpdf/reporte/reporte-abonos-corte.php?tipo="+tipoAbonos+"&fecha="+globalDate,"_blank");
});

$("#fechaFinal").change(function()
{
	var fecha = $("#fechaInicial").val()+"|"+$("#fechaFinal").val();
	globalDate = fecha;
	cargarTablaCorteAbono(fecha);
});

$("#abonos-cliente").change(function()
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
				$('#ventas-cliente').empty().append('whatever');
				$('#ventas-cliente').prepend("<option value='' >Seleccione un item</option>")
	 			for (var i = 0; i < respuesta.length; i++) {
					$('#ventas-cliente').prepend("<option value='"+respuesta[i]["Folio"]+"' >"+respuesta[i]["Folio"]+"</option>");
				}
			}
		});
	}
	else
	{
		$('#ventas-cliente').empty().append('whatever');
	}
})

$('#ventas-cliente').change(function()
{
	globalFolio = $(this).val();
	cargarTablaAbonoPorCliente($(this).val());
});

//SECCION DE LAS TABLAS
function cargarTablaAbonoPorCliente(Folio)
{
	var data;
	$('.tablaAbonos tbody').remove();
	var tableAbonosPorCLiente = $(".tablaAbonos").dataTable(
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

$('#imprimir-abonos-cliente').click(function() {
	if (globalFolio != null) {
		var tipoAbonos = "Reporte de abonos";
		window.open("extenciones/mpdf/reporte/reporte-abonos-por-cliente.php?tipo="+tipoAbonos+"&folio="+gobalFolio,"_blank");
	} else {
		swal.fire({
			title: "No hay datos para imprimir",
			text: "La tabla esta vacia",
			type: "warning",
			confirmButtonText: "¡Cerrar!"
		})
	}
});

