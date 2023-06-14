<!DOCTYPE html>
<html>
<head>
  <title>Doctor Form</title>
</head>
<body>
  <h2>Doctor Form</h2>
  <form action="doctor.php" method="post">
    <label for="ssn">SSN:</label>
    <input type="text" id="ssn" name="ssn" required><br><br>
    
    <label for="name">Name:</label>
    <input type="text" id="name" name="name" required><br><br>
    
    <label for="specialty">Specialty:</label>
    <input type="text" id="specialty" name="specialty" required><br><br>
    
    <label for="experience">Years of Experience:</label>
    <input type="number" id="experience" name="experience" required><br><br>
    
    <label for="email">Email:</label>
    <input type="email" id="email" name="email" required><br><br>
    
    <input type="submit" value="Submit">
  </form>
</body>
</html>
