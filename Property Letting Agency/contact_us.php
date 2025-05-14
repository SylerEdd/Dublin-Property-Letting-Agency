<?php
// Start session
session_start();
include("header.php");
     include("search.php");

// Process form submission
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Validate inputs
    $email = trim($_POST['email']);
    $message = trim($_POST['message']);

    // Validate email and message are not empty
    if (empty($email) || empty($message)) {
        $error_message = "Email and message are required fields.";
    } else {
        // Insert message into database
        require 'connection.php';

        $sql = "INSERT INTO messages (email, message) VALUES (?, ?)";
        $stmt = $conn->prepare($sql);
        if ($stmt) {
            $stmt->bind_param("ss", $email, $message);
            if ($stmt->execute()) {
                $success_message = "Message sent successfully. We'll get back to you soon!";
                // Clear form fields
                $email = $message = "";
            } else {
                $error_message = "Failed to send message. Please try again later.";
            }
            $stmt->close();
        } else {
            $error_message = "Error preparing statement: " . $conn->error;
        }

        $conn->close();
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Contact Us</title>
</head>
<body>
    <h2>Contact Us</h2>
    <?php if (isset($success_message)) { ?>
        <p style="color: green;"><?php echo $success_message; ?></p>
    <?php } ?>
    <?php if (isset($error_message)) { ?>
        <p style="color: red;"><?php echo $error_message; ?></p>
    <?php } ?>
    <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
        <label for="email">Email:</label><br>
        <input type="email" id="email" name="email" value="<?php echo isset($email) ? $email : ''; ?>" required><br><br>
        <label for="message">Message:</label><br>
        <textarea id="message" name="message" rows="4" required><?php echo isset($message) ? $message : ''; ?></textarea><br><br>
        <button type="submit">Submit</button>
    </form>
</body>
</html>

