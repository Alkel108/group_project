
<html>
    
    <head>
    <link rel="stylesheet" href="styles/styles.css">
    <link href="https://fonts.googleapis.com/css2?family=Special+Gothic&family=Special+Gothic+Expanded+One&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Special+Gothic&display=swap" rel="stylesheet"> 
</head>



<body>
    <?php include 'nav.inc'; ?>
    <div  class="jobs_container">
    <h2>Login</h2>

    <form action="login.php" method="post">
        <label>Username:</label><br>
        <input type="text" name="username" required><br><br>

        <label>Password:</label><br>
        <input type="password" name="password" required><br><br>

        <input type="submit" value="Login">
    </form>
</div>
</body>

</html>




<?php 
require_once('settings.php');
session_start();

$conn = mysqli_connect($host, $user, $pwd, $sql_db);

if(!$conn){
    die("Database connection failed".mysqli_connect_error());
}

if($_SERVER['REQUEST_METHOD'] == 'POST'){

    $input_username = trim($_POST['username']);
    $input_password = trim($_POST['password']);
    $query = "SELECT * FROM users WHERE username = '$input_username' AND password = '$input_password'";
    $result = mysqli_query($conn, $query);


    if($user = mysqli_fetch_assoc($result)){
        $_SESSION['username'] = $user['username'];
        $_SESSION['email'] = $user['email'];
        
        header("Location: manager.php");
        exit;
    }
    else
    {
        $_SESSION['error'] = "Invalid username or password";
        echo "login failed";
    }
    
}

?>
