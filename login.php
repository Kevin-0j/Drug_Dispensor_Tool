<?php
session_start();

// Define the registered users
$users = array(
    array("username" => "admin", "password" => "admin123", "type" => "admin"),
    array("username" => "pharmacist", "password" => "pharma123", "type" => "pharmacist"),
    array("username" => "doctor", "password" => "doctor123", "type" => "doctor")
);

// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST["username"];
    $password = $_POST["password"];

    // Check if the username and password are valid
    foreach ($users as $user) {
        if ($user["username"] == $username && $user["password"] == $password) {
            // Create a session and store the user's information
            $_SESSION["username"] = $username;
            $_SESSION["type"] = $user["type"];

            // Redirect the user to the appropriate page
            if ($user["type"] == "admin") {
                header("Location: admin.php");
            } else if ($user["type"] == "pharmacist") {
                header("Location: pharmacist.php");
            } else if ($user["type"] == "doctor") {
                header("Location: doctor.php");
            }
            exit();
        }
    }

    // If the username and password are invalid, show an error message
    $error = "Invalid username or password.";
}
?>

<!-- Create the login form -->
<form method="post">
    <label>Username:</label>
    <input type="text" name="username"><br>

    <label>Password:</label>
    <input type="password" name="password"><br>

    <button type="submit">Login</button>
</form>

<?php
// Display the user's username if logged in
if (isset($_SESSION["username"])) {
    echo "Welcome, " . $_SESSION["username"] . "!";
}
?>
