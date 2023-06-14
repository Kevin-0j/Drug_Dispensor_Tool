<?php
require_once("connection.php");

// Retrieve form data
$prescription_id = $_POST['prescription_id'];
$description = $_POST['description'];
$patientssn = $_POST['patientssn'];
$doctorssn = $_POST['doctorssn'];

// Prepare and execute the SQL statement
$stmt = $conn->prepare("INSERT INTO prescriptions (prescription_id, description, patientssn, doctorssn) VALUES (?, ?, ?, ?)");
$stmt->bind_param("isss", $prescription_id, $description, $patientssn, $doctorssn);
$stmt->execute();

if ($stmt->affected_rows > 0) {
    echo "Prescription inserted successfully!";
} else {
    echo "Error inserting prescription.";
}

$stmt->close();
$conn->close();
?>
