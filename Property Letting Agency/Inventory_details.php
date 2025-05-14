<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Inventory</title>
    <link rel="stylesheet" href="inventory_details.css ">
</head>

<body>
    <h1>Welcome to your inventory</h1>
    <div class="container my-5 ">
        <h2>Inventory</h2>
        <table class="table">
            <thead>
                <tr>
                    <th>Inventory ID</th>
                    <th>Item1</th>
                    <th>Item2</th>
                    <th>Item3</th>
                    <th>Item4</th>
                    <th>Total Cost</th>
                    <th>Property ID</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                <?php
                include("header.php");
                include("search.php");

                $sql = "SELECT * FROM Inventory_details";
                $result = $db_connection->query($sql);
                if (!$result) {
                    die("Invalid query: " . $db_connection->error);
                }

                while ($row = $result->fetch_assoc()) {
                    echo "
                    <tr>
                        <td>" . htmlspecialchars($row['inID']) . "</td>
                        <td>" . htmlspecialchars($row['item1']) . "</td>
                        <td>" . htmlspecialchars($row['item2']) . "</td>
                        <td>" . htmlspecialchars($row['item3']) . "</td>
                        <td>" . htmlspecialchars($row['item4']) . "</td>
                        <td>" . htmlspecialchars($row['totalCost']) . "</td>
                        <td>" . htmlspecialchars($row['prID']) . "</td>
                        <td>
                            <a class='btn btn-primary btn-sm' href='Inventory_details_edit.php?inID={$row['inID']}' role='button'>Edit</a>
                        </td>
                    </tr>";


                }
                ?>

            </tbody>

    </div>
    <div class="add">
        <a href="Inventory_details_add.php">Add</a>
    </div>

</body>

</html>

