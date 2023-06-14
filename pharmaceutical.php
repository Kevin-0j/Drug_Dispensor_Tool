<?php
require("connection.php");

// Retrieve form data
$company_name = $_POST['company_name'];
$phone_number = $_POST['phone_number'];
$pharmaceuticalcomp_id = $_POST['pharmaceuticalcomp_id'];

// Prepare and execute the SQL statement
$stmt = $conn->prepare("INSERT INTO pharmaceutical_companies (company_name, phone_number, pharmaceuticalcomp_id) VALUES (?, ?, ?)");
$stmt->bind_param("ssi", $company_name, $phone_number, $pharmaceuticalcomp_id);
$stmt->execute();

if ($stmt->affected_rows > 0) {
    echo "Company registered successfully!";
} else {
    echo "Error registering company.";
}

$stmt->close();
$conn->close();
?>
