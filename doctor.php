<?php
require "connection.php";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $FName = $_POST["FName"];
    $LName = $_POST["LName"];
    $SSN = $_POST["SSN"];
    $Speciality = $_POST["Speciality"]; 
    $Experience = $_POST["Experience"];
    $Email = $_POST["Email"];
    
    $sql = "INSERT INTO doctor (FName, LName, SSN, Speciality, Experience, Email)
             VALUES ('$FName', '$LName', '$SSN', '$Speciality', '$Experience', '$Email')";
   
   echo "<br>";

    if ($conn->query($sql) === TRUE) {
        echo "Doctor registered successfully";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
    $conn->close();
}
?>















