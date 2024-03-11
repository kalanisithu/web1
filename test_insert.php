<?php
// Database credentials
$servername = "localhost";
$username = "root"; 
$password = ""; 
$database = "healthcare_dashboard"; 

$uname = $_POST['username'];
$upass = $_POST['password'];
$patientname = $_POST['patient_name'];
$age = $_POST['age'];
$address = $_POST['address'];
$telephone = $_POST['telephone'];



try {
    // Create connection
    //$conn = new mysqli($servername, $username, $password, $database);
    $conn = new mysqli($servername, $username, $password, $database);

    // Check connection
    if ($conn->connect_error) {
        throw new Exception("Connection failed: " . $conn->connect_error);
    }
    $sql = "INSERT INTO users (username, password, patient_name, age, address, telephone) 
    VALUES ('". $uname ."', '". $upass ."', '". $patientname ."', '". $age ."', '". $address ."', '". $telephone ."')";
    //$mysqli->execute_query($sql,[$uname, $upass, $patientname, $age, $address, $telephone]);

    if ($conn->query($sql) === TRUE) {
      echo "New record created successfully";
    } else {
      echo "Error: " . $sql . "<br>" . $conn->error;
    }

    $conn->close();
} catch (Exception $e) {
    // Handle connection error
    die("Connection failed::: " . $e->getMessage());
}
?>
