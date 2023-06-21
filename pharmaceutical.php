<?php
require "connection.php";

// Retrieve form data
if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $company_name = $_POST['company_name'];
    $username =$_POST["username"];
    $password =$_POST["password"];
    $phone_number = $_POST['phone_number'];
    $pharmaceuticalcomp_id = $_POST['pharmaceuticalcomp_id'];

    $sql = "INSERT INTO pharmaceutical(company_name, username,password,phone_number, pharmaceuticalcomp_id)
            VALUES ('$company_name','$username','$password', '$phone_number', '$pharmaceuticalcomp_id')";



    if ($conn->query($sql) === TRUE) {
        echo "Company registered successfully!";
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
    <title>Pharamceutical Table</title>
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
                        <h2 class="display-6 text-center"> Table of  Pharmaceutical Companies</h2>
                    </div>
                    <div class="card-body">
                        <table class="table table-bordered text-center">
                            <tr class="bg-secondary text-danger">
                                <td>Username</td>
                                <td>Password</td>
                                <td>Company Name</td>
                                <td>Phone Number</td>
                                <td>Pharmaceutical Company ID</td>
                                
                                
                            </tr>
                            <?php
                            require("connection.php");
                            $query = "SELECT * FROM pharmaceutical";
                            $result = mysqli_query($conn, $query);
                            while ($row = mysqli_fetch_assoc($result)) {
                                ?>
                                <tr>
                                    <td><?php echo $row['username']; ?></td>
                                    <td><?php echo $row['password']; ?></td>
                                    <td><?php echo $row['company_name']; ?></td>
                                    <td><?php echo $row['phone_number']; ?></td>
                                    <td><?php echo $row['pharmaceuticalcomp_id']; ?></td>
                                    
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


