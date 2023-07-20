<!DOCTYPE html>
<html>
<head>
  <style>
    body {
      font-family: Arial, sans-serif;
      background-color: #f5f5f5;
      padding: 20px;
      text-align: center;
    }

    h1 {
      color: #333333;
      margin-bottom: 20px;
    }

    .pharmacist-name {
      position: absolute;
      top: 20px;
      left: 20px;
      font-size: 20px;
      font-weight: bold;
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
  <div class="pharmacist-name">Pharmacist1</div>
  <h1>Drugs Dispensed</h1>
  <div class="success-message">
    <?php
    echo "Drugs Dispensed Successfully";
    ?>
  </div>
</body>
</html>
