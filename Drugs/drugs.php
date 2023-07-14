<?php
require 'connection.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $tradeName = $_POST['trade_name'];
    $drugId = $_POST['drug_id'];
    $text = $_POST['text'];
    $quantity = $_POST['quantity'];
    $companyName = $_POST['company_name'];
    $manufacturerDate = $_POST['manufacturer_date'];
    $expiryDate = $_POST['expiry_date'];

    $sql = "INSERT INTO drugs (trade_name, drug_id, text, quantity, company_name, manufacturer_date, expiry_date)
            VALUES ('$tradeName', '$drugId', '$text', '$quantity', '$companyName', '$manufacturerDate', '$expiryDate')";

    echo "<br>";

    if ($conn->query($sql) === TRUE) {
        echo "Drug data inserted successfully";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
    $conn->close();
}
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Drugs Table</title>
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <style>
        table {
            border-collapse: collapse;
            border: 1px solid black;
        }
        th, td {
            border: 1px solid black;
            padding: 8px;
            text-align: center;
        }
        th {
            background-color: #333;
            color: white;
        }
    </style>    
</head>
<body class="bg-dark">
    <div class="container">
        <div class="row mt-6">
            <div class="col">
                <div class="card mt-6">
                    <div class="card-header">
                        <h2 class="display-6 text-center">Table of Drugs</h2>
                    </div>
                    <div class="card-body">
                        <table class="table table-bordered text-center">
                            <tr class="bg-secondary text-danger">
                                <td>Trade Name</td>
                                <td>Drug ID</td>
                                <td>Text</td>
                                <td>Quantity</td>
                                <td>Company Name</td>
                                <td>Manufacturer Date</td>
                                <td>Expiry Date</td>
                            </tr>
                            <?php
                            require("connection.php");
                            $query = "SELECT * FROM drugs";
                            $result = mysqli_query($conn, $query);
                            while ($row = mysqli_fetch_assoc($result)) {
                                ?>
                                <tr>
                                    <td><?php echo $row['trade_name']; ?></td>
                                    <td><?php echo $row['drug_id']; ?></td>
                                    <td><?php echo $row['text']; ?></td>
                                    <td><?php echo $row['quantity']; ?></td>
                                    <td><?php echo $row['company_name']; ?></td>
                                    <td><?php echo $row['manufacturer_date']; ?></td>
                                    <td><?php echo $row['expiry_date']; ?></td>
                                </tr>
                                <?php
                            }
                            ?>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
</html>