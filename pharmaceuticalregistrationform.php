<!DOCTYPE html>
<html>
<head>
  <title>Pharmaceutical Company Registration</title>
</head>
<body>
  <h1>Pharmaceutical Company Registration</h1>
  <form action="pharmaceutical.php" method="POST">
    <label for="company_name">Company Name:</label> 
    <input type="text" id="company_name" name="company_name" required><br><br>

    <label for="phone_number">Phone Number:</label>
    <input type="text" id="phone_number" name="phone_number" required><br><br>

    <label for="pharmaceuticalcomp_id">Pharmaceutical Company ID:</label>
    <input type="text" id="pharmaceuticalcomp_id" name="pharmaceuticalcomp_id" required><br><br>

    <input type="submit" value="Register">
  </form>
</body>
</html>