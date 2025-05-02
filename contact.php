<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "contact";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Check if form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = trim($_POST['name']);
    $email = trim($_POST['email']);
    $subject = trim($_POST['subject']);
    $message = trim($_POST['message']);

    if (empty($name) || empty($email) || empty($message)) {
        echo "<script>alert('Error: All fields are required!');</script>";
        exit();
    }

    $stmt = $conn->prepare("INSERT INTO contact (name, email, subject, message) VALUES (?, ?, ?, ?)");

    if (!$stmt) {
        echo "<script>alert('Error: Failed to prepare statement.');</script>";
        exit();
    }

    $stmt->bind_param("ssss", $name, $email, $subject, $message);

    if ($stmt->execute()) {
        echo "<script>alert('Message sent successfully!');</script>";
    } else {
        echo "<script>alert('Error: Failed to send message.');</script>";
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
    <title>Contact Us | EcoRecycle</title>
    <link rel="icon" href="kisspng-earth-world-map-globe-vector-hand-planet-5a9af8cfde0632.1928504515201056799094.png" type="image/x-icon">
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700&display=swap" rel="stylesheet">
    <script src="https://kit.fontawesome.com/a076d05399.js" crossorigin="anonymous"></script>
    <style>
        .contact-bg {
            background: linear-gradient(rgba(0, 0, 0, 0.5), rgba(0, 0, 0, 0.5)), url('bg-contact.jpg');
            background-size: cover;
            background-position: center;
        }
        .contact-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 10px 20px rgba(0, 0, 0, 0.1);
        }
    </style>
</head>

<body class="font-['Poppins'] bg-gray-50">
    <?php include 'navigation.php'; ?>

    <div class="container mx-auto px-4 py-8">
        <!-- Hero Section -->
        <section class="contact-bg text-white py-32 text-center">
            <div class="container mx-auto px-4">
                <h1 class="text-4xl md:text-5xl font-bold mb-4">Contact Us</h1>
                <p class="text-xl mb-8 max-w-2xl mx-auto">Have questions about e-waste recycling? We're here to help.</p>
            </div>
        </section>

        <!-- Contact Section -->
        <section class="py-16 bg-white">
            <div class="container mx-auto px-4">
                <div class="grid md:grid-cols-2 gap-12">

                    <!-- Contact Form -->
                    <div class="bg-gray-50 p-8 rounded-lg shadow-md contact-card transition duration-300">
                        <h2 class="text-2xl font-bold text-emerald-600 mb-6">Send Us a Message</h2>

                        <form method="POST" class="space-y-4">
                            <div>
                                <label class="block text-gray-700 mb-2">Your Name</label>
                                <input type="text" name="name" class="w-full px-4 py-2 border rounded-lg focus:ring-2 focus:ring-emerald-400" placeholder="Enter Name" required>
                            </div>
                            <div>
                                <label class="block text-gray-700 mb-2">Email Address</label>
                                <input type="email" name="email" class="w-full px-4 py-2 border rounded-lg focus:ring-2 focus:ring-emerald-400" placeholder="E-mail" required>
                            </div>
                            <div>
                                <label class="block text-gray-700 mb-2">Subject</label>
                                <select name="subject" class="w-full px-4 py-2 border rounded-lg focus:ring-2 focus:ring-emerald-400">
                                    <option value="general">General Inquiry</option>
                                    <option value="facility">Facility Information</option>
                                    <option value="partnership">Partnership Opportunity</option>
                                    <option value="feedback">Feedback/Suggestion</option>
                                </select>
                            </div>
                            <div>
                                <label class="block text-gray-700 mb-2">Your Message</label>
                                <textarea name="message" rows="5" class="w-full px-4 py-2 border rounded-lg focus:ring-2 focus:ring-emerald-400" placeholder="Your message means to us..." required></textarea>
                            </div>
                            <button type="submit" class="bg-emerald-500 hover:bg-emerald-600 text-white font-bold px-6 py-3 rounded-lg transition duration-300 w-full">
                                Send Message <i class="fas fa-paper-plane ml-2"></i>
                            </button>
                        </form>
                    </div>

                    <!-- Contact Info -->
                    <div class="space-y-8">
                        <div class="bg-gray-50 p-8 rounded-lg shadow-md contact-card transition duration-300">
                            <h2 class="text-2xl font-bold text-emerald-600 mb-6">Contact Information</h2>
                            <div class="space-y-4">
                                <div class="flex items-start">
                                    <div class="bg-emerald-100 text-emerald-600 p-3 rounded-full mr-4">
                                        <i class="fas fa-map-marker-alt"></i>
                                    </div>
                                    <div>
                                        <h3 class="font-semibold text-gray-800">Our Address</h3>
                                        <p class="text-gray-600">123 Green Avenue, Eco City, EC 12345</p>
                                    </div>
                                </div>
                                <div class="flex items-start">
                                    <div class="bg-emerald-100 text-emerald-600 p-3 rounded-full mr-4">
                                        <i class="fas fa-phone-alt"></i>
                                    </div>
                                    <div>
                                        <h3 class="font-semibold text-gray-800">Phone Number</h3>
                                        <p class="text-gray-600">(800) 555-RECYCLE (732-925)</p>
                                        <p class="text-sm text-gray-500 mt-1">Monday-Friday, 9am-5pm EST</p>
                                    </div>
                                </div>
                                <div class="flex items-start">
                                    <div class="bg-emerald-100 text-emerald-600 p-3 rounded-full mr-4">
                                        <i class="fas fa-envelope"></i>
                                    </div>
                                    <div>
                                        <h3 class="font-semibold text-gray-800">Email Address</h3>
                                        <p class="text-gray-600">info@ecorecycle.org</p>
                                        <p class="text-gray-600">support@ecorecycle.org</p>
                                    </div>
                                </div>
                            </div>
                        </div>

                    </div> <!-- End Right Column -->

                </div>
            </div>
        </section>
    </div>
</body>
</html>
