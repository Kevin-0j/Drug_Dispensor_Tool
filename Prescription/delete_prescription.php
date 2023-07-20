<?php
require "connection.php";
session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST["username"];

    $deleteQuery = "DELETE FROM prescription WHERE username = '$username'";

    if ($conn->query($deleteQuery) === TRUE) {
        $_SESSION["deleteMessage"] = "Pharmacist information deleted successfully";
    } else {
        $_SESSION["deleteMessage"] = "Error deleting pharmacist information: " . $conn->error;
    }
    $conn->close();
}

header("Location: prescription.php");
exit();
?>


