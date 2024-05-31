<?php
session_start();
require_once "settings.php"; // Load MySQL login credentials

$conn = mysqli_connect($host, $username, $password, $dbname);
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

// Check if the user has exceeded the maximum number of login attempts
if (isset($_SESSION['login_attempts']) && $_SESSION['login_attempts'] >= 3) {
    // Check if the lockout period has passed
    if (isset($_SESSION['lockout_time']) && time() < $_SESSION['lockout_time']) {
        $remaining_time = $_SESSION['lockout_time'] - time();
        echo "<p>You have exceeded the maximum number of login attempts. Please try again after $remaining_time seconds.</p>";
        exit; // Prevent further execution of the script
    } else {
        // Reset login attempts and lockout time
        unset($_SESSION['login_attempts']);
        unset($_SESSION['lockout_time']);
    }
}

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['login'])) {
    $username = $_POST['username'];
    $password = $_POST['password'];

    // Use prepared statement to prevent SQL injection
    $stmt = $conn->prepare("SELECT * FROM tb_student WHERE username=?");
    $stmt->bind_param("s", $username);
    $stmt->execute();
    $result = $stmt->get_result();
    // echo "$result";
    if ($result->num_rows == 1) {
        $row = $result->fetch_assoc();
        // echo $row['password'];
        echo password_verify($password, $row['password']);

        // Verify password using password_verify
        if ($password == $row['password']) {
            $_SESSION["username"] = $username;
            // Reset login attempts on successful login
            unset($_SESSION['login_attempts']);
            unset($_SESSION['lockout_time']);
            $_SESSION["loggedin"] = true;
            header("Location: manage1.php");
            exit;
        } else {
            // Increment login attempts
            if (isset($_SESSION['login_attempts'])) {
                $_SESSION['login_attempts']++;
            } else {
                $_SESSION['login_attempts'] = 1;
            }
            
            // Lock the user out for 30 seconds after 3 failed attempts
            if ($_SESSION['login_attempts'] >= 3) {
                $_SESSION['lockout_time'] = time() + 30; // Lockout period: 30 seconds
                echo "You have been locked out. Please try again after 30 seconds.";
            } else {
                $remaining_attempts = 3 - $_SESSION['login_attempts'];
                echo "Invalid password. Attempts left: $remaining_attempts";
            }
        }
    } else {
        echo "User not found";
    }
}

mysqli_close($conn);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Page</title>
    <link rel="stylesheet" href="./styles/styles2.css">

        
</head>
<body>
    <div class="login-container">
        <h2>Login</h2>
        <form action="login.php" method="post">
            <div class="input-group">
                <label for="username">Username:</label>
                <input type="text" id="username" name="username" required class="field">
            </div>
            <div class="input-group">
                <label for="password">Password:</label>
                <input type="password" id="password" name="password" required class="field">
            </div>
            <button type="submit" name="login" value="login" class="field">Login</button>
        </form>
    </div>
</body>
</html>
