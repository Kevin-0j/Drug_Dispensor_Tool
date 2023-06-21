<?php
session_start();

// Check if the user is logged in as a pharmaceutical user
if (isset($_SESSION['role']) && $_SESSION['role'] === 'pharmaceutical') {
  // Retrieve the logged-in username
  $username = $_SESSION['username'];
} else {
  // Redirect to the login page if the user is not logged in as a pharmaceutical user
  header("Location: login.html");
  exit();
}
?>

<!DOCTYPE html>
<html>
<head>
  <title>Pharmaceutical Page</title>
</head>
<body>
  <div style="text-align: right; padding: 10px;">
    Logged in as: <?php echo $username; ?>
  </div>
  <h1>Welcome Pharmacist <?php echo $username; ?></h1>
  <p>This is the pharmaceutical page.</p>
  <!-- Rest of the pharmaceutical page content -->
</body>
</html>
