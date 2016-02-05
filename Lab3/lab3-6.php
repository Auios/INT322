<?php
$labVer = 'Lab 3.6';
$labDesc = 'Enter a phone number';

$code = $_GET['code'];
$pattern1 = "/^[\ ]*[0-9]{3}[\-][0-9]{3}[\-][0-9]{4}[\ ]*$/i";          //999-999-9999
$pattern2 = "/^[\ ]*[0-9]{3}[\ ][0-9]{3}[\ ][0-9]{4}[\ ]*$/i";          //999 999 9999
$pattern3 = "/^[\ ]*[0-9]{3}[\ ][0-9]{3}[\-][0-9]{4}[\ ]*$/i";          //999 999-9999
$pattern4 = "/^[\ ]*[0-9]{10}[\ ]*$/i";                                 //9999999999
$pattern5 = "/^[\ ]*[0-9]{3}[\ ][0-9]{7}[\ ]*$/i";                      //999 9999999
$pattern6 = "/^[\ ]*[\(][0-9]{3}[\)][\ ][0-9]{3}[\-][0-9]{4}[\ ]*$/i";  //(999) 999-9999
$pattern7 = "/^[\ ]*[\(][0-9]{3}[\)][\ ][0-9]{3}[\ ][0-9]{4}[\ ]*$/i";  //(999) 999 9999 

if($_GET)
{
    if($code)
    {
        $isValid = preg_match($pattern1,$code);                //999-999-9999
        if(!$isValid){$isValid = preg_match($pattern2,$code);} //999 999 9999
        if(!$isValid){$isValid = preg_match($pattern3,$code);} //999 999-9999
        if(!$isValid){$isValid = preg_match($pattern4,$code);} //9999999999
        if(!$isValid){$isValid = preg_match($pattern5,$code);} //999 9999999
        if(!$isValid){$isValid = preg_match($pattern6,$code);} //(999) 999-9999
        if(!$isValid){$isValid = preg_match($pattern7,$code);} //(999) 999 9999 
    }
}
?>

<html>
    <head>
        <title><?php echo($labVer); ?></title>
        <style>
        body
        {
            width: 400px;
            margin: 200px auto;
            text-align: center;
        }
        </style>
    </head>
    <body>
        <form method="GET">
            <fieldset>
                <legend><?php echo($labVer); ?></legend>
                <p><?php echo($labDesc); ?></p>
                <p><input type="text" name="code" value="<?php echo($_GET['code']); ?>" autocomplete="off"></p>
                <p><input type="Submit" value="Submit"></p>
            </fieldset>
        </form>
        <?php
        if($_GET && $code)
        {
            if($isValid)
            {
                echo('Output: Valid!');
            }
            else
            {
                echo('Output: Invalid!');
            }
            
        }
        else
        {
            echo('Output: Empty');
        }
        ?>
    </body>
</html>