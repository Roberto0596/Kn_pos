//Initialize Select2 Elements
$('.select2').select2({
	width: 'resolve'
})

//Datemask dd/mm/yyyy
$('#datemask').inputmask('dd/mm/yyyy', { 'placeholder': 'dd/mm/yyyy' })
//Datemask2 mm/dd/yyyy
$('#datemask2').inputmask('mm/dd/yyyy', { 'placeholder': 'mm/dd/yyyy' })
//Money Euro
$('[data-mask]').inputmask()

//iCheck for checkbox and radio inputs
$('input[type="checkbox"].minimal, input[type="radio"].minimal').iCheck({
  checkboxClass: 'icheckbox_minimal-blue',
  radioClass   : 'iradio_minimal-blue'
})

$(".cancelar").click(function()
{
	var destino = $(this).attr("destino");
	swal.fire({
		title: '¿Esta seguro que desea salir de la pagina?',
		text: "¡si lo hace antes de guardar se perderan datos!",
		type: 'warning',
		showCancelButton: true,
		confirmButtonColor: '#3085d6',
		cancelButtonColor: '#d33',
		cancelButtonText: 'Cancelar',
		confirmButtonText: 'Si, salir'

	}).then((result)=>
	{
		if (result.value)
		{
			window.location = destino;
		}
	})
})

function getFocus(Elemento) {
	document.getElementById(Elemento).focus();
}