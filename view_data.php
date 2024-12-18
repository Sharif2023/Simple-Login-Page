<!DOCTYPE html>
<html>
<head>
    <title>View Users</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f7f7f7;
            margin: 0;
            padding: 0;
        }
        table {
            width: 80%;
            margin: 20px auto;
            border-collapse: collapse;
            background-color: #fff;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }
        th, td {
            padding: 12px;
            text-align: left;
            border: 1px solid #ddd;
        }
        th {
            background-color: #ff6600;
            color: white;
        }
        h1 {
            text-align: center;
            color: #333;
        }
        .container {
            width: 80%;
            margin: 20px auto;
            text-align: right;
        }
        .btn {
            padding: 10px 20px;
            background-color: #ff6600;
            color: white;
            text-decoration: none;
            border-radius: 4px;
        }
        .btn:hover {
            background-color: #e65c00;
        }
        .error {
            color: red;
            text-align: center;
        }
    </style>
</head>
<body>
    <h1>All Registered Users</h1>
    <div class="container">
        <a href="loginpage.php" class="btn">Back to Home Page</a>
    </div>

    <table>
        <tr>
            <th>First Name</th>
            <th>Last Name</th>
            <th>Gender</th>
            <th>Email</th>
            <th>Phone Number</th>
        </tr>
        <?php
        // Database connection
        $conn = new mysqli('localhost', 'root', '', 'demologinpage');

        // Check connection
        if ($conn->connect_error) {
            die("<tr><td colspan='5' class='error'>Connection Failed: " . $conn->connect_error . "</td></tr>");
        } 

        // Query the database
        $sql = "SELECT firstName, lastName, gender, email, number FROM registration";
        $result = $conn->query($sql);

        // Check if there are any results
        if ($result && $result->num_rows > 0) {
            // Output data for each row
            while ($row = $result->fetch_assoc()) {
                echo "<tr>
                        <td>" . htmlspecialchars($row['firstName']) . "</td>
                        <td>" . htmlspecialchars($row['lastName']) . "</td>
                        <td>" . htmlspecialchars($row['gender']) . "</td>
                        <td>" . htmlspecialchars($row['email']) . "</td>
                        <td>" . htmlspecialchars($row['number']) . "</td>
                      </tr>";
            }
        } else {
            // If no data is found
            echo "<tr><td colspan='5' class='error'>No Users Found</td></tr>";
        }

        // Close the connection
        $conn->close();
        ?>
    </table>
</body>
</html>
