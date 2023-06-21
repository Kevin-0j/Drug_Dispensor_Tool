<?php

session_start();

// Check if the user is logged in as a supervisor
if (isset($_SESSION['role']) && $_SESSION['role'] === 'supervisor') {
  // Retrieve the logged-in username
  $username = $_SESSION['username'];
} else {
  // Redirect to the login page if the user is not logged in as a supervisor
  header("Location: login.html");
  exit();
}
?>

<!DOCTYPE html>
<html>
<head>
  <title>Supervisor Page</title>
</head>
<body>
  <div style="text-align: right; padding: 10px;">
    Logged in as: <?php echo $username; ?>
  </div>
  <h1>Welcome Supervisor <?php echo $username; ?></h1>
  <p>This is the supervisor's page.</p>
  <!-- Rest of the supervisor's page content -->
</body>
</html>
