<?php
session_start();

$_SESSION['loggedIn'] = 'FALSE';
?>
<html>
	<head>
		<title>Logout</title>
	</head>
	<body>
		<script> location.replace("http://zenit.senecac.on.ca:11349/cgi-bin/lab6/login.php"); </script>
	</body>
</html>