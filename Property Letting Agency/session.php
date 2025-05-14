<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<body>
    <?php

// Start the session 
session_start();
// if the user is already logged in then redirect user to welcome page
if (isset($_SESSION["email"]) && $_SESSION["email"]) {
header("location: index.php"); 
exit;
}
?>
</body>

</html>