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

// Specify the directory where uploaded profile pictures will be stored
$uploadDirectory = 'profile_pictures/';

// Handle profile picture upload
if (isset($_FILES['profile_picture'])) {
  $file = $_FILES['profile_picture'];

  // Check if the file was uploaded without errors
  if ($file['error'] === UPLOAD_ERR_OK) {
    $tempFilePath = $file['tmp_name'];

    // Create the directory if it doesn't exist
    if (!file_exists($uploadDirectory)) {
      mkdir($uploadDirectory, 0755, true);
    }

    // Generate a unique filename based on the username and original file name
    $fileName = $username . '_' . $file['name'];
    $targetFilePath = $uploadDirectory . $fileName;

    // Move the uploaded file to the desired location
    if (move_uploaded_file($tempFilePath, $targetFilePath)) {
      // File upload success
      #$message = 'Profile picture uploaded successfully!';
    } else {
      // File upload failed
      $message = 'Error uploading profile picture.';
    }

    // Set the profile picture path
    $profilePicturePath = $targetFilePath;
  } else {
    // No file uploaded or upload error occurred
    $message = 'No profile picture uploaded.';
  }
}

// Check if the user has uploaded a profile picture or use the default profile picture
$defaultPicturePath = 'default_profile_picture.jpg';
$displayPicturePath = isset($profilePicturePath) ? $profilePicturePath : $defaultPicturePath;

// Handle appointment booking
if (isset($_POST['appointment_date'])) {
  $appointmentDate = $_POST['appointment_date'];
  bookAppointment($username, $appointmentDate);

  // Display success message
  $successMessage = 'Appointment booked successfully!';
}

// Encouragement note on good health
$encouragementNote = 'Stay healthy and take care of yourself. Your well-being matters!';

function bookAppointment($username, $appointmentDate) {
  // Add your code here to handle the booking of the appointment
  // You can store the appointment information in a database or perform any other necessary operations
}
?>

<!DOCTYPE html>
<html>
<head>
  <title>Patient Page</title>
  <style>
     body {
      /* Add the background image link here */
      background-image: url('https://i.pinimg.com/564x/0f/bb/80/0fbb80d55d38c753a3165d71c7303d48.jpg');
      /* Set background image size and other properties as needed */
      background-size: cover;
      background-repeat: no-repeat;
      background-position: center;
      margin: 0; /* Remove default margin from body */
      padding: 0; /* Remove default padding from body */
      min-height: 100vh; /* Set minimum height to cover the entire viewport */
      display: flex;
      flex-direction: column;
      justify-content: center;
      align-items: center;
    }
    .user-info {
      display: flex;
      justify-content: flex-end; /* Align user info to the right */
      padding: 10px;
      align-items: center; /* Align items vertically */
    }
    .profile-picture-container {
      display: flex;
      flex-direction: column;
      align-items: flex-end; /* Align items to the right */
      margin-left: 20px; /* Add margin between the text and profile picture */
    }
    .profile-picture {
      width: 100px;
      height: 100px;
      border-radius: 50%;
      background-color: #ccc;
      overflow: hidden;
      position: relative;
      margin-top: 10px;
    }
    .profile-picture img {
      width: 100%;
      height: 100%;
      object-fit: cover;
    }
    .profile-picture .upload-icon {
      position: absolute;
      bottom: -2px; /* Adjust the value to position the plus sign */
      right: 39px; /* Adjust the value to position the plus sign */
      background-color: #4CAF50;
      color: #fff;
      width: 20px;
      height: 20px;
      border-radius: 50%;
      display: flex;
      justify-content: center;
      align-items: center;
      cursor: pointer;
      font-size: 16px;
    }
    .success-message {
      color: green;
    }
    .encouragement-note {
      font-style: italic;
      color: #888;
    }
  </style>
</head>
<body>
  <div class="user-info">
    <h3 style="margin: 0;">Logged in as: <?php echo $username; ?></h3>
    <div class="profile-picture-container">
      <div class="profile-picture">
        <img src="<?php echo $displayPicturePath; ?>" alt="Profile Picture">
        <div class="upload-icon" onclick="document.getElementById('profile_picture').click();">+</div>
      </div>
    </div>
  </div>

  <h1 style="margin-top: 0;">Welcome Patient <?php echo $username; ?></h1>

  <?php if (isset($message)) { ?>
    <p><?php echo $message; ?></p>
  <?php } ?>

  <form action="patient_page.php" method="POST" enctype="multipart/form-data" style="display: none;">
    <input type="file" name="profile_picture" id="profile_picture" accept="image/*" onchange="this.form.submit();">
    <input type="submit" value="Upload">
  </form>

  <!-- Book Appointment -->
  <h2>Book Appointment:</h2>
  <?php if (isset($successMessage)) { ?>
    <p class="success-message"><?php echo $successMessage; ?></p>
  <?php } ?>
  <form action="patient_page.php" method="POST">
    <input type="date" name="appointment_date" required>
    <input type="submit" value="Book">
  </form>

  <!-- Encouragement note -->
  <p class="encouragement-note"><?php echo $encouragementNote; ?></p>

  <!-- Rest of the patient's page content -->
</body>
</html>
