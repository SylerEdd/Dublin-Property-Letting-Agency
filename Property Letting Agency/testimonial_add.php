<?php
// Start session
session_start();
include("header.php");
     include("search.php");

// Check if user is not logged in
if (!isset($_SESSION['user_id'])) {
    // Redirect to login page
    header("Location: login.php");
    exit();
}

// Check if the user is a landlord or user
if (!isset($_SESSION['user_id']) && !isset($_SESSION['admin_id']) && !isset($_SESSION['landlord_id'])) {
    // Redirect to login page
    header("Location: login.php");
    exit();
}

// Process form submission
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['service_name'], $_POST['comment'])) {
    // Validate inputs
    $service_name = $_POST['service_name'];
    $comment = $_POST['comment'];
    $user_id = $_SESSION['user_id'];

    // Insert testimonial into database
    // require 'connection.php'; // Require database connection
    $sql = "INSERT INTO testimonials (service_name, comment, user_id, date) VALUES (?, ?, ?, NOW())";
    $stmt = $db_connection->prepare($sql);
    if ($stmt) {
        $stmt->bind_param("ssi", $service_name, $comment, $user_id);
        if ($stmt->execute()) {
            $success_message = "Testimonial added successfully.";
        } else {
            $error_message = "Error: " . $stmt->error;
        }
        $stmt->close();
    } else {
        $error_message = "Error preparing statement: " . $db_connection->error;
    }
    $db_connection->close();
}


?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Add Testimonial</title>
</head>
<body>
    <h2>Add Testimonial</h2>
    <?php if (isset($success_message)) { ?>
        <p style="color: green;"><?php echo $success_message; ?></p>
    <?php } ?>
    <?php if (isset($error_message)) { ?>
        <p style="color: red;"><?php echo $error_message; ?></p>
    <?php } ?>
    <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
        <label for="service_name">Service Name:</label><br>
        <input type="text" id="service_name" name="service_name" required><br><br>
        <label for="comment">Comment:</label><br>
        <textarea id="comment" name="comment" rows="4" required></textarea><br><br>
        <button type="submit">Submit Testimonial</button>
    </form>
</body>
</html>

