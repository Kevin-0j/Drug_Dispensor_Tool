<?php
require "connection.php";
session_start();
//Meant for server adminstration CAT 1
// Initialize error message
//
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
        $table = 'drugs';
    } elseif ($userType == 'supervisor') {
        $table = 'supervisor';
    }
      elseif ($userType == 'pharmacist') {
          $table = 'prescription';
      }
    elseif ($userType == 'admin') {
        $table = 'admin';
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
                header("Location: Drugs/dashboard.php");
                exit();
            } elseif ($userType == 'supervisor') {
                header("Location: Supervisor/supervisor_page.php");
                exit();
            }
              elseif ($userType == 'pharmacist') {
                header("Location: Prescription/pharmacist_page.php");
                exit();
            }
            elseif ($userType == 'admin') {
                header("Location: Admin/admin_page.php");
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
  <style>
    body {
      font-family: Arial, sans-serif;
      background-color: #f2f2f2;
      margin: 0;
      padding: 20px;
    }

    h2 {
      color: #333333;
    }

    form {
      background-color: #ffffff;
      padding: 20px;
      border-radius: 5px;
      box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
    }

    input[type="text"],
    input[type="password"],
    select {
      padding: 10px;
      width: 200px;
      border: 1px solid #cccccc;
      border-radius: 5px;
      font-size: 14px;
      color: #333333;
    }

    label {
      color: #666666;
      margin-top: 10px;
      display: block;
    }

    button {
      padding: 10px 20px;
      background-color: #007bff;
      border: none;
      border-radius: 5px;
      color: #ffffff;
      font-size: 16px;
      cursor: pointer;
    }

    button:hover {
      background-color: #0056b3;
    }

    p {
      color: red;
      margin-top: 10px;
    }
  </style>
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
      <option value="pharmacist">Pharmacist</option>

      <option value="admin">Admin</option>

    </select><br><br>

    <button type="submit" name="login">Login</button>
    
    <?php if ($error !== '') { ?>
      <p style="color: red;"><?php echo $error; ?></p>

    <?php } ?>
  </form>
</body>
</html>



