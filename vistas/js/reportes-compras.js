const ip = { style: 'currency', currency: 'USD' };
const numberFormat34 = new Intl.NumberFormat('en-US', ip);

$(document).ready(function() {
	$(".tableProveedor").DataTable();
})
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

$("#provider-pro").change(function()
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
					$('#compras-realizadas').empty().append('whatever');
					for (var i = 0; i < respuesta2.length; i++)
					{
						var folio = respuesta2[i]["Folio"];
						$('#compras-realizadas').prepend("<option value='"+folio+"' >"+folio+"</option>");
					}
					$('#compras-realizadas').prepend("<option value='' selected>Seleccione una opción</option>");
					$(".ocultar").fadeIn(1000);
				}
			});
		}
	});
});

$("#fechaFinalProveedores").change(function() {
	var fechaInicial = $("#fechaInicialProveedores").val();
	var fechaFinal = $(this).val();
	if(fechaInicial.length > 0) {
		var data = new FormData();
		data.append("fechaInicialProveedor", fechaInicial);
		data.append("fechaFinalProveedor", fechaFinal);
		data.append("proveedorCompras", $("#provider-pro").val());
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
				if(respuesta.length > 0) {
					$('#compras-realizadas').empty().append('whatever');
					for (var i = 0; i < respuesta.length; i++)
					{
						var folio = respuesta[i]["Folio"];
						$('#compras-realizadas').prepend("<option value='"+folio+"' >"+folio+"</option>");
					}
					$('#compras-realizadas').prepend("<option value='' selected>Seleccione una opción</option>");
				} else {
					swal.fire({
						title: "Sin resultados",
						type: "info",
						confirmButtonText: "¡Cerrar!"
					});
				}
			}
		});
	} else {
		swal.fire({
			title: "Tiene que elegir una fecha inicial",
			type: "error",
			confirmButtonText: "¡Cerrar!"
		});
		$("#fechaFinalProveedores").val("");
	}
})

$("#compras-realizadas").change(function()
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
			$("#monto").html(numberFormat34.format(respuesta["TotalVenta"]));
			mostrarTablaProveedor(respuesta["Folio"]);
		}
	});
});

