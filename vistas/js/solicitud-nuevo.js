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

$("#casa").change(function()
{
	var casa = $(this).val();
	if (estado_civil!="Propietario")
	{
		$("#contenido_aval").html(contenido_aval);
	}
	else
	{
		$("#contenido_aval").html("");
	}
});
var contenido_aval = '<label class="label-style" for="">Aval</label>'+
                 '<table class="table">'+
                   '<thead>'+
                     '<th>#</th>'+
                     '<th>Nombre</th>'+
                     '<th>Direccion</th>'+
                     '<th>Telefono</th>'+
                   '</thead>'+
                  ' <tbody>'+
                     '<tr>'+

                       '<th>Aval</th>'+
                       '<td>'+

                         '<div class="input-group mb-3">'+

                            '<input type="text" name="nombre_d_aval" id="nombre_d_aval" placeholder="Nombre" class="form-control capitalize" required>'+
                            '<input type="hidden" name="referencia_padre" value="4">'+

                         '</div>'+

                       '</td>'+

                       '<td>'+

                         '<div class="input-group mb-3">'+

                           '<input type="text" name="direccion_d_aval" id="direccion_d_aval" placeholder="Direccion" class="form-control capitalize" required>'+

                         '</div>'+

                       '</td>'+

                      ' <td>'+

                         '<div class="input-group mb-3">'+

                           '<input type="text" name="telefono_d_aval" id="telefono_d_aval" placeholder="Telefono" class="form-control capitalize" data-inputmask="mask:(999) 999-9999" data-mask>'+

                         '</div>'+

                       '</td>'+

                     '</tr>'+

                   '</tbody>'+

                 '</table>';

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
