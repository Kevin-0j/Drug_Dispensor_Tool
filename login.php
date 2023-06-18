<?php
require "connection.php";

session_start();

// Assuming you have already established a database connection

 /// This is for the Doctor Page

// Handle form submission
if ($_SERVER["REQUEST_METHOD"] == "POST") {
  $username = $_POST['FName'];
  $password = $_POST['LName'];

  // Check if the user exists in the doctors table
  $query = "SELECT * FROM doctor WHERE FName = '$username' AND LName = '$password'";
  $result = mysqli_query($conn, $query);

  if (mysqli_num_rows($result) == 1) {
    $_SESSION['username'] = $username;
    $_SESSION['role'] = 'doctor';
    header("Location: doctor_page.php");
    exit();
  }
   // Redirect to registration form if the user doesn't exist
   header("Location: doctorform.html");
   exit();


}

?>
