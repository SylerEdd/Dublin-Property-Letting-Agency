<?php
session_start();

// Database connection (replace with your connection details)
require '../../connection.php';

// Initialize variables for form data
$username = $password = "";
$role = ""; // Variable to store selected role
$error = "";

// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Sanitize and validate form data
    $username = trim($_POST['username']);
    $password = $_POST['password'];
    $role = $_POST['role']; // Get selected role

    if ($role == "admin") {
        // Prepare and execute SQL statement to retrieve admin from database
        $admin_sql = "SELECT admin_id, username, password FROM admins WHERE username = ?";
        $admin_stmt = $db_connection->prepare($admin_sql);
        $admin_stmt->bind_param("s", $username);
        $admin_stmt->execute();
        $admin_result = $admin_stmt->get_result();

        // Check if admin exists and verify password
        if ($admin_result->num_rows == 1) {
            $row = $admin_result->fetch_assoc();
            // Check password before checking for admin existence
            if (password_verify($password, $row['password'])) {
                // Set session variables for admin
                $_SESSION['admin_id'] = $row['admin_id'];
                $_SESSION['username'] = $row['username'];
                // Redirect to admin dashboard
                header("Location: index.php");
                exit();
            } else {
                $error = "Invalid username or password.";
            }
        } else {
            $error = "Admin not found.";
        }

        $admin_stmt->close(); // Close admin statement
    } elseif ($role == "user") {
        // Prepare and execute SQL statement to retrieve user from database
        $user_sql = "SELECT user_id, username, password FROM users WHERE username = ?";
        $user_stmt = $db_connection->prepare($user_sql);
        $user_stmt->bind_param("s", $username);
        $user_stmt->execute();
        $user_result = $user_stmt->get_result();

        // Check if user exists and verify password
        if ($user_result->num_rows == 1) {
            $row = $user_result->fetch_assoc();
            if (password_verify($password, $row['password'])) {
                // Set session variables for user
                $_SESSION['user_id'] = $row['user_id'];
                $_SESSION['username'] = $row['username'];
                // Redirect to home page
                header("Location: index.php");
                exit();
            }
        }
        $user_stmt->close(); // Close user statement
    } elseif ($role == "landlord") {
        // Prepare and execute SQL statement to retrieve landlord from database
        $landlord_sql = "SELECT landlord_id, username, password FROM landlords WHERE username = ?";
        $landlord_stmt = $db_connection->prepare($landlord_sql);
        $landlord_stmt->bind_param("s", $username);
        $landlord_stmt->execute();
        $landlord_result = $landlord_stmt->get_result();

        // Check if landlord exists and verify password
        if ($landlord_result->num_rows == 1) {
            $row = $landlord_result->fetch_assoc();
            if (password_verify($password, $row['password'])) {
                // Set session variables for landlord
                $_SESSION['landlord_id'] = $row['landlord_id'];
                $_SESSION['username'] = $row['username'];
                // Redirect to home page
                header("Location: index.php");
                exit();
            }
        }
        $landlord_stmt->close(); // Close landlord statement
    }

    // If no matching user, admin, or landlord found or password doesn't match, set error message
    $error = "Invalid username or password.";
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Login</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" type="text/css" href="style.css">
</head>
<body>
  <div class="wrap">
    <h2>Login</h2>
    <?php if (!empty($error)) { ?>
        <p style="color: red;"><?php echo $error; ?></p>
    <?php } ?>
    <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
        <label for="username">Username:</label><br>
        <input  class="form-control" id="floatingInput" type="text" id="username" name="username" required><br>
        <label for="password">Password:</label><br>
        <input  class="form-control" id="floatingInput" type="password" id="password" name="password" required><br>
      </div>
      <div class="wrap2">
        <label for="role">Login as:</label><br>
        <input type="radio" id="admin" name="role" value="admin" required>
        <label for="admin">Admin</label><br>
        <input type="radio" id="user" name="role" value="user" required>
        <label for="user">User</label><br>
        <input type="radio" id="landlord" name="role" value="landlord" required>
        <label for="landlord">Landlord</label><br><br>
      </div><br><br>
        <button class="btn btn-success" type="submit">Login</button>
    </form>
    <a href="registration.php">Register</a> <!-- This is the Register button -->
    <a href="password_reset.php">Forgot Password?</a> <!-- This is the Forgot Password button -->
</body>
</html>

