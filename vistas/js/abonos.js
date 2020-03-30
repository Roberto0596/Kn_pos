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
					$("#conceptoCompra").prepend("<p>"+producto.cantidad+" "+producto.descripcion+" $"+producto.total+"</p>");
				});
				$(".datosCredito").html(" ");
				var fechas = $.parseJSON(fechasAbonos[indiceCred-1]);
				var datosCredito = "<div class='col-md-2'>"+fechas.length+" pagos</div>";
				datosCredito += "<div class='col-md-2'>"+tipoAbonos[indiceCred-1]+" de $"+fechas[fechas.length-1].Abono+"</div>";
				datosCredito += "<div class='col-md-2'>Importe $"+importes[indiceCred-1]+"</div>";
				datosCredito += "<div class='col-md-2'>Enganche $"+enganches[indiceCred-1]+"</div>";
				datosCredito += "<div class='col-md-2'>Saldo $"+saldos[indiceCred-1]+"</div>";
				$(".datosCredito").prepend(datosCredito);
				$(".tablaAbonos tbody").html(" ");
				$.each(fechas, function (indice, fecha) {

					$('.tablaAbonos tbody').append("<tr><td>"+(indice+1)+"</td><td>"+fecha.Fecha+"</td><td>23</td><td>12-12-2012</td><td>$120</td><td>$1209</td><td>23</td></tr>");
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