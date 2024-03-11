<?php
// Include database connection
include "db_connect.php";

// Retrieve list of doctors
$sql = "SELECT * FROM doctors";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Input Medical Details</title>
    <link rel="stylesheet" href="styles2.css">
</head>
<body>
    <div class="container">
        <h2>Input Medical Details</h2>
        <form action="input_process.php" method="post">
            <div class="form-group">
                <label for="patient_name">Patient Name:</label>
                <input type="text" id="patient_name" name="patient_name" required>
            </div>
            <div class="form-group">
                <label for="medical_records">Medical Records:</label>
                <textarea id="medical_records" name="medical_records" required></textarea>
            </div>
            <div class="form-group">
                <label for="diagnosis">Diagnosis:</label>
                <input type="text" id="diagnosis" name="diagnosis" required>
            </div>
            <div class="form-group">
                <label for="treatment">Treatment:</label>
                <textarea id="treatment" name="treatment" required></textarea>
            </div>
            <div class="form-group">
                <label for="doctor">Select Doctor:</label>
                <select id="doctor" name="doctor" required>
                    <option value="">Select Doctor</option>
                    <?php while ($row = $result->fetch_assoc()) : ?>
                        <option value="<?php echo $row["id"]; ?>"><?php echo $row["doctor_name"]; ?></option>
                    <?php endwhile; ?>
                </select>
            </div>
            <button type="submit" name="submit">Submit</button>
        </form>
    </div>
</body>
</html>

<?php
// Close connection
$conn->close();
?>
