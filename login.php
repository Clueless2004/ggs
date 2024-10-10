<?php
// Database connection settings
$host = 'localhost'; 
$db = 'ggs'; 
$user = 'root'; 
$pass = ''; 

// Create connection
$conn = new mysqli($host, $user, $pass, $db);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Sanitize input
function sanitize_input($data) {
    return htmlspecialchars(stripslashes(trim($data)));
}

// Check if form was submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = sanitize_input($_POST['loginUsername']);
    $password = sanitize_input($_POST['loginPassword']);

    // Retrieve user details from the database
    $login_query = "SELECT * FROM users WHERE username=?";
    $stmt = $conn->prepare($login_query);
    $stmt->bind_param("s", $username);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        // Fetch user data
        $user = $result->fetch_assoc();

        // Verify password
        if (password_verify($password, $user['password'])) {
            // Successful login, redirect to a dashboard or home page
            header("Location: index.html");
            exit();
        } else {
            // Invalid password
            echo "Invalid password.";
        }
    } else {
        // Invalid username
        echo "Invalid username.";
    }

    // Close statement and connection
    $stmt->close();
}
$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Log in</title>
    <link rel="icon" href="images/logo.png">
    <link rel="stylesheet" href="css/typography.css">
    <link rel="stylesheet" href="css/layout.css">
    <link rel="stylesheet" href="css/header.css">
    <link rel="stylesheet" href="css/footer.css">
    <link rel="stylesheet" href="css/signup.css">
</head>
<body>
    <div class="container">
        <h2>Login</h2>
        <form id="loginForm" action="login.php" method="POST">
            <input type="text" id="loginUsername" name="loginUsername" placeholder="Username" required>
            <input type="password" id="loginPassword" name="loginPassword" placeholder="Password" required>
            <button type="submit">Login</button>
        </form>
        <p>Don't have an account? <a href="registration.php">Register here</a></p>
    </div>
</body>
</html>