<?php
require "connection.php";
session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $ssn = $_POST["ssn"];
    
    // Fetch the existing patient information from the database
    $query = "SELECT * FROM patient WHERE ssn = '$ssn'";
    $result = mysqli_query($conn, $query);
    $row = mysqli_fetch_assoc($result);

    // Display a form to edit the patient's information
    echo "
    <form action='update_patient.php' method='POST'>
        <input type='hidden' name='ssn' value='$ssn'>
        First Name: <input type='text' name='first_name' value='".$row['first_name']."'><br>
        Last Name: <input type='text' name='last_name' value='".$row['last_name']."'><br>
        Username: <input type='text' name='username' value='".$row['username']."'><br>
        Password: <input type='text' name='password' value='".$row['password']."'><br>
        SSN: <input type='text' name='ssn' value='".$row['ssn']."' readonly><br>
        Address: <input type='text' name='address' value='".$row['address']."'><br>
        Medical History: <input type='text' name='medical_history' value='".$row['medical_history']."'><br>
        <input type='submit' value='Update'>
    </form>";
}

// Handle the form submission to update the patient's information
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["first_name"])) {
    $ssn = $_POST["ssn"];
    $firstName = $_POST["first_name"];
    $lastName = $_POST["last_name"];
    $username = $_POST["username"];
    $password = $_POST["password"];
    $address = $_POST["address"];
    $medicalHistory = $_POST["medical_history"];

    $updateQuery = "UPDATE patient SET first_name = '$firstName', last_name = '$lastName', username = '$username', password = '$password', address = '$address', medical_history = '$medicalHistory' WHERE ssn = '$ssn'";

    if ($conn->query($updateQuery) === TRUE) {
        // Set a session variable to store the success message
        $_SESSION["successMessage"] = "Patient information updated successfully";
        // Redirect to the patient.php file
        header("Location: patient.php");
        exit();
    } else {
        echo "Error updating patient information: " . $conn->error;
    }
    $conn->close();
}
?>
