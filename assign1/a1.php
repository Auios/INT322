<?php
	/*
	Student Declaration

	I/we declare that the attached assignment is my/our own work in accordance with Seneca Academic Policy. No part of this assignment has been copied manually or electronically from any other source (including web sites) or distributed to other students.

	Name: Connor Andrew Ngo

	Student ID: 040842148
	*/


	//Make a neat function to organize myself
	function insertData($INmodel,$INmanu,$INversion,$INprice)
	{
		//Get data for SQL
		$lines = file('/home/int322_161a19/secret/topsecret');
		$j=0;
		$host = trim($lines[$j++]);
		$user = trim($lines[$j++]);
		$pass = trim($lines[$j++]);
		$dbnm = trim($lines[$j++]);

		//Establish connection
		$conn = mysqli_connect($host,$user,$pass,$dbnm) or die('Error connecting to database: ' . mysqli_error($conn));

		//Execute command and make sure it worked
		$sqlCmd = 'INSERT INTO phones SET model="' . trim($INmodel) . '",manu="' . trim($INmanu) . '",version="' . trim($INversion) . '",price=' . trim($INprice);
		//echo $sqlCmd . "<br>";
		mysqli_query($conn,$sqlCmd) or die('Error2: ' . mysqli_error($conn));

		//Close connection
		mysqli_close($conn);
	}

	//Drop table
	function dropTable()
	{
		//Get data for SQL
		$lines = file('/home/int322_161a19/secret/topsecret');
		$j=0;
		$host = trim($lines[$j++]);
		$user = trim($lines[$j++]);
		$pass = trim($lines[$j++]);
		$dbnm = trim($lines[$j++]);

		//Establish connection
		$conn = mysqli_connect($host,$user,$pass,$dbnm) or die('Error connecting to database: ' . mysqli_error($conn));

		//Execute command and make sure it worked
		$sqlCmd = "DROP TABLE phones";
		mysqli_query($conn,$sqlCmd) or die('Error!: ' . mysqli_error($conn));

		//Close connection
		mysqli_close($conn);
	}

	//Create table
	function createTable()
	{
		//Get data for SQL
		$lines = file('/home/int322_161a19/secret/topsecret');
		$j=0;
		$host = trim($lines[$j++]);
		$user = trim($lines[$j++]);
		$pass = trim($lines[$j++]);
		$dbnm = trim($lines[$j++]);

		//Establish connection
		$conn = mysqli_connect($host,$user,$pass,$dbnm) or die('Error connecting to database: ' . mysqli_error($conn));

		//Execute command and make sure it worked
		$sqlCmd = "create table phones (model varchar(40) not null, manu varchar(40) not null, version varchar(40) not null, price decimal(10,2) not null);";
		mysqli_query($conn,$sqlCmd) or die('Error!: ' . mysqli_error($conn));

		//Close connection
		mysqli_close($conn);
	}

	//List phones
	function listPhones($tmin,$tmax,$tmanu)
	{
		//Get data for SQL
		$lines = file('/home/int322_161a19/secret/topsecret');
		$j=0;
		$host = trim($lines[$j++]);
		$user = trim($lines[$j++]);
		$pass = trim($lines[$j++]);
		$dbnm = trim($lines[$j++]);

		//Establish connection
		$conn = mysqli_connect($host,$user,$pass,$dbnm) or die('Error connecting to database: ' . mysqli_error($conn));

		//Execute command and make sure it worked
		$sqlCmd = 'SELECT * FROM phones WHERE manu="' . $tmanu . '" AND price>=' . $tmin . ' AND price<=' . $tmax;
		$query = mysqli_query($conn,$sqlCmd) or die('Error: ' . mysqli_error($conn));
		?>
		<table border="1">
			<tr>
				<th>Model</th>
				<th>Manufacturer</th>
				<th>Version</th>
				<th>Price</th>
			</tr>
				<?php
				while($result=mysqli_fetch_assoc($query))
				{
					echo("<tr>");
						echo("<td>" . $result['model'] . "</td>");
						echo("<td>" . $result['manu'] . "</td>");
						echo("<td>" . $result['version'] . "</td>");
						echo("<td>" . $result['price'] . "</td>");
					echo("</tr>");
				}
				?>
		</table>
		<?php
		

		//Close connection
		mysqli_close($conn);
	}

	function showDate()
	{
		//Get data for SQL
		$lines = file('/home/int322_161a19/secret/topsecret');
		$j=0;
		$host = trim($lines[$j++]);
		$user = trim($lines[$j++]);
		$pass = trim($lines[$j++]);
		$dbnm = trim($lines[$j++]);

		//Establish connection
		$conn = mysqli_connect($host,$user,$pass,$dbnm) or die('Error connecting to database: ' . mysqli_error($conn));

		//Execute command and make sure it worked
		$sqlCmd = 'SELECT CURDATE()';

		$query = mysqli_query($conn, $sqlCmd) or die('query failed'. mysqli_error($conn));

		//Get result
		$result = mysqli_fetch_assoc($query);
		echo('<p>' . $result['CURDATE()'] . '</p>');

		//Close connection
		mysqli_close($conn);
	}

	//insertData("iPhone 6S","imanu",9.0,1024.99);
	$fmodel = file('cellphone.txt');
	$fmanu = file('manu.txt');
	$fversion = file('version.txt');
	$fprice = file('price.txt');

	dropTable();
	createTable();

	for($i=0;$i<count($fmodel);$i++)
	{
		insertData($fmodel[$i],$fmanu[$i],$fversion[$i],$fprice[$i]);
	}
?>

<html>
	<head>
		<title>Assignment 1</title>	
	</head>
	<body>
		<form method="get" action="a1.php">
			<p>Cell phone</p>
			<select name="manu">
				<?php
					//Get data for SQL
					$lines = file('/home/int322_161a19/secret/topsecret');
					$j=0;
					$host = trim($lines[$j++]);
					$user = trim($lines[$j++]);
					$pass = trim($lines[$j++]);
					$dbnm = trim($lines[$j++]);
					$conn = mysqli_connect($host,$user,$pass,$dbnm) or die('Error connecting to database: ' . mysqli_error($conn));
					$sqlCmd = 'SELECT DISTINCT manu FROM phones';
					$query = mysqli_query($conn,$sqlCmd);

					while($result=mysqli_fetch_assoc($query))
					{
						?><option value="<?php echo($result["manu"]); ?>" <?php if($_GET){if($_GET['manu'] == $result["manu"]){echo(" selected");}} ?>><?php echo($result["manu"]); ?></option><?php
					}

					//Close connection
					mysqli_close($conn);
				?>
			</select>

			<table>
				<tr>
					<td>Min:</td>
					<td><input type="text" name="min" value="<?php if($_GET){echo($_GET['min']);}else{echo("0");} ?>"></td>
				</tr>
				<tr>
					<td>Max:</td>
					<td><input type="text" name="max" value="<?php if($_GET){echo($_GET['max']);}else{echo("0");} ?>"></td>
				</tr>
			</table>
			<p><input type="submit"></p>
		</form>
		<?php
			if($_GET)
			{
				$isValid = true;
				$vErr = "";

				// Min/Max values
				$min = floatval($_GET['min']);
				$max = floatval($_GET['max']);
				$manu = $_GET['manu'];

				// Regex for decimals
				$pat = '/^[0-9]+(\.[0-9]{1,2})?/';
				/*
				Usage:
				if (!preg_match($pat, $str))
				{
				    echo "Invalid";
				}
				*/

				//Min is ok?
				if(!preg_match($pat,$min))
				{
					$isValid = false;
					$vErr = "Bad min";
				}

				//Max is ok?
				if(!preg_match($pat,$max))
				{
					$isValid = false;
					$vErr = "Bad max";
				}

				//Is min higher than max? >.>
				if($min > $max)
				{
					$isValid = false;
					$vErr = "Min is higher than max";
				}

				echo("<br><hr><br>");

				if($isValid)
				{
					//echo("$min,$max,$manu");

					showDate();
					listPhones($min,$max,$manu);
				}
				else
				{
					//I doubt youll ever get this message... I really hope not at least
					echo("Error: " . $vErr);
				}
			}
		?>
	</body>
</html>

<?php
/*
	
*/
?>