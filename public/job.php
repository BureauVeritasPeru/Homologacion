
<!DOCTYPE html>
<html>
<head>
	<title>Update</title>
	<script src="https://code.jquery.com/jquery-3.3.1.min.js"></script>
</head>
<body>
	<script type="text/javascript">
		window.onload = function() {
			$.getJSON('/scs/homologacion/ajax/job_requerimiento.php', function(data) {
				window.close();
			});
			$.getJSON('/scs/homologacion/ajax/job_homologacion.php', function(data) {
				window.close();
			});
		};

	</script>
</body>
</html>