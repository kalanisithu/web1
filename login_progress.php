<?php
// Include database connection
include "db_connect.php";

// Initialize session
session_start();

// Check if the login form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve form data
    $username = $_POST['username'];
    $password = $_POST['password'];
    //$password = password_hash($_POST['password'], PASSWORD_DEFAULT);

    // Prepare and execute SQL statement to select user with the given username
    $sql = "SELECT * FROM users WHERE username = ?";
    $stmt = $conn->prepare($sql);
    
    if (!$stmt) {
        // Handle SQL preparation error
        echo "SQL preparation error: " . $conn->error;
        exit();
    }
    
    $stmt->bind_param("s", $username);
    $stmt->execute();
    $result = $stmt->get_result();

    if (!$result) {
        // Handle SQL execution error
        echo "SQL execution error: " . $stmt->error;
        exit();
    }

    if ($result->num_rows == 1) {
        // User found, verify password
        $row = $result->fetch_assoc();
        if (password_verify($password, $row['password'])) {
            // Password is correct, start session and redirect
            $_SESSION['username'] = $username;
            header("Location: http://localhost/Hospital/index"); // Redirect to dashboard or desired page
            exit();
        } else {
            // Password is incorrect
            $error = "Incorrect password";
            echo '<script>alert("Incorrect password"); window.location.href="http://localhost/Hospital/login.php";</script>>'; 
            //header("Location: http://localhost/Hospital/login.php");
            exit();
        }
    } else {
        // User not found
        $error = "User not found. Please register.";
        echo '<script>alert("User not found. Please register."); window.location.href="http://localhost/Hospital/register.php";</script>';
        //header("Location: http://localhost/Hospital/register.php");
        exit();
    }
    
    // Close statement
    $stmt->close();
}

// Close connection
$conn->close();
?>
