<?php
// Start session
session_start();
include("header.php");
     include("search.php");

// Check if user is not logged in or not an admin
if (!isset($_SESSION['admin_id'])) {
    // Redirect to unauthorized page or display an error message
    header("Location: login.php");
    exit();
}

// Retrieve messages from the database

$sql = "SELECT email, message FROM messages";
$result = $db_connection->query($sql);
$db_connection->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Contact Us Management</title>
</head>
<body>
    <h2>Contact Us Management</h2>
    <table border="1">
        <tr>
            <th>Email</th>
            <th>Message</th>
        </tr>
        <?php
        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                echo "<tr>";
                echo "<td>" . $row['email'] . "</td>";
                echo "<td>" . $row['message'] . "</td>";
                echo "</tr>";
            }
        } else {
            echo "<tr><td colspan='3'>No messages found.</td></tr>";
        }
        ?>
    </table>
</body>
</html>

