<?php
// Database connection
$conn = new mysqli('localhost', 'root', '', 'demologinpage');

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$email = $_POST['email'];
$password = $_POST['password'];

// Verify user credentials
$sql = "SELECT * FROM registration WHERE email = '$email' AND password = '$password'";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    // Redirect to update page with user data
    header("Location: update_data.php?email=$email");
} else {
    echo "<script>alert('Invalid credentials!'); window.location.href = 'loginpage.php';</script>";
}

$conn->close();
?>
