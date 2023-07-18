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

// Include frequency of taking the drugs
// Assuming you have a database connection, you can fetch the frequency information for the drugs
$drugFrequencies = array(
  'Aspirin' => 'Once daily',
  'Ibuprofen' => 'Every 4-6 hours',
  'Paracetamol' => 'Every 6 hours',
  // Add more drugs and their frequencies as needed
);

// Search for a patient
// Assuming you have a database connection, you can perform a search based on the patient's information
function searchPatient($patientName) {
  require("connection.php");

  $query = "SELECT * FROM patient WHERE first_name LIKE ? OR last_name LIKE ?";
  $stmt = mysqli_prepare($conn, $query);
  $searchTerm = "%$patientName%";
  mysqli_stmt_bind_param($stmt, "ss", $searchTerm, $searchTerm);
  mysqli_stmt_execute($stmt);
  $result = mysqli_stmt_get_result($stmt);

  $patients = array();

  while ($row = mysqli_fetch_assoc($result)) {
    $patient = array(
      'first_name' => $row['first_name'],
      'last_name' => $row['last_name'],
      'username' => $row['username'],
      'password' => $row['password'],
      'ssn' => $row['ssn'],
      'address' => $row['address'],
      'medical_history' => $row['medical_history']
      // Add more patient details as needed
    );

    $patients[] = $patient;
  }

  return $patients;
}

// Prescribe a drug
// Assuming you have a database connection, you can insert the prescribed drug information
function prescribeDrug($patientID, $drugName, $dosage, $quantity, $price) {
  require("connection.php");

  // Assuming you have a "drugs" table with appropriate columns: patient_ssn, trade_name, description, quantity, price
  $query = "INSERT INTO drugs (patient_ssn, trade_name, description, quantity, price) VALUES (?, ?, ?, ?, ?)";
  $stmt = mysqli_prepare($conn, $query);
  mysqli_stmt_bind_param($stmt, "isssd", $patientID, $drugName, $dosage, $quantity, $price);
  mysqli_stmt_execute($stmt);
  
  // Check if the prescription was successfully inserted
  if (mysqli_stmt_affected_rows($stmt) > 0) {
    return true; // Prescription successfully inserted
  } else {
    return false; // Prescription insertion failed
  }
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
?>

<!DOCTYPE html>
<html>
<head>
  <title>Doctor Page</title>
  <style>
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

  <h1 style="margin-top: 0;">Welcome Dr. <?php echo $username; ?></h1>

  <?php if (isset($message)) { ?>
    <p><?php echo $message; ?></p>
  <?php } ?>

  <form action="doctor_page.php" method="POST" enctype="multipart/form-data" style="display: none;">
    <input type="file" name="profile_picture" id="profile_picture" accept="image/*" onchange="this.form.submit();">
    <input type="submit" value="Upload">
  </form>

  <!-- Include frequency of taking the drugs -->
  <h2>Drug Frequencies:</h2>
  <ul>
    <?php foreach ($drugFrequencies as $drug => $frequency) { ?>
      <li><?php echo $drug . ': ' . $frequency; ?></li>
    <?php } ?>
  </ul>

  <!-- Search for a patient -->
  <h2>Search for a Patient:</h2>
  <form action="doctor_page.php" method="GET">
    <input type="text" name="patient_name" placeholder="Enter patient name">
    <input type="submit" value="Search">
  </form>

  <?php
// Handle the search form submission
if (isset($_GET['patient_name'])) {
  $patientName = $_GET['patient_name'];
  $patients = searchPatient($patientName);

  if ($patients) {
    // Display the patient's information
    echo '<h2>Patient Information:</h2>';
    foreach ($patients as $patient) {
      echo '<p>Name: ' . $patient['first_name'] . ' ' . $patient['last_name'] . '</p>';
      echo '<p>Username: ' . $patient['username'] . '</p>';
      // echo '<p>Password: ' . $patient['password'] . '</p>';
      echo '<p>SSN: ' . $patient['ssn'] . '</p>';
      echo '<p>Address: ' . $patient['address'] . '</p>';
      echo '<p>Medical History: ' . $patient['medical_history'] . '</p>';
      // Display more patient details as needed
      echo '<hr>';
    }
  } else {
    // Patient not found
    echo '<p>No patients found with the given name.</p>';
  }
}
?>

  <!-- Prescribe a drug -->
  <h2>Prescribe a Drug:</h2>
  <form action="drugs.php" method="POST">
    <input type="text" name="patient_ssn" placeholder="Patient SSN" required>
    <input type="text" name="trade_name" placeholder="Drug Name" required>
    <input type="text" name="description" placeholder="Dosage" required>
    <input type="text" name="quantity" placeholder="Quantity" required>
    <input type="text" name="price" placeholder="Price" required>
    <input type="submit" value="Prescribe">
  </form>
  <?php
  // Handle the prescription form submission
  if (isset($_POST['patient_ssn'], $_POST['trade_name'], $_POST['description'], $_POST['quantity'], $_POST['price'])) {
    $patientID = $_POST['patient_ssn'];
    $drugName = $_POST['trade_name'];
    $dosage = $_POST['description'];
    $quantity = $_POST['quantity'];
    $price = $_POST['price'];

    prescribeDrug($patientID, $drugName, $dosage, $quantity, $price);

    // Display success message
    echo '<p>Drug prescribed successfully!</p>';
  }
  ?>
  <!-- Rest of the doctor's page content -->
</body>
</html>
