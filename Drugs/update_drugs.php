<?php
require "connection.php";
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $drug_Id = $_POST["drug_id"];
    // Fetch the existing user information from the database
    $query = "SELECT * FROM drugs WHERE drug_id = '$drug_Id'";
    $result = mysqli_query($conn, $query);
    $row = mysqli_fetch_assoc($result);


    echo "
    <form action='update_drugs.php' method='POST'>
        <input type='hidden' name='drug_id' value='$drug_Id'>
        Trade Name: <input type='text' name='trade_name' value='".$row['trade_name']."' required><br>
        Text: <input type='text' name='text' value='".$row['text']."' required><br>
        Quantity: <input type='text' name='quantity' value='".$row['quantity']."' required><br>
        Company Name: <input type='text' name='company_name' value='".$row['company_name']."' required><br>
        Manufacturer Date: <input type='date' name='manufacturer_date' value='".$row['manufacturer_date']."' required><br>
        Expiry Date: <input type='date' name='expiry_date' value='".$row['expiry_date']."' required><br>
        <input type='submit' value='Update' class='btn btn-primary'>
    </form>";
}
                            
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["trade_name"])) {
    $drug_Id = $_POST["drug_id"];
    $tradeName = $_POST["trade_name"];
    $text = $_POST["text"];
    $quantity = $_POST["quantity"];
    $companyName = $_POST["company_name"];
    $manufacturerDate = $_POST["manufacturer_date"];
    $expiryDate = $_POST["expiry_date"];
    
    $updateQuery = "UPDATE drugs SET trade_name = '$tradeName', text = '$text', quantity = '$quantity', company_name = '$companyName', manufacturer_date = '$manufacturerDate', expiry_date = '$expiryDate' WHERE drug_id = '$drug_Id'";
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