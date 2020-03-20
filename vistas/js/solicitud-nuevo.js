$(".nuevaFoto").change(function()
{
	var imagen = this.files[0];
	if (imagen["type"] != "image/jpeg" && imagen["type"] != "image/png")
	{
		$(".nuevaFoto").val("");

		swal.fire({
			title: "Error al subir foto",
			text: "¡La imagen debe ser en formato JPG o PNG!",
			type: "error",
			conmfirmButtonText:"¡Cerrar!"});
	}
	else
	if(imagen["size"] > 2000000)
	{
		$(".nuevaFoto").val("");
		swal.fire({
			title: "Error al subir la imagen",
			text: "La imagen no debe pesar mas de 2MB",
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

	if (casa!="Propietario")
	{
		$("#contenido_aval").html(contenido_aval);
		$('input[name="telefono_d_aval"]').inputmask({"mask": "(999) 999-9999"});
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
                     '<th>Dirección</th>'+
                     '<th>Teléfono</th>'+
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

                           '<input type="text" name="direccion_d_aval" id="direccion_d_aval" placeholder="Dirección" class="form-control capitalize" required>'+

                         '</div>'+

                       '</td>'+

                      ' <td>'+

                         '<div class="input-group mb-3">'+

                           '<input type="text" name="telefono_d_aval" id="telefono_d_aval" placeholder="Teléfono" class="form-control">'+

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
				$("#id_cliente").val(0).trigger('change');
				$("#id_cliente").focus();
			}
	}});
})

var html;
$(document).ready(function()
{
	html = $("#aval").html();
})

$("#estado_civil").change(function()
{
	var estado_civil = $(this).val();

	if (estado_civil=="Soltero" || estado_civil=="Divorciado" || estado_civil=="Viudo")
	{
		$(".oculto").css("display","none");
		$("#aval").html("");
	}
	else
	{
		$(".oculto").css("display","block");
		$("#aval").html(html);
		$('input[name="telefono_mama_aval"]').inputmask({"mask": "(999) 999-9999"});
		$('input[name="telefono_papa_aval"]').inputmask({"mask": "(999) 999-9999"});

		$('input[name="telefono_familiar_aval[]"]').inputmask({"mask": "(999) 999-9999"});
		$('input[name="telefono_amistad_aval[]"]').inputmask({"mask": "(999) 999-9999"});
		
		$('input[name="tel_empresa_aval"]').inputmask({"mask": "(999) 999-9999"});
		$('input[name="t_celular_aval"]').inputmask({"mask": "(999) 999-9999"});
		$('input[name="t_casa_aval"]').inputmask({"mask": "(999) 999-9999"});
		$("#estado_civil_aval").val(estado_civil).trigger('change');
	}
});

$( "#myTab .nav-item .nav-link" ).on( "click", function() {
	if($( this ).text() == "Foto"){
		if($("#estado_civil").val()=="Soltero" || $("#estado_civil").val()=="Divorciado" || $("#estado_civil").val()=="Viudo"){
			$(".botonesAccion").css("visibility","visible");
		}
	}else{
		$(".botonesAccion").css("visibility","hidden");
		$( "#myTab2 .nav-item .nav-link" ).on( "click", function() {
		  if($( this ).text() == "Referencias de amistad"){
			  if($("#estado_civil").val()=="Casado" || $("#estado_civil").val()=="Unión libre" ){

				  $(".botonesAccion").css("visibility","visible");
			  }
		  }else{
			  $(".botonesAccion").css("visibility","hidden");
		  }
		});
	}
  });

