<?php
// Database connection
require_once ('../../connection.php');

// Initialize variables for form data
$username = $password = $confirm_password = "";
$account_type = "user"; // Default account type is user
$error = "";

// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Validate form data
    $username = $_POST['username'];
    $password = $_POST['password'];
    $confirm_password = $_POST['confirm_password'];
    $account_type = $_POST['account_type']; // Get selected account type

    // Check if passwords match
    if ($password != $confirm_password) {
        $error = "Passwords do not match.";
    } else {
        // Hash the password
        $hashed_password = password_hash($password, PASSWORD_DEFAULT);

        // Insert new user, landlord, or admin into the database based on the selected account type
        if ($account_type == "admin") {
            $sql = "INSERT INTO admins (username, password) VALUES (?, ?)";
        } elseif ($account_type == "landlord") {
            // Adjust the SQL query to include placeholders for the landlord account details
            $sql = "INSERT INTO landlord_account (landlord_id, rental_income, commission, management_fee) VALUES (?, ?, ?, ?)";
        } else {
            $sql = "INSERT INTO users (username, password) VALUES (?, ?)";
        }

        // Prepare the SQL statement
        $stmt = $db_connection->prepare($sql);

        // Check if the statement preparation was successful
        if ($stmt) {
            // If the account type is landlord, bind the parameters accordingly
            if ($account_type == "landlord") {
                // Assuming landlord_id is automatically generated (e.g., AUTO_INCREMENT)
                $landlord_id = null; // Assuming it's an AUTO_INCREMENT column
                $rental_income = 0; // Sample default value for rental_income
                $commission = 0; // Sample default value for commission
                $management_fee = 0; // Sample default value for management_fee
                $stmt->bind_param("iddd", $landlord_id, $rental_income, $commission, $management_fee);
            } else {
                // For other account types (e.g., user, admin), bind only username and hashed password
                $stmt->bind_param("ss", $username, $hashed_password);
            }

            // Execute the statement
            if ($stmt->execute()) {
                // Redirect to login page after successful registration
                header("Location: login.php");
                exit();
            } else {
                $error = "Error executing the query: " . $stmt->error;
            }

            // Close the statement
            $stmt->close();
        } else {
            $error = "Error preparing the statement: " . $db_connection->error;
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
  <link rel="stylesheet" type="text/css" href="style.css">
    <meta charset="UTF-8">
    <title>User Registration</title>
</head>
<body>
    <h2>Registration</h2>
    <?php if (!empty($error)) { ?>
        <p style="color: red;"><?php echo $error; ?></p>
    <?php } ?>
    <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
        <label  for="username">Username:</label><br>
        <input  class="form-control" id="floatingInput" type="text" id="username" name="username" required><br><br>
        <label  for="password">Password:</label><br>
        <input  class="form-control" id="floatingInput" type="password" id="password" name="password" required><br><br>
        <label  for="confirm_password">Confirm Password:</label><br>
        <input  class="form-control" id="floatingInput" type="password" id="confirm_password" name="confirm_password" required><br><br>
        <label for="account_type">Account Type:</label><br>
        <select id="account_type" name="account_type">
            <option value="user">User</option>
            <option value="admin">Admin</option>
            <option value="landlord">Landlord</option>
        </select><br><br>
        <button  class="btn btn-success" type="submit">Register</button>
    </form>
</body>
</html>

