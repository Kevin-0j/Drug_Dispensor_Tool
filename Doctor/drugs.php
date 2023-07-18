<?php
session_start();
require("connection.php");

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $patient_ssn = $_POST["patient_ssn"];
    $trade_name = $_POST["trade_name"];
    $description = $_POST["description"];
    $quantity = $_POST["quantity"];
    $price = $_POST["price"];

    // Insert the drug into the database
    $query = "INSERT INTO drugs (patient_ssn, trade_name, description, quantity, price) 
              VALUES ('$patient_ssn', '$trade_name', '$description', '$quantity', '$price')";
    mysqli_query($conn, $query);

    // Redirect to the drugs.php page after successful insertion
    header("Location: drugs.php");
    exit();
}
?>

<!DOCTYPE html>
<!-- Rest of the code remains unchanged -->

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
                        <?php
                        if (isset($_SESSION["deleteMessage"])) {
                            ?>
                            <div class="alert alert-danger text-center">
                                <?php echo $_SESSION["deleteMessage"]; ?>
                            </div>
                            <?php
                            unset($_SESSION["deleteMessage"]);
                        }
                        ?>
                        

                        <table class="table table-bordered text-center">
                            <tr class="bg-secondary text-danger">
                                <th>Patient ssn</th>
                                <th>Trade Name</th>
                                <th>Description</th>
                                <th>Quantity</th>
                                <th>Price</th>
                                <th>Actions</th>
                            </tr>
                            <?php
                            require("connection.php");
                            $query = "SELECT * FROM drugs";
                            $result = mysqli_query($conn, $query);
                            while ($row = mysqli_fetch_assoc($result)) {
                                ?>
                                <tr>
                                    <td><?php echo $row['patient_ssn']; ?></td>
                                    <td><?php echo $row['trade_name']; ?></td>
                                    <td><?php echo $row['description']; ?></td>
                                    <td><?php echo $row['quantity']; ?></td>
                                    <td><?php echo $row['price']; ?></td>
                                    
                                    <td>
                                        <form action="update_drugs.php" method="POST">
                                            <input type="hidden" name="patient_ssn" value="<?php echo $row['patient_ssn']; ?>">
                                            <button type="submit" class="btn btn-sm btn-warning">Update</button>
                                        </form>
                                    </td>
                                    <td>
                                        <form action="delete_drugs.php" method="POST">
                                            <input type="hidden" name="patient_ssn" value="<?php echo $row['patient_ssn']; ?>">
                                            <button type="submit" class="btn btn-sm btn-danger">Delete</button>
                                        </form>
                                    </td>

                                    <td>
                                        <form action="dispense.php" method="POST">
                                            <input type="hidden" name="patient_ssn" value="<?php echo $row['patient_ssn']; ?>">
                                            <input type="hidden" name="trade_name" value="<?php echo $row['trade_name']; ?>">
                                            <button type="submit" class="btn btn-sm btn-success">Dispense</button>
                                        </form>
                                    </td>
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
