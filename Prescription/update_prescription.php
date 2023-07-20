<?php
require "connection.php";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST["username"];

    // Fetch the existing prescription information from the database
    $query = "SELECT * FROM prescription WHERE username= '$username'";
    $result = mysqli_query($conn, $query);
    $row = mysqli_fetch_assoc($result);

    // Display a form to edit the prescription's information
    echo "
    <form action='update_prescription.php' method='POST'>
        <input type='hidden' name='username' value='$username'>
        First Name: <input type='text' name='firstName' value='".$row['firstName']."'><br>
        Last Name: <input type='text' name='lastName' value='".$row['lastName']."'><br>
        Username: <input type='text' name='username' value='".$row['username']."'><br>
        Password: <input type='text' name='password' value='".$row['password']."'><br>
        <input type='submit' value='Update'>
    </form>";
}



if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["username"])) {
    $firstName = $_POST["firstName"];
    $lastName = $_POST["lastName"];
    $username = $_POST["username"];
    $password = $_POST["password"];

    $updateQuery = "UPDATE prescription SET firstName = '$firstName', lastName = '$lastName', username = '$username', password = '$password' WHERE username = '$username'";

    if ($conn->query($updateQuery) === TRUE) {
        // Set a session variable to store the success message
        $_SESSION["successMessage"] = "Pharmacist information updated successfully";
        // Redirect to the prescription.php file
        header("Location: prescription.php");
        exit();
    } else {
        echo "Error updating pharmacist information: " . $conn->error;
    }
    $conn->close();
}
?>

<!-- Rest of your HTML code remains unchanged -->

