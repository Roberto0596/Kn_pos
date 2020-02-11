var tablaProveedores = $(".tablaProveedores").DataTable({
		"deferRender": true,
		"retrieve": true,
		"processing": true,
		"ajax":"ajax/dataTable-proveedores.ajax.php",
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
})



$(".tablaProveedores tbody").on("click","button.btnEliminarProveedor", function()
{
	var idProveedor = $(this).attr("idProveedor");
		swal.fire({
		title: '¿Esta seguro de eliminar el proveedor?',
		text: "¡si no lo esta puede cancelar!",
		type: 'warning',
		showCancelButton: true,
		confirmButtonColor: '#3085d6',
		cancelButtonColor: '#d33',
		cancelButtonText: 'cancelar',
		confirmButtonText: 'Si, Borrar'
	}).then((result)=>
	{
		if (result.value)
		{
			window.location = "index.php?ruta=almacen&idAlmacen="+idAlmacen;
		}
	})
})

$(".tablaProveedores tbody").on("click","button.btnEditarProveedor", function()
{
	var idProveedor =$(this).attr("idProveedor");
	var data = new FormData();
	data.append("idProveedor",idProveedor);
	$.ajax(
	{
		url: "ajax/proveedores.ajax.php",
		method: "POST",
      	data: data,
      	cache: false,
     	contentType: false,
     	processData: false,
     	dataType:"json",
		success:function(respuesta)
		{
			$("#nombre").val(respuesta["Nombre"]);
			$("#id_proveedor").val(respuesta["id_proveedor"]);
			$("#direccion").val(respuesta["Direccion"]);
			$("#rfc").val(respuesta["RFC"]);
			$("#telefono").val(respuesta["Telefono"]);
			$("#ejecutivo").val(respuesta["Ejecutivo"]);
			$("#correo").val(respuesta["Correo"]);
		}
	})
})
