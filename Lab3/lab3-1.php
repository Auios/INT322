<?php
$labVer = 'Lab 3.1';
$labDesc = 'Enter a postal code';

$code = $_GET['code'];
$pattern = "/^[a-z][0-9][a-z][0-9][a-z][0-9]$/i";

if($_GET)
{
    if($code)
    {
        $isValid = preg_match($pattern,$code);
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