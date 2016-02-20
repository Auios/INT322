<?php

function insertData($preeditT,$posteditT,$selectionT)
{
	$lines = file('/home/int322_161a19/secret/topsecret');
	$j=0;
	$host = trim($lines[$j++]);
	$user = trim($lines[$j++]);
	$pass = trim($lines[$j++]);
	$dbnm = trim($lines[$j++]);

	$conn = mysqli_connect($host, $user, $pass, $dbnm);
	if(!$conn) //If fail then kill
	{
		die('Connection failed: ' . mysqli_connect_error()); //RIP
	}

	//(This is broken... Dont know why... Whatever...)
	//$sql = 'INSERT INTO editing (preedit, postedit, selection) VALUES (' . $preeditT . ', ' . $posteditT . ', ' . $selectionT . ')';
	$sql = 'INSERT INTO editing SET preedit="' . $preeditT .
			'", postedit="' . $posteditT .
			'", selection="' . $selectionT . '"';

	if (mysqli_query($conn, $sql))
	{
		echo "New record created successfully";
	}
	else
	{
		echo "Error: " . $sql . "<br>" . mysqli_error($conn);
	}

	mysqli_close($conn);
}

$fileName = 'DeadLanguages.txt';

//Patterns
//r = replace
$pat1 = '/wh*/';

$pat2 = '/\(.*\)/';
$pat2r = '(*wh*)';

$pat3 = '/wha/';
$pat3r = '/which/';
?>

<html>
	<head>
		<title>PHP Files and MySql Exercise</title>	
	</head>
	<body>
		<?php
			if(file_exists($fileName))
			{
				//Open file for read
				if(filesize($fileName)>0)
				{
					$fp = fopen($fileName, 'r');
					$txt = fread($fp,filesize($fileName));
					?><p><?php print($txt); ?></p><?php
					fclose($fp);

					//Pre edit
					preg_match_all($pat1, $txt, $matches);
					$preedit = count($matches[0]);
					?><p>$preedit=<?php print($preedit); ?></p><?php

					//Post edit
					$txt = preg_replace($pat2, $pat2r, $txt, -1, $postedit)
					?><p><?php print($txt); ?></p><?php
					?><p>$postedit=<?php print($postedit); ?></p><?php

					//Selection
					$data = file_get_contents($fileName, NULL, NULL, 782);

					$txt = preg_replace($pat3, $pat3r, $data, -1, $selection);

					?><p>$data="<?php print($data); ?>"</p><?php
					?><p>$selection=<?php print($selection); ?></p><?php

					//Open file for write
					$fp = fopen($fileName, 'w');
					fwrite($fp, $txt);
					fclose($fp);

					//SQL Insert
					insertData($preedit,$postedit,$selection);
				}
				else
				{
					?><p><?php print('File is empty!'); ?></p><?php
				}
			}
			else
			{
				?><p>File "<i><?php print($fileName); ?></i>" is missing!</p><?php
			}?>
	</body>
</html>