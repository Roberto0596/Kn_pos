var creditos = [];
var fechasAbonos = [];
var tipoAbonos = [];
var enganches = [];
var importes = [];
var saldos = [];

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
				datosCredito += "<div class='col-md-2'>"+tipoAbonos[indiceCred-1]+" de $"+darFormato(fechas[fechas.length-1].Abono)+"</div>";
				datosCredito += "<div class='col-md-2'>Importe $"+darFormato(importes[indiceCred-1])+"</div>";
				datosCredito += "<div class='col-md-2'>Enganche $"+darFormato(enganches[indiceCred-1])+"</div>";
				var saldin = importes[indiceCred-1]-enganches[indiceCred-1];
				datosCredito += "<div class='col-md-2'>Saldo $"+darFormato(saldin)+"</div>";
				$(".datosCredito").prepend(datosCredito);
				$(".tablaAbonos tbody").html(" ");

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
									$('.tablaAbonos tbody').append("<tr><td>"+(indice+1)+"</td><td>"+fecha.Fecha+"</td><td></td><td></td><td></td><td></td><td><button id='btnAbonar' class='btn btn-primary pull-right btnAbonar' title='Cobrar' type='button' data-toggle = 'modal' data-target = '#modalCobro'>Abonar</button></td></tr>");
								}else{
									$('.tablaAbonos tbody').append("<tr><td>"+(indice+1)+"</td><td>"+fecha.Fecha+"</td><td></td><td></td><td></td><td></td><td></td></tr>");
								}

							});
						}else{//si hay abonos
							var verifica = 0;
							$.each(fechas, function (indice, fecha) {
								if(abonosActuales[indice] != null){
									$('.tablaAbonos tbody').append("<tr><td>"+(indice+1)+"</td><td>"+fecha.Fecha+"</td><td>"+abonosActuales[indice].folio_pago+"</td><td>"+abonosActuales[indice].fecha_pago+"</td><td>$"+darFormato(abonosActuales[indice].cantidad)+"</td><td>$"+darFormato(abonosActuales[indice].saldo)+"</td><td></td></tr>");
								}else{
									if(verifica == 0){
										$('.tablaAbonos tbody').append("<tr><td>"+(indice+1)+"</td><td>"+fecha.Fecha+"</td><td></td><td></td><td></td><td></td><td><button id='btnAbonar' class='btn btn-primary pull-right btnAbonar' title='Cobrar' type='button' data-toggle = 'modal' data-target = '#modalCobro'>Abonar</button></td></tr>");
										verifica = verifica + 1;
									}else{
										$('.tablaAbonos tbody').append("<tr><td>"+(indice+1)+"</td><td>"+fecha.Fecha+"</td><td></td><td></td><td></td><td></td><td></td></tr>");
									}
								}

							});
						}
					}
				});
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
	}
});

//.tablaAbonos tbody tr td button
$(".tablaAbonos tbody").on("click","button.btnAbonar", function()
{
	$("#nCredito").val($("#folioCompra").val());
});