<?php
session_start();

// Check if the user is logged in
if (!isset($_SESSION['username']) || !isset($_SESSION['email'])) 
{
    header("Location: login.php"); // redirect to login if not logged in
    exit;
}

$username = $_SESSION['username'];
$email = $_SESSION['email'];
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Profile</title>
</head>
<body>
    <h1>Welcome, <?php echo htmlspecialchars($username); ?>!</h1>
    <p>Your email: <?php echo htmlspecialchars($email); ?></p>
     <form action="update_profile.php" method="post">
        <label>Edit email:</label><br>
        <input type="text" name="email" required><br><br>

        

        <input type="submit" value="Submit">
        
</body>
</html>
