<?php
if($_GET){
    $isValid =false;
    $postalCodeErr = "";
    $postalCode = $_GET[postalCode];
    $pattern = "/^[a-z][0-9][a-z][\ ]?[0-9][a-z][0-9]$/i";
    if(preg_match($pattern, $postalCode))
    {
       $isValid = true;
    }
    else
        $postalCodeErr = "Invalid postal Code";
}

if($_GET && $isValid){
    echo "$postalCode is valid!";
}
else{
?>
    <html>
    <head>
      <title>Lab 3</title>
    </head>
    <body>
            <form action="lab3-2.php" method="get">
                <p> Enter a Postal Code <br>
                <input type="text" name="postalCode" value="<?php if (isset($_GET['postalCode']))echo $_GET['postalCode'];?>"/><?php echo" $postalCodeErr"; ?>
                <br />
                <input type="submit" name="submit" />
                </p>
            </form>
    </body>
   </html>
<?php
}
?>