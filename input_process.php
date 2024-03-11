<?php
// Include database connection
include "db_connect.php";

// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve form data
    $patient_name = $_POST['patient_name'];
    $medical_records = $_POST['medical_records'];
    $diagnosis = $_POST['diagnosis'];
    $treatment = $_POST['treatment'];
    $doctor_id = $_POST['doctor'];

    // Prepare and execute SQL statement to insert data into the database
    $sql = "INSERT INTO medical_details (patient_name, medical_records, diagnosis, treatment, doctor_id) VALUES (?, ?, ?, ?, ?)";
    $stmt = $conn->prepare($sql);
    
    if (!$stmt) {
        // Handle SQL preparation error
        echo "SQL preparation error: " . $conn->error;
        exit();
    }
    
    $stmt->bind_param("ssssi", $patient_name, $medical_records, $diagnosis, $treatment, $doctor_id);
    if ($stmt->execute()) {
        // Data inserted successfully
        echo "Medical details inserted successfully";
    } else {
        // Error inserting data
        echo "Error inserting data: " . $stmt->error;
    }
    
    // Close statement
    $stmt->close();
}

// Close connection
$conn->close();
?>
