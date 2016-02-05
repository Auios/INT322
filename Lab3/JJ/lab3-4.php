<?php
if($_GET){
    $isValid =true;
    $postalCodeErr = "";
    $postalCode = $_GET[postalCode];
    $pattern = "/^[\ ]*[a-z][0-9][a-z][\ ]?[0-9][a-z][0-9][\ ]*$/i";
    if(!preg_match($pattern, $postalCode))
    {
       $isValid = false;
	   $postalCodeErr = "Invalid postal Code";
    }        
	$subjectCode = $_GET[subjectCode];
	$subjectCodeErr = "";
	$pattern = "/^[\ ]*[A-Z]{3}[0-9]{3}[A-Z]{1,3}[\ ]*$/";
	if(!preg_match($pattern, $subjectCode))
	{
	   $isValid = false;
	   $subjectCodeErr ="Invalid Subject Code";
	}
		
}

if($_GET && $isValid){
    echo "$postalCode and $subjectCode is valid!";
}
else{
?>
    <html>
    <head>
      <title>Lab 3</title>
    </head>
    <body>
            <form action="lab3-4.php" method="get">
                Postal Code: <input type="text" name="postalCode" value="<?php if (isset($_GET['postalCode']))echo $_GET['postalCode'];?>"/><?php echo" $postalCodeErr"; ?>
                <br />
				Subject Code: <input type="text" name="subjectCode" value = "<?php if (isset($_GET['subjectCode']))echo $_GET['subjectCode'];?>"/><?php echo" $subjectCodeErr"; ?>
				<br />
                <input type="submit" name="submit" />
                </p>
            </form>
    </body>
   </html>
<?php
}
?>