<?php
// Database connection
$servername = "localhost";
$username = "root"; // or your MySQL username
$password = ""; // or your MySQL password
$dbname = "donations_db";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Check if form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Sanitize and collect input data
    $full_name = $conn->real_escape_string($_POST['fullName']);
    $email = $conn->real_escape_string($_POST['email']);
    $donation_amount = $conn->real_escape_string($_POST['donationAmount']);
    $payment_method = $conn->real_escape_string($_POST['paymentMethod']);
    $message = $conn->real_escape_string($_POST['message']);

    // Insert data into the donations table
    $sql = "INSERT INTO donations (full_name, email, donation_amount, payment_method, message) 
            VALUES ('$full_name', '$email', '$donation_amount', '$payment_method', '$message')";

    if ($conn->query($sql) === TRUE) {
        echo "Donation successful!";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}

// Close the connection
$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Donations</title>
    <link rel="icon" href="images/logo.png">
    <link rel="stylesheet" href="css/typography.css">
    <link rel="stylesheet" href="css/layout.css">
    <link rel="stylesheet" href="css/header.css">
    <link rel="stylesheet" href="css/footer.css">
    <link rel="stylesheet" href="css/donation.css">
</head>
<body>
    <header>
        <div id="logo">
            <a href="index.html">
                <img src="images/logo.png" width="70px" height="40px">
            </a>
        </div>
        <div id="navigation">
            <ul>
                <li><a href="index.html">Home</a></li>
                <li><a href="projects.html">Projects</a></li>
                <li><a href="events.html">Events</a></li>
                <li><a href="gallery.html">Gallery</a></li>
                <li><a href="statistics.html">Statistics</a></li>
                <li><a href="about.html">About</a></li>
                <li><a href="donation.php">Donations</a></li>
                <li><a href="contact.php">Contact</a></li>
            </ul>
        </div>
        <div id="registration">
            <ul>
                <li><a href="registration.php">Sign up</a></li>
                <li><a href="login.php">Log in</a></li>
            </ul>
        </div>
    </header>
    <div class="container">
        <h1>Donate for Life on Land</h1>
        <p>Your contribution can help restore and protect ecosystems for future generations.</p>
        
        <form id="donationForm" action="process_donation.php" method="POST">
    <h2>Make a Donation</h2>
    
    <label for="fullName">Full Name</label>
    <input type="text" id="fullName" name="fullName" placeholder="Enter your full name" required>

    <label for="email">Email</label>
    <input type="email" id="email" name="email" placeholder="Enter your email" required>

    <label for="donationAmount">Donation Amount</label>
    <input type="number" id="donationAmount" name="donationAmount" placeholder="Enter amount in USD" required>

    <label for="paymentMethod">Payment Method</label>
    <select id="paymentMethod" name="paymentMethod" required>
        <option value="" disabled selected>Select payment method</option>
        <option value="credit_card">Credit Card</option>
        <option value="paypal">PayPal</option>
        <option value="bank_transfer">Bank Transfer</option>
    </select>
    
    <label for="message">Leave a Message (Optional)</label>
    <textarea id="message" name="message" placeholder="Write a message if you like"></textarea>
    
    <button type="submit">Donate Now</button>
</form>

    </div>
    <footer>
        <div id="links">
            <div id="phone">
                Phone:
                <a href="tel:+910987654321">+91 0987654321</a>
            </div>
            <div id="email">
                Email:
                <a href="mailto:gshivani00004@gmail.com">greenguardians@gmail.com</a>
            </div>
            <div id="connect">
                <p>Connect with me:<br>
                    <span class="social">
                        <a href="">
                            <img src="images/linkedin.png" alt="linkedin" width="30px" height="30px">
                        </a>
                        <a href="">
                            <img src="images/insta.png" alt="instagram" width="30px" height="30px">
                        </a>
                        <a href="">
                            <img src="images/whatsapp.png" alt="whatsapp" width="30px" height="30px">
                        </a>
                    </span>
                </p>
            </div>
            <div id="contact">
                <p>
                    Leave a message here:<br>
                    <a href="contact.php">
                        <i style="font-size: large;">HERE</i>
                    </a>
                </p>
            </div>
        </div>
        <div id="copyright">
            &copy; G.G.A<sup>3</sup>
        </div>
    </footer>
</body>
</html>