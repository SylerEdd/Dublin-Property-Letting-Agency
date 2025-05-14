<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

include("header.php");
     include("search.php");

$tID = "";
$name = "";
$password = "";
$email = "";
$monthly_fee = "";
$length_tenancy = "";
$tenancy_agreement = "";
$start_date = "";
$end_date = "";
$amount_paid = "";
$amount_owed = "";

$errors = []; // Define the $errors array

$tID = $_GET["tID"] ?? '';

$sql = "SELECT * FROM tenant WHERE tID = ?";
$stmt = $db_connection->prepare($sql);
$stmt->bind_param("i", $tID);
$stmt->execute();
$result = $stmt->get_result();
$row = $result->fetch_assoc();

if (!$row) {
    header("location: Tenant.php");
    exit;
}

$name = $row["name"];
$password = $row["password"];
$email = $row["email"];
$monthly_fee = $row["monthly_fee"];
$length_tenancy = $row["length_tenancy"];
$tenancy_agreement = $row["tenancy_agreement"];
$start_date = $row["start_date"];
$end_date = $row["end_date"];
$amount_paid = $row["amount_paid"];
$amount_owed = $row["amount_owed"];

if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['edit'])) {

    $name = $_POST["name"];
    $password = $_POST["password"];
    $email = $_POST["email"];
    $monthly_fee = $_POST["monthly_fee"];
    $length_tenancy = $_POST["length_tenancy"];
    $tenancy_agreement = $_POST["tenancy_agreement"];
    $start_date = $_POST["start_date"];
    $end_date = $_POST["end_date"];
    $amount_paid = $_POST["amount_paid"];
    $amount_owed = $_POST["amount_owed"];

    // Validate form inputs
    // $errors = validateInputs($_POST);

    if (empty($errors)) {
        // Update the database
        $sql = "UPDATE Tenant SET name = ?, password = ?, email = ?, monthly_fee = ?, length_tenancy = ?, tenancy_agreement = ?, start_date = ?, end_date = ?, amount_paid = ?, amount_owed = ? WHERE tID = ?";
        $stmt = $db_connection->prepare($sql);
        $stmt->bind_param("ssssssssssi", $name, $password, $email, $monthly_fee, $length_tenancy, $tenancy_agreement, $start_date, $end_date, $amount_paid, $amount_owed, $tID);
        $result = $stmt->execute();

        if ($result) {
            $successMessage = "Tenant updated successfully";
        } else {
            // Error message for query if error with update
            $errorMessage = "Invalid query: " . $db_connection->error;
        }
    } else {
        $errorMessage = implode("<br>", $errors);
    }
}

function validateInputs($input)
{
    global $db_connection;
    $errors = [];
    if (empty($input['name'])) {
        $errors[] = "Please enter valid name.";
    } else {
        $name = $input['name'];
        if (!preg_match("/^[a-zA-Z\s]+$/", $name)) {
            $errors[] = "Please enter a valid name with only alphabetic characters and spaces.";
        } else {
            $sql = "SELECT name FROM Tenant WHERE name = '$name'";
            $result = $db_connection->query($sql);
            if ($result && $result->num_rows > 0) {
                $errorMessage .= "Tenant name '$name' exists in the database.";
            }
        }
    }
    if (empty($input['password'])) {
        $errors[] = "Please enter a password.";
    } else {
        $password = $input['password'];
        if (!preg_match("/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[@$!%*?&])[A-Za-z\d@$!%*?&]{8,}$/", $password)) {
            $errors[] = "Password must be at least 8 characters long and contain at least one uppercase letter, one lowercase letter, one number, and one special character.";
        }
    }
    if (empty($input['email'])) {
        $errors[] = "Please enter an email address.";
    } else {
        $email = $input['email'];
        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $errors[] = "Please enter a valid email address.";
        } else {
            $sql = "SELECT email FROM Tenant WHERE email = '$email'";
            $result = $db_connection->query($sql);
            if ($result && $result->num_rows > 0) {
                $errorMessage .= "Email '$email' exists in the database.";
            }
        }
    }
    if (empty($input['monthly_fee'])) {
        $errors[] = "Please fill in monthly_fee.";
    }
    if (empty($input['length_tenancy'])) {
        $errors[] = "Please fill in length_tenancy.";
    }
    if (empty($input['tenancy_agreement'])) {
        $errors[] = "Please fill in tenancy_agreement.";
    }
    if (empty($input['start_date'])) {
        $errors[] = "Please enter a starting date.";
    } else {
        $start_date = $input['start_date'];
        if (strtotime($start_date) === false || strtotime($start_date) < strtotime('today')) {
            $errors[] = "Please enter a valid starting date that is today or later.";
        }
    }
    if (empty($input['end_date'])) {
        $errors[] = "Please enter an ending date.";
    } else {
        $end_date = $input['end_date'];
        if (strtotime($end_date) === false || strtotime($end_date) < strtotime('today')) {
            $errors[] = "Please enter a valid ending date that is today or later.";
        } elseif (!empty($input['start_date']) && strtotime($end_date) <= strtotime($input['start_date'])) {
            $errors[] = "The ending date must be later than the starting date.";
        }
    }
    if (empty($input['amount_paid'])) {
        $errors[] = "Please fill in amount_paid.";
    }
    if (empty($input['amount_owed'])) {
        $errors[] = "Please fill in amount_owed.";
    }

    return $errors;
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://unicons.iconscout.com/release/v2.1.9/css/unicons.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.5.0/css/bootstrap.min.css">
    <link rel="stylesheet" href="editor.css">
</head>
<body>
    <div class="section">
        <div class="container">
            <div class="row full-height justify-content-center">
                <div class="col-12 text-center align-self-center py-5">
                    <div class="section pb-5 pt-5 pt-sm-2 text-center">
                        <input class="checkbox" type="checkbox" id="reg-log" name="reg-log" />
                        <label for="reg-log"></label>
                        <div class="card-3d-wrap mx-auto">
                            <div class="card-3d-wrapper">
                                <div class="card-front">
                                    <div class="center-wrap">
                                        <div class="section text-center">
                                            <h4 class="mb-4 pb-3">Edit Tenant Details</h4>
                                            <?php
                                            if (!empty($errorMessage)) {
                                                echo "
                                                <div class='alert alert-warning alert-dismissible fade show' role='alert'>
                                                    <strong>$errorMessage</strong>
                                                    <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button>
                                                </div>";
                                            }
                                            ?>
                                            <form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']) . "?tID=" . $tID; ?>" method="POST" class="mt-5" novalidate>
                                                <input type="hidden" name="tID" value="<?php echo $tID; ?>">
                                                <div class="row mb-3">
                                                    <label class="col-sm-3 col-form-label" for="name">Name:</label>
                                                    <div class="col-sm-6">
                                                        <input type="text" class="form-control" name="name" id="name" value="<?php echo $name; ?>" required>
                                                    </div>
                                                </div>
                                                <div class="row mb-3">
                                                    <label class="col-sm-3 col-form-label">Password:</label>
                                                    <div class="col-sm-6">
                                                        <input type="password" class="form-control" name="password" value="<?php echo $password; ?>" required>
                                                    </div>
                                                </div>
                                                <div class="row mb-3">
                                                    <label class="col-sm-3 col-form-label">Email:</label>
                                                    <div class="col-sm-6">
                                                        <input type="email" class="form-control" name="email" value="<?php echo $email; ?>" required>
                                                    </div>
                                                </div>
                                                <div class="row mb-3">
                                                    <label class="col-sm-3 col-form-label">Monthly Fee:</label>
                                                    <div class="col-sm-6">
                                                        <input type="number" class="form-control" name="monthly_fee" value="<?php echo $monthly_fee; ?>" required>
                                                    </div>
                                                </div>
                                                <div class="row mb-3">
                                                    <label class="col-sm-3 col-form-label">Length of Tenancy:</label>
                                                    <div class="col-sm-6">
                                                        <input type="text" class="form-control" name="length_tenancy" value="<?php echo $length_tenancy; ?>" required>
                                                    </div>
                                                </div>
                                                <div class="row mb-3">
                                                    <label class="col-sm-3 col-form-label">Tenancy Agreement:</label>
                                                    <div class="col-sm-6">
                                                        <input type="text" class="form-control" name="tenancy_agreement" value="<?php echo $tenancy_agreement; ?>" required>
                                                    </div>
                                                </div>
                                                <div class="row mb-3">
                                                    <label class="col-sm-3 col-form-label" required>Start Date:</label>
                                                    <div class="col-sm-6">
                                                        <input type="date" class="form-control" name="start_date" value="<?php echo $start_date; ?>" required>
                                                    </div>
                                                </div>
                                                <div class="row mb-3">
                                                    <label class="col-sm-3 col-form-label">End Date:</label>
                                                    <div class="col-sm-6">
                                                        <input type="date" class="form-control" name="end_date" value="<?php echo $end_date; ?>" required>
                                                    </div>
                                                </div>
                                                <div class="row mb-3">
                                                    <label class="col-sm-3 col-form-label">Amount Paid:</label>
                                                    <div class="col-sm-6">
                                                        <input type="number" class="form-control" name="amount_paid" value="<?php echo $amount_paid; ?>" required>
                                                    </div>
                                                </div>
                                                <div class="row mb-3">
                                                    <label class="col-sm-3 col-form-label">Amount Owed:</label>
                                                    <div class="col-sm-6">
                                                        <input type="number" class="form-control" name="amount_owed" value="<?php echo $amount_owed; ?>" required>
                                                    </div>
                                                </div>
                                                <?php
                                                if (!empty($successMessage)) {
                                                    echo "
                                                    <div class='row mb-3'>
                                                        <div class='offset-sm-3 col-sm-6'>
                                                            <div class='alert alert-success alert-dismissible fade show' role='alert'>
                                                                <strong>$successMessage</strong>
                                                                <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button>
                                                            </div>
                                                        </div>
                                                    </div>";
                                                }
                                                ?>
                                                <div class="row mb-3">
                                                    <div class="offset-sm-3 col-sm-3 d-grid">
                                                        <button type="submit" name="edit" class="btn btn-primary">Submit</button>
                                                    </div>
                                                </div>
                                                <div class="row mb-3">
                                                    <div class="offset-sm-3 col-sm-3 d-grid">
                                                        <a class="btn btn-outline-primary" href="Tenant.php" role="button">Cancel</a>
                                                    </div>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
</html>