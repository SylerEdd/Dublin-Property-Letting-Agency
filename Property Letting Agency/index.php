<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dublin Property Lettings Agency</title>
    <link rel="stylesheet" href="index.css">
</head>

<body>
    
    
    <?php
    include("cookies.php");
    include("header.php");
     include("search.php");


    ini_set('display_errors', 1);
    ini_set('display_startup_errors', 1);
    error_reporting(E_ALL);

    // Include the database connection file
    // session_start();
    require_once('../../connection.php');
   

    // Fetch all properties from the property table
    $sql = "SELECT * FROM property";
    $result = $db_connection->query($sql);

    ?>


    <h1 class="banner">Dublin Property Lettings Agency</h1>

    <div class="properties-container">
        <h1>Properties</h1>

        <?php
        if ($result && $result->num_rows > 0) {
            // Output data of each row
            while ($row = $result->fetch_assoc()) {
                echo "<div class='properties'>";
                echo "<h2 class='title'>Property " . $row["prID"] . "</h2>";
                echo "<p class='details'>" . $row["description"] . "</p>";
                echo "<p><strong>Address:</strong> " . $row["address"] . "</p>";
                echo "<p><strong>Eircode:</strong> " . $row["eircode"] . "</p>";
                echo "<p><strong>Price:</strong> $" . $row["price"] . "</p>";
                echo "<p><strong>Furnished:</strong> " . ($row["furnished"] ? 'Yes' : 'No') . "</p>";
                echo "<p><strong>Tenancy Length:</strong> " . $row["length_of_tenancy"] . "</p>";
                echo "<a href='property.php?id=" . $row["prID"] . "' class='link'>View Details</a>";
                echo "<img src='". $row["photo_path"] . "'/>";
                echo "</div>";
            }
        } else {
            echo "No properties found.";
        }

        // Close the database connection
        $db_connection->close();
        ?>
    </div>

    <footer>
        <p>Contact: +353 (12) 345 6789</p>
        <p>Email: severgeeks@griffith.ie</p>
        <p>Website: DublinPropertyAgency.ie</p>
        <p>Since 2024</p>
    </footer>

</body>

</html>
