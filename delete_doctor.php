<?php
require "connection.php";
session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $ssn = $_POST["ssn"];

    $deleteQuery = "DELETE FROM patient WHERE ssn = '$ssn'";

    if ($conn->query($deleteQuery) === TRUE) {
        $_SESSION["successMessage"] = "Patient information deleted successfully";
    } else {
        $_SESSION["successMessage"] = "Error deleting patient information: " . $conn->error;
    }
    $conn->close();
}

header("Location: patient.php");
exit();
?>
