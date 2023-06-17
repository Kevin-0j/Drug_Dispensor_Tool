<?php
require 'connection.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $supervisorID = $_POST['supervisor_id'];
    $FirstName = $_POST['first_name'];
    $LastName = $_POST['last_name'];
    $phone_number = $_POST['phone_number'];

    $sql = "INSERT INTO supervisor(supervisor_id, first_name, last_name, phone_number)
            VALUES ('$supervisorID', '$FirstName', '$LastName', '$phone_number')";

    echo "<br>";

    if ($conn->query($sql) === TRUE) {
        echo "Supervisor data inserted successfully";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
    $conn->close();
}
?>

