<?php
require "connection.php";
session_start();

// Initialize error message
$error = '';

// Handle login
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['login'])) {
    $username = $_POST['username'];
    $password = $_POST['password'];
    $userType = $_POST['user_type'];

    // Determine the appropriate table based on the selected user type
    $table = '';

    if ($userType == 'doctor') {
        $table = 'doctor';
    } elseif ($userType == 'patient') {
        $table = 'patient';
    } elseif ($userType == 'pharmaceutical') {
        $table = 'pharmaceutical';
    } elseif ($userType == 'supervisor') {
        $table = 'supervisor';
    }

    if ($table !== '') {
        // Check if the user exists in the specified table
        $query = "SELECT * FROM $table WHERE username = '$username' AND password = '$password'";
        $result = mysqli_query($conn, $query);

        if (mysqli_num_rows($result) == 1) {
            $_SESSION['username'] = $username;
            $_SESSION['role'] = $userType;

            // Redirect to the appropriate page based on user type
            if ($userType == 'doctor') {
                header("Location: Doctor/doctor_page.php");
                exit();
            } elseif ($userType == 'patient') {
                header("Location: Patient/patient_page.php");
                exit();
            } elseif ($userType == 'pharmaceutical') {
                header("Location: Pharmaceutical/pharmaceutical_page.php");
                exit();
            } elseif ($userType == 'supervisor') {
                header("Location: Supervisor/supervisor_page.php");
                exit();
            }
        } else {
            $error = "Invalid username or password.";
        }
    }
}
?>

<!DOCTYPE html>
<html>
<head>
  <title>Login</title>
</head>
<body>
  <h2>Login</h2>
  
  <form method="POST" action="login.php">
    <input type="text" name="username" placeholder="Username" required><br><br>
    <input type="password" name="password" placeholder="Password" required><br><br>
    
    <label for="user_type">Select user type:</label>
    <select name="user_type" id="user_type">
      <option value="doctor">Doctor</option>
      <option value="patient">Patient</option>
      <option value="pharmaceutical">Pharmaceutical</option>
      <option value="supervisor">Supervisor</option>
    </select><br><br>

    <button type="submit" name="login">Login</button>
    
    <?php if ($error !== '') { ?>
      <p style="color: red;"><?php echo $error; ?></p>
    <?php } ?>
  </form>
</body>
</html>
