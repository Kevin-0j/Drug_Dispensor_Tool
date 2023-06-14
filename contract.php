<?php
require_once("connection.php");

// Retrieve form data
$contract_id = $_POST['contract_id'];
$startdate = $_POST['startdate'];
$enddate = $_POST['enddate'];
$pharmacyid = $_POST['pharmacyid'];

// Prepare and execute the SQL statement
$stmt = $conn->prepare("INSERT INTO contracts (contract_id, startdate, enddate, pharmacyid) VALUES (?, ?, ?, ?)");
$stmt->bind_param("issi", $contract_id, $startdate, $enddate, $pharmacyid);
$stmt->execute();

if ($stmt->affected_rows > 0) {
    echo "Data inserted successfully!";
} else {
    echo "Error inserting data.";
}

$stmt->close();
$conn->close();
?>
