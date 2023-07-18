<?php
require "connection.php";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $pharmaceuticalcomp_id = $_POST["pharmaceuticalcomp_id"];
    // Fetch the existing user information from the database
    $query = "SELECT * FROM pharmaceutical  WHERE pharmaceuticalcomp_id = '$pharmaceuticalcomp_id'";
    $result = mysqli_query($conn, $query);
    $row = mysqli_fetch_assoc($result);

    // Display a form to edit the user's information
    echo "
    <form action='update_pharmaceutical.php' method='POST'>
        <input type='hidden' name='pharmaceuticalcomp_id' value='$pharmaceuticalcomp_id'>
        Company Name: <input type='text' name='company_name' value='".$row['company_name']."'><br>
        Pharmaceutical Company ID: <input type='text' name='pharmaceuticalcomp_id' value='".$row['pharmaceuticalcomp_id']."'><br>
        Username: <input type='text' name='username' value='".$row['username']."'><br>
        Password: <input type='text' name='password' value='".$row['password']."'><br>
        Trade Name: <input type='text' name='trade_name' value='".$row['trade_name']."'><br>
        Drug ID: <input type='text' name='drug_id' value='".$row['drug_id']."'><br>
        Quantity: <input type='text' name='quantity' value='".$row['quantity']."'><br>
        Manufacturer Date: <input type='text' name='manufacturer_date' value='".$row['manufacturer_date']."'><br>
        Expiry Date: <input type='text' name='expiry_date' value='".$row['expiry_date']."'><br>


        
        <input type='submit' value='Update'>
    </form>";
}

// Handle the form submission to update the user's information
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["company_name"])) {
    $company_name = $_POST["company_name"];
    $pharmaceuticalcomp_id = $_POST["pharmaceuticalcomp_id"];
    $username = $_POST["username"];
    $password = $_POST["password"];
    $tradename = $_POST["trade_name"];
    $drug_id = $_POST["drug_id"];
    $quantity = $_POST["quantity"];
    $manufacturer_date = $_POST["manufacturer_date"];
    $expiry_date = $_POST["expiry_date"];

    

    $updateQuery = "UPDATE pharmaceutical SET company_name = '$company_name', trade_name= '$tradename',drug_id='$drug_id',quantity='$quantity',manufacture_date='$manufacture_date',expiry_date='$expiry_date', username = '$username', password = '$password' WHERE pharmaceuticalcomp_id = '$pharmaceuticalcomp_id'";

    if ($conn->query($updateQuery) === TRUE) {
        // Set a session variable to store the success message
        session_start();
        $_SESSION["successMessage"] = "Pharmaceutical information updated successfully";
        // Redirect to the pharmaceutical.php file
        header("Location: pharmaceutical.php");
        exit();
    } else {
        echo "Error updating pharmaceutical information: " . $conn->error;
    }
    $conn->close();
}
?>
