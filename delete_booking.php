<?php
include('db.php');
session_start();

if (!isset($_SESSION['username'])) {
    header("location: login.php");
    exit;
}

if (isset($_GET['booking_id'])) {
    $booking_id = $_GET['booking_id'];

    $query = "DELETE FROM Bookings WHERE booking_id = ?";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("i", $booking_id);
    if ($stmt->execute()) {
        header("Location: manage_bookings.php");  // Redirect back to the manage bookings page
    } else {
        echo "Error deleting booking: " . $stmt->error;
    }
    $stmt->close();
}
?>
