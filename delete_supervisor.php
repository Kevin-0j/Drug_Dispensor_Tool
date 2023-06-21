<?php
require "connection.php";

session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $supervisor_id = $_POST["supervisor_id"];

    $deleteQuery = "DELETE FROM supervisor WHERE supervisor_id = '$supervisor_id'";

    if ($conn->query($deleteQuery) === TRUE) {
        $_SESSION["deleteMessage"] = "Supervisor information deleted successfully";
    } else {
        $_SESSION["deleteMessage"] = "Error deleting supervisor information: " . $conn->error;
    }
    $conn->close();
}

header("Location: supervisor.php");
exit();
?>
