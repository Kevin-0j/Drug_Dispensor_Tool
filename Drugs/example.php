<!-- dashboard.php -->
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Drug Dashboard</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f2f2f2;
        }

        h2 {
            text-align: center;
            color: #333;
        }

        ul {
            list-style-type: none;
            margin: 0;
            padding: 0;
            overflow: hidden;
            background-color: #333;
        }

        li {
            float: left;
        }

        li a {
            display: block;
            color: white;
            text-align: center;
            padding: 14px 16px;
            text-decoration: none;
        }

        li a:hover {
            background-color: #555;
        }

        .drug-container {
            display: flex;
            flex-wrap: wrap;
            justify-content: space-around;
            padding: 20px;
        }

        .drug-item {
            text-align: center;
            margin: 10px;
        }

        .drug-item img {
            width: 200px;
            height: 200px;
            object-fit: cover;
            border: 1px solid #ccc;
            border-radius: 8px;
        }
    </style>
</head>
<body>
    <h2>Drug Dashboard</h2>
    
    <!-- Navigation Menu -->
    <ul>
        <li><a href="add_drug.php">Add Drug</a></li>
        <li><a href="#">View Dashboard</a></li>
    </ul>

    <!-- Display Drug Images -->
    <div class="drug-container">
        <?php
        require "connection.php"; // Include your database connection file

        // Connect to the database (replace with your actual database credentials)
        $conn = new mysqli($servername, $username, $password, $dbname);

        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        }

        $sql = "SELECT * FROM drugs";
        $result = $conn->query($sql);

        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                echo "<div class='drug-item'>";
                echo "<img src='" . $row["image"] . "' alt='" . $row["category"] . "'><br>";
                echo "<a href='view_details.php?id=" . $row["drug_id"] . "'>View Details</a>";
                echo "</div>";
            }
        } else {
            echo "<p>No drugs found</p>";
        }

        $conn->close();
        ?>
    </div>
</body>
</html>
