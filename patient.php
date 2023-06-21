<?php
require 'connection.php';

session_start();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $firstName = $_POST['first_name'];
    $lastName = $_POST['last_name'];
    $username = $_POST["username"];
    $password = $_POST["password"];
    $ssn = $_POST['ssn'];
    $address = $_POST['address'];
    $medicalHistory = $_POST['medical_history'];

    $sql = "INSERT INTO patient (first_name, last_name, username, password, ssn, address, medical_history)
            VALUES ('$firstName', '$lastName', '$username', '$password', '$ssn', '$address', '$medicalHistory')";

    if ($conn->query($sql) === TRUE) {
        $_SESSION["successMessage"] = "Patient registered successfully";
    } else {
        $_SESSION["errorMessage"] = "Error: " . $sql . "<br>" . $conn->error;
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
    <title>Patient Table</title>
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
                        <h2 class="display-6 text-center">Table of Patients</h2>
                    </div>
                    <div class="card-body">
                        <?php if (isset($_SESSION["successMessage"])) { ?>
                            <div class="alert alert-success" role="alert">
                                <?php echo $_SESSION["successMessage"]; ?>
                            </div>
                            <?php unset($_SESSION["successMessage"]); ?>
                        <?php } ?>
                        <?php if (isset($_SESSION["errorMessage"])) { ?>
                            <div class="alert alert-danger" role="alert">
                                <?php echo $_SESSION["errorMessage"]; ?>
                            </div>
                            <?php unset($_SESSION["errorMessage"]); ?>
                        <?php } ?>
                        <table class="table table-bordered text-center">
                            <tr class="bg-secondary text-danger">
                                <td>First Name</td>
                                <td>Last Name</td>
                                <td>Username</td>
                                <td>Password</td>
                                <td>SSN</td>
                                <td>Address</td>
                                <td>Medical History</td>
                                <td></td>
                                <td></td>
                            </tr>
                            <?php
                            require("connection.php");
                            $query = "SELECT * FROM patient";
                            $result = mysqli_query($conn, $query);
                            while ($row = mysqli_fetch_assoc($result)) {
                            ?>
                                <tr>
                                    <td><?php echo $row['first_name']; ?></td>
                                    <td><?php echo $row['last_name']; ?></td>
                                    <td><?php echo $row['username']; ?></td>
                                    <td><?php echo $row['password']; ?></td>
                                    <td><?php echo $row['ssn']; ?></td>
                                    <td><?php echo $row['address']; ?></td>
                                    <td><?php echo $row['medical_history']; ?></td>
                                    <td>
                                        <form action="update_patient.php" method="POST">
                                            <input type="hidden" name="ssn" value="<?php echo $row['ssn']; ?>">
                                            <button type="submit" class="btn btn-primary">Update</button>
                                        </form>
                                    </td>
                                    <td>
                                        <form action="delete_patient.php" method="POST">
                                            <input type="hidden" name="ssn" value="<?php echo $row['ssn']; ?>">
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
    </div>
</body>
</html>
