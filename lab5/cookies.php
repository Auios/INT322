<?php
	$isValid = true;
	$cookieName = '';
	$cookieValue = '';

	$count = intval($_COOKIE['visitCount']) + 1;
	setcookie("visitCount",$count,time() + (60*60),'/'); //1 hour

	if(!$count)
	{
		header("Refresh:0");
	}

	if($_POST)
	{
		$cookieName = trim($_POST['cookieName']);
		$cookieValue = trim($_POST['cookieValue']);

		if(!empty($cookieName))
		{
			if(!empty($cookieValue))
			{
				setcookie($cookieName,$cookieValue,time() + (60*60),'/'); //1 hour
			}
			else
			{
				//Bad cookie value
				$isValid = false;
				$error = true;
				$errorMsg = "Error: Empty value!";
			}
		}
		else
		{
			//Bad cookie name
			$isValid = false;
			$error = true;
			$errorMsg = "Error: Empty name!";
		}
	}
?>

<!DOCTYPE html>
<html>
	<head>
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

		<meta charset="UTF-8">
		<title>Lab 5</title>
	</head>
	<body>
		<form method="post">
			<fieldset>
				<legend>Cookie information</legend>
				<table>
					<tr>
						<td>Name</td>
						<td><input type="text" name="cookieName"></td>
					</tr>
					<tr>
						<td>Value</td>
						<td><input type="text" name="cookieValue"></td>
					</tr>
				</table>
				<?php
				if($error)
				{
					echo('<p class="warning">' . $errorMsg . '</p>');
				}
				?>
				<input type="submit">
			</fieldset>
		</form>

		<p>Cookies:</p>
		<?php
		foreach ($_COOKIE as $key=>$val)
		{
			echo $key . ' = ' . $val . "<br>";
		}
		?>
		<hr>
		<p>You have been here
		<?php
		echo($_COOKIE['visitCount']);
		?>
		times!
		</p>
		<p><a href="http://zenit.senecac.on.ca:11349/cgi-bin/lab5/cookies.php">Reload page</a></p>
	</body>
</html>

