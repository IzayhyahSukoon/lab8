<?php
session_start();
require_once("settings.php");

$conn = mysqli_connect($host, $username, $password, $database);

if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = trim($_POST['username']);
    $password = trim($_POST['password']);

    $query = "SELECT * FROM users WHERE username = '$username' AND password = '$password'";
    $result = mysqli_query($conn, $query);
    $user = mysqli_fetch_assoc($result);

    if ($user) {
        $_SESSION['username'] = $user['username'];
        header("Location: profile.php");
        exit();
    } else {
        echo "❌ Incorrect username or password.";
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Login Page</title>
</head>
<body>
  <h2>Login</h2>
  <form method="post" action="login.php">
    <label>Username:</label>
    <input type="text" name="username" required><br>
    <label>Password:</label>
    <input type="password" name="password" required><br>
    <button type="submit">Login</button>
  </form>
</body>
</html>