<?php
session_start();

// Check if the user is logged in as a doctor
if (isset($_SESSION['role']) && $_SESSION['role'] === 'doctor') {
  // Retrieve the logged-in username
  $username = $_SESSION['username'];

  // Specify the directory where uploaded profile pictures will be stored
  $uploadDirectory = 'profile_pictures/';

  // Check if the file was uploaded without errors
  if (isset($_FILES['profile_picture']) && $_FILES['profile_picture']['error'] === UPLOAD_ERR_OK) {
    $tmpFilePath = $_FILES['profile_picture']['tmp_name'];
    $newFilePath = $uploadDirectory . $username . '_' . $_FILES['profile_picture']['name'];

    // Move the uploaded file to the desired location
    if (move_uploaded_file($tmpFilePath, $newFilePath)) {
      // File upload success
      echo 'Profile picture uploaded successfully!';
    } else {
      // File upload failed
      echo 'Error uploading profile picture.';
    }
  } else {
    // No file uploaded or upload error occurred
    echo 'No profile picture uploaded.';
  }
} else {
  // Redirect to the login page if the user is not logged in as a doctor
  header("Location: login.html");
  exit();
}
?>
