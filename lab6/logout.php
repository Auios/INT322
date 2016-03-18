<?php
session_start();

$_SESSION['loggedIn'] = 'FALSE';
?>
<html>
	<head>
	</head>
	<body>
		<script> location.replace("http://zenit.senecac.on.ca:11349/cgi-bin/lab5/login.php"); </script>
	</body>
</html>