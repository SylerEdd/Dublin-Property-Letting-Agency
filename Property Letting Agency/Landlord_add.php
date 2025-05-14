<?php
include("header.php");
     include("search.php");

$lID = "";
$name = "";
$password = "";
$email = "";
$income = "";
$commission = "";
$management_fee = "";
$prID = "";

$errorMessage = "";
$successMessage = "";

if ($_SERVER['REQUEST_METHOD'] == 'POST') {

    $name = $_POST["name"];
    $password = $_POST["password"];
    $email = $_POST["email"];
    $income = $_POST["income"];
    $commission = $_POST["commission"];
    $management_fee = $_POST["management_fee"];
    $prID = $_POST["prID"];

    // Validate form inputs
    $errors = validateInputs($_POST);

    if (empty($errors)) {

        $sql = "INSERT INTO Landlord (name, password, email, income, commission, management_fee, prID) " .
            "VALUES ('$name', '$password', '$email', '$income', '$commission', '$management_fee', '$prID')";

        $result = $db_connection->query($sql);

        if ($result) {
            $successMessage = "Landlord Created";
            $name = $password = $email = $income = $commission = $management_fee = $prID = "";

        } else {
            $errorMessage = "Error: " . $db_connection->error;

        }
    } else {
        $errorMessage = implode("<br>", $errors);
    }
}

// Function to validate form inputs
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
            $sql = "SELECT name FROM Landlord WHERE name = '$name'";
            $result = $db_connection->query($sql);
            if ($result && $result->num_rows > 0) {
                $errorMessage .= "Landlord name '$name' exists in the database.";
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
            $sql = "SELECT email FROM Landlord WHERE email = '$email'";
            $result = $db_connection->query($sql);
            if ($result && $result->num_rows > 0) {
                $errorMessage .= "Email '$email' exists in the database.";
            }
        }
    }
    if (empty($input['income'])) {
        $errors[] = "Please fill in income.";
    }
    if (empty($input['commission'])) {
        $errors[] = "Please fill in commission.";
    }
    if (empty($input['management_fee'])) {
        $errors[] = "Please fill in management_fee.";
    }
    if (empty($input['prID'])) {
        $errors[] = "Please enter Property ID.";
    } else {
        $prID = $input['prID'];
        $sql = "SELECT prID FROM property WHERE prID = '$prID'";
        $result = $db_connection->query($sql);
        if ($result && $result->num_rows > 0) {
            $errorMessage .= "Property ID '$prID' exists in the database.";
        } else {
            $errorMessage .= "Property ID '$prID' does not exist in the database.";
        }
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
                                            <h4 class="mb-4 pb-3">Add Landlord below</h4>
                                            <?php
                                            if (!empty($errorMessage)) {
                                                echo "
                                                <div class='alert alert-warning alert-dismissible fade show' role='alert'>
                                                    <strong>$errorMessage</strong>
                                                    <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button>
                                                </div>";
                                            }
                                            ?>
                                            <form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="post" class="mt-5" novalidate>
                                                <input type="hidden" name="lID" value="<?php echo $lID; ?>">
                                                <div class="row mb-3">
                                                    <label class="col-sm-3 col-form-label">Name:</label>
                                                    <i class="input-icon uil uil-at"></i>
                                                    <div class="col-sm-6">
                                                        <input type="text" class="form-control" name="name" value="<?php echo $name; ?>" required>
                                                    </div>
                                                </div>
                                                <div class="row mb-3">
                                                    <label class="col-sm-3 col-form-label">Password:</label>
                                                    <i class="input-icon uil uil-at"></i>
                                                    <div class="col-sm-6">
                                                        <input type="password" class="form-control" name="password" value="<?php echo $password; ?>" required>
                                                    </div>
                                                </div>
                                                <div class="row mb-3">
                                                    <label class="col-sm-3 col-form-label">Email:</label>
                                                    <i class="input-icon uil uil-at"></i>
                                                    <div class="col-sm-6">
                                                        <input type="email" class="form-control" name="email" value="<?php echo $email; ?>" required>
                                                    </div>
                                                </div>
                                                <div class="row mb-3">
                                                    <label class="col-sm-3 col-form-label">Income:</label>
                                                    <i class="input-icon uil uil-at"></i>
                                                    <div class="col-sm-6">
                                                        <input type="number" class="form-control" name="income" value="<?php echo $income; ?>" required>
                                                    </div>
                                                </div>
                                                <div class="row mb-3">
                                                    <label class="col-sm-3 col-form-label">Commission:</label>
                                                    <i class="input-icon uil uil-at"></i>
                                                    <div class="col-sm-6">
                                                        <input type="number" class="form-control" name="commission" value="<?php echo $commission; ?>" required>
                                                    </div>
                                                </div>
                                                <div class="row mb-3">
                                                    <label class="col-sm-3 col-form-label">Management Fee</label>
                                                    <i class="input-icon uil uil-at"></i>
                                                    <div class="col-sm-6">
                                                        <input type="number" class="form-control" name="management_fee" value="<?php echo $management_fee; ?>" required>
                                                    </div>
                                                </div>
                                                <div class="row mb-3">
                                                    <label class="col-sm-3 col-form-label">Propery ID:</label>
                                                    <i class="input-icon uil uil-at"></i>
                                                    <div class="col-sm-6">
                                                        <input type="text" class="form-control" name="prID" value="<?php echo $prID; ?>" required>
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
                                                        <button type="submit" class="btn btn-primary">Submit</button>
                                                    </div>
                                                </div>
                                                <div class="row mb-3">
                                                    <div class="offset-sm-3 col-sm-3 d-grid">
                                                        <a class="btn btn-outline-primary" href="Landlord.php" role="button">Cancel</a>
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

