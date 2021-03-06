<?php
$labVer = 'Lab 3.4';
$labDesc = 'Enter a course code';

$code = $_GET['code'];
$pattern = "/^[\ ]*[a-z]{3}[0-9]{3}[a-z]{1,3}[\ ]*$/i";

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
        <p><a href="lab3-3.php">Previous Lab</a> --- <a href="lab3-5.php">Next Lab</a></p>
    </body>
</html>