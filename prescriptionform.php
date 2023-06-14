<!DOCTYPE html>
<html>
<head>
  <title>Prescription Form</title>
</head>
<body>
  <h1>Prescription Form</h1>
  <form action="prescription.php" method="POST">
    <label for="prescription_id">Prescription ID:</label>
    <input type="text" id="prescription_id" name="prescription_id" required><br><br>

    <label for="description">Description:</label>
    <textarea id="description" name="description" rows="4" cols="50" required></textarea><br><br>

    <label for="patientssn">Patient SSN:</label>
    <input type="text" id="patientssn" name="patientssn" required><br><br>

    <label for="doctorssn">Doctor SSN:</label>
    <input type="text" id="doctorssn" name="doctorssn" required><br><br>

    <input type="submit" value="Submit Prescription">
  </form>
</body>
</html>
