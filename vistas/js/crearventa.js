function mostrarTablaVenta()
{
	var tablaVenta = $('.tablaVentas').DataTable(
	{
		"destroy":true,
		"deferRender": true,
		"retrieve": true,
		"processing": true,
		"bFilter": true,
		"bLengthChange" : true,
		"lengthMenu":[[5, 10, 20, 25, 50, -1], [5, 10, 20, 25, 50, "Todos"]],
		"ajax":"ajax/dataTable-ventas.ajax.php",
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
		$(this).addClass("btn-default");
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
	          	if(existencia == 0)
	          	{
	      			swal({
				      title: "No hay existencia disponible",
				      type: "error",
				      confirmButtonText: "¡Cerrar!"
				    });
				    $("#button"+idProductoVenta).addClass("btn-primary agregarProducto");
				    return;
	          	}

	          	$(".nuevoProducto").append(

	          	'<div class="row" style="padding:5px 15px">'+

				  '<!-- Descripción del producto -->'+
		          
		          '<div class="col-xs-5" style="padding-right:0px">'+
		          
		            '<div class="input-group">'+
		              
		              '<span class="input-group-addon"><button type="button" class="btn btn-danger btn-xs quitarProducto" idProducto="'+idProductoVenta+'"><i class="fa fa-times"></i></button></span>'+

		              '<input type="text" class="form-control nuevoNombreProducto" idProducto="'+idDproducto+'" name="agregarProducto" value="'+nombre+'" readonly required>'+

		            '</div>'+

		          '</div>'+

		          '<!-- Cantidad del producto -->'+

		          '<div class="col-xs-1">'+
		            
		             '<h5>'+precio+'</h5>'+

		          '</div>' +

		          '<!-- Cantidad del producto -->'+

		          '<div class="col-xs-3">'+
		            
		             '<input type="number" class="form-control nuevaCantidadProducto" name="nuevaCantidadProducto" min="1" value="1" existencia="'+existencia+'" nuevaExistencia="'+Number(existencia-1)+'" required>'+

		          '</div>' +

		          '<!-- Precio del producto -->'+

		          '<div class="col-xs-3 ingresoPrecio" style="padding-left:0px">'+

		            '<div class="input-group">'+

		              '<span class="input-group-addon"><i class="ion ion-social-usd"></i></span>'+
		                 
		              '<input type="text" class="form-control nuevoPrecioProducto" precioReal="'+precio+'" name="nuevoPrecioProducto" value="'+precio+'" readonly required>'+
		 
		            '</div>'+
		             
		          '</div>'+

		        '</div>') 
		        sumarTotalPrecios()
		        listarProductos()
	      	}
	    })

	})

	$(".tablaVentas").on("draw.dt", function()
	{
		if(localStorage.getItem("quitarProducto") != null)
		{
			var listaIdProductos = JSON.parse(localStorage.getItem("quitarProducto"));
			for(var i = 0; i < listaIdProductos.length; i++)
			{
				$("#button"+listaIdProductos[i]["idProducto"]).removeClass('btn-default');
				$("#button"+listaIdProductos[i]["idProducto"]).addClass('btn-primary agregarProducto');
			}
		}
	})

	$(".formularioVenta").on("click", "button.quitarProducto", function()
	{
		$(this).parent().parent().parent().parent().remove();
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

		$("#button"+idProducto).removeClass("btn-default");
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
	})

	$(".formularioVenta").on("change", "input.nuevaCantidadProducto", function()
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
	})

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
		var sumaTotalPrecios = arraySumaPrecio.reduce(sumaArrayPrecios);
		$("#nuevoTotalVenta").html(sumaTotalPrecios);
		$("#totalVenta").val(sumaTotalPrecios);
		$("#nuevoTotalVenta").attr("total",sumaTotalPrecios);
	}


	$(".formularioVenta").on("change", "input#nuevoValorEfectivo", function()
	{
		var efectivo = $(this).val();
		if (Number(efectivo) < Number($('#totalVenta').val())) 
		{
			swal({

				title: "El efectivo es menor al total",
				text: "¡Favor de capturar bien el efectivo!",
				type: "error",
				confirmButtonText: "¡Cerrar!"
			});
			$("#nuevoValorEfectivo").val(null);
	    }
		else
		{
			var cambio =  Number(efectivo) - Number($('#totalVenta').val());
			var nuevoCambioEfectivo = $(this).parent().parent().parent().children('#capturarCambioEfectivo').children().children('#nuevoCambioEfectivo');
			nuevoCambioEfectivo.val(cambio);
		    nuevoCambioEfectivo.number(true, 2);
		}
	})

	$(".formularioVenta").on("change", "input#nuevoCodigoTransaccion", function(){
	     listarMetodos()
	})

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
							$("#button"+idProductoVenta).addClass("btn-default");
							var nombre = respuesta["Nombre"];
							var existencia = respuesta["Stock"];
							var precio = respuesta["Precio_venta"];
							var idDproducto = respuesta["Id_producto"];

							if(existencia == 0)
							{
								swal({
								title: "No hay existencia disponible",
								type: "error",
								confirmButtonText: "¡Cerrar!"
								});
								$("#button"+idProductoVenta).addClass("btn-primary agregarProducto");
									return;
							}
							$(".nuevoProducto").append(
								'<div class="row" style="padding:5px 15px">'+
								'<!-- Descripción del producto -->'+
							
								'<div class="col-xs-5" style="padding-right:0px">'+
								
									'<div class="input-group">'+
									
									'<span class="input-group-addon"><button type="button" class="btn btn-danger btn-xs quitarProducto" idProducto="'+idProductoVenta+'"><i class="fa fa-times"></i></button></span>'+

									'<input type="text" class="form-control nuevoNombreProducto" idProducto="'+idDproducto+'" name="agregarProducto" value="'+nombre+'" readonly required>'+

									'</div>'+

								'</div>'+

								'<!-- Cantidad del producto -->'+

								'<div class="col-xs-1">'+
									
									'<h5>'+precio+'</h5>'+

								'</div>' +

								'<!-- Cantidad del producto -->'+

								'<div class="col-xs-3">'+
									
									'<input type="number" class="form-control nuevaCantidadProducto" id="'+idProductoVenta+'" name="nuevaCantidadProducto" min="1" value="1" existencia="'+existencia+'" nuevaExistencia="'+Number(existencia-1)+'" required>'+

								'</div>' +

								'<!-- Precio del producto -->'+

								'<div class="col-xs-3 ingresoPrecio" style="padding-left:0px">'+

									'<div class="input-group">'+

									'<span class="input-group-addon"><i class="ion ion-social-usd"></i></span>'+
										
									'<input type="text" class="form-control nuevoPrecioProducto" precioReal="'+precio+'" name="nuevoPrecioProducto" value="'+precio+'" readonly required>'+
						
									'</div>'+
									
								'</div>'+

								'</div>') 

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
								swal({
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

window.onload = function()
{
   listarProductos();
   mostrarTablaVenta();
};

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


