
<?php
//session_start();

//Connect to SQL DB
$lines = file('/home/int322_161a19/secret/topsecret');
$j=0;
$host = trim($lines[$j++]);
$user = trim($lines[$j++]);
$pass = trim($lines[$j++]);
$dbnm = trim($lines[$j++]);

$con = mysqli_connect($host,$user,$pass,$dbnm) or die("Error connecting to SQL: " . mysqli_error($con));

$valid = true;
$day1 = "FALSE";
$day2 = "FALSE";
?>

<html>
  <head>
    <title>FSOSS Registration</title>
  </head>
  <body>
  	<?php
  	function endl()
	{
		return '<br>';
	}
	
  	if($_POST)
	{
		$title = trim($_POST['title']);
		$firstName = trim($_POST['firstName']);
		$lastName = trim($_POST['lastName']);
		$organization = trim($_POST['organization']);
		$email = trim($_POST['email']);
		$phone = trim($_POST['phone']);
		$tshirt = trim($_POST['t-shirt']);

		if($title)
		{
			if($firstName)
			{
				if($lastName)
				{
					if($organization)
					{
						if($email)
						{
							if($phone)
							{
								if($tshirt != "--Please choose--")
								{
									if(trim($_POST['monday']))
									{
										$day1 = "TRUE";
									}
									if(trim($_POST['tuesday']))
									{
										$day2 = "TRUE";
									}
								}
								else
								{
									$valid = false;
								}
							}
							else
							{
								$valid = false;
							}
						}
						else
						{
							$valid = false;
						}
					}
					else
					{
						$valid = false;
					}
				}
				else
				{
					$valid = false;
				}
			}
			else
			{
				$valid = false;
			}
		}
		else
		{
			$valid = false;
		}

		if($valid)
		{
			//Insert
			$sqlCmd = 'INSERT INTO lab4 SET title="' . $title .
			'", firstName="' . $firstName .
			'", lastName="' . $lastName .
			'", organization="' . $organization .
			'", email="' . $email .
			'", phone="' . $phone .
			'", tshirt="' . $tshirt .
			'", dayAttending1="' . $day1 .
			'", dayAttending2="' . $day2 . '"';
			echo('Sent: ' . $sqlCmd);

			//Check for error
			$result = mysqli_query($con, $sqlCmd) or die('Query failed: '. mysqli_error($con));

			//Get data
			$sqlCmd = "SELECT * FROM lab4";
			$query = mysqli_query($con, $sqlCmd);

			//Table header
			?>
			<table border="1">
				<tr>
					<th>ID</th>
					<th>Title</th>
					<th>First Name</th>
					<th>Last Name</th>
					<th>Organization</th>
					<th>Email</th>
					<th>Phone</th>
					<th>T-Shirt</th>
					<th>Monday</th>
					<th>Tuesday</th>
					<th>Action</th>
				</tr>
			<?php
					//Table continues

			while($result = mysqli_fetch_assoc($query))
			{
				//Table contents
				?>
					<tr>
						<td><?php echo($result["ID"]); ?></td>
						<td><?php echo($result["title"]); ?></td>
						<td><?php echo($result["firstName"]); ?></td>
						<td><?php echo($result["lastName"]); ?></td>
						<td><?php echo($result["organization"]); ?></td>
						<td><?php echo($result["email"]); ?></td>
						<td><?php echo($result["phone"]); ?></td>
						<td><?php echo($result["tshirt"]); ?></td>
						<td><?php echo($result["dayAttending1"]); ?></td>
						<td><?php echo($result["dayAttending2"]); ?></td>
						<td><a href="http://zenit.senecac.on.ca:11349/cgi-bin/lab4/cancel.php?id=<?php echo($result['ID']);?>"><?php if($result["dayAttending1"] || $result["dayAttending2"])$cancel ='cancel'; echo $cancel; ?></td>
					</tr>
				//Table row
				<?php
			}
			echo('</table>');
		}
	}
	if(!$_POST || $valid == false)
	{
	?>
		<h1>FSOS Registration</h1>
		<form method="POST">
			<table>
			<tr>
		    	<td valign="top">Title:</td>
				<td>
					<table>
						<tr>
							<td><input type="radio" name="title" value="Mr" <?php if($_POST['title'] == 'Mr'){echo('checked');} ?>>Mr</td>
						</tr>
						<tr>
							<td><input type="radio" name="title" value="Mrs" <?php if($_POST['title'] == 'Mrs'){echo('checked');} ?>>Mrs</td>
						</tr>
						<tr>
							<td><input type="radio" name="title" value="Ms" <?php if($_POST['title'] == 'Ms'){echo('checked');} ?>>Ms</td>
						</tr>
					</table>
				</td>
			</tr>
			<tr>
		    	<td>First name:</td>
				<td><input name="firstName" type="text" value="<?php echo($_POST['firstName']); ?>"></td>
			</tr>
			<tr>
		    	<td>Last name:</td>
				<td><input name="lastName" type="text" value="<?php echo($_POST['lastName']); ?>"></td>
			</tr>
			<tr>
		    	<td>Organization:</td>
				<td><input name="organization" type="text" value="<?php echo($_POST['organization']); ?>"></td>
			</tr>
			<tr>
		    	<td>Email address:</td>
				<td><input name="email" type="text" value="<?php echo($_POST['email']); ?>"></td>
			</tr>
			<tr>
		    	<td>Phone number:</td>
				<td><input name="phone" type="text" value="<?php echo($_POST['phone']); ?>"></td>
			</tr>
			<tr>
		    	<td>Days attending:</td>
			<td>
				<input name="monday" type="checkbox" value="monday" <?php if($_POST['monday']){echo('checked');} ?>>Monday
				<input name="tuesday" type="checkbox" value="tuesday" <?php if($_POST['tuesday']){echo('checked');} ?>>Tuesday<td/>
			</tr>
			<tr>
				<td>T-shirt size:</td>
				<td>
					<select name="t-shirt">
						<option>--Please choose--</option>
						<option name="small" value="S" <?php if($_POST['t-shirt'] == 'S'){echo('selected');} ?>>Small</option>
						<option value="M" <?php if($_POST['t-shirt'] == 'M'){echo('selected');} ?>>Medium</option>
						<option value="L" <?php if($_POST['t-shirt'] == 'L'){echo('selected');} ?>>Large</option>
						<option value="XL" <?php if($_POST['t-shirt'] == 'XL'){echo('selected');} ?>>X-Large</option>
					</select>
				</td>
			</tr>
			<tr><td><br></td></tr>
			<tr>
				<td></td>
				<td><input name="submit" type="submit"></td>
			</tr>
		</form>
	<?php
	}
	?>
	  </body>
</html>
