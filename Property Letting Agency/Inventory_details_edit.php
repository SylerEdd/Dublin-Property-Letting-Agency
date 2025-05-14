<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);


include("header.php");
     include("search.php");

$inID = "";
$item1 = "";
$item2 = "";
$item3 = "";
$item4 = "";
$totalCost = "";
$prID = "";
$errors = []; // Define the $errors array

$inID = $_GET["inID"] ?? '';

$sql = "SELECT * FROM Inventory_details WHERE inID = ?";
$stmt = $db_connection->prepare($sql);
$stmt->bind_param("i", $inID);
$stmt->execute();
$result = $stmt->get_result();
$row = $result->fetch_assoc();

if (!$row) {
    header("location: Inventory_details.php");
    exit;
}

$item1 = $row["item1"];
$item2 = $row["item2"];
$item3 = $row["item3"];
$item4 = $row["item4"];
$totalCost = $row["totalCost"];
$prID = $row["prID"];

if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['edit'])) {

    $item1 = $_POST["item1"];
    $item2 = $_POST["item2"];
    $item3 = $_POST["item3"];
    $item4 = $_POST["item4"];
    $totalCost = $_POST["totalCost"];
    $prID = $_POST["prID"];

    // Validate form inputs
    // $errors = validateInputs($_POST);

    if (empty($errors)) {
        $sql = "UPDATE inventory_details SET item1 = ?, item2 = ?, item3 = ?, item4 = ?, totalCost = ?, prID = ? WHERE inID = ?";
        $stmt = $db_connection->prepare($sql);
        $stmt->bind_param("ssssisi", $item1, $item2, $item3, $item4, $totalCost, $prID, $inID);
        $result = $stmt->execute();

        if ($result) {
            $successMessage = "Inventory updated successfully";

        } else {
            $errorMessage = "Invalid query: " . $db_connection->error;
        }
    } else {
        $errorMessage = implode("<br>", $errors);
    }
}

//Function to validate form inputs
function validateInputs($input)
{
    global $db_connection;
    $errors = [];
    // Validate each input field
    if (empty($input['item1'])) {
        $errors[] = "Please fill in item1.";
    }
    if (empty($input['item2'])) {
        $errors[] = "Please fill in item2.";
    }
    if (empty($input['item3'])) {
        $errors[] = "Please fill in item3.";
    }
    if (empty($input['item4'])) {
        $errors[] = "Please fill in item4.";
    }
    if (empty($input['totalCost'])) {
        $errors[] = "Please fill in totalCost.";
    }
    if (empty($input['prID'])) {
        $errors[] = "Please enter Property ID.";
    } else {
        $prID = $input['prID'];
        $sql = "SELECT prID FROM property WHERE prID = ?";
        $stmt = $db_connection->prepare($sql);
        $stmt->bind_param("s", $prID);
        $stmt->execute();
        $result = $stmt->get_result();
        if ($result && $result->num_rows > 0) {
            $errors[] = "Property ID '$prID' exists in the database.";
        } else {
            $errors[] = "Property ID '$prID' does not exist in the database.";
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
                                            <h4 class="mb-4 pb-3">Edit Inventory below</h4>

                                            <?php
                                            if (!empty($errorMessage)) {
                                                echo "
                                                <div class='alert alert-warning alert-dismissible fade show' role='alert'>
                                                <strong>$errorMessage</strong>
                                                <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button>
                                                </div>";
                                            }
                                            ?>

                                            <form
                                                action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']) . "?inID=" . $inID; ?>"
                                                method="POST" class="mt-5" novalidate>
                                                <input type="hidden" name="inID" value="<?php echo $inID; ?>">
                                                <div class="row mb-3">
                                                    <label class="col-sm-3 col-form-label">Item 1:</label>
                                                    <i class="input-icon uil uil-at"></i>
                                                    <div class="col-sm-6">
                                                        <input type="text" class="form-control" name="item1"
                                                            value="<?php echo $item1; ?>" required>
                                                    </div>
                                                </div>
                                                <div class="row mb-3">
                                                    <label class="col-sm-3 col-form-label">Item 2:</label>
                                                    <i class="input-icon uil uil-at"></i>
                                                    <div class="col-sm-6">
                                                        <input type="text" class="form-control" name="item2"
                                                            value="<?php echo $item2; ?>" required>
                                                    </div>
                                                </div>
                                                <div class="row mb-3">
                                                    <label class="col-sm-3 col-form-label">Item 3:</label>
                                                    <i class="input-icon uil uil-at"></i>
                                                    <div class="col-sm-6">
                                                        <input type="text" class="form-control" name="item3"
                                                            value="<?php echo $item3; ?>" required>
                                                    </div>
                                                </div>
                                                <div class="row mb-3">
                                                    <label class="col-sm-3 col-form-label">Item 4:</label>
                                                    <i class="input-icon uil uil-at"></i>
                                                    <div class="col-sm-6">
                                                        <input type="text" class="form-control" name="item4"
                                                            value="<?php echo $item4; ?>" required>
                                                    </div>
                                                </div>
                                                <div class="row mb-3">
                                                    <label class="col-sm-3 col-form-label">Total Cost:</label>
                                                    <i class="input-icon uil uil-at"></i>
                                                    <div class="col-sm-6">
                                                        <input type="number" class="form-control" name="totalCost"
                                                            value="<?php echo $totalCost; ?>" required>
                                                    </div>
                                                </div>
                                                <div class="row mb-3">
                                                    <label class="col-sm-3 col-form-label">Property ID:</label>
                                                    <i class="input-icon uil uil-at"></i>
                                                    <div class="col-sm-6">
                                                        <input type="text" class="form-control" name="prID"
                                                            value="<?php echo $prID; ?>" required>
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
                                                        <button type="submit" name="edit"
                                                            class="btn btn-primary">Submit</button>
                                                    </div>
                                                </div>
                                                <div class="row mb-3">
                                                    <div class="offset-sm-3 col-sm-3 d-grid">
                                                        <a class="btn btn-outline-primary" href="Inventory_details.php"
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
