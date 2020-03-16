var tablaClientes = $(".tablaClientes").DataTable({
	"deferRender": true,
    "retrieve": true,
	"processing": true,
	"destroy": true,
	"lengthMenu":[[5,10, 20, 25, 50, -1], [5,10, 20, 25, 50, "Todos"]],
	"ajax":"ajax/DataTable-clientes.ajax.php",
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

$(".tablaClientes tbody").on("click","button.btnEliminarCliente",function(){
	var idCliente = $(this).attr("idCliente");
	swal.fire({
		title: '¿esta seguro de borrar el cliente?',
		text: "¡si no lo esta puede cancelar!",
		type: 'warning',
		showCancelButton: true,
		confirmButtonColor: '#3085d6',
		cancelButtonColor: '#d33',
		cancelButtonText: 'Cancelar',
		confirmButtonText: 'Si, borrar cliente'

	}).then((result)=>
	{
		if (result.value)
		{
			window.location = "index.php?ruta=clientes&idCliente="+idCliente;
		}
	})
})

$(".tablaClientes tbody").on("click","button.btnEditarCliente",function(){
	var idCliente = $(this).attr("idCliente");
	var datos = new FormData();
	datos.append("idCliente", idCliente);
	$.ajax({
		url:"ajax/clientes.ajax.php",
		method: "POST",
		data: datos,
		cache: false,
		contentType: false,
		processData: false,
		dataType: "json",
		success: function(respuesta)
		{
			$("#nombre").val(respuesta["nombre"]);
			$("#direccion").val(respuesta["direccion"]);
			$("#edad").val(respuesta["edad"]);
			$("#t_casa").val(respuesta["telefono_casa"]);
			$("#t_celular").val(respuesta["telefono_celular"]);
			$("#codigo_postal").val(respuesta["codigo_postal"]);
			$("#ciudad").val(respuesta["ciudad"]);
			$("#id_cliente").val(respuesta["id_cliente"]);
	}});
})


$("#codigo").click(function()
{
	$.ajax({
		url:"https://api-sepomex.hckdrk.mx/query/info_cp/84303?type=simplified",
		cache: false,
		contentType: false,
		processData: false,
		dataType: "json",
		success: function(respuesta)
		{
			console.log(respuesta);
	}});
	// https://api-sepomex.hckdrk.mx/query/get_cp_por_municipio/Aguascalientes
})

