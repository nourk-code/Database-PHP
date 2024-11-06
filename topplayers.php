<?php
include('db.php'); // Include your database connection

// Query to fetch the top players with their country
$sql = "SELECT Players.first_name, Players.last_name, Players.date_of_birth, Teams.country, Players.team_position
        FROM Players
        INNER JOIN Teams ON Players.team_id = Teams.team_id
        ORDER BY Players.player_id
        LIMIT 25"; // Adjust the query based on your criteria
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Top Players</title>
</head>
<form action="index.php">
    <button type="submit">Back to Main Page</button>
</form>
<body>
    <h1>Top Players</h1>
    <ul>
    <?php
    // Check if there are any players
    if ($result->num_rows > 0) {
        // Output data of each player
        while($row = $result->fetch_assoc()) {
            echo "<li>Name: " . $row["first_name"]. " " . $row["last_name"]. "<br>";
            echo "Date of Birth: " . $row["date_of_birth"]. "<br>";
            echo "Country: " . $row["country"]. "<br>";
            echo "Position: " . $row["team_position"]. "</li><br>";
        }
    } else {
        echo "No players found";
    }
    $conn->close();
    ?>
    </ul>
</body>
</html>
