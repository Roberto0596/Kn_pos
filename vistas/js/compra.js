$(document).ready(function()
{
	$(".ocultar").css("display","none");
})

function mostrarTablaVenta(idProveedor)
{
	var tablaVenta = $('.tablaVentas').DataTable(
	{
		"destroy":true,
		"deferRender": true,
		"processing": true,
		"bFilter": true,
		"bLengthChange" : true,
		"lengthMenu":[[5, 10, 20, 25, 50, -1], [5, 10, 20, 25, 50, "Todos"]],
		"ajax":
		{
			url: "ajax/dataTable-compra.ajax.php",
			type: "POST",
			data: {idProveedor:idProveedor}
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
	})

	$(".tablaVentas tbody").on("click","button.agregarProducto", function()
	{
		var idProductoVenta = $(this).attr("idProducto");
		$(this).removeClass("btn-primary agregarProducto");
		$(this).addClass("btn-default DeUno");
		var datos = new FormData();
		datos.append("idProductoVenta", idProductoVenta);
		$.ajax({
			url:"ajax/productos.ajax.php",
			method: "POST",
			data: datos,
			cache: false,
			contentType: false,
			processData: false,
			dataType:"json",
			success:function(respuesta)
			{
				var nombre = respuesta["Nombre"];
				var existencia = respuesta["Stock"];
				var precio = respuesta["Precio_venta"];
				var idDproducto = respuesta["Id_producto"];
				$(".nuevoProducto").append(
				'<tr role="row" class="odd Producto'+idDproducto+'">'+
					'<td>'+
						'<span class="input-group-addon">'+
						'<button type="button" class="btn btn-danger btn-xs quitarProducto" idProducto="'+idProductoVenta+'">'+
							'<i class="fa fa-times"></i>'+
						'</button>'+
						'</span>'+
						'<input type="hidden" class="form-control nuevoNombreProducto" idProducto="'+idDproducto+'" name="agregarProducto" value="'+nombre+'" readonly required>'+
					'</td>'+
					'<td>'+nombre+'</td>'+
					'<td>$'+precio+'</td>'+
					'<td><input type="number" class="form-control nuevaCantidadProducto" name="nuevaCantidadProducto" min="1" value="1" existencia="'+existencia+'" nuevaExistencia="'+Number(existencia-1)+'" required></td>'+
					'<td  class="ingresoPrecio">'+
					'<input type="hidden" class="form-control nuevoPrecioProducto" precioReal="'+precio+'" name="nuevoPrecioProducto" value="'+precio+'" readonly required>'+
					'<label id="nuevoPrecioLabel">$'+precio+'</label>'+
					'</td>'+
				'</tr>'
				);
				// sumarTotalPrecios();
				// listarProductos();
			}
		});
	});
}

function nuevaCantidadProducto()
{
	var precio = $(this).parent().parent().children(".ingresoPrecio").children().children(".nuevoPrecioProducto");
	var precioFinal = $(this).val() * precio.attr("precioReal");
	precio.val(precioFinal);
	var nuevaExistencia = Number($(this).attr("existencia")) - $(this).val();
	$(this).attr("nuevaExistencia", nuevaExistencia);
	if (Number($(this).val()) > Number($(this).attr("existencia")))
	{
		$(this).val(1);
		swal({
			title: "La cantidad supera la existencia",
			text: "¡Solo hay "+$(this).attr("existencia")+" pares!",
			type: "error",
			confirmButtonText: "¡Cerrar!"
		});
	}
	sumarTotalPrecios();
	listarProductos();
}

$("#idProveedor").change(function()
{
	if ($(this).val() != "")
	{
		$("#listaProductos").val("");
		var idProveedor = $(this).val();
		$("#createProduct").removeAttr("disabled");
		mostrarTablaVenta(idProveedor);
	}
	else
	{
		$("#createProduct").attr("disabled","disabled");
		mostrarTablaVenta("0");
	}
})

$(document).ready(function()
{
   listarProductos();
   mostrarTablaVenta("0");
	$("#nuevo_precio_venta").prop("readonly",true);
});

function listarProductos()
{
	var listaProductos =[];
	var descripcion = $(".nuevoNombreProducto");
	var cantidad = $(".nuevaCantidadProducto");
	var precio = $(".nuevoPrecioProducto");

	for(var i=0; i<descripcion.length; i++)
	{
		listaProductos.push({ "id" : $(descripcion[i]).attr("idProducto"), 
							  "descripcion" : $(descripcion[i]).val(),
							  "cantidad" : $(cantidad[i]).val(),
							  "existencia" : $(cantidad[i]).attr("nuevaExistencia"),
							  "precio" : $(precio[i]).attr("precioReal"),
							  "total" : $(precio[i]).val()});
	}

	$("#listaProductos").val(JSON.stringify(listaProductos));  
}


$("#guardarProducto").click(function()
{
	var codigo = $("#nuevo_codigo_producto").val();
	var nombre = $("#nuevo_nombre_producto").val();
	var precio_compra = $("#nuevo_precio_compra").val();
	var precio_venta = $("#nuevo_precio_venta").val();
	var idProveedor = $("#idProveedor").val();

	if (codigo != "" && nombre != "" && precio_compra != "" && precio_venta != "")
	{
		var data_library = [{"codigo" : codigo,
		"nombre" : nombre, 
		"precio_compra" : precio_compra, 
		"precio_venta" : precio_venta, 
		"stock" : 0,
		"idProveedor":idProveedor}];

		var datos = new FormData();
		datos.append("data_library", JSON.stringify(data_library));
		
		$.ajax({

			url:"ajax/productos.ajax.php",
			method: "POST",
			data: datos,
			cache: false,
			contentType: false,
			processData: false,
			dataType: "json",
			success: function(respuesta)
			{
				if (respuesta)
				{
					$('#modalCrearProducto').modal('hide');
					limpiarCamposModal();
					swal.fire({
						title: 'El producto se creo correctamente',
						type: 'success',
						confirmButtonColor: '#3085d6',
						confirmButtonText: 'Aceptar'
					}).then((result)=>
					{
						if (result.value)
						{
							mostrarTablaVenta(idProveedor);
						}
					})
				}
				else
				{
					$('#modalCrearProducto').modal('hide');
					limpiarCamposModal();
					swal.fire({
						title: 'No fue posible agregar el producto',
						type: 'error',
						confirmButtonColor: '#3085d6',
						confirmButtonText: 'Aceptar'
					}).then((result)=>
					{
						if (result.value)
						{
							mostrarTablaVenta(idProveedor);
						}
					})
				}
		}});
	}
	else
	{
		swal.fire({
			title: "Tiene que completar todos los campos",
			text: "¡favor de revisar!",
			type: "info",
			confirmButtonText: "¡Cerrar!"
		});
	}
})


function limpiarCamposModal()
{
	$("#nuevo_codigo_producto").val("");
	$("#nuevo_nombre_producto").val("");
	$("#nuevo_precio_compra").val("");
	$("#nuevo_precio_venta").val("");
}

$("#nuevo_precio_compra").change(function()
{
	if ($(".porcentaje").prop("checked"))
	{
		var valorPorcentaje = $(".nuevoPorcentaje").val();

		var porcentaje = Number(($("#nuevo_precio_compra").val()*valorPorcentaje/100)) + Number($("#nuevo_precio_compra").val());

		
		$("#nuevo_precio_venta").val(porcentaje);
		$("#nuevo_precio_venta").prop("readonly",true);
	
	}
})

$(".nuevoPorcentaje").change(function()
{
	if ($(".porcentaje").prop("checked"))
	{
		var valorPorcentaje = $(this).val();

		var porcentaje = Number(($("#nuevo_precio_compra").val()*valorPorcentaje/100)) + Number($("#nuevo_precio_compra").val());
		
		$("#nuevo_precio_venta").val(porcentaje);
		$("#nuevo_precio_venta").prop("readonly",true);
	}
})

$(".porcentaje").on("ifUnchecked",function()
{
	$("#nuevo_precio_venta").prop("readonly",false);
})

$(".porcentaje").on("ifChecked",function()
{
	$("#nuevo_precio_venta").prop("readonly",true);
})




