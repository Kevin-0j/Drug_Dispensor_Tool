<?php
require "connection.php";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $FName = $_POST["FName"];
    $LName = $_POST["LName"];
    $SSN = $_POST["SSN"];
    $Speciality = $_POST["Speciality"]; 
    $Experience = $_POST["Experience"];
    $Email = $_POST["Email"];
    
    $sql = "INSERT INTO doctor (FName, LName, SSN, Speciality, Experience, Email)
             VALUES ('$FName', '$LName', '$SSN', '$Speciality', '$Experience', '$Email')";
   
    if ($conn->query($sql) === TRUE) {
        echo "Doctor registered successfully";
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
    <title>Doctor's Page</title>
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
                        <h2 class="display-6 text-center">Table of Registered Doctors</h2>
                    </div>
                    <div class="card-body">
                        <table>
                            <tr>
                                <th>Doctor's SSN</th>
                                <th>First Name</th>
                                <th>Last Name</th>
                                <th>Specialty</th>
                                <th>Years of Experience</th>
                            </tr>
                            <?php
                            require("connection.php");
                            $query = "SELECT * FROM doctor";
                            $result = mysqli_query($conn, $query);
                            while ($row = mysqli_fetch_assoc($result)) {
                                ?>
                                <tr>
                                    <td><?php echo $row['SSN']; ?></td>
                                    <td><?php echo $row['FName']; ?></td>
                                    <td><?php echo $row['LName']; ?></td>
                                    <td><?php echo $row['Speciality']; ?></td>
                                    <td><?php echo $row['Experience']; ?></td>
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
















