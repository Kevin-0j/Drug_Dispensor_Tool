<?php
require 'connection.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $supervisorID = $_POST['supervisor_id'];
    $FirstName = $_POST['First_name'];
    $LastName = $_POST['Last_name'];
    $phone_number = $_POST['phone_number'];

    $sql = "INSERT INTO supervisor(supervisor_id, First_name, Last_name, phone_number)
            VALUES ('$supervisorID', '$FirstName', '$LastName', '$phone_number')";

    echo "<br>";

    if ($conn->query($sql) === TRUE) {
        echo "Supervisor data inserted successfully";
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
    <title>Supervisor Page</title>
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
                        <h2 class="display-6 text-center"> Table of Registered Supervisors</h2>
                    </div>
                    <div class="card-body">
                        <table class="table table-bordered text-center">
                            <tr class="bg-secondary text-danger">
                                <td>Supervisor ID</td>
                                <td>Supervisor FirstName:</td>
                                <td>Supervisor LastName:</td>
                                <td>Phone Number:</td>
                                
                                
                                
                            </tr>
                            <?php
                            require("connection.php");
                            $query = "SELECT * FROM supervisor";
                            $result = mysqli_query($conn, $query);
                            while ($row = mysqli_fetch_assoc($result)) {
                                ?>
                                <tr>
                                    <td><?php echo $row["supervisor_id"]; ?></td>
                                    <td><?php echo $row["First_name"]; ?></td>
                                    <td><?php echo $row["Last_name"]; ?></td>
                                    <td><?php echo $row["phone_number"]; ?></td>
                                    
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


