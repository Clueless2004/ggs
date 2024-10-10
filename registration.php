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
    $fullName = sanitize_input($_POST['fullName']);
    $username = sanitize_input($_POST['username']);
    $email = sanitize_input($_POST['email']);
    $phone = sanitize_input($_POST['phone']);
    $password = sanitize_input($_POST['password']);
    $sdgInterest = sanitize_input($_POST['sdgInterest']);

    // Hash the password for security
    $hashed_password = password_hash($password, PASSWORD_DEFAULT);

    // Check if username or email already exists
    $check_query = "SELECT * FROM users WHERE username=? OR email=?";
    $stmt = $conn->prepare($check_query);
    $stmt->bind_param("ss", $username, $email);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        // Optionally redirect back to registration form or show a message
        echo "Username or Email already exists.";
    } else {
        // Insert user data into database
        $insert_query = "INSERT INTO users (full_name, username, email, phone, password, sdg_interest) VALUES (?, ?, ?, ?, ?, ?)";
        $stmt = $conn->prepare($insert_query);
        $stmt->bind_param("ssssss", $fullName, $username, $email, $phone, $hashed_password, $sdgInterest);

        if ($stmt->execute()) {
            // Redirect to login page after successful registration
            header("Location: login.php");
            exit(); // Ensure that the script stops after the redirect
        } else {
            echo "Error: " . $insert_query . "<br>" . $conn->error;
        }
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
    <title>Sign Up</title>
    <link rel="icon" href="images/logo.png">
    <link rel="stylesheet" href="css/typography.css">
    <link rel="stylesheet" href="css/layout.css">
    <link rel="stylesheet" href="css/header.css">
    <link rel="stylesheet" href="css/footer.css">
    <link rel="stylesheet" href="css/signup.css">
</head>
<body>
    <div class="container">
        <h2>Register</h2>
        <form id="registerForm" action="registration.php" method="POST">
    <input type="text" id="fullName" name="fullName" placeholder="Full Name" required>
    <input type="text" id="username" name="username" placeholder="Username" required>
    <input type="password" id="password" name="password" placeholder="Password" required>
    <input type="email" id="email" name="email" placeholder="Email" required>
    <input type="text" id="phone" name="phone" placeholder="Phone Number" required>
    <select id="sdgInterest" name="sdgInterest" required>
        <option value="" disabled selected>Your Area of Interest in SDG 15</option>
        <option value="forest_conservation">Forest Conservation</option>
        <option value="biodiversity">Biodiversity Protection</option>
        <option value="land_restoration">Land Restoration</option>
        <option value="wildlife_protection">Wildlife Protection</option>
        <option value="sustainable_agriculture">Sustainable Agriculture</option>
        <option value="climate_resilience">Climate Resilience</option>
    </select>   
    <button type="submit">Register</button>
</form>

        <p>Already have an account? <a href="login.php">Log In</a></p>
    </div>
</body>
</html>