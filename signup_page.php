<?php
session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['user_type'])) {
    $userType = $_POST['user_type'];

    // Redirect to the appropriate signup form based on the selected user type
    if ($userType == 'doctor') {
        header("Location: Doctor/doctorform.html");
        exit();
    } elseif ($userType == 'patient') {
        header("Location: Patient/patientform.html");
        exit();
    } elseif ($userType == 'pharmaceutical') {
        header("Location: Pharmaceutical/pharmaceuticalregistrationform.html");
        exit();
    } elseif ($userType == 'supervisor') {
        header("Location: Supervisor/supervisorform.html");
        exit();
    }
} else {
    // Handle invalid request or missing user type
    echo "Invalid request";
}
?>
