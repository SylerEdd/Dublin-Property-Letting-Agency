<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    
</head>

<body>
<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
// Set the SMTP server and port
ini_set("SMTP", "your_smtp_server_address");
ini_set("smtp_port", "your_smtp_port_number");

session_start();
// Include database connection file

include("header.php");
     include("search.php");

$type = $bedrooms = $tenancy_length = $description = $address = $eircode = $price = $furnished = $password = $confirm_password = $email = '';
$errors = [];

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Validate and sanitize input data
    $type = isset($_POST['type']) ? htmlspecialchars($_POST['type']) : '';
    $bedrooms = htmlspecialchars($_POST['bedrooms']);
    $tenancy_length = htmlspecialchars($_POST['tenancy_length']);
    $description = htmlspecialchars($_POST['description']);
    $address = htmlspecialchars($_POST['address']);
    $eircode = htmlspecialchars($_POST['eircode']);
    $price = htmlspecialchars($_POST['price']);
    $furnished = isset($_POST['furnished']) ? htmlspecialchars($_POST['furnished']) : 0; // Default to 0 if not furnished
    $password = htmlspecialchars($_POST['password']);
    $confirm_password = htmlspecialchars($_POST['confirm_password']);
    $email = htmlspecialchars($_POST['email']);

    // Perform validation
    if(isset($_POST['type'])){
        $type = $_POST['type'];
        // Checking if the user chose any of the options
        if($type === false){
            $errors[] = "Please select your Type.";
        }
    }

    // Address Validation
    if(isset($_POST['address'])){
        $address = $_POST['address'];
        if(empty($address)){
            // Address is empty
            $errors[] = "Please Enter your Address!";
        }
    }   

    // Email Validation
    if(isset($_POST['email'])){
        $email = $_POST['email'];
        // Check if email is valid
        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $errors[] = "Invalid email format";
        }
    } else {
        $errors[] = "Please enter your Email!";
    }

    // bedrooms Validation
    if(isset($_POST['bedrooms'])){
        $bedrooms = $_POST['bedrooms'];
        if(empty($bedrooms)){
            // bedrooms is empty
            $errors[] = "Please Enter your Bedrooms!";
        }
    }  
    // confirm_password Validation
    if(isset($_POST['confirm_password'])){
        $confirm_password = $_POST['confirm_password'];
        if(empty($confirm_password)){
            // confirm_password is empty
            $errors[] = "Please Enter your Confirm Password!";
        }
    } 
    // password Validation
    if(isset($_POST['password'])){
        $password = $_POST['password'];
        if(empty($password)){
            // Password is empty
            $errors[] = "Please Enter your Password!";
        }
    }  
    
    
    // price Validation
    if(isset($_POST['price'])){
        $price = $_POST['price'];
        if(empty($price)){
            // price is empty
            $errors[] = "Please Enter your Price!";
        }
    } 
    // description Validation
    if(isset($_POST['description'])){
        $description = $_POST['description'];
        if(empty($description)){
            // description is empty
            $errors[] = "Please Enter your Description!";
        }
    } 

    // Eircode Validation
    if(isset($_POST['eircode'])){
        // First, sanitize the eircode input
        $eircode = $_POST['eircode'];
        // Then validate if the sanitized eircode is a valid eircode format
        // '/^D(0[1-9]|1[0-9]|2[0-4]|6W)\s?[A-Z][0-9][A-Z0-9]{2}$/' i used this as you gave me but it was not working on my eircode which is D08 AN2H so i changed it
        if(!preg_match('/^D(0[1-9]|1[0-9]|2[0-4]|6W)\s?[A-Z][A-Z0-9]{3}$/', $eircode)){
            $errors[] = "Enter Valid Eircode!";
        }
    }

    // Ensure passwords match
    if ($password !== $confirm_password) {
        $errors[] = "Error: Passwords do not match.";
    }


    // If there are errors, display them
    if (!empty($errors)) {
        foreach ($errors as $error) {
            $errors = "Error: $error";
            
        }
    } else {
        // Process form submission
        // Handle file uploads
        $target_dir = "property_photos/";
        $target_files = array();
        foreach ($_FILES["photos"]["tmp_name"] as $key => $tmp_name) {
            $target_file = $target_dir . basename($_FILES["photos"]["name"][$key]);
            move_uploaded_file($tmp_name, $target_file);
            $target_files[] = $target_file;
        }

        // Prepare SQL statement to insert property details
        $sql_property = "INSERT INTO property (type, bedrooms, address, eircode, price, furnished, length_of_tenancy, description, photo_path)
                VALUES ('$type', '$bedrooms', '$address', '$eircode', '$price', '$furnished', '$tenancy_length', '$description','". implode(",", $target_files) . "')";

        // Execute SQL statement for property database
        if ($db_connection->query($sql_property) === TRUE) {
            // Get the ID of the last inserted record
            $property_id = $db_connection->insert_id;

            // Prepare SQL statement to update landlord details 
            $sql_landlord = "UPDATE Landlord SET prID = ? WHERE email = ?";

            // Prepare the statement
            $stmt = $db_connection->prepare($sql_landlord);

            // Bind the parameters
            $stmt->bind_param("is", $property_id, $email);

            // Execute the statement
            if ($stmt->execute()) {
                // Set session variable for property ID
                $_SESSION['property_id'] = $property_id;

                

               
            } else {
                echo "<p>Error updating landlord details.</p>";
            }
        } else {
            echo "<p>Error inserting property details: " . $db_connection->error . "</p>";
        }
    }
    // Close database connection
    $db_connection->close();
} else {
    // Display the registration form
    
    if (!empty($errors)) {
        echo "<div style='color: red;'>";
        foreach ($errors as $error) {
            $errors = "Error: $error";
        }
        echo "</div>";
    }
    
    
}
?>
    


    <h1>Register Your Property</h1>
    <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="POST" novalidate enctype="multipart/form-data">


        <label for="bedrooms">Select Number of Bedrooms:</label>
        <select name="bedrooms" id="bedrooms">
            <option value="Apartment">Apartment</option>
            <option value="House">House</option>
        </select><br><br>

        <label for="bedrooms">Select Number of Bedrooms:</label>
        <select name="bedrooms" id="bedrooms">
            <option value="1">1 Bedroom</option>
            <option value="2">2 Bedrooms</option>
            <option value="3">3 Bedrooms</option>
            <option value="4">4 Bedrooms</option>
        </select><br><br>

        <label for="tenancy_length">Select Tenancy Length:</label>
        <select name="tenancy_length" id="tenancy_length">
            <option value="3-month">3-month rental</option>
            <option value="6 month">6-month rental</option>
            <option value="1 year">1-year rental</option>
            <option value="1+ year">1+ year</option>
        </select><br><br>

        <label for="address">Address:</label>
        <input type="text" name="address" id="address" value="<?php if(isset($_POST['address'])) echo htmlspecialchars($_POST['address'], ENT_QUOTES); ?>" required><br><br>

        <label for="eircode">Eircode:</label>
        <input type="text" name="eircode" id="eircode" value="<?php if(isset($_POST['eircode'])) echo htmlspecialchars($_POST['eircode'], ENT_QUOTES); ?>" required><br><br>

        <label for="price">Price:</label>
        <input type="text" name="price" id="price" value="<?php if(isset($_POST['price'])) echo htmlspecialchars($_POST['price'], ENT_QUOTES); ?>" required><br><br>
    
        <label for="furnished">Is the property furnished?</label>
        <input type="radio" name="furnished" value="1" id="furnished"> Yes
        <input type="radio" name="furnished" value="0" id="not_furnished"> No<br><br>

        <label for="description">Property Description:</label><br>
        <textarea name="description" id="description" rows="4" cols="50" required></textarea><br><br>

        <label for="photos">Upload Property Photos:</label><br>
        <input type="file" name="photos[]" id="photos" multiple accept="image/*" required><br><br>
        

        <label for="email">Email:</label>
        <input type="email" name="email" id="email" required><br><br>

        <label for="password">Password:</label>
        <input type="password" name="password" id="password" required><br><br>

        <label for="confirm_password">Confirm Password:</label>
        <input type="password" name="confirm_password" id="confirm_password" required><br><br>

        <input type="submit" value="Submit">
    </form>
    
</body>

</html>