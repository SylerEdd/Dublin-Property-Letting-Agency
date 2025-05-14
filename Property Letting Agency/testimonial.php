<?php
session_start();
include_once("header.php");
     include("search.php");

// Check if user is not logged in
if (!isset($_SESSION['user_id']) && !isset($_SESSION['admin_id'])) {
    // Redirect to login page
    header("Location: login.php");
    exit();
}

// Database connection
                   

// Fetch testimonials from the database
$sql = "SELECT * FROM testimonials";
$result = $db_connection->query($sql);

// Include header
include_once 'header.php';
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Testimonials</title>
    <style>
        /* Add your CSS styles for testimonials here */
    </style>
</head>
<body>
    <h2>Testimonials</h2>

    <?php
    // Check if user is authenticated
    if (isset($_SESSION['user_id']) || isset($_SESSION['admin_id'])) {
        // Display Add Testimonial button
        echo '<a href="testimonial_add.php" class="add-testimonial-button">Add Testimonial</a>';
    }
    ?>

    <table>
        <tr>
            <th>Service Name</th>
            <th>Date</th>
            <th>Comment</th>
        </tr>

        <?php
        // Check if testimonials exist
        if ($result->num_rows > 0) {
            // Output testimonials
            while ($row = $result->fetch_assoc()) {
                echo "<tr>";
                echo "<td>{$row['service_name']}</td>";
                echo "<td>{$row['date']}</td>";
                echo "<td>{$row['comment']}</td>";
                echo "</tr>";
            }
        } else {
            echo "<tr><td colspan='3'>No testimonials available.</td></tr>";
        }
        ?>
    </table>
</body>
</html>

