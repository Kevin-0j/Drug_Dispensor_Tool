<?php
require "connection.php";
session_start();
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $drugId = $_POST["drug_id"];
    
    $deleteQuery = "DELETE FROM drugs WHERE drug_id = '$drugId'";
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
