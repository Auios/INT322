<?php
//Connect to SQL DB
$lines = file('/home/int322_161a19/secret/topsecret');
$j=0;
$host = trim($lines[$j++]);
$user = trim($lines[$j++]);
$pass = trim($lines[$j++]);
$dbnm = trim($lines[$j++]);

session_start();

function redirect($url)
{
   header('Location: ' . $url);
   die();
}
?>

<?php
if($_POST)
{
	$username = trim($_POST['username']);
	$password = trim($_POST['password']);
	if(!empty($username))
	{
		if(!empty($password))
		{
			//All good!
			$con = mysqli_connect($host,$user,$pass,$dbnm) or die("Error connecting to SQL: " . mysqli_error($con));
			$sqlCmd = "SELECT DISTINCT username, password FROM users WHERE username='" . $username . "' AND password='" . $password . "'";
			$result = mysqli_query($con, $sqlCmd) or die('Query failed: '. mysqli_error($con));
			mysqli_close($con);

			if (mysqli_num_rows($result) > 0)
			{
				// output data of each row
				$row = mysqli_fetch_assoc($result);
				if($row["username"] == $username)
				{
					$_SESSION['loggedIn'] = 'TRUE';
					?>
					<script>
						location.replace("http://zenit.senecac.on.ca:11349/cgi-bin/lab5/protectedstuff.php");
					</script>
					<?php
				}
				else
				{
					//Couldnt find email in database
					$error = true;
					$errorMsg = 'Error: Bad login!';
				}
			}
			else
			{
				echo "User not found!";
			}
		}
		else
		{
			//Empty password
			$error = true;
			$errorMsg = 'Error: Empty password!';
		}
	}
	else
	{
		//Empty username
		$error = true;
		$errorMsg = 'Error: Empty username!';
	}
}
?>

<html>
	<head>
		<title>Login</title>
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
		<form method="post">
			<fieldset>
				<legend>Login</legend>
				<table>
					<tr>
						<td>Username</td>
						<td><input type="email" name="username"></td>
					</tr>
					<tr>
						<td>Password</td>
						<td><input type="password" name="password"></td>
					</tr>
				</table>
				<?php
				if($error)
				{
					echo('<p class="warning">' . $errorMsg . '</p>');
				}
				?>
				<br>
				<input type="submit">
			</fieldset>
		</form>
		<p><a href="http://zenit.senecac.on.ca:11349/cgi-bin/lab5/forgotpassword.php">Forgot password</a></p>
		<p><a href="http://zenit.senecac.on.ca:11349/cgi-bin/lab5/login.php">Reload page</a></p>
	</body>
</html>