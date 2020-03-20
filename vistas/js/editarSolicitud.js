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
			if (respuesta["estado_civil"]=="Soltero" || respuesta["estado_civil"]=="Divorciado" || respuesta["estado_civil"]=="Viudo")
			{
				$(".oculto").css("display","none");
				$("#aval").html("");
			}
            $("#nombreCliente").val(respuesta[18][1]);
            $("#idCliente").val(respuesta[18][0]);

            $("#num_placas").val(respuesta["num_placas"]);
            $("#estado_civil").val(respuesta["estado_civil"]);
            $("#casa").val(respuesta["casa"]);
            $("#tiempo_casa").val(respuesta["tiempo_casa"]);
            $("#gastos_mensuales").val(respuesta["gastos_mensuales"]);

			$("#profesion").val(respuesta["profesion"]);
			$("#nombre_empresa").val(respuesta["empresa"]);
			$("#dom_empresa").val(respuesta["dom_empresa"]);
			$("#tel_empresa").val(respuesta["tel_empresa"]);
			$("#puesto").val(respuesta["puesto"]);
			$("#sueldo").val(respuesta["sueldo"]);
			$("#antiguedad").val(respuesta["antiguedad"]);
			$(".previsualizar").attr("src", respuesta["foto"]);
			$("#fotoVieja").val(respuesta["foto"]);

			var ref_fam = 1;
			var ref_amg = 1;

			var datosReferencias = new FormData();
			datosReferencias.append("idSolicitud_ref", idSolicitud);
			$.ajax({
				url:"ajax/solicitud.ajax.php",
				method: "POST",
				data: datosReferencias,
				cache: false,
				contentType: false,
				processData: false,
				dataType: "json",
				success: function(respuesta2)
				{
					console.log(respuesta2);
					for (var i = 0; i < respuesta2.length; i++)
					{
						if (respuesta2[i]["tipo"] == 0)
						{
							$("#ref_fam_nombre"+ref_fam).val(respuesta2[i]["nombre"]);
							$("#ref_fam_direccion"+ref_fam).val(respuesta2[i]["direccion"]);
							$("#ref_fam_telefono"+ref_fam).val(respuesta2[i]["telefono"]);
							$("#ides").append('<input type="hidden" name="id_fam_ref'+ref_fam+'" value="'+respuesta2[i]["id_referencia"]+'">');
							ref_fam ++ ;
						}
						else if (respuesta2[i]["tipo"]==1)
						{
							$("#ref_amg_nombre"+ref_amg).val(respuesta2[i]["nombre"]);
							$("#ref_amg_direccion"+ref_amg).val(respuesta2[i]["direccion"]);
							$("#ref_amg_telefono"+ref_amg).val(respuesta2[i]["telefono"]);
							$("#ides").append('<input type="hidden" name="id_amg_ref'+ref_amg+'" value="'+respuesta2[i]["id_referencia"]+'">');
							ref_amg ++;
						}
						else if (respuesta2[i]["tipo"]==2)
						{
							$("#nombre_papa").val(respuesta2[i]["nombre"]);
							$("#direccion_papa").val(respuesta2[i]["direccion"]);
							$("#telefono_papa").val(respuesta2[i]["telefono"]);
							$("#ides").append('<input type="hidden" name="id_papa_ref" value="'+respuesta2[i]["id_referencia"]+'">');
						}
						else if (respuesta2[i]["tipo"]==3)
						{
							$("#nombre_mama").val(respuesta2[i]["nombre"]);
							$("#direccion_mama").val(respuesta2[i]["direccion"]);
							$("#telefono_mama").val(respuesta2[i]["telefono"]);
							$("#ides").append('<input type="hidden" name="id_mama_ref" value="'+respuesta2[i]["id_referencia"]+'">');
						}
						else if (respuesta2[i]["tipo"]==4)
						{
							$("#contenido_aval").html(contenido_aval);
							$('input[name="telefono_d_aval"]').inputmask({"mask": "(999) 999-9999"});
							$("#nombre_d_aval").val(respuesta2[i]["nombre"]);
							$("#direccion_d_aval").val(respuesta2[i]["direccion"]);
							$("#telefono_d_aval").val(respuesta2[i]["telefono"]);
							$("#ides").append('<input type="hidden" name="id_d_aval" value="'+respuesta2[i]["id_referencia"]+'">');
						}
					}
				}
			});
			if($("#idSolicitudConyuge").val()!=0)
			{
				var datosSolicitudAval = new FormData();
				datosSolicitudAval.append("idSolicitud", $("#idSolicitudConyuge").val());
				$.ajax({
					url:"ajax/solicitud.ajax.php",
					method: "POST",
					data: datosSolicitudAval,
					cache: false,
					contentType: false,
					processData: false,
					dataType: "json",
					success: function(respuesta3)
					{
						$("#nombre_aval").val(respuesta3[18]["nombre"]);
						$("#id_cliente_aval").val(respuesta3[18]["id_cliente"]);
						$("#direccion_aval").val(respuesta3[18]["direccion"]);
						$("#edad_aval").val(respuesta3[18]["edad"]);
						$("#t_casa_aval").val(respuesta3[18]["telefono_casa"]);
						$("#t_celular_aval").val(respuesta3[18]["telefono_celular"]);
						$("#ciudad_aval").val(respuesta3[18]["ciudad"]);
						$("#num_placas_aval").val(respuesta3["num_placas"]);
						$("#estado_civil_aval").val(respuesta3["estado_civil"]);
						$("#casa_aval").val(respuesta3["casa"]);
						$("#tiempo_casa_aval").val(respuesta3["tiempo_casa"]);
						$("#profesion_aval").val(respuesta3["profesion"]);
						$("#nombre_empresa_aval").val(respuesta3["empresa"]);
						$("#dom_empresa_aval").val(respuesta3["dom_empresa"]);
						$("#tel_empresa_aval").val(respuesta3["tel_empresa"]);
						$("#puesto_aval").val(respuesta3["puesto"]);
						$("#sueldo_aval").val(respuesta3["sueldo"]);
						$("#gastos_mensuales_aval").val(respuesta3["gastos_mensuales"]);
						$("#antiguedad_aval").val(respuesta3["antiguedad"]);

						var ref_fam_aval = 1;
						var ref_amg_aval = 1;

						var datosReferencias = new FormData();
						datosReferencias.append("idSolicitud_ref", $("#idSolicitudConyuge").val());
						$.ajax({
							url:"ajax/solicitud.ajax.php",
							method: "POST",
							data: datosReferencias,
							cache: false,
							contentType: false,
							processData: false,
							dataType: "json",
							success: function(respuesta3)
							{
								for (var i = 0; i < respuesta3.length; i++)
								{
									if (respuesta3[i]["tipo"] == 0)
									{
										$("#ref_fam_nombre_aval"+ref_fam_aval).val(respuesta3[i]["nombre"]);
										$("#ref_fam_direccion_aval"+ref_fam_aval).val(respuesta3[i]["direccion"]);
										$("#ref_fam_telefono_aval"+ref_fam_aval).val(respuesta3[i]["telefono"]);
										$("#ides").append('<input type="hidden" name="id_fam_ref_aval'+ref_fam_aval+'" value="'+respuesta3[i]["id_referencia"]+'">');
										ref_fam_aval ++ ;
									}
									else if (respuesta3[i]["tipo"]==1)
									{
										$("#nombre_amistad_aval"+ref_amg_aval).val(respuesta3[i]["nombre"]);
										$("#direccion_amistad_aval"+ref_amg_aval).val(respuesta3[i]["direccion"]);
										$("#telefono_amistad_aval"+ref_amg_aval).val(respuesta3[i]["telefono"]);
										$("#ides").append('<input type="hidden" name="id_amg_ref_aval'+ref_amg_aval+'" value="'+respuesta3[i]["id_referencia"]+'">');
										ref_amg_aval ++;
									}
									else if (respuesta3[i]["tipo"]==2)
									{
										$("#nombre_papa_aval").val(respuesta3[i]["nombre"]);
										$("#direccion_papa_aval").val(respuesta3[i]["direccion"]);
										$("#telefono_papa_aval").val(respuesta3[i]["telefono"]);
										$("#ides").append('<input type="hidden" name="id_papa_ref_aval" value="'+respuesta3[i]["id_referencia"]+'">');
									}
									else if (respuesta3[i]["tipo"]==3)
									{
										$("#nombre_mama_aval").val(respuesta3[i]["nombre"]);
										$("#direccion_mama_aval").val(respuesta3[i]["direccion"]);
										$("#telefono_mama_aval").val(respuesta3[i]["telefono"]);
										$("#ides").append('<input type="hidden" name="id_mama_ref_aval" value="'+respuesta3[i]["id_referencia"]+'">');
									}
								}
							}
						});

					}
				});
			}
    	}});
})

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