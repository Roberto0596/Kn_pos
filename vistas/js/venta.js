var tablaVenta;
function mostrarTablita() {
	$('.tablaVentas tbody').remove();
	tablaVenta = $('.tablaVentas').DataTable(
	{
		"destroy":true,
		"deferRender": true,
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
	});
}

function mostrarTablaVenta()
{
	mostrarTablita();
	$(".tablaVentas tbody").on("click","button.DeUno", function()
	{
		$("#descuentoP").val(null);
		var idProductoVenta = $(this).attr("idProducto");
		var cantidad = $(".Producto"+idProductoVenta+" .nuevaCantidadProducto").val();
		$(".Producto"+idProductoVenta+" .nuevaCantidadProducto").val(parseInt(cantidad)+1);
		$(".Producto"+idProductoVenta+" .nuevaCantidadProducto").trigger('change');
		$('#descuentoP').trigger('focus');
	});

	$(".tablaVentas tbody").on("click","button.agregarProducto", function()
	{
		var opcion = $('#seleccionarCliente').val();
		if(opcion != ""){
			$("#descuentoP").val(null);
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
					if(existencia == 0)
					{
						swal.fire({
						title: "No hay existencia disponible",
						type: "error",
						confirmButtonText: "¡Cerrar!"
						});
						$("#button"+idProductoVenta).addClass("btn-primary agregarProducto");

						return;
					}

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
					sumarTotalPrecios();
					listarProductos();
				}
			});
			$('#descuentoP').trigger('focus');

		}else{
			swal.fire({
				title: "Primero seleccione el cliente",
				type: "error",
				confirmButtonText: "¡Cerrar!"
			}).then((result) => {
				$('#seleccionarCliente').trigger('focus');
			  });
		}

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


	$(".formularioVenta").on("keyup", "input.nuevaCantidadProducto", function()
	{
		var precio = $(this).parent().parent().children(".ingresoPrecio").children().children(".nuevoPrecioProducto");
		var precioLabel = $(this).parent().parent().children(".ingresoPrecio").children("#nuevoPrecioLabel");
		var precioFinal = $(this).val() * precio.attr("precioReal");

		if(precioFinal != ""){
			precio.val(precioFinal);
			precioLabel.hmtl("$"+precioFinal);
		}else{
			precio.val(0);
			precioLabel.hmtl("$0");
		}


		var nuevaExistencia = Number($(this).attr("existencia")) - $(this).val();

		$(this).attr("nuevaExistencia", nuevaExistencia);

		if (Number($(this).val()) > Number($(this).attr("existencia")))
		{
			$(this).val(1);
			var precio = $(this).parent().parent().children(".ingresoPrecio").children().children(".nuevoPrecioProducto");
			var precioFinal = $(this).val() * precio.attr("precioReal");
			precio.val(precioFinal);
			swal.fire({
				title: "La cantidad supera la existencia",
				text: "¡Solo hay "+$(this).attr("existencia")+" unidades!",
				type: "error",
				confirmButtonText: "¡Cerrar!"
			});
		}
		sumarTotalPrecios();
		listarProductos();
	});

	$(".formularioVenta").on("change", "input.nuevaCantidadProducto", function()
	{
		var precio = $(this).parent().parent().children(".ingresoPrecio").children(".nuevoPrecioProducto");
		var precioLabel = $(this).parent().parent().children(".ingresoPrecio").children("#nuevoPrecioLabel");
		var precioFinal = $(this).val() * precio.attr("precioReal");

		if(precioFinal != ""){
			precio.val(precioFinal);
			precioLabel.text("$"+precioFinal);
		}else{
			precio.val(0);
			precioLabel.text("$0");
		}

		var nuevaExistencia = Number($(this).attr("existencia")) - $(this).val();

		$(this).attr("nuevaExistencia", nuevaExistencia);

		if (Number($(this).val()) > Number($(this).attr("existencia")))
		{
			$(this).val(1);
			var precio = $(this).parent().parent().children(".ingresoPrecio").children().children(".nuevoPrecioProducto");
			var precioFinal = $(this).val() * precio.attr("precioReal");
			precio.val(precioFinal);
			swal.fire({
				title: "La cantidad supera la existencia",
				text: "¡Solo hay "+$(this).attr("existencia")+" unidades!",
				type: "error",
				confirmButtonText: "¡Cerrar!"
			});

		}
		sumarTotalPrecios();
		listarProductos();
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
	$(".formularioVenta").on("keyup", "input#nuevoValorEfectivo", function()
	{
		var efectivo = $(this).val();
		var cambio =  Number(efectivo) - Number($('#totalVenta').val());
		var nuevoCambioEfectivo = $(this).parent().parent().parent().children('#capturarCambioEfectivo').children().children('#nuevoCambioEfectivo');
		if (Number(efectivo) > Number($('#totalVenta').val()))
		{
			nuevoCambioEfectivo.val(redondear(cambio,2));
	    }else{
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
			if(cambio < 0){
				nuevoCambioEfectivo.val(0);
			}else{
				nuevoCambioEfectivo.val(redondear(cambio,2));
			}


		}
	});

	$(".formularioVenta").on("change", "input#nuevoCodigoTransaccion", function(){
	     listarMetodos()
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
							var precio = respuesta["Precio_venta"];
							var idDproducto = respuesta["Id_producto"];

							if(existencia == 0)
							{
								swal.fire({
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

window.onload = function()
{
   listarProductos();
   mostrarTablaVenta();
};

$(".formularioVenta").on("click", "button.btn-info", function()
	{
		$(".formularioVenta .tipoCompra").removeClass('btn-info');
		$(".formularioVenta .tipoCompra").addClass('btn-secondary');
		$(".formularioVenta .tipoCompra").text("Contado");

		$("#tipoVenta").val(1);
		$('#seleccionarCliente').val(null).trigger('change');

		$('#tipoTiempo').attr('disabled',true);
		$('#cantidadTiempo').attr('disabled',true);
		$('#primerAbono').attr('disabled',true);
		$('#nuevoValorEfectivo').attr('placeholder','Pago');
		$('#listaProductos').val('');
		$('#tablaProductos tbody').empty();
		$("#nuevoTotalVenta").html(0);
		$("#totalVenta").val(0);
		$("#nuevoTotalVenta").attr("total",0);
		$("#nuevoValorEfectivo").val(null);
		$("#nuevoCambioEfectivo").val(null);
		$("#descuentoP").val(null);
		mostrarTablaVenta();
	});

	$(".formularioVenta").on("click", "button.btn-secondary", function()
	{
		$(".formularioVenta .tipoCompra").removeClass('btn-secondary');
		$(".formularioVenta .tipoCompra").addClass('btn-info');
		$(".formularioVenta .tipoCompra").text("Crédito");

		$("#tipoVenta").val(0);
		$('#seleccionarCliente').val(null).trigger('change');

		$('#tipoTiempo').attr('disabled',false);
		$('#cantidadTiempo').attr('disabled',false);
		$('#primerAbono').attr('disabled',false);
		$('#nuevoValorEfectivo').attr('placeholder','Enganche');
		$('#listaProductos').val('');
		$('#tablaProductos tbody').empty();
		$("#nuevoTotalVenta").html(0);
		$("#totalVenta").val(0);
		$("#nuevoTotalVenta").attr("total",0);
		$("#nuevoValorEfectivo").val(null);
		$("#nuevoCambioEfectivo").val(null);
		$("#descuentoP").val(null);
		mostrarTablaVenta();
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

$(document).ready(function() {
	$("#seleccionarCliente").select2({
		placeholder: "Nombre del cliente",
		allowClear: true
	});
});
function activarControles() {
	$("#totalVenta").val();
}
$("#seleccionarCliente").on("change", function(){
	if(this.value > 0 && $(".formularioVenta .tipoCompra").text()=="Crédito"){
		var idCliente = this.value;
		var data = new FormData();
		data.append("id_cliente",idCliente);
		$.ajax(
		{
			url: "ajax/venta.ajax.php",
			method: "POST",
			data: data,
			cache: false,
			contentType: false,
			processData: false,
			dataType:"json",
			success:function(respuesta)
			{
				if(!respuesta){
					swal.fire({
						title: "Cliente sin crédito",
						text: "Cliente seleccionado no tiene crédito, se pasará a contado.",
						type: "error",
						confirmButtonText: "¡Cerrar!"
					}).then((result) => {
						$(".formularioVenta .tipoCompra").click();
						$('#seleccionarCliente').val(idCliente).trigger('change');
					  });
				}

			}
		});
	}
});
$( "#frmCobro" ).submit(function( event ) {
	if($("#totalVenta").val() > $("#nuevoValorEfectivo").val() && $("#nuevoCambioEfectivo").val() == 0 && $(".formularioVenta .tipoCompra").text()=="Contado"){
		event.preventDefault();
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
  });


  function redondear(numero, digitos){
    let base = Math.pow(10, digitos);
    let entero = Math.round(numero * base);
    return entero / base;
}

function sumarTotalPreciosD()
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

  $('#descuentoP').on('change', function() {
	sumarTotalPreciosD();
	var totalVent = $('#totalVenta').val();
	var porcentaje = $(this).val();
	var descuento = porcentaje;//(porcentaje/100) * totalVent;
	descuento = redondear(descuento,2);
	totalVent = totalVent - descuento;
	totalVent = redondear(totalVent,2);
	$('#descuentoTH').val(descuento);
	$('#descuentoT').html(descuento);
	$('#totalVenta').val(totalVent);
	$('#nuevoTotalVenta').html(totalVent);
	$('#primerAbono').val(0);
	$('#tipoTiempo').trigger('focus');
  });

  $('#tipoTiempo').on('change', function() {
	var opcion = $(this).val();
	if(opcion=="Semanal") $('#cantidadTiempo').val(50);
	if(opcion=="Quincenal") $('#cantidadTiempo').val(25);
	if(opcion=="Mensual") $('#cantidadTiempo').val(12);
	$('#primerAbono').val(0);
	$('#primerAbono').trigger('focus');
  });


  $('#primerAbono').on('change', function() {
	var diasSemana = new Array("Domingo","Lunes","Martes","Miércoles","Jueves","Viernes","Sábado");
	var fecha = new Date($(this).val());
	fecha.setDate(fecha.getDate()+1); //rectificando la dia
	switch($("#tipoTiempo").val()) {
		case "Semanal":
		  if(fecha.getDay()!=5){
			swal.fire({
				title: "Abonos semanales",
				text: "Los abonos semanales solo son los dias viernes",
				type: "error",
				confirmButtonText: "¡Cerrar!"
			}).then((result) => {
				$(this).val(0);
				return;
			  });
		  }
		  break;
		case "Quincenal":
			if(fecha.getDate()!=15 && fecha.getDate()!=30 && !(fecha.getDate()==28 && fecha.getMonth() != 2)){
				swal.fire({
					title: "Abonos quincenal",
					text: "Los abonos quincelanes tienen que ser los dias 15 y 30.",
					type: "error",
					confirmButtonText: "¡Cerrar!"
				}).then((result) => {
					$(this).val(0);
					return;
				  });
			  }
		  break;
		case "Mensual":
			if(fecha.getDate()>28){
				swal.fire({
					title: "Abonos mensual",
					text: "Los abonos mensuales no pueden ser los dias 29, 30 ni 31.",
					type: "error",
					confirmButtonText: "¡Cerrar!"
				}).then((result) => {
					$(this).val(0);
					return;
				  });
			}
		  break;
		  default:
			swal.fire({
				title: "Abonos",
				text: "Primero debe seleccionar tipo de abono.",
				type: "error",
				confirmButtonText: "¡Cerrar!"
			}).then((result) => {
				$(this).val(0);
				$('#tipoTiempo').trigger('focus');
				return;
			  });
	  }
	$('#nuevoValorEfectivo').trigger('focus');
  });

  $("html, body").animate({
    scrollTop: 140
}, 2300);
