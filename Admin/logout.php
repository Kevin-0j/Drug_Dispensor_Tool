<?php
  // Start the session (if not already started)
  session_start();

  // Destroy the session data
  session_destroy();

  // Redirect to the home page (adjust the URL as needed)
  header("Location: home_page.html");
  exit();
?>
