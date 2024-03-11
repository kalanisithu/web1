<?php
// Include database connection
include "db_connect.php";

// Check if the registration form is submitted
if (isset($_POST['register'])) {
    // Retrieve form data
    $uname = $_POST['username'];
    $upass = password_hash($_POST['password'], PASSWORD_DEFAULT); // Hash the password
    $patientname = $_POST['patient_name'];
    $age = $_POST['age'];
    $address = $_POST['address'];
    $telephone = $_POST['telephone'];

    // Prepare and execute SQL statement to insert data into the database
    $sql = "INSERT INTO users (username, password, patient_name, age, address, telephone) 
    VALUES ('". $uname ."', '". $upass ."', '". $patientname ."', '". $age ."', '". $address ."', '". $telephone ."')";

    if ($conn->query($sql) === TRUE) {
        echo "New record created successfully";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}

// Close connection
$conn->close();
?>
