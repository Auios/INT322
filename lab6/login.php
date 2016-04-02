<?php
include('myClasses.php');

session_start();
?>

<?php
if($_POST)
{
	$login = new loginData;
	$login->username = trim(strtolower($_POST['username']));
	$login->password = trim($_POST['password']);

	if($login->isValid())
	{
		//All good!
		//$conn = mysqli_connect($host,$user,$pass,$dbnm) or die("Error connecting to SQL: " . mysqli_error($conn));
		//$sqlCmd = "SELECT DISTINCT username, password, salt FROM users WHERE username='" . $username . "'";
		//$result = mysqli_query($conn, $sqlCmd) or die('Query failed: '. mysqli_error($conn));
		//mysqli_close($conn);

		$db = new dbLink('int322_161a19');
		$result = $db->query("SELECT DISTINCT username, password, salt FROM users WHERE username='" . $login->username . "'");

		if (mysqli_num_rows($result) > 0)
		{
			// output data of each row
			$row = mysqli_fetch_assoc($result);
			if($row['username'] == $login->username && $row['password'] == crypt($login->password,$row['salt']))
			{
				$_SESSION['loggedIn'] = 'TRUE';
				?>
				<script>
					location.replace("http://zenit.senecac.on.ca:11349/cgi-bin/lab6/protectedstuff.php");
				</script>
				<?php
			}
		}
		else
		{
			//Couldnt find email in database
			$login->error = true;
			$login->errorMsg = 'Error: Bad Login!';
		}
	}
	else
	{

	}
}
?>

<html>
	<head>
		<title>Login</title>
		<style>
			body{width: 30%;margin: 100px auto;}
			.warning{color: red;}
		</style>
	</head>
	<body>
		<form method="post">
			<fieldset>
				<legend>Login</legend>
				<table>
					<tr>
						<td>Email</td>
						<td><input type="email" name="username"></td>
					</tr>
					<tr>
						<td>Password</td>
						<td><input type="password" name="password"></td>
					</tr>
				</table>
				<?php
				if($login->error)
				{
					echo('<p class="warning">' . $login->errorMsg . '</p>');
				}
				?>
				<br>
				<input type="submit">
			</fieldset>
		</form>
		<p><a href="http://zenit.senecac.on.ca:11349/cgi-bin/lab6/signup.php">Create an account</a></p>
		<p><a href="http://zenit.senecac.on.ca:11349/cgi-bin/lab6/forgotpassword.php">Forgot password</a></p>
		<p><a href="http://zenit.senecac.on.ca:11349/cgi-bin/lab6/login.php">Reload page</a></p>
	</body>
</html>