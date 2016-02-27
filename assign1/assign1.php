<html>
<?php
function readFile1($cellphone, $os, $model, $price){
	$phone = file($cellphone);
	$os = file($os);
	$model = file($model);
	$price = file($price);
}

//connect to database
$lines = file('/home/int322_161a21/secret/topsecret');
$dbserver = trim($lines[0]);
$uid = trim($lines[1]);
$pw = trim($lines[2]);
$dbname = trim($lines[3]);
$link = mysqli_connect($dbserver, $uid, $pw, $dbname)
         		or die('Could not connect: ' . mysqli_error($link));
				
//clear out data in table
$sql_query = 'delete from phone';
mysqli_query($link, $sql_query) or die('query failed'. mysqli_error($link));

//read from files
readFile1('cellphone.txt', 'os.txt', 'model.txt', 'price.txt');

//populate database
for($x=0; $x < 6; $x++){
	$sql_query = 'INSERT INTO phone set itemName="' .trim($phone[$x]). '", os="' .trim($os[$x]). '", model="' .trim($model[$x]). '", price="' .trim($price[$x]). '"';
	mysqli_query($link, $sql_query) or die('query failed'. mysqli_error($link));
}
//validating
if($_POST){
	$dataValid = true;	
	if ($_POST['phone'] == "") { 
			$phoneErr = "Error - you must choose a phone!";
			$dataValid = false;
	}
	if($_POST['min'] == ""){
		$minErr = "Error - value cant be empty";
		$dataValid = false;
	}
	elseif (!preg_match("/^[0-9]+(\.[0-9][0-9]?)?$/" ,$_POST['min'])){
		$minErr = "Error - value must be a decimal number only!";
		$dataValid = false;
	}
	if($_POST['max'] == ""){
		$maxErr = "Error - value cant be empty";
		$dataValid = false;
	}
	elseif (!preg_match("/^[0-9]+(\.[0-9][0-9]?)?$/" ,$_POST['max'])){
		$maxErr = "Error - value must be a decimal number only!";
		$dataValid = false;
	}
	elseif($_POST['min'] > $_POST['max']){
		$maxErr = "Error - max value must be greater than min value!";
		$dataValid = false;
	}
}

if($_POST && $dataValid){
	$min = $_POST['min'];
	$max = $_POST['max'];
	$sql_query = 'SELECT * FROM phone WHERE (itemName="' .$_POST[phone]. '" && price BETWEEN "'.$min.'" AND "'.$max.'") ORDER BY price' ;
	echo $sql_query;
	$query = 'SELECT CURDATE()';
	$date = mysqli_query($link, $query) or die('query failed'. mysqli_error($link));
	$date1 = mysqli_fetch_assoc($date);
	print "<br>";
	echo  $date1['CURDATE()'];
	$result = mysqli_query($link, $sql_query) or die('query failed'. mysqli_error($link));
	?>
	<table border = "2">
	<tr>
		<th>Phone</th><th>OS</td><th>Model</th><th>Price</th>
	</tr>	
	<?php
	while($row = mysqli_fetch_assoc($result)){
	?>
		<tr>
				<td><?php print $row['itemName']?></td>
				<td><?php print $row['os']?></td>
				<td><?php print $row['model']?></td>
				<td><?php print $row['price']?></td>
		</tr>
	<?php
	}
}
else{
?>

<h3>Product Comparison</h3>
<form method="post" action="assign1.php">
	<table>
	<tr>
	<td>Phone:</td>
	<td>
	<select name="phone">
	  <option name="choose" value="">--Please choose--</option>
	  <option name="Android" value="Android" <?php if ($_POST['phone'] == "Android") echo "SELECTED"; ?>>Android</option>
	  <option name="Iphone" value="Iphone" <?php if ($_POST['phone'] == "Iphone") echo "SELECTED"; ?>>iPhone</option>
	  <option name="Microsoft" value="Microsoft" <?php if ($_POST['phone'] == "Microsoft") echo "SELECTED"; ?>>Windows Phone</option>
	  <option name="Blackberry" vaulue="BlackBerry" <?php if ($_POST['phone'] == "BlackBerry") echo "SELECTED"; ?>>BlackBerry</option>
	</select>
	</td>
	<td>
	<?php echo $phoneErr;?>
	<td>
	</tr>
	<br />
	<tr>
	<td>
	Minimum Price:
	</td>
	<td>
	<input type="text" name="min" value="<?php if (isset($_POST['min'])) echo $_POST['min']; ?>">
	</td>
	<td>
	<?php echo $minErr;?>
	</td>
	</tr>
	<tr>
	<td>
	Maximum Price:
	</td>
	<td>
	<input type="text" name="max" value="<?php if (isset($_POST['max'])) echo $_POST['max']; ?>">
	</td>
	<td>
	<?php echo $maxErr;?>
	</td>
	</tr>
	</table>
	<input type="submit" name="submit">
	</form>

	</html>

<?php
}
?>
