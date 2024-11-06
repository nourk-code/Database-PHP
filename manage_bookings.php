<?php
include('db.php');
session_start();

if (!isset($_SESSION['username'])) {
    header("location: login.php");
    exit;
}

$user_id = $_SESSION['user_id'];

// Fetch user bookings from the database
$query = "SELECT Bookings.booking_id, Games.game_name, Games.location, Games.game_date, Bookings.num_tickets
          FROM Bookings
          JOIN Games ON Bookings.game_id = Games.game_id
          WHERE Bookings.user_id = ?";
$stmt = $conn->prepare($query);
$stmt->bind_param("i", $user_id);
$stmt->execute();
$result = $stmt->get_result();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manage Your Bookings</title>
</head>
<form action="index.php">
    <button type="submit">Back to Main Page</button>
</form>
<body>
<h2>Your Bookings</h2>
<table>
    <tr>
        <th>Game Name</th>
        <th>Location</th>
        <th>Date</th>
        <th>Tickets</th>
        <th>Actions</th>
    </tr>
    <?php while ($booking = $result->fetch_assoc()): ?>
    <tr>
        <td><?php echo htmlspecialchars($booking['game_name']); ?></td>
        <td><?php echo htmlspecialchars($booking['location']); ?></td>
        <td><?php echo htmlspecialchars($booking['game_date']); ?></td>
        <td>
            <form action="update_booking.php" method="post">
                <input type="number" name="num_tickets" value="<?php echo $booking['num_tickets']; ?>" min="1">
                <input type="hidden" name="booking_id" value="<?php echo $booking['booking_id']; ?>">
                <button type="submit">Update</button>
            </form>
        </td>
        <td>
            <a href="delete_booking.php?booking_id=<?php echo $booking['booking_id']; ?>">Delete</a>
        </td>
    </tr>
    <?php endwhile; ?>
</table>
<a href="matches.php">Add More Games</a>
</body>
</html>
