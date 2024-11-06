<?php
include('db.php');
session_start();

if (!isset($_SESSION['username'])) {
    header("location: login.php");
    exit;
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $booking_id = $_POST['booking_id'];
    $num_tickets = $_POST['num_tickets'];

    $query = "UPDATE Bookings SET num_tickets = ? WHERE booking_id = ?";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("ii", $num_tickets, $booking_id);
    if ($stmt->execute()) {
        header("Location: manage_bookings.php");  // Redirect back to the manage bookings page
    } else {
        echo "Error updating booking: " . $stmt->error;
    }
    $stmt->close();
}
?>
