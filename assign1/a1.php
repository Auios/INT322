<?php
$fileName = 'DeadLanguages.txt';
?>

<html>
<head>
	<title>PHP Files and MySql Exercise</title>	
</head>
<body>
	<?php
		if(file_exists($fileName))
		{
			$fp = fopen($fileName,'r');
			$txt = fread($fp,filesize($fileName));
			?><p><?php print($txt); ?></p><?php
			fclose($fp);
		}
		else
		{?>
			<p>File <i>"DeadLanguages.txt"</i> is missing!</p>
		<?php
		}?>
</body>
</html>