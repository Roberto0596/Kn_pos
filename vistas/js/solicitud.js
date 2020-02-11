var tablaSolicitudes = $(".tablaSolicitudes").DataTable({
	"deferRender": true,
    "retrieve": true,
	"processing": true,
	"destroy": true,
	"lengthMenu":[[5,10, 20, 25, 50, -1], [5,10, 20, 25, 50, "Todos"]],
	"ajax":"ajax/DataTable-solicitud.ajax.php",
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