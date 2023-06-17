<?php
require "connection.php";

// Retrieve form data
$company_name = $_POST['company_name'];
$phone_number = $_POST['phone_number'];
$pharmaceuticalcomp_id = $_POST['pharmaceuticalcomp_id'];

$sql = "INSERT INTO pharmaceutical(company_name, phone_number, pharmaceuticalcomp_id)
VALUES ('$company_name', '$phone_number', '$pharmaceuticalcomp_id')";

echo "<br>";

if ($conn->query($sql) === TRUE) {
    echo "Company registered successfully!";
} else {
    echo "Error: " . $sql . "<br>" . $conn->error;
}
$conn->close();

?>

