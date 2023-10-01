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

    $company_name = $_POST['company_name'];
    $pharmaceuticalcomp_id = $_POST['pharmaceuticalcomp_id'];
    $username =$_POST["username"];
    $password =$_POST["password"];
    $tradename =$_POST["trade_name"];
    $category =$_POST["category"];
    $type =$_POST["type"];
    $image =$_POST["image"];
    $price =$_POST["price"];
    $drug_Id =$_POST["drug_id"];
    $quantity =$_POST["quantity"];
    $manufacture_date =$_POST["manufacture_date"];
    $expiryDate =$_POST["expiry_date"];

    $sql = "INSERT INTO drugs (company_name, pharmaceuticalcomp_id, username, password, trade_name, category, type, image, price, drug_id, quantity, manufacture_date, expiry_date)
    VALUES ('$company_name', '$pharmaceuticalcomp_id', '$username', '$password', '$tradename', '$category', '$type', '$image', '$price', '$drug_Id', '$quantity', '$manufacture_date', '$expiryDate')";
    



    if ($conn->query($sql) === TRUE) {
        echo "Company and drugs registered successfully!";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
    $conn->close();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pharamceutical Table</title>
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
                        <h2 class="display-6 text-center"> Table of  Pharmaceutical Companies and Registered</h2>
                    </div>
                    <div class="card-body">
                        <?php
                        if (isset($_SESSION["deleteMessage"])) {
                            echo "<div class='alert alert-success'>" . $_SESSION["deleteMessage"] . "</div>";
                            unset($_SESSION["deleteMessage"]);
                        }
                        ?>
                        <table>
                            <tr> 
                                <th>Company Name</th>
                                <th>Pharmaceutical Company ID</th>
                                <th>Username</th>
                                <th>Password</th>
                                <th>Trade Name</th>
                                <th>Category</th>
                                <th>Type</th>     
                                <th>Image</th> 
                                <th>Price</th> 
                                <th>Drug ID</th>
                                <th>Quantity</th>
                                <th>Manufacture Date</th>
                                <th>Expiry Date</th>

                                
                                
                                
                            </tr>
                            <?php
                            require("connection.php");
                            $query = "SELECT * FROM drugs";
                            $result = mysqli_query($conn, $query);
                            while ($row = mysqli_fetch_assoc($result)) {
                             ?>
                                <tr>
                                    <td><?php echo $row['company_name']; ?></td>
                                    <td><?php echo $row['pharmaceuticalcomp_id']; ?></td>
                                    <td><?php echo $row['username']; ?></td>
                                    <td><?php echo $row['password']; ?></td>
                                    <td><?php echo $row['trade_name']; ?></td>
                                    <td><?php echo $row['category']; ?></td>
                                    <td><?php echo $row['type']; ?></td>
                                    <td><?php echo $row['image']; ?></td>
                                    <td><?php echo $row['price']; ?></td>
                                    <td><?php echo $row['drug_id']; ?></td>
                                    <td><?php echo $row['quantity']; ?></td>
                                    <td><?php echo $row['manufacture_date']; ?></td>
                                    <td><?php echo $row['expiry_date']; ?></td>


                                    
                                    <td>
                                        <form action="update_pharmaceutical.php" method="POST">
                                            <input type="hidden" name="pharmaceuticalcomp_id" value="<?php echo $row['pharmaceuticalcomp_id']; ?>">
                                            <button type="submit" class="btn btn-primary">Update</button>
                                        </form>
                                    </td>
                                    <td>
                                        <form action="delete_pharmaceutical.php" method="POST">
                                            <input type="hidden" name="pharmaceuticalcomp_id" value="<?php echo $row['pharmaceuticalcomp_id']; ?>">
                                            <button type="submit" class="btn btn-danger">Delete</button>
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
