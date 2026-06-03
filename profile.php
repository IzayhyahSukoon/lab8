<?php
session_start();

if (!isset($_SESSION['username'])) {
    header("Location: login.php");
    exit();
}

require_once("settings.php");

$conn = mysqli_connect($host, $user, $pwd, $sql_db);

$username = $_SESSION['username'];

$sql = "SELECT * FROM users WHERE username='$username'";

$result = mysqli_query($conn, $sql);

$row = mysqli_fetch_assoc($result);
?>

<!DOCTYPE html>
<html>

<head>
    <title>Profile</title>
</head>

<body>

    <h1>Profile Page</h1>

    <p>
        <strong>Username:</strong>
        <?php echo $row['username']; ?>
    </p>

    <p>
        <strong>Email:</strong>
        <?php echo $row['email']; ?>
    </p>

    <hr>

    <h2>Edit Profile</h2>

    <form action="update_profile.php" method="post">

        New Email:

        <input
            type="email"
            name="email"
            value="<?php echo $row['email']; ?>"
            required>

        <input type="submit" value="Update">

    </form>

</body>

</html>

<?php
mysqli_close($conn);
?>