<?php
include('db.php');
session_start();

if (!isset($_SESSION['username'])) {
    header("location: login.php");
    exit;
}

// Fetch matches from the database
$result = $conn->query("SELECT * FROM Games ORDER BY game_date");

if(!$result) {
    die("Query failed: " . $conn->error);
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>View Matches</title>
    <style>
        table {
            width: 100%;
            border-collapse: collapse;
        }
        th, td {
            border: 1px solid #dddddd;
            text-align: left;
            padding: 8px;
        }
        th {
            background-color: #f2f2f2;
        }
    </style>
</head>
<form action="index.php">
    <button type="submit">Back to Main Page</button>
</form>
<body>
<h2>Available Matches</h2>
<table>
    <tr>
        <th>Game Name</th>
        <th>Location</th>
        <th>Date</th>
        <th>Action</th>
    </tr>
    <?php if($result->num_rows > 0): ?>
        <?php while($row = $result->fetch_assoc()): ?>
            <tr>
                <td><?php echo htmlspecialchars($row['game_name']); ?></td>
                <td><?php echo htmlspecialchars($row['location']); ?></td>
                <td><?php echo htmlspecialchars($row['game_date']); ?></td>
                <td><a href="book.php?game_id=<?php echo $row['game_id']; ?>">Book Tickets</a></td>
            </tr>
        <?php endwhile; ?>
    <?php else: ?>
        <tr>
            <td colspan="4">No matches available.</td>
        </tr>
    <?php endif; ?>
</table>
</body>
</html>
