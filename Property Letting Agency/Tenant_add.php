<?php
include("header.php");
     include("search.php");

$tID = $name = $password = $email = $monthly_fee = $lenght_tenancy = $tenancy_agreement = $start_date = $end_date = $amount_paid = $amount_owed = '';
$errorMessage = $successMessage = '';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $name = $_POST["name"];
    $password = $_POST["password"];
    $email = $_POST["email"];
    $monthly_fee = $_POST["monthly_fee"];
    $lenght_tenancy = $_POST["lenght_tenancy"];
    $tenancy_agreement = $_POST["tenancy_agreement"];
    $start_date = $_POST["start_date"];
    $end_date = $_POST["end_date"];
    $amount_paid = $_POST["amount_paid"];
    $amount_owed = $_POST["amount_owed"];

    $errors = validateInputs($_POST);

    if (empty($errors)) {
        $sql = "INSERT INTO Tenant (name, password, email, monthly_fee, lenght_tenancy, tenancy_agreement, start_date, end_date, amount_paid, amount_owed) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";
        $stmt = $db_connection->prepare($sql);
        $stmt->bind_param("ssssssssss", $name, $password, $email, $monthly_fee, $lenght_tenancy, $tenancy_agreement, $start_date, $end_date, $amount_paid, $amount_owed);
        $result = $stmt->execute();

        if ($result) {
            $successMessage = "Tenant Created";
            // Clear form fields after successful submission
            $name = $password = $email = $monthly_fee = $lenght_tenancy = $tenancy_agreement = $start_date = $end_date = $amount_paid = $amount_owed = '';
        } else {
            $errorMessage = "Failed to create tenant: " . $stmt->error;
        }
    } else {
        $errorMessage = implode("<br>", $errors);
    }
}

function validateInputs($input)
{
    $errors = [];

    if (empty($input['name'])) {
        $errors[] = "Please enter a valid name.";
    }

    if (empty($input['password'])) {
        $errors[] = "Please enter a password.";
    }

    if (empty($input['email'])) {
        $errors[] = "Please enter an email address.";
    } elseif (!filter_var($input['email'], FILTER_VALIDATE_EMAIL)) {
        $errors[] = "Please enter a valid email address.";
    }

    if (empty($input['monthly_fee'])) {
        $errors[] = "Please fill in monthly fee.";
    } elseif (!is_numeric($input['monthly_fee']) || $input['monthly_fee'] <= 0) {
        $errors[] = "Monthly fee must be a positive number.";
    }

    if (empty($input['lenght_tenancy'])) {
        $errors[] = "Please fill in tenancy length.";
    } // Add further validation if necessary

    if (empty($input['tenancy_agreement'])) {
        $errors[] = "Please fill in tenancy agreement details.";
    } // Add further validation if necessary

    if (empty($input['start_date'])) {
        $errors[] = "Please enter a starting date.";
    } elseif (strtotime($input['start_date']) === false || strtotime($input['start_date']) < strtotime('today')) {
        $errors[] = "Please enter a valid starting date that is today or later.";
    }

    if (empty($input['end_date'])) {
        $errors[] = "Please enter an ending date.";
    } elseif (strtotime($input['end_date']) === false || strtotime($input['end_date']) < strtotime('today')) {
        $errors[] = "Please enter a valid ending date that is today or later.";
    } elseif (strtotime($input['end_date']) <= strtotime($input['start_date'])) {
        $errors[] = "The ending date must be later than the starting date.";
    }

    if (empty($input['amount_paid'])) {
        $errors[] = "Please fill in the amount paid.";
    } elseif (!is_numeric($input['amount_paid']) || $input['amount_paid'] < 0) {
        $errors[] = "Amount paid must be a non-negative number.";
    }

    if (empty($input['amount_owed'])) {
        $errors[] = "Please fill in the amount owed.";
    } elseif (!is_numeric($input['amount_owed']) || $input['amount_owed'] < 0) {
        $errors[] = "Amount owed must be a non-negative number.";
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
                                            <h4 class="mb-4 pb-3">Add Tenant below</h4>

                                            <?php if (!empty($errorMessage)): ?>
                                                <div class="alert alert-warning alert-dismissible fade show" role="alert">
                                                    <strong><?php echo $errorMessage; ?></strong>
                                                    <button type="button" class="btn-close" data-bs-dismiss="alert"
                                                        aria-label="Close"></button>
                                                </div>
                                            <?php endif; ?>

                                            <?php if (!empty($successMessage)): ?>
                                                <div class="alert alert-success alert-dismissible fade show" role="alert">
                                                    <strong><?php echo $successMessage; ?></strong>
                                                    <button type="button" class="btn-close" data-bs-dismiss="alert"
                                                        aria-label="Close"></button>
                                                </div>
                                            <?php endif; ?>

                                            <form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>"
                                                method="post" class="mt-5" novalidate>
                                                <input type="hidden" name="tID" value="<?php echo $tID; ?>">
                                                <div class="row mb-3">
                                                    <label class="col-sm-3 col-form-label">Name:</label>
                                                    <div class="col-sm-6">
                                                        <input type="text" class="form-control" name="name"
                                                            value="<?php echo $name; ?>" required>
                                                    </div>
                                                </div>
                                                <div class="row mb-3">
                                                    <label class="col-sm-3 col-form-label">Password:</label>
                                                    <div class="col-sm-6">
                                                        <input type="password" class="form-control" name="password"
                                                            value="<?php echo $password; ?>" required>
                                                    </div>
                                                </div>
                                                <div class="row mb-3">
                                                    <label class="col-sm-3 col-form-label">Email:</label>
                                                    <div class="col-sm-6">
                                                        <input type="email" class="form-control" name="email"
                                                            value="<?php echo $email; ?>" required>
                                                    </div>
                                                </div>
                                                <div class="row mb-3">
                                                    <label class="col-sm-3 col-form-label">Monthly Fee:</label>
                                                    <div class="col-sm-6">
                                                        <input type="number" class="form-control" name="monthly_fee"
                                                            value="<?php echo $monthly_fee; ?>" required>
                                                    </div>
                                                </div>
                                                <div class="row mb-3">
                                                    <label class="col-sm-3 col-form-label">Tenancy Length:</label>
                                                    <div class="col-sm-6">
                                                        <input type="text" class="form-control" name="lenght_tenancy"
                                                            value="<?php echo $lenght_tenancy; ?>" required>
                                                    </div>
                                                </div>
                                                <div class="row mb-3">
                                                    <label class="col-sm-3 col-form-label">Tenancy Agreement:</label>
                                                    <div class="col-sm-6">
                                                        <input type="text" class="form-control"
                                                            name="tenancy_agreement"
                                                            value="<?php echo $tenancy_agreement; ?>" required>
                                                    </div>
                                                </div>
                                                <div class="row mb-3">
                                                    <label class="col-sm-3 col-form-label">Start Date:</label>
                                                    <div class="col-sm-6">
                                                        <input type="date" class="form-control" name="start_date"
                                                            value="<?php echo $start_date; ?>" required>
                                                    </div>
                                                </div>
                                                <div class="row mb-3">
                                                    <label class="col-sm-3 col-form-label">End Date:</label>
                                                    <div class="col-sm-6">
                                                        <input type="date" class="form-control" name="end_date"
                                                            value="<?php echo $end_date; ?>" required>
                                                    </div>
                                                </div>
                                                <div class="row mb-3">
                                                    <label class="col-sm-3 col-form-label">Amount Paid:</label>
                                                    <div class="col-sm-6">
                                                        <input type="number" class="form-control" name="amount_paid"
                                                            value="<?php echo $amount_paid; ?>" required>
                                                    </div>
                                                </div>
                                                <div class="row mb-3">
                                                    <label class="col-sm-3 col-form-label">Amount Owed:</label>
                                                    <div class="col-sm-6">
                                                        <input type="number" class="form-control" name="amount_owed"
                                                            value="<?php echo $amount_owed; ?>" required>
                                                    </div>
                                                </div>
                                                <div class="row mb-3">
                                                    <div class="offset-sm-3 col-sm-3 d-grid">
                                                        <button type="submit" class="btn btn-primary">Submit</button>
                                                    </div>
                                                    <div class="col-sm-3 d-grid">
                                                        <a class="btn btn-outline-primary" href="Tenant.php"
                                                            role="button">Cancel</a>
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