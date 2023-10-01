<?php
include("connection.php");

$categoryQuery = "SELECT DISTINCT category FROM drugs";
$categoryResult = mysqli_query($conn, $categoryQuery);

$categories = [];
while ($row = mysqli_fetch_assoc($categoryResult)) {
    $categories[] = $row['category'];
}

mysqli_close($conn);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Medicinal Drugs</title>
    <link rel="stylesheet" href="styles.css">
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f2f2f2;
            background-image: url("https://images.unsplash.com/photo-1586015555751-63bb77f4322a?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=1470&q=80");
        }

        h2.logo {
            text-align: center;
            color: #fff;
            font-size: 35px;
            padding: 10px;
            border-radius: 8px;
            margin: 10px 0;
        }

        ul {
            list-style-type: none;
            margin: 0;
            padding: 0;
            overflow: hidden;
            font color: black;
            
            display: flex;
            justify-content: flex-start; /* Align items to the right */
        }

        li {
            font color: black;
            margin-left: 10px; /* Add margin between list items */
        }

        li a {
            display: block;
            color:black;
            text-align: center;
            padding: 14px 16px;
            text-decoration: none;
        }

        li a:hover {
            background-color: white;
        }

        .drug-category {
            margin-bottom: 20px;
        }

        .drug-category h2 {
            text-align: center;
            color: #fff;
            background-color: #333;
            padding: 10px;
            border-radius: 8px;
            margin: 10px 0;
            font-size: 35px;
            margin-bottom: 10px;
        }

        .drug-list {
            display: flex;
            flex-wrap: wrap;
            justify-content: space-around;
        }

        .drug-card-container {
            margin-bottom: 20px;
        }

        .drug-card {
            border: 1px solid #ddd;
            padding: 10px;
            width: 300px;
            text-align: center;
        }

        .drug-image {
            max-width: 100%;
            height: auto;
            border: 1px solid #ccc;
            border-radius: 8px;
        }
    </style>
</head>
<body>
    <header>
        <h2 class="logo">DRUG DASHBOARD</h2>
        
        <ul>
            <li><a href="pharmaceuticalregistrationform.html" target='_blank'>Add Drug</a></li>
            <li><a href="#">View Dashboard</a></li>
        </ul>
        
    </header>

    <?php foreach ($categories as $category): ?>
        <section class="drug-category">
            <h2><?php echo $category; ?></h2>
            <div class="drug-list">
                <?php
                include("connection.php");
                $categoryQuery = "SELECT * FROM drugs WHERE category = '$category'";
                $categoryResult = mysqli_query($conn, $categoryQuery);

                while ($row = mysqli_fetch_assoc($categoryResult)):
                    ?>
                    <div class="drug-card-container">
                        <div class="drug-card">
                            <img src="<?php echo $row['image']; ?>" alt="<?php echo $row['trade_name']; ?>" class="drug-image">
                            <p><?php echo $row['trade_name']; ?></p>
                            <p><?php echo $row['type']; ?></p>
                            <p>Price: <?php echo $row['price']; ?> Shillings</p>
                            <a href="view_details.php?id=<?php echo $row['drug_id']; ?>">View Details</a>
                        </div>
                    </div>
                <?php endwhile; ?>

                <?php mysqli_close($conn); ?>
            </div>
        </section>
    <?php endforeach; ?>
</body>
</html>
