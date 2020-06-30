<?php
	session_start();
?>
<!DOCTYPE html>
<html>
<head>
	<!-- metadatos -->
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
	<title>Karina mueblerias</title>
	<link rel="icon" href="vistas/img/favicon.ico" type="image/x-icon" />

	<!-- estilos -->

	<!-- Font Awesome -->
	<link rel="stylesheet" href="vistas/plugins/fontawesome-free/css/all.min.css">
	<!-- genericos -->
	<link rel="stylesheet" href="vistas/css/general.css">
	<!-- Ionicons -->
	<link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
	<!-- Tempusdominus Bbootstrap 4 -->
	<link rel="stylesheet" href="vistas/plugins/tempusdominus-bootstrap-4/css/tempusdominus-bootstrap-4.min.css">
	<!-- Theme style -->
	<link rel="stylesheet" href="vistas/dist/css/adminlte.min.css">
	<!-- iCheck -->
	<link rel="stylesheet" href="vistas/plugins/icheck-bootstrap/icheck-bootstrap.min.css">
	<!-- JQVMap -->
	<link rel="stylesheet" href="vistas/plugins/jqvmap/jqvmap.min.css">
	<!-- overlayScrollbars -->
	<link rel="stylesheet" href="vistas/plugins/overlayScrollbars/css/OverlayScrollbars.min.css">
	<!-- Daterange picker -->
	<link rel="stylesheet" href="vistas/plugins/daterangepicker/daterangepicker.css">
	<!-- summernote -->
	<link rel="stylesheet" href="vistas/plugins/summernote/summernote-bs4.css">
	<!-- Google Font: Source Sans Pro -->
	<link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet">
	<!-- DataTables -->
  	<link rel="stylesheet" href="vistas/plugins/datatables-bs4/css/dataTables.bootstrap4.css">

  	<!-- Select2 -->
 	<link rel="stylesheet" href="vistas/plugins/select2/css/select2.min.css">
  	<link rel="stylesheet" href="vistas/plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css">
  	<!-- iCheck for checkboxes and radio inputs -->
  	<link rel="stylesheet" href="vistas/plugins/iCheck/all.css">
  	<!-- Toastr -->
  	<link rel="stylesheet" href="vistas/plugins/toastr/toastr.min.css">

	<!-- scripts -->

	<!-- jQuery -->
	<script src="vistas/plugins/jquery/jquery.min.js"></script>
	<!-- jQuery UI 1.11.4 -->
	<script src="vistas/plugins/jquery-ui/jquery-ui.min.js"></script>
	<!-- Bootstrap 4 -->
	<script src="vistas/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
	<!-- ChartJS -->
	<script src="vistas/plugins/chart.js/Chart.min.js"></script>
	<!-- jQuery Knob Chart -->
	<script src="vistas/plugins/jquery-knob/jquery.knob.min.js"></script>
	<!-- daterangepicker -->
	<script src="vistas/plugins/moment/moment.min.js"></script>
	<script src="vistas/plugins/daterangepicker/daterangepicker.js"></script>
	<!-- Tempusdominus Bootstrap 4 -->
	<script src="vistas/plugins/tempusdominus-bootstrap-4/js/tempusdominus-bootstrap-4.min.js"></script>
	<!-- Summernote -->
	<script src="vistas/plugins/summernote/summernote-bs4.min.js"></script>
	<!-- overlayScrollbars -->
	<script src="vistas/plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js"></script>
	<!-- AdminLTE App -->
	<script src="vistas/dist/js/adminlte.js"></script>
	<!-- AdminLTE for demo purposes -->
	<script src="vistas/dist/js/demo.js"></script>
	<!-- DataTables -->
	<script src="vistas/plugins/datatables/jquery.dataTables.js"></script>
	<script src="vistas/plugins/datatables-bs4/js/dataTables.bootstrap4.js"></script>
	<!-- sweetalert -->
  	<script src="vistas/plugins/sweetalert2/sweetalert2.all.js"></script>
  	<!-- Select2 -->
	<script src="vistas/plugins/select2/js/select2.full.min.js"></script>
	  <!-- InputMask -->
  	<script src="vistas/plugins/input-mask/jquery.inputmask.js"></script>
  	<script src="vistas/plugins/input-mask/jquery.inputmask.date.extensions.js"></script>
  	<script src="vistas/plugins/input-mask/jquery.inputmask.extensions.js"></script>
  	<!-- iCheck 1.0.1 -->
 	<script src="vistas/plugins/iCheck/icheck.min.js"></script>
 	<!-- Toastr -->
	<script src="vistas/plugins/toastr/toastr.min.js"></script>

	<!-- ChartJS -->
	<script src="plugins/chart.js/Chart.min.js"></script>
	<!-- Sparkline -->
	<script src="plugins/sparklines/sparkline.js"></script>
	<!-- JQVMap -->
	<script src="plugins/jqvmap/jquery.vmap.min.js"></script>
	<script src="plugins/jqvmap/maps/jquery.vmap.usa.js"></script>
	<!-- jQuery Knob Chart -->
	<script src="plugins/jquery-knob/jquery.knob.min.js"></script>

</head>

<body id="body" class="sidebar-mini sidebar-collapse login-page" style="height: auto;">
	<?php
	    if (isset($_SESSION["iniciarSesion"])== "ok")
	    {
	    	echo "<script>
	    		$('#body').removeClass('login-page');
	    	</script>";
		    echo '<div class="wrapper">';
		    include "modulos/cabezote.php";
		    include "modulos/menu.php";
		    if(isset($_GET["ruta"]))
		    {
				$url = rtrim($_GET["ruta"],'-');
				$url = filter_var($url, FILTER_SANITIZE_URL);
				$url = explode('-',$url);

				if(file_exists('vistas/modulos/'.$url[0].'/'.$url[0].'.php'))
				{
					if ($_SESSION["perfil"] =="Gerente General")
					{				
						if(count($url) > 1)
						{
							if(file_exists('vistas/modulos/'.$url[0].'/'.$url[1].'.php'))
							{
								include "modulos/".$url[0]."/".$url[1].".php";
	                        	echo '<script src="vistas/js/'.$_GET["ruta"].'.js"></script>';
							}
							else
							{
								include_once "modulos/404.php";
							}
						}
						else
						{
							include_once "modulos/".$url[0]."/".$url[0].".php";
			          		echo '<script src="vistas/js/'.$url[0].'.js"></script>';
						}
					}
					else
					{
						$valid_routes = ["clientes","solicitud","crearventa","abonos"];
						if (in_array($url[0], $valid_routes))
						{					
							if(count($url) > 1)
							{
								if(file_exists('vistas/modulos/'.$url[0].'/'.$url[1].'.php'))
								{
									include "modulos/".$url[0]."/".$url[1].".php";
		                        	echo '<script src="vistas/js/'.$_GET["ruta"].'.js"></script>';
								}
								else
								{
									include_once "modulos/404.php";
								}
							}
							else
							{
								include_once "modulos/".$url[0]."/".$url[0].".php";
				          		echo '<script src="vistas/js/'.$url[0].'.js"></script>';
							}
						}
						else
						{
							include_once "modulos/crearventa/crearventa.php";
						}
					}
				}
				else
				{
					include_once "modulos/404.php";
				}
		    }
		    else
		    {
		      	include "modulos/inicio.php";
		        echo '<script src="vistas/js/inicio.js"></script>';
		    }
		    include "modulos/footer.php";
		    echo '</div>';
	    }
	    else
	    {
	      include "modulos/login.php";
	    }
    ?>
    <script src="vistas/js/plantilla.js"></script>
    <script src="vistas/js/barcode.js"></script>
	<script>
	  $.widget.bridge('uibutton', $.ui.button)
	</script>
</body>
</html>