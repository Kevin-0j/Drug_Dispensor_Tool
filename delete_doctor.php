<?php
require "connection.php";

session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $SSN = $_POST["SSN"];

    $deleteQuery = "DELETE FROM doctor WHERE SSN = '$SSN'";

    if ($conn->query($deleteQuery) === TRUE) {
        $_SESSION["deleteMessage"] = "Doctor information deleted successfully";
    } else {
        $_SESSION["deleteMessage"] = "Error deleting doctor information: " . $conn->error;
    }
    $conn->close();
}

header("Location: doctor.php");
exit();
?>
