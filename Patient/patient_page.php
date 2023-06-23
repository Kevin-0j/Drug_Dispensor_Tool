
<?php
session_start();

// Check if the user is logged in as a patient
if (isset($_SESSION['role']) && $_SESSION['role'] === 'patient') {
  // Retrieve the logged-in username
  $username = $_SESSION['username'];
} else {
  // Redirect to the login page if the user is not logged in as a patient
  header("Location: login.html");
  exit();
}
?>

<!DOCTYPE html>
<html>
<head>
  <title>Patient Page</title>
</head>
<body>
  <div style="text-align: right; padding: 10px;">
    Logged in as: <?php echo $username; ?>
  </div>
  <h1>Welcome Patient <?php echo $username; ?></h1>
  <p>This is the patient page.</p>
  <!-- Rest of the patient page content -->
</body>
</html>
