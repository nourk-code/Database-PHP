<?php
session_start();
if (!isset($_SESSION['username'])) {
    header("location: login.php");
    exit;
}

// Include your database connection file here
require_once 'db.php'; // Make sure this points to your actual database connection setup file

// Query to select all stadiums from the Stadiums table
$sql = "SELECT name, location, capacity FROM Stadiums";
$result = $conn->query($sql);

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Stadiums List</title>
</head>
<form action="index.php">
    <button type="submit">Back to Main Page</button>
</form>
<body>
<h1>Stadiums List</h1>
<?php
if ($result->num_rows > 0) {
    // Create a table to display the data
    echo "<table border='1'>";
    echo "<tr><th>Name</th><th>Location</th><th>Capacity</th></tr>";
    while($row = $result->fetch_assoc()) {
        echo "<tr>";
        echo "<td>" . htmlspecialchars($row["name"]) . "</td>";
        echo "<td>" . htmlspecialchars($row["location"]) . "</td>";
        echo "<td>" . htmlspecialchars($row["capacity"]) . "</td>";
        echo "</tr>";
    }
    echo "</table>";
} else {
    echo "No results found";
}
$conn->close();
?>
</body>
</html>
