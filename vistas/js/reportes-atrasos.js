$('#imprimir-abonos-retrasos').click(function() {
	var tipoAbonos = "Reporte de abonos retrasados";
	window.open("extenciones/mpdf/reporte/reporte-abonos-atrasados.php?tipo="+tipoAbonos,"_blank");
});