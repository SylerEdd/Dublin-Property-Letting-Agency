<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <?php
        DEFINE('DB_USER','root');
        DEFINE('DB_HOST','localhost');
        DEFINE('DB_PASS','root');
        DEFINE('DB_NAME','childcare');

        $db_connection = mysqli_connect(DB_HOST, DB_USER,DB_PASS, DB_NAME) OR die("Could not connect toMySQL!".mysqli_connect_error());

        // if(!(empty($db_connection)));//echo nl2br("connection completed\n");

        // else echo "not connected";

        if(!mysqli_select_db($db_connection,'childcare')) die("Unable to select database" .mysqli_error());

        mysqli_set_charset($db_connection,'utf8');
    ?>
</body>
</html>
