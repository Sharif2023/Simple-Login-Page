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
    // Delete the user
    $deleteSql = "DELETE FROM registration WHERE email = '$email'";
    if ($conn->query($deleteSql) === TRUE) {
        echo "<script>alert('User deleted successfully!'); window.location.href = 'loginpage.php';</script>";
    } else {
        echo "Error deleting record: " . $conn->error;
    }
} else {
    echo "<script>alert('Invalid credentials!'); window.location.href = 'loginpage.php';</script>";
}

$conn->close();
?>
