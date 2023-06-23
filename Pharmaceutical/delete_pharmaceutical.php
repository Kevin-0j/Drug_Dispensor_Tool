<?php
require "connection.php";
session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $pharmaceuticalcomp_id = $_POST["pharmaceuticalcomp_id"];

    $deleteQuery = "DELETE FROM pharmaceutical WHERE pharmaceuticalcomp_id= '$pharmaceuticalcomp_id'";

    if ($conn->query($deleteQuery) === TRUE) {
        $_SESSION["successMessage"] = "Pharmaceutical information deleted successfully";
    } else {
        $_SESSION["successMessage"] = "Error deleting pharmaceutical information: " . $conn->error;
    }
    $conn->close();
}

header("Location: pharmaceutical.php");
exit();
?>
