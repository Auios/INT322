<?php
	$lines = file('/home/int322_161a19/secret/topsecret');
	$j=0;
	$host = trim($lines[$j++]);
	$user = trim($lines[$j++]);
	$pass = trim($lines[$j++]);
	$dbnm = trim($lines[$j++]);

	$con = mysqli_connect($host,$user,$pass,$dbnm) or die("Error connecting to SQL: " . mysqli_error($con));

	$id = $_GET['id'];
	echo($id . '<br>');

	$sqlCmd = 'UPDATE lab4 SET dayAttending1="FALSE", dayAttending2="FALSE" WHERE ID=' . $id;
	echo("Sent: " . $sqlCmd . '<br>');
	$result = mysqli_query($con, $sqlCmd) or die('Query failed: '. mysqli_error($con));

	//Get results
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
?>