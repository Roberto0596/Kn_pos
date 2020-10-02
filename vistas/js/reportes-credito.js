var globalInitDateCredito = null;
var globalFinalDateCredito = null;

function tablaCreditoVentas(init, final) {
    $('.tablaCreditoVentas tbody').remove();
	$(".tablaCreditoVentas").dataTable(
	{
		"destroy":true,
		"deferRender": true,
		"processing": true,
		"bFilter": true,
		"bLengthChange" : true,
		"lengthMenu":[[5, 10, 20, 25, 50, -1], [5, 10, 20, 25, 50, "Todos"]],
		"ajax":
		{
			url: "ajax/reportes/dataTable-reporte-ventas-credito-ajax.php",
			type: "POST",
			data: {init:init,final:final}
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
	});

	const options = { style: 'currency', currency: 'USD' };
    const money = new Intl.NumberFormat('en-US', options);
	var datos = new FormData();
	datos.append("rango",init+"|"+final);
	$.ajax({
		url:"ajax/reportes.ajax.php",
		method: "POST",
		data:datos,
		cache: false,
		contentType: false,
		processData: false,
		dataType: "json",
		success: function(respuesta)
		{
			$("#total-credito-venta").html(money.format(respuesta));
		}
	});

	$(".tablaCreditoVentas tbody").on("click","button.verProductos", function(){
		$("#laracast").empty();
		var folio = $(this).attr("folio");
		var data = new FormData();
		data.append("folio",folio);
		$.ajax({
			url:"ajax/reportes.ajax.php",
			method: "POST",
			data:data,
			cache: false,
			contentType: false,
			processData: false,
			dataType: "json",
			success: function(respuesta)
			{
				var lista = JSON.parse(respuesta);
				for (var i = 0; i < lista.length; i++) {
					 $("#laracast").append("<tr>"+
			           	"<td>"+lista[i]["id"]+"</td>"+
			           	"<td>"+lista[i]["descripcion"]+"</td>"+
			           	"<td>"+lista[i]["cantidad"]+"</td>"+
			           	"<td>"+lista[i]["existencia"]+"</td>"+
			           	"<td>"+lista[i]["precio"]+"</td>"+
			           	"<td>"+lista[i]["total"]+"</td>"+
			            "</tr>");
				}
			}
		});
	});
}


$(document).ready(function() {
	tablaCreditoVentas(null, null);
})

$("#fechaFinalCreditos").change(function() {
	var fechaInicial = $("#fechaInicialCreditos").val();
	var fechaFinal = $(this).val();
	if(fechaInicial.length > 0) {
		globalInitDateCredito = fechaInicial;
		globalFinalDateCredito = fechaFinal;
		tablaCreditoVentas(fechaInicial, fechaFinal);
	} else {
		globalInitDateCredito = null;
		globalFinalDateCredito = null;
		swal.fire({
			title: "Tiene que elegir una fecha inicial",
			type: "error",
			confirmButtonText: "¡Cerrar!"
		});
		$("#fechaFinalCreditos").val("");
	}
});

$('#imprimir-ventas-credito').click(function() {
	var tipoAbonos = "Reporte de ventas al contado";
	window.open("extenciones/mpdf/reporte/reporte-ventas-credito.php?tipo="+tipoAbonos+"&init="+globalInitDateCredito+"&final="+globalFinalDateCredito,"_blank");
});
