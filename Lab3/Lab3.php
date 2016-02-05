<html>
	<head>
	<title>Lab 3.1</title>
	<style>
		body
		{
			width: 800px;
			margin: 200px auto;
			text-align: center;
		}
	</style>
	</head>
	<body>
		<?php
			if($_POST)
			{
				$pattern = '/[0-9]/';
				$subject = "123abc";
				preg_match($pattern, $subject, $matches);
				echo('<p>OUTPUT: ' . $matches . '</p>');
			}
			else
			{
				echo
				('
					<form method="POST">
					<fieldset>
						<legend>Lab 3.1</legend>
						<p><input type="text"></p>
						<p><input type="Submit" value="Submit"></p>
					</fieldset>
					</form>
				');
			}
		?>
	</body>
</html>