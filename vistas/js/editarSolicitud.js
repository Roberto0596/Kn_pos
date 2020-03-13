$(document).ready(function()
{
    var idSolicitud = $("#idSolicitud").val();
	var datos = new FormData();
	datos.append("idSolicitud", idSolicitud);
	$.ajax({
		url:"ajax/solicitud.ajax.php",
		method: "POST",
		data: datos,
		cache: false,
		contentType: false,
		processData: false,
		dataType: "json",
		success: function(respuesta)
		{
            console.log(respuesta);
            $("#nombreCliente").val(respuesta[19][1]);
            $("#idCliente").val(respuesta[19][0]);
            $("#num_placas").val(respuesta["num_placas"]);
            $("#estado_civil").val(respuesta["estado_civil"]);
            $("#casa").val(respuesta["casa"]);
            $("#tiempo_casa").val(respuesta["tiempo_casa"]);
            $("#gastos_mensuales").val(respuesta["gastos_mensuales"]);
    	}});
})