var almacenActual = $("#id_almacen").val();

function mostrarTablaSolicitud(status)
{
	var tablaSolicitudes = $(".tablaSolicitudes").DataTable({
		"deferRender": true,
		"processing": true,
		"destroy": true,
		"lengthMenu":[[5,10, 20, 25, 50, -1], [5,10, 20, 25, 50, "Todos"]],
		"ajax":
		{
			url: "ajax/DataTable-solicitud.ajax.php",
			type: "POST",
			data:
			{
				almacen:almacenActual,
				status:status
			}
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

	$(".tablaSolicitudes tbody").on("click","button.btnEliminarSolicitud",function()
	{
		var idSolicitud = $(this).attr("idSolicitud");
		var fotoCliente = $(this).attr("foto");
		swal.fire({
				title: '¿esta seguro que decea borrar la solicitud?',
				text: "¡si no lo esta puede cancelar!",
				type: 'warning',
				showCancelButton: true,
				confirmButtonColor: '#3085d6',
				cancelButtonColor: '#d33',
				cancelButtonText: 'Cancelar',
				confirmButtonText: 'Si, borrar solicitud'

			}).then((result)=>
			{
				if (result.value)
				{
					window.location = "index.php?ruta=solicitud&idSolicitud="+idSolicitud+"&fotoCliente="+fotoCliente;
				}
			})
	})

	var arrayColores = ["btn-default","btn-warning","btn-success","btn-danger"]; 
	var arrayEtiquetas = ["S/E","Procesando","Aceptada","Rechazada"];

	$(".tablaSolicitudes tbody").on("click","button.btnCambiarStatus",function()
	{
		var idSolicitud = $(this).attr("idSolicitud");
		var status = $(this).attr("valorActual");
		status++;		
		var datos = new FormData();
		datos.append("idSolicitud",idSolicitud);
		datos.append("status",status);
		$.ajax({
			url: "ajax/solicitud.ajax.php",
			method: "POST",
			data: datos,
			cache: false,
			contentType: false,
			processData: false,
			success: function(respuesta)
			{
			}
		})
		window.location = "solicitud";
	});

	$(".tablaSolicitudes tbody").on("click","button.btnElegirEstado",function()
	{
		var idSolicitud = $(this).attr("idSolicitud");
		$("#idSolicitud").val(idSolicitud);		
	});
}

$(".opciones").click(function()
{
	var opcion = $(this).attr("status");
	var idSolicitud = $("#idSolicitud").val();
	var datos = new FormData();
	datos.append("idSolicitud",idSolicitud);
	datos.append("status",opcion);
	$.ajax({
		url: "ajax/solicitud.ajax.php",
		method: "POST",
		data: datos,
		cache: false,
		contentType: false,
		processData: false,
		success: function(respuesta)
		{
		}
	})
	mostrarTablaSolicitud(1);
})

$("#solicitudes").change(function()
{
	var tipoSolicitud = $(this).val();
	mostrarTablaSolicitud(tipoSolicitud);
})

$(document).ready(function()
{
	mostrarTablaSolicitud(0);
})