<html>
<body>
<?php
//displayforminfo.php

function endl()
{
	return '<br>';
}

if($_POST)
{
	echo
	(
		'Title: ' . $_POST['title'] . endl() .
		'First name: ' . $_POST['firstName'] . endl() .
		'Last name: ' . $_POST['lastName'] . endl() .
		'Organization: ' . $_POST['organization'] . endl() .
		'Email: ' . $_POST['email'] . endl() .
		'Phone: ' . $_POST['phone'] . endl() .
		'Days attending...' . endl() .
		$_POST['monday'] . endl() .
		$_POST['tuesday'] . endl() .
		'Shirt size: ' . $_POST['t-shirt'] . endl()

	);
}
else
{
	echo("You shouldn't be here!");
}

?>
</body>
</html>