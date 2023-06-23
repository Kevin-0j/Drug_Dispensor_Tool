<?php
require "connection.php";

// Check if the success message is set
session_start();
if (isset($_SESSION["successMessage"])) {
    echo "<div class='alert alert-success'>" . $_SESSION["successMessage"] . "</div>";
    // Unset the session variable to clear the message
    unset($_SESSION["successMessage"]);
}

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
                        <?php
                        if (isset($_SESSION["deleteMessage"])) {
                            echo "<div class='alert alert-success'>" . $_SESSION["deleteMessage"] . "</div>";
                            unset($_SESSION["deleteMessage"]);
                        }
                        ?>
                        <table>
                            <tr> 
                                <th>Company Name</th>
                                <th>Username</th>
                                <th>Password</th>
                                <th>Phone Number</th>
                                <th>Pharmaceutical Company ID</th>
                                
                                
                            </tr>
                            <?php
                            require("connection.php");
                            $query = "SELECT * FROM pharmaceutical";
                            $result = mysqli_query($conn, $query);
                            while ($row = mysqli_fetch_assoc($result)) {
                             ?>
                                <tr>
                                    <td><?php echo $row['company_name']; ?></td>
                                    <td><?php echo $row['username']; ?></td>
                                    <td><?php echo $row['password']; ?></td>
                                    <td><?php echo $row['phone_number']; ?></td>
                                    <td><?php echo $row['pharmaceuticalcomp_id']; ?></td>
                                    
                                    <td>
                                        <form action="update_pharmaceutical.php" method="POST">
                                            <input type="hidden" name="pharmaceuticalcomp_id" value="<?php echo $row['pharmaceuticalcomp_id']; ?>">
                                            <button type="submit" class="btn btn-primary">Update</button>
                                        </form>
                                    </td>
                                    <td>
                                        <form action="delete_pharmaceutical.php" method="POST">
                                            <input type="hidden" name="pharmaceuticalcomp_id" value="<?php echo $row['pharmaceuticalcomp_id']; ?>">
                                            <button type="submit" class="btn btn-danger">Delete</button>
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
