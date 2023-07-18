<?php
require "connection.php";
session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $trade_name = $_POST["trade_name"];

    $deleteQuery = "DELETE FROM prescription WHERE trade_name = '$trade_name'";

    if ($conn->query($deleteQuery) === TRUE) {
        $_SESSION["deleteMessage"] = "Prescription information deleted successfully";
    } else {
        $_SESSION["deleteMessage"] = "Error deleting prescription information: " . $conn->error;
    }
    $conn->close();
}

header("Location: prescription.php");
exit();
?>

