<?php
include('myClasses.php');
session_start();

if($_POST)
{
	$email = strtolower($_POST['email']);
	$password = $_POST['password'];
	$rePassword = $_POST['rePassword'];
	$passwordHint = $_POST['passwordHint'];
	if(!empty($email))
	{
		if(!empty($password))
		{
			if(!empty($rePassword))
			{
				if($password == $rePassword)
				{
					//$conn = mysqli_connect($host,$user,$pass,$dbnm);
					//$sqlCmd = "SELECT username FROM users WHERE username='" . $email . "'";
					//$result = mysqli_query($conn,$sqlCmd) or die('Query failed: ' . mysqli_error($conn));
					//mysqli_close($conn);
					$db = new dbLink('int322_161a19');
					$result = $db->query("SELECT username FROM users WHERE username='" . $email . "'");

					if(mysqli_num_rows($result) > 0)
					{
						//User already exists
						$error = true;
						$errorMsg = 'Email already exists!';
					}
					else
					{
						//All good!
						$salt = uniqid();
						$hashedPassword = crypt($password,$salt);
						echo $salt . '<br>' . $hashedPassword . '<br>';
						$conn = mysqli_connect($host,$user,$pass,$dbnm);
						$sqlCmd = "INSERT INTO users(username,password,salt,role,passwordHint) VALUES('" . $email . "','" . $hashedPassword . "','" . $salt . "','user','" . $passwordHint . "')";
						mysqli_query($conn,$sqlCmd) or die('Query failed: ' . mysqli_error($conn));
						mysqli_close($conn);
					}
				}
				else
				{
					//Passwords do not match
					$error = true;
					$errorMsg = 'Passwords do not match!';
				}
			}
			else
			{
				//Didnt enter rePassword
				$error = true;
				$errorMsg = 'Please retype your password!';
			}
		}
		else
		{
			//Didnt enter password
			$error = true;
			$errorMsg = 'Please enter a password!';
		}
	}
	else
	{
		//Didnt enter email
		$error = true;
		$errorMsg = 'Please enter your email!';
	}
}
?>

<html>
	<head>
		<title>Sign up</title>
		<style>
			body{width: 30%;margin: 100px auto;}
			.warning{color: red;}
		</style>
	</head>
	<body>
		<form method="post">
			<fieldset>
				<legend>Sign up</legend>
				<table>
					<tr>
						<td>Email</td>
						<td><input type="email" name="email"></td>
					</tr>
					<tr>
						<td>Password</td>
						<td><input type="password" name="password"></td>
					</tr>
					<tr>
						<td>Retype Password</td>
						<td><input type="password" name="rePassword"></td>
					</tr>
					<tr>
						<td>Password Hint</td>
						<td><input type="text" name="passwordHint"></td>
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
		<p><a href="http://zenit.senecac.on.ca:11349/cgi-bin/lab6/signup.php">Reload page</a></p>
	</body>
</html>