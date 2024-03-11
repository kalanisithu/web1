<?php
// Include database connection
include "db_connect.php";

// Initialize session
session_start();

// Check if user is logged in
if (!isset($_SESSION['username'])) {
    // Redirect to login page if not logged in
    header("Location: login.php");
    exit();
}

// Retrieve patient details from the database
$sql_patients = "SELECT * FROM medical_details";
$result_patients = $conn->query($sql_patients);

// Retrieve doctor details from the database
$sql_doctors = "SELECT * FROM doctors";
$result_doctors = $conn->query($sql_doctors);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Patient Medical Details</title>
    <link rel="stylesheet" href="styles5.css">
</head>
<body>
    <div class="container">
        <h2>Patient Medical Details</h2>
        <form action="" method="post">
            <div class="form-group">
                <label for="patient">Select Patient:</label>
                <select id="patient" name="patient">
                    <?php while ($row_patient = $result_patients->fetch_assoc()) : ?>
                        <option value="<?php echo $row_patient["patient_name"]; ?>"><?php echo $row_patient["patient_name"]; ?></option>
                    <?php endwhile; ?>
                </select>
                <button type="submit" name="submit">View Details</button>
            </div>
        </form>

        <?php
        if (isset($_POST['submit'])) {
            $selected_patient = $_POST['patient'];
            $sql_details = "SELECT * FROM medical_details WHERE patient_name = '$selected_patient'";
            $result_details = $conn->query($sql_details);

            if ($result_details->num_rows > 0) {
                echo "<h3>Medical Details for Patient: $selected_patient</h3>";
                echo "<table>";
                echo "<thead><tr><th>Medical Records</th><th>Diagnosis</th><th>Treatment</th><th>Doctor</th></tr></thead>";
                echo "<tbody>";
                while ($row_details = $result_details->fetch_assoc()) {
                    $doctor_id = $row_details["doctor_id"];
                    $sql_doctor_name = "SELECT doctor_name FROM doctors WHERE id = '$doctor_id'";
                    $result_doctor_name = $conn->query($sql_doctor_name);
                    $doctor_name = ($result_doctor_name->num_rows > 0) ? $result_doctor_name->fetch_assoc()["doctor_name"] : "Unknown";
                    
                    echo "<tr>";
                    echo "<td>" . $row_details["medical_records"] . "</td>";
                    echo "<td>" . $row_details["diagnosis"] . "</td>";
                    echo "<td>" . $row_details["treatment"] . "</td>";
                    echo "<td>" . $doctor_name . "</td>";
                    echo "</tr>";
                }
                echo "</tbody></table>";
            } else {
                echo "<p class='no-data'>No medical records found for $selected_patient</p>";
            }
        }
        ?>
    </div>
</body>
</html>

<?php
// Close connection
$conn->close();
?>
