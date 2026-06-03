<?php
session_start();
require_once("settings.php");

if (!isset($_SESSION['username'])) {
    header("Location: login.php");
    exit();
}

$conn = mysqli_connect($host, $username, $password, $database);

if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

$username = $_POST['username'];
$newEmail = $_POST['email'];

$success = mysqli_query($conn, "UPDATE users SET email = '$newEmail' WHERE username = '$username'");
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Update Profile</title>
</head>
<body>
  <?php if ($success): ?>
    <p>✅ Profile updated successfully!</p>
    <p><a href="profile.php">Go back to Profile</a></p>
  <?php else: ?>
    <p>❌ Error updating profile: <?php echo mysqli_error($conn); ?></p>
  <?php endif; ?>
</body>
</html>