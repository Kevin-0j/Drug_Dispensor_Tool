<!DOCTYPE html>
<html>
<head>
<title>Dispensor Page</title>    
  <style>
    body {
        /* Add the background image link here */
      background-image: url('https://i.pinimg.com/564x/bb/87/b7/bb87b743b9ed1dc1516a08955fe51842.jpg');
      /* Set background image size and other properties as needed */
      background-size: cover;
      background-repeat: no-repeat;
      background-position: center;
      margin: 0; /* Remove default margin from body */
      padding: 0; /* Remove default padding from body */
      min-height: 100vh; /* Set minimum height to cover the entire viewport */
      display: flex;
      flex-direction: column;
      justify-content: center;
      align-items: center;
      font-family: Arial, sans-serif;
      background-color: #f5f5f5;
      padding: 20px;
      text-align: center;
    }

    h1 {
      color: #333333;
      margin-bottom: 20px;
    }

    

    .success-message {
      background-color: #dff0d8;
      border: 1px solid #d0e9c6;
      color: #3c763d;
      padding: 10px;
      margin: 0 auto;
      width: 300px;
    }
  </style>
</head>
<body>
 
  <h1>Drugs Dispensed</h1>
  <div class="success-message">
    <?php
    echo "Drugs Dispensed Successfully";
    ?>
  </div>
</body>
</html>
