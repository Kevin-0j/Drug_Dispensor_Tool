<?php
require 'connection.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $supervisorID = $_POST['supervisor_id'];
    $supervisorName = $_POST['supervisor_name'];
    $phoneNo = $_POST['phoneNo'];

    $sql = "INSERT INTO supervisors (SupervisorID, SupervisorName, PhoneNo)
            VALUES ('$supervisorID', '$supervisorName', '$phoneNo')";

    echo "<br>";

    if ($conn->query($sql) === TRUE) {
        echo "Supervisor data inserted successfully";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
    $conn->close();
}
?>
