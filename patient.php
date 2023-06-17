<?php
require 'connection.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $firstName = $_POST['first_name'];
    $lastName = $_POST['last_name'];
    $ssn = $_POST['ssn'];
    $address = $_POST['address'];
    $medicalHistory = $_POST['medical_history'];

    $sql = "INSERT INTO patient (first_name, last_Name, ssn, address, medical_history)
            VALUES ('$firstName', '$lastName', '$ssn', '$address', '$medicalHistory')";

    echo "<br>";

    if ($conn->query($sql) === TRUE) {
        echo "Patient registered successfully";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
    $conn->close();
}
?>
