<?php
include('db.php');
session_start();
$message = '';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST['username'];
    $email = $_POST['email'];
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT);
    $phone_number = $_POST['phone_number'];

    $sql = "INSERT INTO users (username, email, password, phone_number) VALUES (?, ?, ?, ?)";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ssss", $username, $email, $password, $phone_number);

    if ($stmt->execute()) {
        $message = "Registration successful.";
    } else {
        $message = "Error: " . $conn->error;
    }
    $stmt->close();
}
$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registration</title>
</head>
<body>
<h2>User Registration</h2>
<form method="post" action="register.php">
    Username: <input type="text" name="username" required><br>
    Email: <input type="email" name="email" required><br>
    Password: <input type="password" name="password" required><br>
    Phone Number: <input type="text" name="phone_number" required><br>
    <input type="submit" value="Register"><br><br>
    <input type="button" value="Already have an account or just signed up?" onclick="location.href='login.php'">
</form>
<p><?php echo $message; ?></p>
</body>
</html>
