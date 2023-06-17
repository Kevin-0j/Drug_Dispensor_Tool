<?php
require"connection.php";

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
