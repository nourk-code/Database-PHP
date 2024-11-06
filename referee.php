<?php
session_start();
if (!isset($_SESSION['username'])) {
    header("location: login.php");
    exit;
}

// Include your database connection file here
require_once 'db.php'; // Ensure this file has the correct database connection information

// Query to select all referees from the Referees table
$sql = "SELECT referee_id, first_name, last_name FROM Referees";
$result = $conn->query($sql);

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Referee List</title>
</head>
<form action="index.php">
    <button type="submit">Back to Main Page</button>
</form>
<body>
<h1>Referee List</h1>
<?php
if ($result->num_rows > 0) {
    echo "<table border='1'>";
    echo "<tr><th>ID</th><th>First Name</th><th>Last Name</th></tr>";
    while($row = $result->fetch_assoc()) {
        echo "<tr>";
        echo "<td>" . htmlspecialchars($row["referee_id"]) . "</td>";
        echo "<td>" . htmlspecialchars($row["first_name"]) . "</td>";
        echo "<td>" . htmlspecialchars($row["last_name"]) . "</td>";
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
