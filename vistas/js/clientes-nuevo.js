$(document).ready(function()
{	
	$.ajax({
		url:"https://api-sepomex.hckdrk.mx/query/get_municipio_por_estado/Sonora",
		cache: false,
		contentType: false,
		processData: false,
		dataType: "json",
		success: function(respuesta)
		{
			for (var i = 0; i < respuesta["response"]["municipios"].length; i++) 
			{
				var codigo = respuesta["response"]["municipios"][i];
				$('#ciudad').prepend("<option value='"+codigo+"' >"+codigo+"</option>");
			}
			
		}});
		$('#ciudad').prepend("<option value='' >Seleccione un municipio</option>");

})

$("#ciudad").change(function()
{
	$('#codigo_postal').empty().append('whatever');
	$('#asentamiento').empty().append('whatever');
	var municipio = $(this).val();
	$.ajax({
		url:"https://api-sepomex.hckdrk.mx/query/get_cp_por_municipio/"+municipio,
		cache: false,
		contentType: false,
		processData: false,
		dataType: "json",
		success: function(respuesta)
		{
			for (var i = 0; i < respuesta["response"]["cp"].length; i++) 
			{
				var codigo = respuesta["response"]["cp"][i];
				$('#codigo_postal').prepend("<option value='"+codigo+"' >"+codigo+"</option>");
			}
			
		}});
		$('#codigo_postal').prepend("<option value='' >Seleccione un codigo postal</option>");
})

$("#codigo_postal").change(function()
{
	$('#asentamiento').empty().append('whatever');
	var codigo_postal = $(this).val();
	$.ajax({
		url:"https://api-sepomex.hckdrk.mx/query/info_cp/"+codigo_postal+"?type=simplified",
		cache: false,
		contentType: false,
		processData: false,
		dataType: "json",
		success: function(respuesta)
		{	
			for (var i = 0; i < respuesta["response"]["asentamiento"].length; i++) 
			{
				var asentamiento = respuesta["response"]["asentamiento"][i];
				$('#asentamiento').prepend("<option value='"+asentamiento+"' >"+asentamiento+"</option>");
			}			
	}});
})