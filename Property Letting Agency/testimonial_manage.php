<?php
// Start session
session_start();
include("header.php");
     include("search.php");

// Check if user is not logged in or not an admin
if (!isset($_SESSION['user_id']) || $_SESSION['user_type'] !== 'admin') {
    // Redirect to unauthorized page
    echo '<a href="http://localhost/Scripts/Ass3/index.php?error=unauthorized">Manage Testimonials</a>';
} else {
    // Otherwise, display the normal link
    echo '<a href="manage_testimonials.php">Manage Testimonials</a>';
}

// Retrieve testimonials from the database

$sql = "SELECT * FROM testimonials ORDER BY date DESC";
$result = $db_connection->query($sql);
$db_connection->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Manage Testimonials</title>
</head>
<body>
    <h2>Manage Testimonials</h2>
    <?php if ($result->num_rows > 0) { ?>
        <table>
            <tr>
                <th>Service Name</th>
                <th>Comment</th>
                <th>User ID</th>
                <th>Date</th>
                <th>Action</th>
            </tr>
            <?php while ($row = $result->fetch_assoc()) { ?>
                <tr>
                    <td><?php echo $row['service_name']; ?></td>
                    <td><?php echo $row['comment']; ?></td>
                    <td><?php echo $row['user_id']; ?></td>
                    <td><?php echo $row['date']; ?></td>
                    <td>
                        <form method="post" action="approve_testimonial.php">
                            <input type="hidden" name="testimonial_id" value="<?php echo $row['testimonial_id']; ?>">
                            <button type="submit">Approve</button>
                        </form>
                    </td>
                </tr>
            <?php } ?>
        </table>
    <?php } else { ?>
        <p>No testimonials available.</p>
    <?php } ?>
</body>
</html>

