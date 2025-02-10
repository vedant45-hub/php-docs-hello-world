<?php
// Handle form submission for the contact form
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['contact_form'])) {
    $name = htmlspecialchars($_POST['name']);
    $email = htmlspecialchars($_POST['email']);
    $message = htmlspecialchars($_POST['message']);

    // Here you can process the form, such as sending an email or saving the data to a database
    echo "<div class='alert success'>Thank you, $name! Your message has been received.</div>";
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>My Website</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <!-- Header Section -->
    <header>
        <div class="container">
            <h1>Welcome to My Website</h1>
            <nav>
                <ul>
                    <li><a href="#about">About</a></li>
                    <li><a href="#services">Services</a></li>
                    <li><a href="#contact">Contact</a></li>
                </ul>
            </nav>
        </div>
    </header>

    <!-- About Section -->
    <section id="about" class="section">
        <div class="container">
            <h2>About Us</h2>
            <p>This is a simple website built using PHP, HTML, and CSS. Here, you can explore our services, read about us, and contact us.</p>
        </div>
    </section>

    <!-- Services Section -->
    <section id="services" class="section">
        <div class="container">
            <h2>Our Services</h2>
            <ul>
                <li><strong>Web Development:</strong> We create high-quality websites tailored to your needs.</li>
                <li><strong>SEO Services:</strong> Improve your website's visibility on search engines.</li>
                <li><strong>Consulting:</strong> Get professional advice for your business and projects.</li>
            </ul>
        </div>
    </section>

    <!-- Contact Section -->
    <section id="contact" class="section">
        <div class="container">
            <h2>Contact Us</h2>
            <form action="index.php" method="POST">
                <label for="name">Name:</label>
                <input type="text" name="name" id="name" required>

                <label for="email">Email:</label>
                <input type="email" name="email" id="email" required>

                <label for="message">Message:</label>
                <textarea name="message" id="message" required></textarea>

                <button type="submit" name="contact_form">Send Message</button>
            </form>
        </div>
    </section>

    <!-- Footer Section -->
    <footer>
        <div class="container">
            <p>&copy; 2025 My Website. All rights reserved.</p>
        </div>
    </footer>
</body>
</html>





