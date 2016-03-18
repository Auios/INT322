<?php
session_start();

$loggedIn = $_SESSION['loggedIn'];
?>

<html>
	<head>
		<title>Protected Stuff</title>

		<style>
			body
			{
				width: 30%;
				margin: 100px auto;
			}

			.warning
			{
				color: red;
			}
		</style>
	</head>
	<body>
		<?php
		if($loggedIn == 'TRUE')
		{?>
			<p>Welcome!</p>
			<p><a href="http://zenit.senecac.on.ca:11349/cgi-bin/lab5/logout.php">Logout</a></p>
		<?php
		}
		else
		{?>
			<p>You are not logged in!</p>
			<script> location.replace("http://zenit.senecac.on.ca:11349/cgi-bin/lab5/login.php"); </script>
		<?php } ?>
	</body>
</html>