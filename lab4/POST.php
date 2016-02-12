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
		/*
		echo
		(
			'Title: ' . (strlen($_POST['title']) > 0 ? $_POST['title'] : 'NO TITLE!') . endl() .
			'First name: ' . (strlen($_POST['firstName']) > 0 ? $_POST['firstName'] : 'NO FIRST NAME!') . endl() .
			'Last name: ' . (strlen($_POST['lastName']) > 0 ? $_POST['lastName'] : 'NO LAST NAME!') . endl() .
			'Organization: ' . (strlen($_POST['organization']) > 0 ? $_POST['organization'] : 'NO ORGANIZATION!') . endl() .
			'Email: ' . (strlen($_POST['email']) > 0 ? $_POST['email'] : 'NO EMAIL!') . endl() .
			'Phone: ' . (strlen($_POST['phone']) > 0 ? $_POST['phone'] : 'NO PHONE!') . endl() .
			'Days attending...' . endl() .
			(strlen($_POST['monday']) > 0 ? 'Monday - YES' : 'Monday - NO') . endl() .
			(strlen($_POST['tuesday']) > 0 ? 'Tuesday - YES' : 'Tuesday - NO') . endl() .
			'Shirt size: ' . ($_POST['t-shirt'] == '--Please choose--' ? 'NO T-SHIRT!' : $_POST['t-shirt']) . endl()

		);
		*/
	}
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
  </body>
</html>
