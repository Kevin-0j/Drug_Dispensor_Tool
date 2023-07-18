<?php
require "connection.php";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $trade_name = $_POST["trade_name"];

    // Fetch the existing prescription information from the database
    $query = "SELECT * FROM prescription WHERE trade_name = '$trade_name'";
    $result = mysqli_query($conn, $query);
    $row = mysqli_fetch_assoc($result);

    // Display a form to edit the prescription's information
    echo "
    <form action='update_prescription.php' method='POST'>
        <input type='hidden' name='trade_name' value='$trade_name'>
        Trade Name: <input type='text' name='updated_trade_name' value='".$row['trade_name']."'><br>
        Description: <input type='text' name='description' value='".$row['description']."'><br>
        Patient SSN: <input type='text' name='patient_ssn' value='".$row['patient_ssn']."'><br>
        <input type='submit' value='Update'>
    </form>";
}

// Handle the form submission to update the prescription's information
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["updated_trade_name"])) {
    $trade_name = $_POST["trade_name"];
    $updated_trade_name = $_POST["updated_trade_name"];
    $description = $_POST["description"];
    $patient_ssn = $_POST["patient_ssn"];

    $updateQuery = "UPDATE prescription SET trade_name = '$updated_trade_name', description = '$description', patient_ssn = '$patient_ssn' WHERE trade_name = '$trade_name'";

    if ($conn->query($updateQuery) === TRUE) {
        // Set a session variable to store the success message
        session_start();
        $_SESSION["successMessage"] = "Prescription information updated successfully";
        // Redirect to the prescription.php file
        header("Location: prescription.php");
        exit();
    } else {
        echo "Error updating prescription information: " . $conn->error;
    }
    $conn->close();
}
?>
