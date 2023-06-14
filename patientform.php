<!DOCTYPE html>
<html>
<head>
  <title>Registration</title>
</head>
<body>
  <h1>Patient Registration Form </h1>
  <form action="patients.php" method="post">
    <label for="ssn">SSN:</label>
    <input type="text" id="ssn" name="ssn" required><br><br>
    
    <label for="firstName">First Name:</label>
    <input type="text" id="firstName" name="firstName" required><br><br>
    
    <label for="lastName">Last Name:</label>
    <input type="text" id="lastName" name="lastName" required><br><br>
    
    <label for="address">Address:</label>
    <textarea id="address" name="address" required></textarea><br><br>

    <label for="Medical_History">Medical_History:</label>
    <textarea id="Medical_History" name="Medical_Hisory" required></textarea><br><br>
   
    
    
    <input type="submit" value="Submit">
  </form>
</body> 
</html>
