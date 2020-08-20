$(document).ready(function(){
	cargarTablaCorteAbono(null);
})
$("#concepto-abonos").change(function(){
	var concepto = $(this).val();
	if (concepto == 0)
	{
		$(".hide-element").fadeOut(1000,function()
		{
			$("#tabla-abonos-2").fadeIn(1000);

		});
		$("#tabla-abonos-1").fadeOut(1000,function()
		{
			$("#tabla-abonos-2").fadeIn(1000);

		});
		$(".rango-fechas").fadeOut(1000,function()
		{
			$("#tabla-abonos-2").fadeIn(1000);

		});
		cargarTablaCorteAbono(null);
	}else if(concepto==1){
		$(".hide-element").fadeOut(1000,function()
		{
			$(".rango-fechas").fadeIn(1000);
			$("#tabla-abonos-2").fadeIn(1000);

		});
		$("#tabla-abonos-1").fadeOut(1000,function()
		{
			$(".rango-fechas").fadeIn(1000);
			$("#tabla-abonos-2").fadeIn(1000);

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
}

$("#fechaFinal").change(function()
{
	var fecha = $("#fechaInicial").val()+"|"+$("#fechaFinal").val();
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
	cargarTablaAbonoPorCliente($(this).val());
});

//SECCION DE LAS TABLAS
function cargarTablaAbonoPorCliente(Folio)
{
	$('.tablaAbonos tbody').remove();
	$(".tablaAbonos").dataTable(
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

