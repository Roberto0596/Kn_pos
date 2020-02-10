<?php 
	
	session_destroy();

	echo '
	<script type="text/javascript">
		window.location = "inicio";
	</script>';
	echo "<script>
	    		$('#body').addClass('login-page');
	    	</script>";
?>

