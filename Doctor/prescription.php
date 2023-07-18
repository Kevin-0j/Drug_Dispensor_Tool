<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Prescriptions Page</title>
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
                        <h2 class="display-6 text-center">Table of Prescriptions</h2>
                    </div>
                    <div class="card-body">
                        <?php
                        if (isset($_SESSION["deleteMessage"])) {
                            echo "<div class='alert alert-success'>" . $_SESSION["deleteMessage"] . "</div>";
                            unset($_SESSION["deleteMessage"]);
                        }
                        ?>
                        
                        <table class="table table-bordered text-center">
                            <tr>
                                <th>Username</th>
                                <th>Password</th>
                                <th>Trade Name</th>
                                <th>Description</th>
                                <th>Patient SSN</th>
                                <th>Actions</th>
                            </tr>
                            <?php
                            require("connection.php");
                            $query = "SELECT * FROM prescription";
                            $result = mysqli_query($conn, $query);
                            while ($row = mysqli_fetch_assoc($result)) {
                                ?>
                                <tr>
                                    <td><?php echo $row["username"]; ?></td>
                                    <td><?php echo $row["password"]; ?></td>
                                    <td><?php echo $row["trade_name"]; ?></td>
                                    <td><?php echo $row['description']; ?></td>
                                    <td><?php echo $row["patient_ssn"]; ?></td>
                                    
                                    <td>
                                        <form action="update_prescription.php" method="POST">
                                            <input type="hidden" name="trade_name" value="<?php echo $row["trade_name"]; ?>">
                                            <button type="submit" class="btn btn-sm btn-danger">Update</button>
                                        </form>
                                    </td>
                                    <td>
                                        <form action="delete_prescription.php" method="POST">
                                            <input type="hidden" name="trade_name" value="<?php echo $row["trade_name"]; ?>">
                                            <button type="submit" class="btn btn-sm btn-warning">Delete</button>
                                        </form>
                                    </td>
                                    <td>
                                        <form action="pharmaceutical.php" method="POST">
                                            <input type="hidden" name="trade_name" value="<?php echo $row["trade_name"]; ?>">
                                            <button type="submit" class="btn btn-sm btn-primary">Dispense</button>
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
