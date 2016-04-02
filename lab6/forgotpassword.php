<?php
//Connect to SQL DB
$lines = file('/home/int322_161a19/secret/topsecret');
$j=0;
$host = trim($lines[$j++]);
$user = trim($lines[$j++]);
$pass = trim($lines[$j++]);
$dbnm = trim($lines[$j++]);

session_start();
?>

<?php
if($_POST)
{
	$email = trim($_POST['email']);
	if(!empty($email))
	{
		//All good
		$con = mysqli_connect($host,$user,$pass,$dbnm) or die("Error connecting to SQL: " . mysqli_error($con));
		$sqlCmd = "SELECT DISTINCT username, passwordHint FROM users WHERE username='" . $email . "'";
		$result = mysqli_query($con, $sqlCmd) or die('Query failed: '. mysqli_error($con));
		mysqli_close($con);
		
		if (mysqli_num_rows($result) > 0)
		{
			// output data of each row
			$row = mysqli_fetch_assoc($result);
			if($row["username"] == $email)
			{
				echo("Email sent!");

				$to = $email;
				$subject = 'Lab5: Password recovery - ' . rand(0,10000);
				$message = 'Your password hint is: ' . $row['passwordHint'];
				$message = wordwrap($message,70,"\r\n");
				mail($to,$subject,$message);
			}
			else
			{
				//Couldnt find email in database
				$error = true;
				$errorMsg = 'Error: Unable to find user!';
			}
		}
		else
		{
			echo "0 results";
		}
	}
	else
	{
		//Empty email
		$error = true;
		$errorMsg = 'Error: Empty email!';
	}
}
?>

<html>
	<head>
		<title>Forgot password</title>
		<style>
			body{width: 30%;margin: 100px auto;}
			.warning{color: red;}
		</style>
	</head>
	<body>
		<form method="post">
			<fieldset>
				<legend>Forgot password</legend>
				<table>
					<tr>
						<td>Email</td>
						<td><input type="email" name="email"></td>
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
		<p><a href="http://zenit.senecac.on.ca:11349/cgi-bin/lab6/login.php">Login</a></p>
		<p><a href="http://zenit.senecac.on.ca:11349/cgi-bin/lab6/forgotpassword.php">Reload page</a></p>
	</body>
</html>