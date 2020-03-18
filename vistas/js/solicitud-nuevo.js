$(".nuevaFoto").change(function()
{
	var imagen = this.files[0];
	if (imagen["type"] != "image/jpeg" && imagen["type"] != "image/png") 
	{
		$(".nuevaFoto").val(""); 

		swal({
			title: "error al subir foto",
			text: "¡la imagen debe ser en formato JPG o PNG!",
			type: "error",
			conmfirmButtonText:"¡cerrar!"});
	}
	else 
	if(imagen["size"] > 2000000)
	{
		$(".nuevaFoto").val(""); 
		swal({
			title: "Error al subir la imagen",
			text: "la imagen no debe pesar mas de 2MB",
			type: "error",
			conmfirmButtonText: "¡Cerrar!"});
	}
	else
	{
		var datosImagen = new FileReader;
		datosImagen.readAsDataURL(imagen);
		$(datosImagen).on("load", function(event)
		{
			var rutaImagen = event.target.result;
			$(".previsualizar").attr("src", rutaImagen);
		})
	}
})

$("#id_cliente").change(function()
{
	var id_cliente = $(this).val();
	var data = new FormData();
	data.append("id_cliente",id_cliente);
	$.ajax({
		url:"ajax/solicitud.ajax.php",
		method: "POST",
		data: data,
		cache: false,
		contentType: false,
		processData: false,
		dataType: "json",
		success: function(respuesta)
		{	
			if (respuesta)
			{
				toastr.warning('Este cliente ya cuenta con solicitud')
				$("#id_cliente").val("");	
				$("#id_cliente").focus("");
			}		
	}});
})
var html;
$(document).ready(function(){
	html = $("#aval").html();
})

$("#estado_civil").change(function()
{
	var estado_civil = $(this).val();
	if (estado_civil=="Soltero")
	{
		$(".oculto").css("display","none");
		$("#aval").html("");
	}
	else
	{
		$(".oculto").css("display","block");
		$("#aval").html(html);
	}
});
