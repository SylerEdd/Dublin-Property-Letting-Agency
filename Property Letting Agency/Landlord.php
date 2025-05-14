<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tenant</title>
    <link rel="stylesheet" href="landlord.css">
</head>

<body>
    <h1>Welcome Landlord</h1>
    <div class="container my-5 ">
        <h2>Account</h2>
        <table class="table">
            <thead>
                <tr>
                    <th>Landlord ID</th>
                    <th>Name</th>
                    <th>password</th>
                    <th>Email</th>
                    <th>Income</th>
                    <th>Commission</th>
                    <th>Managment_fee</th>
                    <th>Proprty ID</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                <?php
                
                include("header.php");
                include("search.php");

                $sql = "SELECT * FROM Landlord";
                $result = $db_connection->query($sql);
                if (!$result) {
                    die("Invalid query: " . $db_connection->error);
                }

                while ($row = $result->fetch_assoc()) {
                    echo "<tr>";
                    echo "<td>" . htmlspecialchars($row['lID']) . "</td>";
                    echo "<td>" . htmlspecialchars($row['name']) . "</td>";
                    echo "<td>" . htmlspecialchars($row['password']) . "</td>";
                    echo "<td>" . htmlspecialchars($row['email']) . "</td>";
                    echo "<td>" . htmlspecialchars($row['income']) . "</td>";
                    echo "<td>" . htmlspecialchars($row['commission']) . "</td>";
                    echo "<td>" . htmlspecialchars($row['management_fee']) . "</td>";
                    echo "<td>" . htmlspecialchars($row['prID']) . "</td>";
                    echo "<td>";
                    echo "<a class='btn btn-primary btn-sm' href='Landlord_edit.php?lID={$row['lID']}' role='button'>Edit</a>";
                    echo "</td>";
                    echo "</tr>";
                }
                ?>

            </tbody>

    </div>
    <div class="add">
        <a href="Landlord_add.php">Add</a>


    </div>

</body>

</html>

