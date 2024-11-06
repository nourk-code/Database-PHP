<?php
session_start();
if (!isset($_SESSION['username'])) {
    header("location: login.php");
    exit;
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Welcome to World Cup Booking System</title>
</head>
<body>
    <h1>Welcome, <?php echo $_SESSION['username']; ?>!</h1>
    <nav>
        <a href="matches.php">View Matches</a>
        <a href="topplayers.php">Top Players</a>
        <a href="manage_bookings.php">Manage Bookings</a>
        <a href="coaches.php">Coaches</a>
        <a href="referee.php">Referees</a>
        <a href="stadium.php">Stadiums</a>
        <a href="logout.php">Logout</a>
    </nav>
</body>
</html>
