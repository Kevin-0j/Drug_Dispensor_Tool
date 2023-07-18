<?php
session_start();

// Check if the user is logged in as an admin
if (isset($_SESSION['role']) && $_SESSION['role'] === 'admin') {
    // Retrieve the logged-in username
    $username = $_SESSION['username'];
} else {
    // Redirect to the login page if the user is not logged in as an admin
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
?>

<!DOCTYPE html>
<html>
<head>
    <title>Admin Page</title>
    <style>
         body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background-image: url("https://i.pinimg.com/564x/c5/c2/f3/c5c2f39e7f1122cf9dcd3fc1500de2a6.jpg");
            background-size: cover;
        }

        .container {
            max-width: 800px;
            margin: 0 auto;
            padding: 20px;
        }

        .title {
            font-size: 24px;
            margin-bottom: 10px;
        }

        .link {
            display: block;
            color: blue;
            margin-bottom: 10px;
            text-decoration: underline;
            cursor: pointer;
        }

        .link:hover {
            color: #0066cc;
        }

        table {
            border-collapse: collapse;
            width: 100%;
        }

        th, td {
            border: 1px solid #ddd;
            padding: 8px;
            text-align: center;
        }

        th {
            background-color: #f2f2f2;
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
    </style>
</head>
<body>
    <div class="container">
        <h1>Welcome Admin <?php echo $username; ?></h1>
        <div class="title">List of Doctors</div>
        <a href="doctor.php" class="link">View Doctors</a>

        <div class="title">List of Patients</div>
        <a href="patient.php" class="link">View Patients</a>

        <?php if (isset($message)) { ?>
            <p><?php echo $message; ?></p>
        <?php } ?>

        <div class="user-info">

            <div class="profile-picture-container">
                <div class="profile-picture">

                <img src="<?php echo $displayPicturePath; ?>" alt="Profile Picture">
            </div>
            <div class="upload-icon" onclick="document.getElementById('profile_picture').click();">+</div>
        </div>

        <form action="admin_page.php" method="POST" enctype="multipart/form-data" style="display: none;">
            <input type="file" name="profile_picture" id="profile_picture" accept="image/*" onchange="this.form.submit();">
        </form>
    </div>
</body>
</html>

