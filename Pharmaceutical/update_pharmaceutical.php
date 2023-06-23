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
        Username: <input type='text' name='username' value='".$row['username']."'><br>
        Password: <input type='text' name='password' value='".$row['password']."'><br>
        Phone Number: <input type='text' name='phone_number' value='".$row['phone_number']."'><br>
        <input type='submit' value='Update'>
    </form>";
}

// Handle the form submission to update the user's information
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["company_name"])) {
    $company_name = $_POST["company_name"];
    $username = $_POST["username"];
    $password = $_POST["password"];
    $phone_number= $_POST["phone_number"];
    $pharmaceuticalcomp_id = $_POST["pharmaceuticalcomp_id"];

    $updateQuery = "UPDATE pharmaceutical SET company_name = '$company_name',  username = '$username', password = '$password', phone_number = '$phone_number' WHERE pharmaceuticalcomp_id = '$pharmaceuticalcomp_id'";

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
