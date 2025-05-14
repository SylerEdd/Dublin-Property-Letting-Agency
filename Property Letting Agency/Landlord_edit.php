<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);


include("header.php");
     include("search.php");

$lID = "";
$name = "";
$password = "";
$email = "";
$income = "";
$commission = "";
$management_fee = ""; // Fixed typo here
$prID = "";
$errors = []; // Define the $errors array

$lID = $_GET["lID"] ?? '';

$sql = "SELECT * FROM Landlord WHERE lID = ?";
$stmt = $db_connection->prepare($sql);
$stmt->bind_param("i", $lID);
$stmt->execute();
$result = $stmt->get_result();
$row = $result->fetch_assoc();

if (!$row) {
    header("location: Landlord.php");
    exit;
}

$name = $row["name"];
$password = $row["password"];
$email = $row["email"];
$income = $row["income"];
$commission = $row["commission"];
$management_fee = $row["management_fee"];
$prID = $row["prID"];

if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['submit'])) {

    $name = $_POST["name"];
    $password = $_POST["password"];
    $email = $_POST["email"];
    $income = $_POST["income"];
    $commission = $_POST["commission"];
    $management_fee = $_POST["management_fee"]; // Fixed typo here
    $prID = $_POST["prID"];

    // Validate form inputs
    $errors = validateInputs($_POST);

    if (empty($errors)) {
        $sql = "UPDATE Landlord SET name = ?, password = ?, email = ?, income = ?, commission = ?, management_fee = ?, prID = ? WHERE lID = ?";
        $stmt = $db_connection->prepare($sql);
        $stmt->bind_param("ssssisii", $name, $password, $email, $income, $commission, $management_fee, $prID, $lID);
        $result = $stmt->execute();

        if ($result) {
            $successMessage = "Landlord updated successfully";

        } else {
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
    // Validate each input field
    if (empty($input['name'])) {
        $errors[] = "Please enter a valid name.";
    } else {
        $name = $input['name'];
        if (!preg_match("/^[a-zA-Z\s]+$/", $name)) {
            $errors[] = "Please enter a valid name with only alphabetic characters and spaces.";
        } else {
            $sql = "SELECT name FROM Landlord WHERE name = ?";
            $stmt = $db_connection->prepare($sql);
            $stmt->bind_param("s", $name);
            $stmt->execute();
            $result = $stmt->get_result();
            if ($result && $result->num_rows > 0) {
                $errors[] = "Landlord name '$name' exists in the database.";
            }
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
                                        <h4 class="mb-4 pb-3">Edit Landlord below</h4>

                                        <?php
                                        if (!empty($errorMessage)) {
                                            echo "
                                            <div class='alert alert-warning alert-dismissible fade show' role='alert'>
                                                <strong>$errorMessage</strong>
                                                <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button>
                                            </div>";
                                        }
                                        ?>

                                        <form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']) . "?lID=" . $lID; ?>" method="POST" class="mt-5" novalidate>
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
                                                    <input type="password" class="form-control" name="password" value="<?php echo $password; ?>"
                                                           required>
                                                </div>
                                            </div>
                                            <div class="row mb-3">
                                                <label class="col-sm-3 col-form-label">Email:</label>
                                                <i class="input-icon uil uil-at"></i>

                                                <div class="col-sm-6">
                                                    <input type="email" class="form-control" name="email" value="<?php echo $email; ?>"
                                                           required>
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
                                                    <input type="number" class="form-control" name="commission" value="<?php echo $commission; ?>"
                                                           required>
                                                </div>
                                            </div>
                                            <div class="row mb-3">
                                                <label class="col-sm-3 col-form-label">Management Fee;</label>
                                                <i class="input-icon uil uil-at"></i>

                                                <div class="col-sm-6">
                                                    <input type="number" class="form-control" name="management_fee"
                                                           value="<?php echo $management_fee; ?>" required>
                                                </div>
                                            </div>
                                            <div class="row mb-3">
                                                <label class="col-sm-3 col-form-label">Property ID:</label>
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
                                                    <button type="submit" name="submit" class="btn btn-primary">Submit</button>
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