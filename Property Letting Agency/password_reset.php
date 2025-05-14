<?php
session_start();
require 'connection.php';
include("header.php");

// Initialize variables
$error = '';

// Process password reset request
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST['username'];
    $email = $_POST['email'];

    // Check if username and email match in the database
    $sql = "SELECT id, username, email FROM users WHERE username = ? AND email = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ss", $username, $email);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows == 1) {
        // Generate a unique token
        $token = bin2hex(random_bytes(32));

        // Store the token in the database
        $user = $result->fetch_assoc();
        $user_id = $user['id'];
        $sql = "INSERT INTO password_resets (user_id, token, created_at) VALUES (?, ?, NOW())";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("is", $user_id, $token);
        if ($stmt->execute()) {
            // Send password reset email with token link
            $reset_link = "http://example.com/reset_password.php?token=$token";
            $to = $email;
            $subject = "Password Reset";
            $message = "Dear $username,\n\nPlease click the following link to reset your password:\n$reset_link\n\nIf you did not request this password reset, please ignore this email.\n\nRegards,\nThe Example Team";
            $headers = "From: admin@example.com";

            if (mail($to, $subject, $message, $headers)) {
                // Redirect to a confirmation page
                header("Location: password_reset_confirmation.php");
                exit();
            } else {
                $error = "Failed to send password reset email. Please try again later.";
            }
        } else {
            $error = "Failed to store password reset token. Please try again later.";
        }
    } else {
        $error = "Username and email do not match our records.";
    }
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Password Reset</title>
</head>
<body>
    <h2>Password Reset</h2>
    <?php if (!empty($error)) { ?>
        <p style="color: red;"><?php echo $error; ?></p>
    <?php } ?>
    <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
        <label for="username">Username:</label><br>
        <input type="text" id="username" name="username" required><br><br>
        <label for="email">Email:</label><br>
        <input type="email" id="email" name="email" required><br><br>
        <button type="submit">Submit</button>
    </form>
</body>
</html>

