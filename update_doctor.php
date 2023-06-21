<?php
require "connection.php";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $SSN = $_POST["SSN"];
    // Fetch the existing user information from the database
    $query = "SELECT * FROM doctor WHERE SSN = '$SSN'";
    $result = mysqli_query($conn, $query);
    $row = mysqli_fetch_assoc($result);

    // Display a form to edit the user's information
    echo "
    <form action='update_doctor.php' method='POST'>
        <input type='hidden' name='SSN' value='$SSN'>
        First Name: <input type='text' name='FName' value='".$row['FName']."'><br>
        Last Name: <input type='text' name='LName' value='".$row['LName']."'><br>
        Username: <input type='text' name='username' value='".$row['username']."'><br>
        Password: <input type='text' name='password' value='".$row['password']."'><br>
        Speciality: <input type='text' name='Speciality' value='".$row['Speciality']."'><br>
        Experience: <input type='text' name='Experience' value='".$row['Experience']."'><br>
        <input type='submit' value='Update'>
    </form>";
}

// Handle the form submission to update the user's information
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["FName"])) {
    $SSN = $_POST["SSN"];
    $FName = $_POST["FName"];
    $LName = $_POST["LName"];
    $username = $_POST["username"];
    $password = $_POST["password"];
    $Speciality = $_POST["Speciality"];
    $Experience = $_POST["Experience"];

    $updateQuery = "UPDATE doctor SET FName = '$FName', LName = '$LName', username = '$username', password = '$password', Speciality = '$Speciality', Experience = '$Experience' WHERE SSN = '$SSN'";

    if ($conn->query($updateQuery) === TRUE) {
        // Set a session variable to store the success message
        session_start();
        $_SESSION["successMessage"] = "Doctor information updated successfully";
        // Redirect to the doctor.php file
        header("Location: doctor.php");
        exit();
    } else {
        echo "Error updating doctor information: " . $conn->error;
    }
    $conn->close();
}
?>
