<?php
require "connection.php";

// Check if the success message is set
session_start();
if (isset($_SESSION["successMessage"])) {
    echo "<div class='alert alert-success'>" . $_SESSION["successMessage"] . "</div>";
    // Unset the session variable to clear the message
    unset($_SESSION["successMessage"]);
}

// Retrieve form data
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $firstName = $_POST["FirstName"];
    $lastName = $_POST["LastName"];
    $username = $_POST['username'];
    $password = $_POST['password'];

    $sql = "INSERT INTO prescription (firstName, lastName, username, password)
            VALUES ('$firstName', '$lastName', '$username', '$password')";

    if ($conn->query($sql) === TRUE) {
        $_SESSION["successMessage"] = "Prescription submitted successfully!";
        header("Location: prescription.php");
        exit();
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
    $conn->close();
}
?>

<!-- Rest of your HTML code remains unchanged -->


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Prescriptions Page</title>
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
        <div class="row mt-6">
            <div class="col">
                <div class="card mt-6">
                    <div class="card-header">
                        <h2 class="display-6 text-center">Table of Pharmacists</h2>
                    </div>
                    <div class="card-body">
                        <?php
                        if (isset($_SESSION["deleteMessage"])) {
                            echo "<div class='alert alert-success'>" . $_SESSION["deleteMessage"] . "</div>";
                            unset($_SESSION["deleteMessage"]);
                        }
                        ?>
                        
                        <table class="table table-bordered text-center">
                            <tr>
                                <th>First Name</th>
                                <th>Last Name</th>
                                <th>Username</th>
                                <th>Password</th>
                                
                            </tr>
                            <?php
                            require("connection.php");
                            $query = "SELECT * FROM prescription";
                            $result = mysqli_query($conn, $query);
                            while ($row = mysqli_fetch_assoc($result)) {
                                ?>
                                <tr>
                                    <td><?php echo $row["firstName"]; ?></td>
                                    <td><?php echo $row["lastName"]; ?></td>
                                    <td><?php echo $row["username"]; ?></td>
                                    <td><?php echo $row["password"]; ?></td>

                                    <td>
                                        <form action="update_prescription.php" method="POST">
                                            <input type="hidden" name="username" value="<?php echo $row["username"]; ?>">
                                            <button type="submit" class="btn btn-sm btn-danger">Update</button>
                                        </form>
                                    </td>
                                    <td>
                                        <form action="delete_prescription.php" method="POST">
                                            <input type="hidden" name="username" value="<?php echo $row["username"]; ?>">
                                            <button type="submit" class="btn btn-sm btn-warning">Delete</button>
                                        </form>
                                    </td>
                                </tr>
                                <?php
                            }
                            ?>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
</html>
