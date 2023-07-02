<?php
require "connection.php";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if(isset($_POST["supervisor_id"])){
        $supervisor_id = $_POST["supervisor_id"];
        // Fetch the existing supervisor information from the database
        $query = "SELECT * FROM supervisor WHERE supervisor_id = '$supervisor_id'";
        $result = mysqli_query($conn, $query);
        $row = mysqli_fetch_assoc($result);

        // Display a form to edit the supervisor's information
        echo "
        <form action='update_supervisor.php' method='POST'>
            <input type='hidden' name='supervisor_id' value='$supervisor_id'>
            Supervisor ID:<input type='text' name='supervisor_id' value='".$row['supervisor_id']."'><br>
            First Name: <input type='text' name='First_name' value='".$row['First_name']."'><br>
            Last Name: <input type='text' name='Last_name' value='".$row['Last_name']."'><br>
            Username: <input type='text' name='username' value='".$row['username']."'><br>
            Password: <input type='text' name='password' value='".$row['password']."'><br>
            Phone Number: <input type='text' name='phone_number' value='".$row['phone_number']."'><br>
            <input type='submit' value='Update'>
        </form>";
    }
    else{
        echo "No supervisor ID provided.";
    }
}

// Handle the form submission to update the supervisor's information
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["First_name"]) && isset($_POST["supervisor_id"])) {
    // ...


    $supervisor_id = $_POST["supervisor_id"];
    $First_name = $_POST["First_name"];
    $Last_name = $_POST["Last_name"];
    $username = $_POST["username"];
    $password = $_POST["password"];
    $phone_number = $_POST["phone_number"];

    $updateQuery = "UPDATE supervisor SET First_name = '$First_name', Last_name = '$Last_name', username = '$username', password = '$password', phone_number = '$phone_number', supervisor_id = '$supervisor_id' WHERE supervisor_id = '$supervisor_id'";

    if ($conn->query($updateQuery) === TRUE) {
        // Set a session variable to store the success message
        session_start();
        $_SESSION["successMessage"] = "Supervisor information updated successfully";
        // Redirect to the supervisor.php file
        header("Location: supervisor.php");
        exit();
    } else {
        echo "Error updating supervisor information: " . $conn->error;
    }
    $conn->close();
}
?>
