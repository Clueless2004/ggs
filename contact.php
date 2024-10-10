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

// Sanitize input function
function sanitize_input($data) {
    return htmlspecialchars(stripslashes(trim($data)));
}

// Handling Contact Form Submission
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['contactForm'])) {
    $name = sanitize_input($_POST['name']);
    $phone = sanitize_input($_POST['phone']);
    $email = sanitize_input($_POST['email']);
    $occupation = sanitize_input($_POST['occupation']);
    $company = sanitize_input($_POST['company']);
    $productRequirement = sanitize_input($_POST['productRequirement']);

    // Insert into contacts table
    $contact_query = "INSERT INTO contacts (name, phone, email, occupation, company, product_requirement) VALUES (?, ?, ?, ?, ?, ?)";
    $stmt = $conn->prepare($contact_query);
    $stmt->bind_param("ssssss", $name, $phone, $email, $occupation, $company, $productRequirement);

    if ($stmt->execute()) {
        echo "Contact information submitted successfully!";
    } else {
        echo "Error: " . $contact_query . "<br>" . $conn->error;
    }

    $stmt->close();
}

// Handling Review Form Submission
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['reviewForm'])) {
    $reviewName = sanitize_input($_POST['reviewName']);
    $username = sanitize_input($_POST['username']);
    $productReceived = sanitize_input($_POST['productReceived']);
    $productReview = sanitize_input($_POST['productReview']);
    $rating = intval(sanitize_input($_POST['rating']));

    // Insert into reviews table
    $review_query = "INSERT INTO reviews (review_name, username, product_received, product_review, rating) VALUES (?, ?, ?, ?, ?)";
    $stmt = $conn->prepare($review_query);
    $stmt->bind_param("ssssi", $reviewName, $username, $productReceived, $productReview, $rating);

    if ($stmt->execute()) {
        echo "Review submitted successfully!";
    } else {
        echo "Error: " . $review_query . "<br>" . $conn->error;
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
    <title>Contact Us</title>
    <link rel="icon" href="images/logo.png">
    <link rel="stylesheet" href="css/typography.css">
    <link rel="stylesheet" href="css/layout.css">
    <link rel="stylesheet" href="css/header.css">
    <link rel="stylesheet" href="css/footer.css">
    <link rel="stylesheet" href="css/contact.css">
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
    <div id="contact-review">
        <div class="contact-container">
            <h2>Contact Us</h2>
            <form id="contactForm" action="contact.php" method="POST">
                <input type="hidden" name="contactForm" value="1">
                <input type="text" id="name" name="name" placeholder="Your Name" required>
                <input type="tel" id="phone" name="phone" placeholder="Phone Number" required>
                <input type="email" id="email" name="email" placeholder="Email" required>
                <input type="text" id="occupation" name="occupation" placeholder="Occupation/Job Title" required>
                <input type="text" id="company" name="company" placeholder="Company" required>
                <textarea id="productRequirement" name="productRequirement" placeholder="Product Requirement" rows="4" required></textarea>
                <button type="submit">Send</button>
            </form>
        </div>

        <div class="review-container">
            <h2>Leave a Review</h2>
            <form id="reviewForm" action="contact.php" method="POST">
                <input type="hidden" name="reviewForm" value="1">
                <input type="text" id="reviewName" name="reviewName" placeholder="Your Name" required>
                <input type="text" id="username" name="username" placeholder="Username" required>
                <input type="text" id="productReceived" name="productReceived" placeholder="Product Received" required>
                <textarea id="productReview" name="productReview" placeholder="Review" rows="4" required></textarea>
                <input type="number" id="rating" name="rating" placeholder="Rating (out of 5)" min="1" max="5" required>
                <button type="submit">Submit Review</button>
            </form>
        </div>
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
