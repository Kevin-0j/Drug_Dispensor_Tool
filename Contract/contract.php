<?php
require "connection.php";

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $contract_id = $_POST['contract_id'];
    $start_date = $_POST['start_date'];
    $end_date = $_POST['end_date'];
    $pharmacy_id = $_POST['pharmacy_id'];

    $sql = "INSERT INTO contract(contract_id, start_date, end_date,pharmacy_id)
            VALUES ('$contract_id', '$start_date', '$end_date','$pharmacy_id')";

    echo "<br>";

    if ($conn->query($sql) === TRUE) {
        echo "Contract registered successfully!";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
    $conn->close();
}
?>
<!-- This is the table part-->

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Contracts Table</title>
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
                        <h2 class="display-6 text-center">Table of Contracts</h2>
                    </div>
                    <div class="card-body">
                        <table>
                            <tr>
                                <th>Contract Id</th>
                                <th>Start Date</th>
                                <th>End Date</th>
                                <th>Pharmacy ID</th>
                                
                            </tr>
                            <?php
                            require("connection.php");
                            $query = "SELECT * FROM contract";
                            $result = mysqli_query($conn, $query);
                            while ($row = mysqli_fetch_assoc($result)) {
                                ?>
                                <tr>
                                    <td><?php echo $row['contract_id']; ?></td>
                                    <td><?php echo $row["start_date"]; ?></td>
                                    <td><?php echo $row["end_date"]; ?></td>
                                    <td><?php echo $row["pharmacy_id"]; ?></td>
                                   
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


