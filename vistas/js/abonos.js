var creditos = [];
var fechasAbonos = [];
var tipoAbonos = [];
var enganches = [];
var importes = [];
var saldos = [];
var abonoBase = 0;
var saldoActual = 0;
var fechaVence = "";
var fechaProximo = "";
var numeroAbono = 0;
var descuentoTotal = 0;
var importeSelect = 0;

$(document).ready(function() {
	$("#seleccionarCliente").select2({
		placeholder: "Nombre del cliente",
		allowClear: true
	});
});

$(document).ready(function() {
	$("#seleccionarCredito").select2({
		placeholder: "Crédito",
		allowClear: true
	});
});

$("#seleccionarCliente").on("change", function(){
	var idCliente = this.value;
	var nombre = $('#seleccionarCliente option:selected').html();
	var data = new FormData();
	data.append("id_cliente",idCliente);
	$.ajax(
	{
		url: "ajax/abonos.ajax.php",
		method: "POST",
		data: data,
		cache: false,
		contentType: false,
		processData: false,
		dataType:"json",
		success:function(respuesta)
		{
			if(respuesta.length==0){
				if (idCliente != 0) {
					swal.fire({
						title: "Sin créditos activos",
						text: "El cliente "+nombre+" no tiene créditos activos",
						type: "warning",
						confirmButtonText: "¡Cerrar!"
					}).then((result) => {
						$('#seleccionarCliente').val(0).trigger('change');
					});
				}else{
					$("#seleccionarCredito").html("");
					$("#seleccionarCredito").prepend("<option></option>");
					$('#seleccionarCredito').val(0).trigger('change');
				}
			}else{
				$("#seleccionarCredito").html("");
				$("#seleccionarCredito").prepend("<option></option>");
				$('.datosClienteH').css("visibility","hidden");
				$('.conceptoCompra').css("visibility","hidden");
				$(".datosCliente").html(" ");
				$("#conceptoCompra").html(" ");
				$(".datosCredito").html(" ");
				$(".tablaAbonos tbody").html(" ");
				$("#folioCompra").val(null);
				$("#nAbono").val(null);
				$("#ultimoSaldo").val(null);
				$("#efectivo").val(null);
				$("#cambio").val(null);
				$.each(respuesta, function (indice, elemento) {
					//alert(elemento["ListaProductos"]);
					//$("#seleccionarCredito").prepend("<option value='"+indice+"'>Crédito "+(indice+1)+"</option>");
					$("#seleccionarCredito").prepend("<option value='"+(indice+1)+"' folio='"+elemento['Folio']+"'>Crédito "+elemento['Folio']+"</option>");
					creditos.push(elemento["ListaProductos"]);
					fechasAbonos.push(elemento["CalendarioAbonos"]);
					tipoAbonos.push(elemento["TipoAbono"]);
					enganches.push(elemento["TotalPago"]);
					importes.push(elemento["TotalVenta"]);
					saldos.push(elemento["Pendiente"]);
				});
			}

		}
	});

});

function darFormato(cantidad) {
	return new Intl.NumberFormat('en-US', {minimumFractionDigits: 2}).format(cantidad);
}

$("#seleccionarCredito").on("change", function(){
	var indiceCred = this.value;
	var idCliente = $('#seleccionarCliente option:selected').val();
	var folioCompra = $("#seleccionarCredito option:selected").attr("folio");
	$("#folioCompra").val(folioCompra);
	if(indiceCred != 0){
		$('.datosClienteH').css("visibility","visible");
		$('.conceptoCompra').css("visibility","visible");
		var data = new FormData();
		data.append("traerCliente",idCliente);
		$.ajax(
		{
			url: "ajax/abonos.ajax.php",
			method: "POST",
			data: data,
			cache: false,
			contentType: false,
			processData: false,
			dataType:"json",
			success:function(respuesta)
			{
				$(".datosCliente").html(" ");
				$(".datosCliente").prepend("<p><strong>Número tel: </strong>"+respuesta['telefono_casa']+", "+respuesta['telefono_celular']+".</p>");
				$(".datosCliente").prepend("<p><strong>Domicilio: </strong>"+respuesta['direccion']+", "+respuesta['asentamiento']+", "+respuesta['ciudad']+".</p>");
				$("#conceptoCompra").html(" ");
				var credito = $.parseJSON(creditos[indiceCred-1]);
				$.each(credito, function (indice, producto) {
					$("#conceptoCompra").prepend("<p>"+producto.cantidad+" "+producto.descripcion+" $"+darFormato(producto.total)+"</p>");
				});
				$(".datosCredito").html(" ");
				var fechas = $.parseJSON(fechasAbonos[indiceCred-1]);
				var datosCredito = "<div class='col-md-2'>"+fechas.length+" pagos</div>";
				//abonoBase = fechas[fechas.length-1].Abono;
				abonoBase = fechas[fechas.length-1].Abono;
				datosCredito += "<div class='col-md-2'>"+tipoAbonos[indiceCred-1]+" de $"+darFormato(abonoBase)+"</div>";
				importeSelect = importes[indiceCred-1];
				datosCredito += "<div class='col-md-2'>Importe $"+darFormato(importes[indiceCred-1])+"</div>";
				datosCredito += "<div class='col-md-2'>Enganche $"+darFormato(enganches[indiceCred-1])+"</div>";
				var saldin = importes[indiceCred-1]-enganches[indiceCred-1];
				datosCredito += "<div class='col-md-2'>Saldo $"+darFormato(saldin)+"</div>";
				$(".datosCredito").prepend(datosCredito);
				$(".tablaAbonos tbody").html(" ");
				var saldoMostrar = parseFloat(saldin);
				var tiene = false;
				var verifica = 0;
				$.each(fechas, function (indice, fecha) {

					if(indice == 0 && fecha.Estado == 0){ //no hay abonos
						verifica = 1;
						$("#nAbono").val(1);
						numeroAbono = 1;
						$("#abono").val(abonoBase);
						$("#ultimoSaldo").val(saldos[indiceCred-1]);
						fechaVence = fecha.Fecha;
						fechaProximo = fechas[indice+1].Fecha;
						numeroAbono = indice;
						$('.tablaAbonos tbody').append("<tr><td>"+(indice+1)+"</td><td>"+fecha.Fecha+"</td><td></td><td></td><td></td><td><button id='btnAbonar' class='btn btn-primary pull-right btnAbonar' title='Cobrar' type='button' data-toggle = 'modal' data-target = '#modalCobro'>Abonar</button></td><td></td></tr>");

					}else if(fecha.FechaPago == 0 && fecha.Folio == 0 && verifica == 0){
						$("#nAbono").val(indice+1);
						numeroAbono = indice+1;
						$("#abono").val(abonoBase);
						$("#ultimoSaldo").val(saldos[indiceCred-1]);
						fechaVence = fecha.Fecha;
						if(fechas.length == numeroAbono){
							abonoBase = saldos[indiceCred-1];
							$("#abono").val(abonoBase);
							fechaProximo = "LIQUIDADO";
						}else{
							fechaProximo = fechas[indice+1].Fecha;
						}
						numeroAbono = indice;
						$('.tablaAbonos tbody').append("<tr><td>"+(indice+1)+"</td><td>"+fecha.Fecha+"</td><td></td><td></td><td></td><td><button id='btnAbonar' class='btn btn-primary pull-right btnAbonar' title='Cobrar' type='button' data-toggle = 'modal' data-target = '#modalCobro'>Abonar</button></td><td></td></tr>");
						verifica = verifica + 1;

					}else{
						if(fecha.FechaPago == 0 && fecha.Folio == 0){
							$('.tablaAbonos tbody').append("<tr><td>"+(indice+1)+"</td><td>"+fecha.Fecha+"</td><td></td><td></td><td></td><td></td><td></td></tr>");
						}else{
							saldoMostrar = saldoMostrar - parseFloat(fecha.Cantidad);
							$('.tablaAbonos tbody').append("<tr><td>"+(indice+1)+"</td><td>"+fecha.Fecha+"</td><td>"+fecha.Folio+"</td><td>"+fecha.FechaPago+"</td><td>$"+fecha.Cantidad+"</td><td></td><td>$"+darFormato(saldoMostrar)+"</td></tr>");
						}

					}

				});

/*
				abonosActuales = [];
				var data = new FormData();
				data.append("traerAbonos",folioCompra);
				$.ajax(
				{
					url: "ajax/abonos.ajax.php",
					method: "POST",
					data: data,
					cache: false,
					contentType: false,
					processData: false,
					dataType:"json",
					success:function(abonosActuales)
					{
						if(abonosActuales.length==0){ //Nada de abonos
							$.each(fechas, function (indice, fecha) {
								if(indice == 0){
									$("#nAbono").val(1);
									numeroAbono = 1;
									$("#abono").val(abonoBase);
									$("#ultimoSaldo").val(saldos[indiceCred-1]);
									fechaVence = fecha.Fecha;
									fechaProximo = fechas[indice+1].Fecha;
									numeroAbono = indice;
									$('.tablaAbonos tbody').append("<tr><td>"+(indice+1)+"</td><td>"+fecha.Fecha+"</td><td></td><td></td><td></td><td><button id='btnAbonar' class='btn btn-primary pull-right btnAbonar' title='Cobrar' type='button' data-toggle = 'modal' data-target = '#modalCobro'>Abonar</button></td><td></td></tr>");
								}else{
									$('.tablaAbonos tbody').append("<tr><td>"+(indice+1)+"</td><td>"+fecha.Fecha+"</td><td></td><td></td><td></td><td></td><td></td></tr>");
								}

							});
						}else{//si hay abonos
							var verifica = 0;
							$.each(fechas, function (indice, fecha) {
								if(abonosActuales[indice] != null){
									//$('.tablaAbonos tbody').append("<tr><td>"+(indice+1)+"</td><td>"+fecha.Fecha+"</td><td>"+abonosActuales[indice].folio_pago+"</td><td>"+abonosActuales[indice].fecha_pago+"</td><td>$"+darFormato(abonosActuales[indice].cantidad)+"</td><td></td><td>$"+darFormato(abonosActuales[indice].saldo)+"</td></tr>");
									$('.tablaAbonos tbody').append("<tr><td>"+(indice+1)+"</td><td>"+fecha.Fecha+"</td><td>"+abonosActuales[indice].folio_pago+"</td><td>"+fecha.FechaPago+"</td><td>$"+fecha.Cantidad+"</td><td></td><td>$"+darFormato(abonosActuales[indice].saldo)+"</td></tr>");
								}else{
									if(verifica == 0){ //ultimo abono
										$("#nAbono").val(indice+1);
										numeroAbono = indice+1;
										$("#abono").val(abonoBase);
										$("#ultimoSaldo").val(saldos[indiceCred-1]);
										fechaVence = fecha.Fecha;
										if(fechas.length == numeroAbono){
											abonoBase = saldos[indiceCred-1];
											$("#abono").val(abonoBase);
											fechaProximo = "LIQUIDADO";
										}else{
											fechaProximo = fechas[indice+1].Fecha;
										}
										numeroAbono = indice;
										$('.tablaAbonos tbody').append("<tr><td>"+(indice+1)+"</td><td>"+fecha.Fecha+"</td><td></td><td></td><td></td><td><button id='btnAbonar' class='btn btn-primary pull-right btnAbonar' title='Cobrar' type='button' data-toggle = 'modal' data-target = '#modalCobro'>Abonar</button></td><td></td></tr>");
										verifica = verifica + 1;
									}else{
										$('.tablaAbonos tbody').append("<tr><td>"+(indice+1)+"</td><td>"+fecha.Fecha+"</td><td></td><td></td><td></td><td></td><td></td></tr>");
									}
								}

							});
						}
					}
				});*/
			}
		});
	}else{
		$('.datosClienteH').css("visibility","hidden");
		$('.conceptoCompra').css("visibility","hidden");
		$(".datosCliente").html(" ");
		$("#conceptoCompra").html(" ");
		$(".datosCredito").html(" ");
		$(".tablaAbonos tbody").html(" ");
		$("#folioCompra").val(null);
		$("#nAbono").val(null);
		$("#ultimoSaldo").val(null);
		$("#efectivo").val(null);
		$("#cambio").val(null);
	}
});

//.tablaAbonos tbody tr td button
$(".tablaAbonos tbody").on("click","button.btnAbonar", function()
{
	$("#nCreditoS").html($("#folioCompra").val());
	$("#saldoActual").html(darFormato($("#ultimoSaldo").val()));
	$("#importeL").html(darFormato(importeSelect));
	$(".btnCambiar").html("Liquidar");
	$(".oculto").css("visibility", "hidden");
	$('#descuentoP').val(0);
	$('#descuentoP').prop("disabled", true);
	$("#abono").val(abonoBase);
	$("#fechaVence").val(fechaVence);
	$("#fechaProximo").val(fechaProximo);
	$("#abono").prop("readonly", false);
	$('#efectivo').trigger('focus');
});
$(".modal-footer").on("click","button.btnCambiar", function()
{
	$("#efectivo").val(null);
	$("#cambio").val(null);
	if($(".btnCambiar").html() == "Liquidar"){
		$(".btnCambiar").html("Abonar");
		$(".oculto").css("visibility", "visible");
		$('#descuentoP').prop("disabled", false);
		$('#descuentoP').val(0);
		$("#abono").val($("#ultimoSaldo").val());
		$("#abono").prop("readonly", true);
	}else{
		$(".btnCambiar").html("Liquidar");
		$(".oculto").css("visibility", "hidden");
		$('#descuentoP').val(0);
		$('#descuentoP').prop("disabled", true);
		$("#abono").val(abonoBase);
		$("#abono").prop("readonly", false);
	}
	$('#efectivo').trigger('focus');
});
function redondear(numero, digitos){
    let base = Math.pow(10, digitos);
    let entero = Math.round(numero * base);
    return entero / base;
}

$("#descuentoP").on("change",function()
{
	var porcentaje = this.value;
	var ultimoAbono = $("#ultimoSaldo").val();
	if(porcentaje != 0 && porcentaje > 0){
		descuentoTotal = porcentaje;//(porcentaje/100) * ultimoAbono;
		$("#descuentoTotal").val(redondear(descuentoTotal,2));
		$("#abono").val(redondear(ultimoAbono - descuentoTotal,2));
	}else{
		$("#abono").val(ultimoAbono);
	}
});

$( "#descuentoP" ).keyup(function() {
	var porcentaje = this.value;
	var ultimoAbono = $("#ultimoSaldo").val();
	if(porcentaje != 0 && porcentaje > 0){
		descuentoTotal = porcentaje;//(porcentaje/100) * ultimoAbono;
		$("#descuentoTotal").val(redondear(descuentoTotal,2));
		$("#abono").val(redondear(ultimoAbono - descuentoTotal,2));
	}else{
		$("#abono").val(ultimoAbono);
	}
});

$("#efectivo").on("change",function()
{
	var efectivo = this.value;
	var totalA = $("#abono").val();
	var cambio = efectivo - totalA;
	if(cambio>0){
		$("#cambio").val(redondear(cambio,2));
	}else{
		$("#cambio").val(0);
	}
});

$( "#efectivo" ).keyup(function() {
	var efectivo = this.value;
	var totalA = $("#abono").val();
	var cambio = efectivo - totalA;
	if(cambio>0){
		$("#cambio").val(redondear(cambio,2));
	}else{
		$("#cambio").val(0);
	}
});

$( "#frmCobro" ).submit(function( event ) {
	console.log($("#abono").val());
	if(Number($("#abono").val()) > Number($("#efectivo").val()) || Number($("#efectivo").val()) == 0){
		event.preventDefault();
		swal.fire({
			title: "El efectivo es menor al abono total",
			text: "¡Favor de capturar bien el pago!",
			type: "error",
			confirmButtonText: "¡Cerrar!"
		}).then((result) => {
			if (result.value) {
				$('#efectivo').trigger('focus');
			}
		  });
		  $("#efectivo").val(null);
		  $("#cambio").val(null);
	}

	if($("#abono").val() < abonoBase){
		event.preventDefault();
		swal.fire({
			title: "El abono tiene que ser igual o mayor a $"+abonoBase,
			text: "¡Favor de capturar bien el abono!",
			type: "error",
			confirmButtonText: "¡Cerrar!"
		}).then((result) => {
			if (result.value) {
				$('#efectivo').trigger('focus');
			}
		  });
		  $("#abono").val(abonoBase);
		  $("#efectivo").val(null);
		  $("#cambio").val(null);
	}

  });