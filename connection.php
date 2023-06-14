<?php

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "drug_dispensing_tool";

// Create connection
$conn = mysqli_connect($servername, $username, $password, $dbname);

// Check connection
if (!$conn) {
  die("Connection failed: " . mysqli_connect_error());
}
echo "Connected Successfully";

$firstName = "John";
$lastName = "Doe";
$ssn = "1";
$address = "123 Main St";

$sql = "INSERT INTO patients (FirstName, LastName, SSN, Address) VALUES ('$firstName', '$lastName', '$ssn', '$address')";

if (mysqli_query($conn, $sql)) {
    echo "  New record created successfully";
} else {
    echo "Error: " . $sql . "<br>" . mysqli_error($conn);
}

mysqli_close($conn);
?>
