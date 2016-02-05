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
	
  	if($_GET)
	{
		echo
		(
			'Title: ' . (strlen($_GET['title']) > 0 ? $_GET['title'] : 'NO TITLE!') . endl() .
			'First name: ' . (strlen($_GET['firstName']) > 0 ? $_GET['firstName'] : 'NO FIRST NAME!') . endl() .
			'Last name: ' . (strlen($_GET['lastName']) > 0 ? $_GET['lastName'] : 'NO LAST NAME!') . endl() .
			'Organization: ' . (strlen($_GET['organization']) > 0 ? $_GET['organization'] : 'NO ORGANIZATION!') . endl() .
			'Email: ' . (strlen($_GET['email']) > 0 ? $_GET['email'] : 'NO EMAIL!') . endl() .
			'Phone: ' . (strlen($_GET['phone']) > 0 ? $_GET['phone'] : 'NO PHONE!') . endl() .
			'Days attending...' . endl() .
			(strlen($_GET['monday']) > 0 ? 'Monday - YES' : 'Monday - NO') . endl() .
			(strlen($_GET['tuesday']) > 0 ? 'Tuesday - YES' : 'Tuesday - NO') . endl() .
			'Shirt size: ' . ($_GET['t-shirt'] == '--Please choose--' ? 'NO T-SHIRT!' : $_GET['t-shirt']) . endl()

		);

		$first_name = $_GET['firstname'];
	}
  	?>
  <h1>FSOS Registration</h1>
  <form method="GET">
	<table>
	<tr>
    	<td valign="top">Title:</td>
	<td>
		<table>
		<tr>
		<td><input type="radio" name="title" value="Mr" <?php if($_GET['title'] == 'Mr'){echo('checked');} ?>>Mr</td>
		</tr>
		<tr>
		<td><input type="radio" name="title" value="Mrs" <?php if($_GET['title'] == 'Mrs'){echo('checked');} ?>>Mrs</td>
		</tr>
		<tr>
		<td><input type="radio" name="title" value="Ms" <?php if($_GET['title'] == 'Ms'){echo('checked');} ?>>Ms</td>
		</tr>
		</table>
	</td>
	</tr>
	<tr>
    	<td>First name:</td>
	<td><input name="firstName" type="text" value="<?php echo($_GET['firstName']); ?>"></td>
	</tr>
	<tr>
    	<td>Last name:</td>
	<td><input name="lastName" type="text" value="<?php echo($_GET['lastName']); ?>"></td>
	</tr>
	<tr>
    	<td>Organization:</td>
	<td><input name="organization" type="text" value="<?php echo($_GET['organization']); ?>"></td>
	</tr>
	<tr>
    	<td>Email address:</td>
	<td><input name="email" type="text" value="<?php echo($_GET['email']); ?>"></td>
	</tr>
	<tr>
    	<td>Phone number:</td>
	<td><input name="phone" type="text" value="<?php echo($_GET['phone']); ?>"></td>
	</tr>
	<tr>
    	<td>Days attending:</td>
	<td>
		<input name="monday" type="checkbox" value="monday" <?php if($_GET['monday']){echo('checked');} ?>>Monday
		<input name="tuesday" type="checkbox" value="tuesday" <?php if($_GET['tuesday']){echo('checked');} ?>>Tuesday<td/>
	</tr>
	<tr>
	<td>T-shirt size:</td>
	<td>
	<select name="t-shirt">
	<option>--Please choose--</option>
	<option name="small" value="S" <?php if($_GET['t-shirt'] == 'S'){echo('selected');} ?>>Small</option>
	<option value="M" <?php if($_GET['t-shirt'] == 'M'){echo('selected');} ?>>Medium</option>
	<option value="L" <?php if($_GET['t-shirt'] == 'L'){echo('selected');} ?>>Large</option>
	<option value="XL" <?php if($_GET['t-shirt'] == 'XL'){echo('selected');} ?>>X-Large</option>
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
