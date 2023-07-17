<?php
require 'connection.php';
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

// Insert new admin if the form is submitted
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $firstname = $_POST['firstname'];
    $lastname = $_POST['lastname'];
    $username = $_POST['username'];
    $password = $_POST['password'];
    $email = $_POST['email'];

    // Create a query to insert the new admin into the database
    $sql = "INSERT INTO admin (firstname, lastname, username, password, email) VALUES ('$firstname', '$lastname', '$username', '$password', '$email')";

    // Check if the query was successful
    if (mysqli_query($conn, $sql)) {
        // Redirect to refresh the page and display the updated table
        header("Location: admin.php");
        exit();
    } else {
        echo "Error: " . $sql . "<br>" . mysqli_error($conn);
    }
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <title>Admin Table</title>
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <style>
        table {
            border-collapse: collapse;
            border: 1px solid black;
        }
        th, td {
            border: 1px solid black;
            padding: 8px;
            text-align: center;
        }
        th {
            background-color: #333;
            color: white;
        }
    </style>
</head>
<body class="bg-dark">
    <div class="container">

        <h2>List of Admins</h2>
        <table>
            <tr>
                <th>Firstname</th>
                <th>Lastname</th>
                <th>Username</th>
                <th>Password</th>
                <th>Email</th>
            </tr>
            <?php
            // Create a query to select all the data from the admin table
            $sql = "SELECT * FROM admin";
            // Execute the query
            $result = mysqli_query($conn, $sql);
            // Check if the query was successful
            if ($result) {
                // Loop through the data and display it in a table format
                while ($row = mysqli_fetch_assoc($result)) {
                    echo "<tr>";
                    echo "<td>" . $row['firstname'] . "</td>";
                    echo "<td>" . $row['lastname'] . "</td>";
                    echo "<td>" . $row['username'] . "</td>";
                    echo "<td>" . $row['password'] . "</td>";
                    echo "<td>" . $row['email'] . "</td>";
                    echo "</tr>";
                }
            } else {
                echo "Error: " . $sql . "<br>" . mysqli_error($conn);
            }
            // Close the connection
            mysqli_close($conn);
            ?>
        </table>
    </div>
</body>
</html>
