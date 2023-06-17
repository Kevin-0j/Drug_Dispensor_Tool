<?php
require "connection.php";

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $contract_id = $_POST['contract_id'];
    $start_date = $_POST['start_date'];
    $end_date = $_POST['end_date'];
    $pharmacy_id = $_POST['pharmacy_id'];

    $sql = "INSERT INTO contract(contract_id, start_date, end_date,pharmacy_id)
            VALUES ('$contract_id', '$start_date', '$end_date','$pharmacy_id')";

    echo "<br>";

    if ($conn->query($sql) === TRUE) {
        echo "Company registered successfully!";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
    $conn->close();
}
?>
