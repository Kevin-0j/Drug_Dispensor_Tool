<?php
require 'connection.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $tradeName = $_POST['trade_name'];
    $text = $_POST['text'];
    $quantity = $_POST['quantity'];
    $companyName = $_POST['company_name'];
    $manufacturerDate = $_POST['manufacturer_date'];
    $expiryDate = $_POST['expiry_date'];

    $sql = "INSERT INTO drugs (TradeName, Text, Quantity, CompanyName, ManufacturerDate, ExpiryDate)
            VALUES ('$tradeName', '$text', '$quantity', '$companyName', '$manufacturerDate', '$expiryDate')";

    echo "<br>";

    if ($conn->query($sql) === TRUE) {
        echo "Drug data inserted successfully";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
    $conn->close();
}
?>
