

<?php
session_start();

// Check if the user is logged in as a doctor
if (isset($_SESSION['role']) && $_SESSION['role'] === 'doctor') {
  // Retrieve the logged-in username
  $username = $_SESSION['username'];
} else {
  // Redirect to the login page if the user is not logged in as a doctor
  header("Location: login.html");
  exit();
}
?>

<!DOCTYPE html>
<html>
<head>
  <title>Doctor Page</title>
</head>
<body>
  <div style="text-align: right; padding: 10px;">
    Logged in as: <?php echo $username; ?>
  </div>
  <h1>Welcome Dr. <?php echo $username; ?></h1>
  <p>This is the doctor's page.</p>
  <!-- Rest of the doctor's page content -->
</body>
</html>
