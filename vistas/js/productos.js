var tablaProveedores = $(".tablaProductos").DataTable({
		"deferRender": true,
		"retrieve": true,
		"processing": true,
		"ajax":"ajax/dataTable-productos.ajax.php",
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



$(".tablaProductos tbody").on("click","button.btnEliminarProducto", function()
{
	var idProducto = $(this).attr("idProducto");
		swal.fire({
		title: '¿Esta seguro de eliminar el producto?',
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
			window.location = "index.php?ruta=productos&idProducto="+idProducto;
		}
	})
})

$(".tablaProductos tbody").on("click","button.btnEditarProducto", function()
{
	var idProducto =$(this).attr("idProducto");
	var data = new FormData();
	data.append("idProducto",idProducto);
	$.ajax(
	{
		url: "ajax/productos.ajax.php",
		method: "POST",
      	data: data,
      	cache: false,
     	contentType: false,
     	processData: false,
     	dataType:"json",
		success:function(respuesta)
		{
			$("#codigo").val(respuesta["Codigo"]);
			$("#id_producto").val(respuesta["Id_producto"]);
			$("#nombre").val(respuesta["Nombre"]);
			$("#precio_compra").val(respuesta["Precio_compra"]);
			$("#precio_venta").val(respuesta["Precio_venta"]);
			$("#idProveedor").val(respuesta["Id_proveedor"]);
		}
	})
})

$(".tablaProductos tbody").on("click","button.btnAumentarStock", function()
{
	var idProducto =$(this).attr("idProducto");
	var data = new FormData();
	data.append("idProducto",idProducto);
	$.ajax(
	{
		url: "ajax/productos.ajax.php",
		method: "POST",
      	data: data,
      	cache: false,
     	contentType: false,
     	processData: false,
     	dataType:"json",
		success:function(respuesta)
		{
			$("#nombreA").val(respuesta["Nombre"]);
			$("#id_productoA").val(respuesta["Id_producto"]);
			$("#stockOA").val(respuesta["Stock"]);
		}
	})
})

$(".tablaProductos tbody").on("click","button.btnDisminuirStock", function()
{
	var idProducto =$(this).attr("idProducto");
	var data = new FormData();
	data.append("idProducto",idProducto);
	$.ajax(
	{
		url: "ajax/productos.ajax.php",
		method: "POST",
      	data: data,
      	cache: false,
     	contentType: false,
     	processData: false,
     	dataType:"json",
		success:function(respuesta)
		{
			$("#nombreD").val(respuesta["Nombre"]);
			$("#id_productoD").val(respuesta["Id_producto"]);
			$("#stockOD").val(respuesta["Stock"]);
		}
	})
})

