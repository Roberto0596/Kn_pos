$(document).ready(function()
{
    $("#precio_venta").prop("readonly",true);
})

$("#precio_compra").change(function()
{
    if ($(".porcentaje").prop("checked"))
    {
        var valorPorcentaje = $(".nuevoPorcentaje").val();

        var porcentaje = Number(($("#precio_compra").val()*valorPorcentaje/100)) + Number($("#precio_compra").val());


        $("#precio_venta").val(porcentaje);
        $("#precio_venta").prop("readonly",true);

    }
})

$(".nuevoPorcentaje").change(function()
{
    if ($(".porcentaje").prop("checked"))
    {
        var valorPorcentaje = $(this).val();

        var porcentaje = Number(($("#precio_compra").val()*valorPorcentaje/100)) + Number($("#precio_compra").val());

        $("#precio_venta").val(porcentaje);
        $("#precio_venta").prop("readonly",true);
    }
})

$(".porcentaje").on("ifUnchecked",function()
{
    $("#precio_venta").prop("readonly",false);
})

$(".porcentaje").on("ifChecked",function()
{
    $("#precio_venta").prop("readonly",true);
})

$("#codigo").change(function()
{
    $(".alert").remove();
    var valor = $(this).val();
    var datos = new FormData();
    datos.append("validarCodigo",valor);
    $.ajax(
    {
        url: "ajax/productos.ajax.php",
        method: "POST",
        data: datos,
        cache: false,
        contentType: false,
        processData: false,
        dataType: "json",
        success: function(respuesta) 
        {
            if(respuesta)
            {
                $("#codigo").parent().after('<div class="alert alert-warning">Este codigo ya esta registrado</div>')
                $("#codigo").val("");  
                $('#codigo').trigger('focus'); 
            }
        }
    })
})
