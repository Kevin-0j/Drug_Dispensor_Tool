<?php
require "connection.php";

// Retrieve form data
$prescription_id = $_POST['prescription_id'];
$description = $_POST['description'];
$patientssn = $_POST['patient_ssn'];
$doctorssn = $_POST['doctor_ssn'];

$sql = "INSERT INTO prescription(prescription_id, description, patient_ssn,doctor_ssn)
        VALUES ('$prescription_id', '$description', '$patientssn','$doctorssn')";

echo "<br>";

if ($conn->query($sql) === TRUE) {
    echo "Prescription submitted successfully!";
} else {
    echo "Error: " . $sql . "<br>" . $conn->error;
}
$conn->close();
?>

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
                        <h2 class="display-6 text-center"> Table of  Prescriptions</h2>
                    </div>
                    <div class="card-body">
                        <table>
                            <tr>
                                <th>Prescription ID</th>
                                <th>Description</th>
                                <th>Patient SSN:</th>
                                <th>Doctor SSN:</th>
                            </tr>
                            <?php
                            require("connection.php");
                            $query = "SELECT * FROM prescription";
                            $result = mysqli_query($conn, $query);
                            while ($row = mysqli_fetch_assoc($result)) {
                                ?>
                                <tr>
                                    <td><?php echo $row["prescription_id"]; ?></td>
                                    <td><?php echo $row['description']; ?></td>
                                    <td><?php echo $row["patient_ssn"]; ?></td>
                                    <td><?php echo $row["doctor_ssn"]; ?></td>
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
