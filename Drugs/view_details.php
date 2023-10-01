<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Drug Details</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f2f2f2;
            background-image: url("https://images.unsplash.com/photo-1586015555751-63bb77f4322a?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=1470&q=80");
        }

        h2 {
            text-align: center;
            font size: 35px;
            color: #333;
            background-color: #555;
            padding: 10px;
            border-radius: 8px;
            margin-bottom: 20px;
        }

        .drug-details {
            max-width: 600px;
            margin: 0 auto;
            background-color: #fff;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        .drug-details p {
            margin: 10px 0;
        }

        .drug-details img {
            max-width: 100%;
            height: auto;
            border: 1px solid #ccc;
            border-radius: 8px;
            margin-top: 10px;
        }
    </style>
</head>
<body>
    <h2>Drug Details</h2>

    <div class="drug-details">
        <?php
        require "connection.php";
        $conn = new mysqli($servername, $username, $password, $dbname);

        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        }

        $drug_id = $_GET["id"];
        $sql = "SELECT * FROM drugs WHERE drug_id = $drug_id";
        $result = $conn->query($sql);

        if ($result) {
            if ($result->num_rows > 0) {
                $row = $result->fetch_assoc();

                echo "<p><strong>Company Name:</strong> " . $row["company_name"] . "</p>";
                echo "<p><strong>Pharmaceutical Company ID:</strong> " . $row["pharmaceuticalcomp_id"] . "</p>";
                echo "<p><strong>Username:</strong> " . $row["username"] . "</p>";
                echo "<p><strong>Trade Name:</strong> " . $row["trade_name"] . "</p>";
                echo "<p><strong>Drug ID:</strong> " . $row["drug_id"] . "</p>";
                echo "<p><strong>Quantity:</strong> " . $row["quantity"] . "</p>";
                echo "<p><strong>Manufacture Date:</strong> " . $row["manufacture_date"] . "</p>";
                echo "<p><strong>Expiry Date:</strong> " . $row["expiry_date"] . "</p>";

                echo "<img src='uploads/" . basename($row["image"]) . "' alt='" . $row["category"] . "'>";
            } else {
                echo "Drug details not found";
            }
        } else {
            echo "Error: " . $conn->error;
        }

        $conn->close();
        ?>
    </div>
</body>
</html>
