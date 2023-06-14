<?php
require_once("connection.php");
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $ssn = $_POST["ssn"];
    $name = $_POST["name"];
    $specialty = $_POST["specialty"];
    $experience = $_POST["experience"];
    $email = $_POST["email"];

    // Prepare and execute the SQL statement
    $stmt = $conn->prepare("INSERT INTO doctors (ssn, name, specialty, experience, email) VALUES (?, ?, ?, ?, ?)");
    $stmt->bind_param("issis", $ssn, $name, $specialty, $experience, $email);
    $stmt->execute();

    if ($stmt->affected_rows > 0) {
        echo "Data inserted successfully!";
    } else {
        echo "Error inserting data.";
    }

    $stmt->close();
}

$conn->close();


















?>