<?php
require "connection.php";
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $patientID = $_POST["patient_ssn"];
    // Fetch the existing user information from the database
    $query = "SELECT * FROM drugs WHERE patient_ssn = '$patientID'";
    $result = mysqli_query($conn, $query);
    $row = mysqli_fetch_assoc($result);

    echo "
    <form action='update_drugs.php' method='POST'>
        <input type='hidden' name='patient_ssn' value='$patientID'>
        Patient ssn: <input type='text' name='patient_ssn' value='$row[patient_ssn]'><br>
        Drug Name: <input type='text' name='trade_name' value='$row[trade_name]'><br>
        Dosage: <input type='text' name='description' value='$row[description]'><br>
        Quantity: <input type='text' name='quantity' value='$row[quantity]'><br>
        Price: <input type='text' name='price' value='$row[price]'><br>
        <input type='submit' value='Update'>
    </form>";
}

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["trade_name"])) {
    $patientID = $_POST["patient_ssn"];
    $drug_name = $_POST["trade_name"];
    $description = $_POST["description"];
    $amount = $_POST["quantity"];
    $price = $_POST["price"];

    $updateQuery = "UPDATE drugs SET trade_name = '$drug_name', description = '$description', quantity = '$amount', price = '$price' WHERE patient_ssn = '$patientID'";
    
    if ($conn->query($updateQuery) === TRUE) {
        session_start();
        $_SESSION["successMessage"] = "Drug information updated successfully";
        header("Location: drugs.php");
        exit();
    } else {
        echo "Error updating drug information: " . $conn->error;
    }
    
    $conn->close();
}
?>
