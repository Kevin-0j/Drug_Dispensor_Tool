<!-- save_drug.php -->
<?php
require "connection.php";

// Handle form submission
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $category = $_POST["category"];

    // Create the uploads directory if it doesn't exist
    $target_dir = __DIR__ . "/uploads/";
    if (!file_exists($target_dir)) {
        mkdir($target_dir, 0777, true);
    }

    // Upload image to server
    $image = $_FILES["image"]["name"];
    $target_file = $target_dir . basename($image);

    if (move_uploaded_file($_FILES["image"]["tmp_name"], $target_file)) {
        // Save drug details to the database
        $sql = "INSERT INTO drugs (company_name, pharmaceuticalcomp_id, username, password, trade_name, drug_id, quantity, manufacture_date, expiry_date, category, image)
        VALUES ('$company_name', '$pharmaceuticalcomp_id', '$username', '$password', '$tradename', '$drug_Id', '$quantity', '$manufacture_date', '$expiryDate', '$category', '$target_file')";
    

        if ($conn->query($sql) === TRUE) {
            echo "Drug details added successfully";
        } else {
            echo "Error: " . $sql . "<br>" . $conn->error;
        }
    } else {
        echo "Error uploading file.";
    }
}

$conn->close();
?>
