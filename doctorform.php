<!DOCTYPE html>
<html>
<head>
  <title>Doctor Form</title>
</head>
<body>
  <h2>Doctor Form</h2>
  <form action="doctor.php" method="post">
    <label for="ssn">SSN:</label>
    <input type="text" id="SSN" name="SSN" required><br><br>
    
    <label for="name">FName:</label>
    <input type="text" id="FName" name="FName" required><br><br>
    
    <label for="name">LName:</label>
    <input type="text" id="LName" name="LName" required><br><br>

    <label for="Speciality">Speciality:</label>
    <input type="text" id="Speciality" name="Speciality" required><br><br>

    
    <label for="experience">Years of Experience:</label>
    <input type="number" id="Experience" name="Experience" required><br><br>
    
    <label for="email">Email:</label>
    <input type="email" id="Email" name="Email" required><br><br>
    
    <input type="submit" value="Submit">
  </form>
</body>
</html>