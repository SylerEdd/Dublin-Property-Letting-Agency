<?php
session_start();
// Destroy session
session_destroy();
// Redirect to index page with logout message
header("Location: index.php?logout=true");
exit();
?>
