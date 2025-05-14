<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tenant</title>
    <link rel="stylesheet" href="tenant.css">
</head>

<body>
    <h1>Welcome Tenant</h1>
    <div class="container my-5 ">
        <h2>Account</h2>
        <table class="table">
            <thead>
                <tr>
                    <th>Tenant ID</th>
                    <th>Name</th>
                    <th>Password</th>
                    <th>Email</th>
                    <th>Monthly Fee</th>
                    <th>Length Tenancy</th>
                    <th>Tenancy Agreement</th>
                    <th>Start Date</th>
                    <th>End Date</th>
                    <th>Amount Paid</th>
                    <th>Amount Owed</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                <?php
                    include("header.php");
                    include("search.php");

                $sql = "SELECT * FROM Tenant";
                $result = $db_connection->query($sql);
                if (!$result) {
                    die("Invalid query: " . $db_connection->error);
                }

                while ($row = $result->fetch_assoc()) {
                    echo "
                <tr>
                    <td>" . htmlspecialchars($row['tID']) . "</td>
                    <td>" . htmlspecialchars($row['name']) . "</td>
                    <td>" . htmlspecialchars($row['password']) . "</td>
                    <td>" . htmlspecialchars($row['email']) . "</td>
                    <td>" . htmlspecialchars($row['monthly_fee']) . "</td>
                    <td>" . htmlspecialchars($row['length_tenancy']) . "</td>
                    <td>" . htmlspecialchars($row['tenancy_agreement']) . "</td>
                    <td>" . htmlspecialchars($row['start_date']) . "</td>
                    <td>" . htmlspecialchars($row['end_date']) . "</td>
                    <td>" . htmlspecialchars($row['amount_paid']) . "</td>
                    <td>" . htmlspecialchars($row['amount_owed']) . "</td>
                    <td>
                        <a class='btn btn-primary btn-sm' href='Tenant_edit.php?tID={$row['tID']}' role='button'>Edit</a>
                    </td>
                </tr>";
                }
                ?>

            </tbody>

    </div>
    <div class="add">
        <a href="Tenant_add.php">Add</a>
    </div>

</body>

</html>