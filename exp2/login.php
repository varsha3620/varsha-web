<?php

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "studentdatabase";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $email = $_POST['email'];

    // Query to fetch the user based on email
    $sql = "SELECT * FROM student WHERE email = '$email'";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        // Get the user details
        $row = $result->fetch_assoc();
       
        // Set a cookie to remember the user
        setcookie('student_id', $row['id'], time() + (86400 * 30), "/");  // Cookie for 30 days

        // Redirect to the dashboard page
        header("Location: dashboard.php");
        exit();
    } else {
        echo "No user found with that email.";
    }

    $conn->close();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Student Login</title>
</head>
<body>
    <h2>Login</h2>
    <form method="POST" action="login.php">
        <label for="email">Email:</label><br>
        <input type="email" id="email" name="email" required><br><br>

        <input type="submit" value="Login">
    </form>
</body>
</html>
