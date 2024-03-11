<?php
// Database credentials
$servername = "localhost";
$username = "root"; 
$password = ""; 
$database = "healthcare_dashboard"; 

try {
    // Create connection
    $conn = new mysqli($servername, $username, $password, $database);

    // Check connection
    if ($conn->connect_error) {
        throw new Exception("Connection failed: " . $conn->connect_error);
    }
} catch (Exception $e) {
    // Handle connection error
    die("Connection failed: " . $e->getMessage());
}
?>
