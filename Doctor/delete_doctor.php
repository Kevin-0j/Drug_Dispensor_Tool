<?php
require "connection.php";
session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $SSN = $_POST["SSN"];

    $deleteQuery = "DELETE FROM doctor WHERE SSN = '$SSN'";

    if ($conn->query($deleteQuery) === TRUE) {
        $_SESSION["successMessage"] = "Doctor information deleted successfully";
    } else {
        $_SESSION["successMessage"] = "Error deleting doctor information: " . $conn->error;
    }
    $conn->close();
}

header("Location: doctor.php");
exit();
?>
