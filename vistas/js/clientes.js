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

$(".tablaClientes tbody").on("click","button.btnEditarCliente",function()
{
	$('#ciudad').empty().append('whatever');
	$('#codigo_postal').empty().append('whatever');
	$('#asentamiento').empty().append('whatever');
	$.ajax({
		url:"https://api-sepomex.hckdrk.mx/query/get_municipio_por_estado/Sonora",
		cache: false,
		contentType: false,
		processData: false,
		dataType: "json",
		success: function(respuesta)
		{
			for (var i = 0; i < respuesta["response"]["municipios"].length; i++) 
			{
				var codigo = respuesta["response"]["municipios"][i];
				$('#ciudad').prepend("<option value='"+codigo+"' >"+codigo+"</option>");
			}
			
	}});
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
			$("#codigo_postal_enviar").val(respuesta["codigo_postal"]);
			$("#ciudad_enviar").val(respuesta["ciudad"]);
			$("#id_cliente").val(respuesta["id_cliente"]);
			$("#asentamiento_enviar").val(respuesta["asentamiento"]);
			$('#ciudad').prepend("<option value='' >"+respuesta["ciudad"]+"</option>");
			$('#codigo_postal').prepend("<option value='' >"+respuesta["codigo_postal"]+"</option>");
			$('#asentamiento').prepend("<option value='' >"+respuesta["asentamiento"]+"</option>");
	}});
})

$("#ciudad").change(function()
{
	$('#codigo_postal').empty().append('whatever');
	$('#asentamiento').empty().append('whatever');
	var municipio = $(this).val();
	$("#ciudad_enviar").val(municipio);
	$.ajax({
		url:"https://api-sepomex.hckdrk.mx/query/get_cp_por_municipio/"+municipio,
		cache: false,
		contentType: false,
		processData: false,
		dataType: "json",
		success: function(respuesta)
		{
			for (var i = 0; i < respuesta["response"]["cp"].length; i++) 
			{
				var codigo = respuesta["response"]["cp"][i];
				$('#codigo_postal').prepend("<option value='"+codigo+"' >"+codigo+"</option>");
			}
			
		}});
		$('#codigo_postal').prepend("<option value='' >Seleccione un codigo postal</option>");
})

$("#codigo_postal").change(function()
{
	$('#asentamiento').removeAttr("readonly");
	$('#asentamiento').empty().append('whatever');
	var codigo_postal = $(this).val();
	$("#codigo_postal_enviar").val(codigo_postal);
	$.ajax({
		url:"https://api-sepomex.hckdrk.mx/query/info_cp/"+codigo_postal+"?type=simplified",
		cache: false,
		contentType: false,
		processData: false,
		dataType: "json",
		success: function(respuesta)
		{	
			var lastValue;
			for (var i = 0; i < respuesta["response"]["asentamiento"].length; i++) 
			{
				var asentamiento = respuesta["response"]["asentamiento"][i];
				$('#asentamiento').prepend("<option value='"+asentamiento+"' >"+asentamiento+"</option>");
				if (i==respuesta["response"]["asentamiento"].length-1)
				{
					lastValue =respuesta["response"]["asentamiento"][i]
				}
			}
			$("#asentamiento_enviar").val($('#asentamiento').val());			
	}});
})

$("#asentamiento").change(function()
{
	$("#asentamiento_enviar").val($('#asentamiento').val());
})

