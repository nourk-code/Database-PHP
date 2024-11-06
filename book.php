<?php
include('db.php');
session_start();

// Ensure the user is logged in and user_id is available
if (!isset($_SESSION['username']) || !isset($_SESSION['user_id'])) {
    header("location: login.php");  // Redirect to login if not logged in or user_id not set
    exit;
}

$user_id = $_SESSION['user_id']; // Retrieve user_id from session

// Process booking on form submission
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_GET['game_id'])) {
    $game_id = $_GET['game_id'];
    $num_tickets = $_POST['num_tickets'];

    // Insert booking into the database
    $sql = "INSERT INTO Bookings (user_id, game_id, num_tickets) VALUES (?, ?, ?)";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("iii", $user_id, $game_id, $num_tickets);
    if ($stmt->execute()) {
        echo "<script>alert('Booking successful!');</script>";
    } else {
        echo "<script>alert('Error booking tickets: " . $stmt->error . "');</script>";
    }
    $stmt->close();
}

// Fetch match details to display
if (isset($_GET['game_id'])) {
    $game_id = $_GET['game_id'];
    $game_query = $conn->prepare("SELECT * FROM Games WHERE game_id = ?");
    $game_query->bind_param("i", $game_id);
    $game_query->execute();
    $game_result = $game_query->get_result();
    $game = $game_result->fetch_assoc();
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Book Tickets</title>
</head>
<body>
<h2>Book Tickets for <?php echo htmlspecialchars($game['game_name']); ?></h2>
<form method="post" action="book.php?game_id=<?php echo $game_id; ?>">
    Number of tickets: <input type="number" name="num_tickets" value="1" min="1" max="10"><br>
    <input type="submit" value="Book Tickets">
</form>
</body>
</html>
