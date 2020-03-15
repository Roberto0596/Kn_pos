$(document).ready(function()
{
	$(".ocultar").css("display","none");
})

function mostrarTablaVenta(idProveedor)
{
	$('.tablaVentas tbody').remove();
	$('.tablaVentas').DataTable(
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
				var precio = respuesta["Precio_compra"];
				var idDproducto = respuesta["Id_producto"];
				$(".nuevoProducto").append(
				'<tr role="row" class="odd Producto'+idDproducto+'">'+
					'<td>'+
						'<span class="input-group-addon">'+
						'<button type="button" class="btn btn-danger btn-xs quitarProducto" idProducto="'+idProductoVenta+'">'+
							'<i class="fa fa-times"></i>'+
						'</button>'+
						'</span>'+
						'<input type="hidden" class="form-control nuevoNombreProducto" idProducto="'+idDproducto+'" name="agregadoProducto" value="'+nombre+'" readonly required>'+
					'</td>'+
					'<td>'+nombre+'</td>'+
					'<td>$'+precio+'</td>'+
					'<td><input type="number" class="form-control nuevaCantidadProducto" name="nuevaCantidadProducto" min="1" value="1" existencia="'+existencia+'" nuevaExistencia="'+Number(existencia+1)+'" required></td>'+
					'<td  class="ingresoPrecio">'+
					'<input type="hidden" class="form-control nuevoPrecioProducto" precioReal="'+precio+'" name="nuevoPrecioProducto" value="'+precio+'" readonly required>'+
					'<label id="nuevoPrecioLabel">$'+precio+'</label>'+
					'</td>'+
				'</tr>'
				);
				sumarTotalPrecios();
				listarProductos();
			}
		});
	});

	$(".tablaVentas").on("draw.dt", function()
	{
		if(localStorage.getItem("quitarProducto") != null)
		{
			var listaIdProductos = JSON.parse(localStorage.getItem("quitarProducto"));
			for(var i = 0; i < listaIdProductos.length; i++)
			{
				$("#button"+listaIdProductos[i]["idProducto"]).removeClass('btn-default DeUno');
				$("#button"+listaIdProductos[i]["idProducto"]).addClass('btn-primary agregarProducto');
			}
		}
	});

	$(".formularioVenta").on("click", "button.quitarProducto", function()
	{
		$(this).parent().parent().parent().remove();
		var idProducto = $(this).attr("idProducto");
		if (localStorage.getItem("listaDProductos")!=null)
		{
			var local = localStorage.getItem("listaDProductos");
			var arreglo = JSON.parse(local)

			for (var i = 0; i < arreglo.length; i++)
			{
				if (arreglo[i]['codigo'] == idProducto)
				{
					arreglo.splice(i,1);
				}
			}

			localStorage.removeItem("listaDProductos");

			if (arreglo.length!=0)
			{
				localStorage.setItem("listaDProductos", JSON.stringify(arreglo));
  			}
 		}

		$("#button"+idProducto).removeClass("btn-default DeUno");
		$("#button"+idProducto).addClass("btn-primary agregarProducto");

		if($(".nuevoProducto").children().length == 0)
		{
			$("#nuevoImpuestoVenta").val(16);
			$("#nuevoTotalVenta").html(0);
			$("#totalVenta").val(0);
			$("#nuevoTotalVenta").attr("total",0);
			$("#nuevoValorEfectivo").val(null);
			$("#nuevoCambioEfectivo").val(null);
		}
		else
		{
	     	sumarTotalPrecios();
	     	listarProductos();
		}
	});

	$(".formularioVenta").on("keyup", "input#nuevoValorEfectivo", function()
	{
		var efectivo = $(this).val();
		var cambio =  Number(efectivo) - Number($('#totalVenta').val());
		var nuevoCambioEfectivo = $(this).parent().parent().parent().children('#capturarCambioEfectivo').children().children('#nuevoCambioEfectivo');
		if (Number(efectivo) > Number($('#totalVenta').val()))
		{
			nuevoCambioEfectivo.val(cambio);
	    }
	    else
	    {
			nuevoCambioEfectivo.val(0);
		}
	});

	$(".formularioVenta").on("change", "input#nuevoValorEfectivo", function()
	{
		var efectivo = $(this).val();
		if (Number(efectivo) < Number($('#totalVenta').val()) && $(".formularioVenta .tipoCompra").text()=="Contado")
		{
			swal.fire({
				title: "El efectivo es menor al total",
				text: "¡Favor de capturar bien el efectivo!",
				type: "error",
				confirmButtonText: "¡Cerrar!"
			}).then((result) => {
				if (result.value) {
					$('#nuevoValorEfectivo').trigger('focus');
				}
			  });
			$("#nuevoValorEfectivo").val(null);
			$("#nuevoCambioEfectivo").val(0);

	    }
		else
		{
			var cambio =  Number(efectivo) - Number($('#totalVenta').val());
			var nuevoCambioEfectivo = $(this).parent().parent().parent().children('#capturarCambioEfectivo').children().children('#nuevoCambioEfectivo');
			nuevoCambioEfectivo.val(redondear(cambio,2));

		}
	});

	function sumarTotalPrecios()
	{
		var precioItem = $(".nuevoPrecioProducto");
		var arraySumaPrecio = [];

		for (var i = 0; i < precioItem.length; i++)
		{
			arraySumaPrecio.push(Number($(precioItem[i]).val()));
		}

		function sumaArrayPrecios(total,numero)
		{
			return total + numero;
		}

		if(arraySumaPrecio != ""){
			var sumaTotalPrecios = arraySumaPrecio.reduce(sumaArrayPrecios);
		}else{
			var sumaTotalPrecios = 0;
		}

		$("#nuevoTotalVenta").html(sumaTotalPrecios);
		$("#totalVenta").val(sumaTotalPrecios);
		$("#nuevoTotalVenta").attr("total",sumaTotalPrecios);

	}

	$(".formularioVenta").on("change", "input.nuevaCantidadProducto", function()
	{
		var precio = $(this).parent().parent().children(".ingresoPrecio").children(".nuevoPrecioProducto");
		var precioLabel = $(this).parent().parent().children(".ingresoPrecio").children("#nuevoPrecioLabel");
		var precioFinal = $(this).val() * precio.attr("precioReal");

		if(precioFinal != "")
		{
			precio.val(precioFinal);
			precioLabel.text("$"+precioFinal);
		}
		else
		{
			precio.val(0);
			precioLabel.text("$0");
		}

		var nuevaExistencia = Number($(this).attr("existencia")) + Number($(this).val());

		$(this).attr("nuevaExistencia", nuevaExistencia);

		sumarTotalPrecios();
		listarProductos();
	});

	var codigoProductos = [];
	localStorage.removeItem("listaDProductos");
	var bandera = 0;

	$('.codigoBarra').on('keyup',function(e)
	{
		tablaVenta.search(this.value).draw();

		if(e.keyCode == 13)
		{

			var idProductoVenta = $("#codigoDVenta").val().toUpperCase();
			var almacenVenta = $('#almacenVenta').val();
			var datos = new FormData();
			datos.append("idProductoVenta", idProductoVenta);
			datos.append("almacenVenta", almacenVenta);
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
					if (respuesta!="error")
					{

						if(localStorage.getItem("listaDProductos") != null)
						{
							var listaIdProductos = JSON.parse(localStorage.getItem("listaDProductos"));

							for(var i = 0; i < listaIdProductos.length; i++)
							{
								if (idProductoVenta == listaIdProductos[i]["codigo"])
								{
									bandera = 1;
								}
							}
						}
						else
						{
							bandera = 0;
						}

						if (bandera == 0)
						{
							$("#button"+idProductoVenta).removeClass("btn-primary agregarProducto");
							$("#button"+idProductoVenta).addClass("btn-default DeUno");
							var nombre = respuesta["Nombre"];
							var existencia = respuesta["Stock"];
							var precio = respuesta["Precio_compra"];
							var idDproducto = respuesta["Id_producto"];

							$(".nuevoProducto").append(
							'<tr role="row" class="odd Producto'+idDproducto+'">'+
								'<td>'+
									'<span class="input-group-addon">'+
									'<button type="button" class="btn btn-danger btn-xs quitarProducto" idProducto="'+idProductoVenta+'">'+
										'<i class="fa fa-times"></i>'+
									'</button>'+
									'</span>'+
									'<input type="hidden" class="form-control nuevoNombreProducto" idProducto="'+idDproducto+'" name="agregadoProducto" value="'+nombre+'" readonly required>'+
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

							if(localStorage.getItem("listaDProductos") == null)
							{
								codigoProductos = [];
							}
							else
							{
								codigoProductos.concat(localStorage.getItem("listaDProductos"))
							}
							codigoProductos.push({"codigo":idProductoVenta});
							localStorage.setItem("listaDProductos", JSON.stringify(codigoProductos));
							sumarTotalPrecios()
							listarProductos()
							$("#codigoDVenta").val("");
							tablaVenta.search("").draw();
						}
						else
						{
							var cantidad = $("#"+idProductoVenta).val();
							var suma = Number(cantidad) + 1;
							$("#"+idProductoVenta).val(suma);
							var precio = $("#"+idProductoVenta).parent().parent().children(".ingresoPrecio").children().children(".nuevoPrecioProducto");

							var precioFinal = $("#"+idProductoVenta).val() * precio.attr("precioReal");

							precio.val(precioFinal);

							var nuevaExistencia = Number($("#"+idProductoVenta).attr("existencia")) - $("#"+idProductoVenta).val();

							$("#"+idProductoVenta).attr("nuevaExistencia", nuevaExistencia);

							if (Number($("#"+idProductoVenta).val()) > Number($("#"+idProductoVenta).attr("existencia")))
							{
								$("#"+idProductoVenta).val(1);
								swal.fire({
									title: "La cantidad supera la existencia",
									text: "¡Solo hay "+$("#"+idProductoVenta).attr("existencia")+" pares!",
									type: "error",
									confirmButtonText: "¡Cerrar!"
								});

							}
							sumarTotalPrecios();
							listarProductos();
							// PONER FORMATO AL PRECIO DE LOS PRODUCTOS
							$(".nuevoPrecioProducto").number(true, 2);
							$("#codigoDVenta").val("");
							tablaVenta.search("").draw();
							bandera = 0;
						}
					}
				}
			})
		}
	});
}

$("#idProveedor").change(function()
{
	if ($(this).val() != "")
	{
		$("#listaProductos").val("");
		$("#createProduct").removeAttr("disabled");
		$("#tablaProductos tbody").empty();
		$("#Id_proveedor").val($(this).val());
		mostrarTablaVenta($(this).val());
	}
	else
	{
		$("#createProduct").attr("disabled","disabled");
		$("#tablaProductos tbody").empty();
		$("#Id_proveedor").val("");
		mostrarTablaVenta("0");
	}
})

$("#frmCobro").submit(function( event ) 
{
	if($("#listaProductos").val() == "[]")
	{
		event.preventDefault();
		swal.fire({
			title: "Debe agregar por lo menos un producto",
			text: "¡Favor de capturar un producto!",
			type: "error",
			confirmButtonText: "¡Cerrar!"
		})
	}
});

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

$(".crear_producto").on("change", "input#nuevo_codigo_producto", function()
{
    $(".alert").remove();
    var valor = $(this).val();
    var datos = new FormData();
    datos.append("validarCodigo",valor);
    $.ajax(
    {
        url: "ajax/productos.ajax.php",
        method: "POST",
        data: datos,
        cache: false,
        contentType: false,
        processData: false,
        dataType: "json",
        success: function(respuesta) 
        {
            if(respuesta)
            {
                $("#nuevo_codigo_producto").parent().after('<div class="alert alert-warning">Este codigo ya esta registrado</div>')
                $("#nuevo_codigo_producto").val("");  
                $('#nuevo_codigo_producto').trigger('focus');
            }
        }
    })
})

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

function redondear(numero, digitos)
{
    let base = Math.pow(10, digitos);
    let entero = Math.round(numero * base);
    return entero / base;
}




