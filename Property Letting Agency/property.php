<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="property.css">
    
</head>
<body>

<?php
// Include the database connection file
include("header.php");
include("search.php");


// Fetch all properties from the property table
$sql = "SELECT * FROM property";
$result = $db_connection->query($sql);

if ($result && $result->num_rows > 0) {
    // Output data of each row
    while ($row = $result->fetch_assoc()) {

        echo "<div class='properties'>";
        echo "<h2 class='title' id='".$row["prID"] ."'>Property " . $row["prID"] . "</h2>";
        echo "<p class='details'>" . $row["description"] . "</p>";
        echo "<p><strong>Address:</strong> " . $row["address"] . "</p>";
        echo "<p><strong>Eircode:</strong> " . $row["eircode"] . "</p>";
        echo "<p><strong>Price:</strong> $" . $row["price"] . "</p>";
        echo "<p><strong>Furnished:</strong> " . ($row["furnished"] ? 'Yes' : 'No') . "</p>";
        echo "<p><strong>Tenancy Length:</strong> " . $row["length_of_tenancy"] . "</p>";
       
        
        echo "<img src='". $row["photo_path"] . "'/>";



        echo "<a href='property.php?id='" . $row["prID"] . "' class='link' name='go' id='go'>View Details</a>";
        echo "</div>";
    }
} else {
    echo "No properties found.";
}


if(isset($_POST["go"])){

}

// Close the database connection
$db_connection->close();
?>

</body>
</html>