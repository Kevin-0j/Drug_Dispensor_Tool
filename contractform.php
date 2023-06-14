<!DOCTYPE html>
<html>
<head>
  <title>Contract Form</title>
</head>
<body>
  <h2>Contract Form</h2>
  <form action="contract.php" method="POST">
    <label for="contract_id">Contract ID:</label>
    <input type="text" id="contract_id" name="contract_id" required><br><br>

    <label for="startdate">Start Date:</label>
    <input type="date" id="startdate" name="startdate" required><br><br>

    <label for="enddate">End Date:</label>
    <input type="date" id="enddate" name="enddate" required><br><br>

    <label for="pharmacyid">Pharmacy ID:</label>
    <input type="text" id="pharmacyid" name="pharmacyid" required><br><br>

    <input type="submit" value="Submit">
  </form>
</body>
</html>
