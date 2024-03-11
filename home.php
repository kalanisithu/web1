<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Doctors List</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }
        th, td {
            padding: 10px;
            text-align: left;
            border-bottom: 1px solid #ddd;
        }
        th {
            background-color: #f2f2f2;
            font-weight: bold;
        }
        tr:hover {
            background-color: #f9f9f9;
        }
        .container {
            max-width: 800px;
            margin: 20px auto;
            padding: 20px;
            background-color: #fff;
            border-radius: 5px;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
        }
        h2 {
            text-align: center;
            color: #333;
        }
    </style>
</head>
<body>
    <div class="container">
        <h2>Doctors List</h2>
        <?php
        // Include database connection
        include "db_connect.php";

        // Query to select all doctors from the database
        $sql = "SELECT * FROM doctors";
        $result = $conn->query($sql);

        // Check if there are any records
        if ($result->num_rows > 0) {
            echo "<table>";
            echo "<tr><th>ID</th><th>Doctor Name</th><th>Specialty</th></tr>";
            // Output data for each doctor
            while ($row = $result->fetch_assoc()) {
                echo "<tr>";
                echo "<td>" . $row["id"] . "</td>";
                echo "<td>" . $row["doctor_name"] . "</td>";
                echo "<td>" . $row["specialty"] . "</td>";
                echo "</tr>";
            }
            echo "</table>";
        } else {
            echo "No doctors found";
        }

        // Close connection
        $conn->close();
        ?>
    </div>
</body>
</html>
