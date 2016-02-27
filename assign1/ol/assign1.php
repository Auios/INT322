<html>
<head>
	<title>Assignment 1</title>
</head>
<body>
	<?php
	$categoryErr = ""; //storing error for the drop-down menu
	$minErr = ""; //storing error for the minimum value
	$maxErr = ""; //storing error for the maximum value
	$dataValid = true;

	function loadCSV($link ,$fileName) {
 		$loadQuery = "LOAD DATA LOCAL INFILE '/home/int322_161a01/apache1/cgi-bin/assign/" . $fileName . ".csv' 
					  INTO TABLE " . $fileName . " 
					  FIELDS TERMINATED BY ',' 
					  ENCLOSED BY '\"'
					  LINES TERMINATED BY '\n'
					  IGNORE 1 LINES;";

		mysqli_query($link, $loadQuery) or die('query failed'. mysqli_error($link));
	}

	if ($_POST) {
		if ($_POST['category'] == "") { //check if a category is chosen
			$categoryErr = "<span style=\"color:red\">Error - you must choose a category!</span>";
			$dataValid = false;
		}

		if ($_POST['min'] == "") { //check if a minimum value is entered
			$minErr = "<span style=\"color:red\">Error - you must enter a minimum price!</span>";
			$dataValid = false;
		} elseif (!preg_match("/^ *\d*\.?\d* *$/", $_POST['min'])) { //check if the data is valid
			$minErr = "<span style=\"color:red\">Error - you can only enter digits here!</span>";
			$dataValid = false;
		}

		if ($_POST['max'] == "") { //check if a maximum value is entered
			$maxErr = "<span style=\"color:red\">Error - you must enter a maximum price!</span>";
			$dataValid = false;
		} elseif (!preg_match("/^ *\d*\.?\d* *$/", $_POST['max'])) { //check if the data is valid
			$maxErr = "<span style=\"color:red\">Error - you can only enter digits here!</span>";
			$dataValid = false;
		} elseif ($_POST['min'] >= $_POST['max']) { //check if max is greater than min
			$maxErr = "<span style=\"color:red\">Error - maximum price must be greater than minimum price!</span>";
			$dataValid = false;
		}
	}

	if ($_POST && $dataValid) {
		//information from the user
		$category = $_POST['category'];
		$min = $_POST['min'];
		$max = $_POST['max'];

		//mySQLi connect information
		$lines = file('/home/int322_161a01/secret/topsecret');
		$dbserver = trim($lines[0]);
		$uid = trim($lines[1]);
		$pw = trim($lines[2]);
		$dbname = trim($lines[3]);

		//Connect to the mysql server and get back our link_identifier
 		$link = mysqli_connect($dbserver, $uid, $pw, $dbname) or die('Could not connect: ' . mysqli_error($link));
 		
 		//empptying all the tables
 		mysqli_query($link, "DELETE FROM android;") or die('query failed'. mysqli_error($link));
 		mysqli_query($link, "DELETE FROM Iphone;") or die('query failed'. mysqli_error($link));
 		mysqli_query($link, "DELETE FROM Microsoft;") or die('query failed'. mysqli_error($link));
 		mysqli_query($link, "DELETE FROM BlackBerry;") or die('query failed'. mysqli_error($link));

 		//load CSV file
 		loadCSV($link, "android");
 		loadCSV($link, "Iphone");
 		loadCSV($link, "Microsoft");
 		loadCSV($link, "BlackBerry");

 		//run the SELECT query
 		$selectQuery = "SELECT * FROM " . $category . " WHERE price BETWEEN " . $min . " AND " . $max . " ORDER BY price;";
 		$result = mysqli_query($link, $selectQuery) or die('query failed'. mysqli_error($link));

		?>
		<h3>Product Comparision</h3>
		<table border="1">
		<tr>
			<th>Model</th><th>OS</th><th>Version</th><th>Price</th>
		</tr>
		<?php
		//iterate through result printing each record
 		while($row = mysqli_fetch_assoc($result)) {
		?>
			<tr>

                                <td><?php print $row['model']; ?></td>
                                <td><?php print $row['os']; ?></td>
				<td><?php print $row['verssion']; ?></td>
				<td><?php print $row['price']; ?></td>				
			</tr>
			<?php
 		}
		?>
		</table>
		<?php
		// Free resultset (optional)
		mysqli_free_result($result);

		//Close the MySQL Link
 		mysqli_close($link);

	} else {
		?>
		<h3>Product Comparision</h3>
		<form method="post" action="">
		 	Category:
			<select name="category">
	     <option name="choose" value="">--Please choose--</option>
	     <option name="android" value="android" <?php if ($_POST['category'] == "android") echo "SELECTED"; ?>>Android</option>
	     <option name="Iphone" value="Iphone" <?php if ($_POST['category'] == "Iphone") echo "SELECTED"; ?>>iPhone</option>
	     <option name="Microsoft" value="Microsoft" <?php if ($_POST['category'] == "Microsoft") echo "SELECTED"; ?>>Windows Phone</option>
	     <option name="BlackBerry" vaulue="BlackBerry" <?php if ($_POST['category'] == "BlackBerry") echo "SELECTED"; ?>>BlackBerry</option>
		 	</select>
			<?php echo $categoryErr;?>
			<br/>

			Minimum Price:
			<input type="text" name="min" value="<?php if (isset($_POST['min'])) echo $_POST['min']; ?>"><?php echo $minErr;?>
			<br/>

			Maximum Price:
			<input type="text" name="max" value="<?php if (isset($_POST['max'])) echo $_POST['max']; ?>"><?php echo $maxErr;?>
			<br/>

			<input type="submit" name="submit">
		</form>
		<?php
	}
	?>

</body>
</html>
