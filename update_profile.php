<?php
session_start();

if (!isset($_SESSION['username'])) {
    header("Location: login.php");
    exit();
}

require_once("settings.php");

$conn = mysqli_connect($host, $user, $pwd, $sql_db);

$username = $_SESSION['username'];

$email = mysqli_real_escape_string(
    $conn,
    $_POST['email']
);

$sql = "UPDATE users
        SET email='$email'
        WHERE username='$username'";

mysqli_query($conn, $sql);

mysqli_close($conn);

header("Location: profile.php");
exit();