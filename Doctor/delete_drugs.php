<?php
require "connection.php";
session_start();
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $patientID = $_POST["patient_ssn"];
    
    $deleteQuery = "DELETE FROM drugs WHERE patient_ssn = '$patientID'";
    if ($conn->query($deleteQuery) === TRUE) {
        $_SESSION["deleteMessage"] = "Drug information deleted successfully";
        header("Location: drugs.php");
        exit();
    } else {
        echo "Error deleting drug information: " . $conn->error;
    }
    $conn->close();
}
?>
