<?php
// Database connection
$conn = new mysqli('localhost', 'root', '', 'demologinpage');

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$email = $_GET['email'];

// Fetch user details
$sql = "SELECT * FROM registration WHERE email = '$email'";
$result = $conn->query($sql);
$user = $result->fetch_assoc();

if (!$user) {
    echo "User not found.";
    exit;
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Update user data
    $firstname = $_POST['firstname'];
    $lastname = $_POST['lastname'];
    $gender = $_POST['gender'];
    $number = $_POST['number'];

    $updateSql = "UPDATE registration SET firstname='$firstname', lastname='$lastname', gender='$gender', number='$number' WHERE email='$email'";
    if ($conn->query($updateSql) === TRUE) {
        echo "<script>alert('Details updated successfully!'); window.location.href = 'view_data.php';</script>";
    } else {
        echo "Error updating record: " . $conn->error;
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Update User Details</title>
    <style>
        body {
            background: #f7f7f7;
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
        }

        .container {
            max-width: 600px;
            margin: 50px auto;
            padding: 15px;
            background: white;
            border-radius: 5px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        h2 {
            text-align: center;
            color: #ff6600;
        }

        .form-group {
            margin-bottom: 15px;
        }

        .form-group label {
            display: block;
            margin-bottom: 5px;
        }

        .form-group input, .form-group select {
            width: 100%;
            padding: 10px;
            border: 1px solid #ddd;
            border-radius: 4px;
        }

        .btn {
            display: block;
            width: 100%;
            padding: 10px;
            background-color: #ff6600;
            color: white;
            border: none;
            border-radius: 4px;
            font-size: 16px;
            cursor: pointer;
        }

        .btn:hover {
            background-color: #e65c00;
        }
    </style>
</head>
<body>
    <h1>Update Details for <?php echo $user['firstname']; ?></h1>
    <form method="post">
        <label for="firstname">First Name:</label>
        <input type="text" name="firstname" value="<?php echo $user['firstname']; ?>" required><br><br>

        <label for="lastname">Last Name:</label>
        <input type="text" name="lastname" value="<?php echo $user['lastname']; ?>" required><br><br>

        <label for="gender">Gender:</label>
        <select name="gender" required>
            <option value="m" <?php echo $user['gender'] == 'm' ? 'selected' : ''; ?>>Male</option>
            <option value="f" <?php echo $user['gender'] == 'f' ? 'selected' : ''; ?>>Female</option>
            <option value="o" <?php echo $user['gender'] == 'o' ? 'selected' : ''; ?>>Other</option>
        </select><br><br>

        <label for="number">Phone Number:</label>
        <input type="text" name="number" value="<?php echo $user['number']; ?>" required><br><br>

        <button type="submit">Update</button>
    </form>
</body>
</html>
