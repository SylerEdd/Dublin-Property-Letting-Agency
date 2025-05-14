<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Search Template</title>
    <link rel="stylesheet" href="search.css">
    <script src="search.js"></script>
</head>

<body>
    <div class="searchclass">
        <div class="search-wrapper">
            <label for="search">
                <form method="post">
                    <input type="search" id="search" placeholder="Search data" name="search">
                    <button class="btn btn-dark btn-sm" name="submit">Search</button>
                </form>
            </label>
        </div>
        <div class="container my-5">
            <?php
            require_once('../../connection.php');
            if (isset($_POST['submit'])) {
                $search = $_POST['search'];

                $sql = "SELECT * FROM property WHERE prID LIKE '%$search%'
                        OR type LIKE '%$search%' 
                        OR address LIKE '%$search%'
                        OR eircode LIKE '%$search%'
                        OR price LIKE '%$search%'
                        OR furnished LIKE '%$search%'
                        OR length_of_tenancy LIKE '%$search%'";

                $result = mysqli_query($db_connection, $sql);

                if ($result && mysqli_num_rows($result) > 0) {
                    while ($row = mysqli_fetch_assoc($result)) {
            ?>
                        <div class="user-cards">
                            <div class="card">
                                <div class="prID">Property ID:<?php echo htmlspecialchars($row['prID']); ?></div>
                                <div class="type">Type:<?php echo htmlspecialchars($row['type']); ?></div>
                                <div class="address">Address:<?php echo htmlspecialchars($row['address']); ?></div>
                                <div class="eircode">Eircode:<?php echo htmlspecialchars($row['eircode']); ?></div>
                                <div class="price">Price:<?php echo htmlspecialchars($row['price']); ?></div>
                                <div class="furnished">Furnished:<?php echo htmlspecialchars($row['furnished']); ?></div>
                                <div class="length_of_tenancy">Length of Tenancy:<?php echo htmlspecialchars($row['length_of_tenancy']); ?></div>
                            </div>
                        </div>
                    <?php
                    }
                } else {
                    echo '<h2 class="text-danger">Data is not found in the Database</h2>';
                }
            }
            ?>
        </div>
    </div>
</body>

</html>

