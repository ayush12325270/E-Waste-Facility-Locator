<?php
// Enable error reporting
error_reporting(E_ALL);
ini_set('display_errors', 1);

session_start();

// Check if user is logged in
if (!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] !== true) {
    header("Location: login.php");
    exit;
}

// Database of Indian E-Waste Facilities (can be moved to separate file later)
$ewaste_facilities = [
    ["name" => "EcoRecycle Mumbai", "pincode" => "400001", "address" => "Fort, Mumbai", "contact" => "Rahul Sharma - 9876543210"],
    ["name" => "GreenTech Dharavi", "pincode" => "400017", "address" => "Dharavi, Mumbai", "contact" => "Priya Patel - 8765432109"],
    ["name" => "Delhi E-Waste Solutions", "pincode" => "110001", "address" => "Connaught Place, Delhi", "contact" => "Amit Singh - 7654321098"],
    ["name" => "Bangalore Eco Center", "pincode" => "560001", "address" => "MG Road, Bangalore", "contact" => "Ananya Reddy - 6543210987"],
    ["name" => "Chennai E-Waste Hub", "pincode" => "600001", "address" => "T. Nagar, Chennai", "contact" => "Vikram Iyer - 9432109876"],
    // Maharashtra (8)
    ["name" => "EcoTech Mumbai Central", "pincode" => "400008", "address" => "Ground Floor, Forbes Building, Dr. D.N. Road, Fort, Mumbai, Maharashtra", "contact" => "Mr. Rajiv Mehta - 9876543210"],
    ["name" => "GreenHub Andheri East", "pincode" => "400069", "address" => "Unit No. 5, Marol MIDC Industrial Estate, Andheri East, Mumbai, Maharashtra", "contact" => "Ms. Priya Desai - 8765432109"],

    // Delhi/NCR (5)
    ["name" => "Delhi E-Waste Solutions", "pincode" => "110001", "address" => "Shop No. 12, Statesman House, Barakhamba Road, Connaught Place, New Delhi", "contact" => "Mr. Rohit Malhotra - 9876543211"],
    ["name" => "GreenTech Noida", "pincode" => "201301", "address" => "B-45, Sector 62, Near Ganga Shopping Complex, Noida, Uttar Pradesh", "contact" => "Ms. Shweta Singh - 8765432110"],

    // Karnataka (4)
    ["name" => "Bangalore Eco Center", "pincode" => "560001", "address" => "No. 24, Unity Building, Mahatma Gandhi Road, Bangalore, Karnataka", "contact" => "Ms. Ananya Reddy - 9876543222"],
    ["name" => "E-Waste Hub Whitefield", "pincode" => "560066", "address" => "Plot No. 7, ITPL SEZ, Whitefield Main Road, Bangalore, Karnataka", "contact" => "Mr. Ramesh Iyer - 8765432221"],

    // Tamil Nadu (4)
    ["name" => "Chennai E-Waste Hub", "pincode" => "600001", "address" => "Door No. 15, Moore Street, Parrys Corner, Chennai, Tamil Nadu", "contact" => "Mr. Karthik Sundar - 9876554321"],

    // West Bengal (3)
    ["name" => "Kolkata Green Collectors", "pincode" => "700001", "address" => "4th Floor, Lindsay Street, Opposite New Market, BBD Bagh, Kolkata, West Bengal", "contact" => "Mr. Debashis Roy - 9876555555"],

    // Gujarat (3)
    ["name" => "Ahmedabad Eco Center", "pincode" => "380001", "address" => "Shop No. 3, Swastik Cross Road, Navrangpura, Ahmedabad, Gujarat", "contact" => "Mr. Jay Patel - 9876544333"],

    // Kerala (3)
    ["name" => "Kochi E-Waste Recyclers", "pincode" => "682001", "address" => "Building No. 28/345, Marine Drive, Ernakulam, Kochi, Kerala", "contact" => "Mr. Suresh Nair - 9895123456"],

    // Punjab (2)
    ["name" => "Chandigarh Green Tech", "pincode" => "160001", "address" => "SCO 45, Sector 17-C, Near Neelam Cinema, Chandigarh", "contact" => "Ms. Harpreet Kaur - 9876549876"],

    // Uttar Pradesh (2)
    ["name" => "Lucknow Eco Solutions", "pincode" => "226001", "address" => "12/34, Hazratganj Market, Opposite Janpath Market, Lucknow, UP", "contact" => "Mr. Alok Verma - 8877665544"],

    // Andhra Pradesh (2)
    ["name" => "Vizag E-Waste Point", "pincode" => "530001", "address" => "Door No. 5-6-7, Waltair Main Road, Opposite Port Stadium, Visakhapatnam, AP", "contact" => "Mr. Raju Naidu - 7654321890"],

    // Madhya Pradesh (2)
    ["name" => "Bhopal Recycle Hub", "pincode" => "462001", "address" => "Plot No. 56, Zone-II, MP Nagar, Near DB Mall, Bhopal, MP", "contact" => "Mrs. Anjali Dubey - 8765432198"],

    // Bihar (2)
    ["name" => "Patna Eco Collectors", "pincode" => "800001", "address" => "Shop No. 12, Fraser Road, Near Gandhi Maidan, Patna, Bihar", "contact" => "Mr. Rakesh Kumar - 9876543217"],

    // Odisha (2)
    ["name" => "Bhubaneswar Green Hub", "pincode" => "751001", "address" => "Plot No. 403, Janpath Road, Unit-III, Bhubaneswar, Odisha", "contact" => "Ms. Madhurima Das - 8765432176"],

    // Assam (2)
    ["name" => "Guwahati E-Waste Center", "pincode" => "781001", "address" => "House No. 34, GS Road, Christian Basti, Guwahati, Assam", "contact" => "Mr. Bikram Baruah - 9876543278"],

    // Jammu & Kashmir (1)
    ["name" => "Srinagar Eco Recyclers", "pincode" => "190001", "address" => "Residency Road, Near Lal Chowk, Srinagar, J&K", "contact" => "Mr. Farooq Ahmed - 9876543298"],

    // Goa (1)
    ["name" => "Goa Eco Recyclers", "pincode" => "403001", "address" => "Shop No. 8, 18th June Road, Opposite Municipal Garden, Panaji, Goa", "contact" => "Mr. Rohan Naik - 9876549999"],
    // Maharashtra (10 entries)
    ["name" => "EcoRecycle Mumbai Fort", "pincode" => "400001", "address" => "12, Mahatma Gandhi Road, Fort, Mumbai, Maharashtra", "contact" => "Rahul Sharma - 9876543210"],
    ["name" => "GreenTech Dharavi", "pincode" => "400017", "address" => "Unit 8, Dharavi Industrial Estate, 90 Feet Road, Mumbai", "contact" => "Priya Patel - 8765432109"],
    ["name" => "EcoTech Mumbai Central", "pincode" => "400008", "address" => "Forbes Building, Dr. D.N. Road, Mumbai", "contact" => "Rajiv Mehta - 9876543210"],
    ["name" => "GreenHub Andheri", "pincode" => "400069", "address" => "Marol MIDC Industrial Estate, Andheri East, Mumbai", "contact" => "Priya Desai - 8765432109"],
    ["name" => "Pune Eco Center", "pincode" => "411001", "address" => "1256, FC Road, Shivajinagar, Pune", "contact" => "Amit Joshi - 7654321098"],

    // Delhi/NCR (8 entries)
    ["name" => "Delhi E-Waste Solutions", "pincode" => "110001", "address" => "Statesman House, Barakhamba Road, Connaught Place", "contact" => "Rohit Malhotra - 9876543211"],
    ["name" => "GreenTech Noida", "pincode" => "201301", "address" => "B-45, Sector 62, Near Ganga Shopping Complex, Noida", "contact" => "Shweta Singh - 8765432110"],
    ["name" => "Gurugram Recycle Hub", "pincode" => "122001", "address" => "32, MG Road, Opposite Galleria Market", "contact" => "Akshay Kumar - 7654321109"],

    // South India (15 entries)
    ["name" => "Bangalore Eco Center", "pincode" => "560001", "address" => "24, Unity Building, MG Road, Bangalore", "contact" => "Ananya Reddy - 6543210987"],
    ["name" => "Chennai E-Waste Hub", "pincode" => "600001", "address" => "15, Moore Street, Parrys Corner", "contact" => "Karthik Sundar - 9876554321"],
    ["name" => "Hyderabad Green Tech", "pincode" => "500001", "address" => "3-5-896, Abids Road, Near Koti Bus Stand", "contact" => "Arvind Reddy - 9876577777"],

    // East/Northeast (10 entries)
    ["name" => "Kolkata Green Collectors", "pincode" => "700001", "address" => "4th Floor, Lindsay Street, BBD Bagh", "contact" => "Debashis Roy - 9876555555"],
    ["name" => "Guwahati E-Waste Center", "pincode" => "781001", "address" => "34, GS Road, Christian Basti", "contact" => "Bikram Baruah - 9876543278"],

    // West/Central (7 entries)
    ["name" => "Ahmedabad Eco Center", "pincode" => "380001", "address" => "Shop 3, Swastik Cross Road, Navrangpura", "contact" => "Jay Patel - 9876544333"],
    ["name" => "Bhopal Recycle Hub", "pincode" => "462001", "address" => "Plot 56, Zone-II, MP Nagar", "contact" => "Anjali Dubey - 8765432198"]

];

// Process search if form submitted
$search_results = [];
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["pincode"])) {
    $search_pincode = $_POST["pincode"];
    $search_results = array_filter($ewaste_facilities, fn($f) => $f["pincode"] == $search_pincode);
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="kisspng-earth-world-map-globe-vector-hand-planet-5a9af8cfde0632.1928504515201056799094.png" rel="icon" type="image/x-icon">
    <title>EcoRecycle | E-Waste Facility Locator</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/lottie-web/5.10.2/lottie.min.js"></script>

    <style>
        .hero-bg {
            background-image: linear-gradient(rgba(0, 0, 0, 0.5), rgba(0, 0, 0, 0.5)), url('BG-HOME.jpg');
            background-size: cover;
            background-position: center;
        }

        .card-hover:hover {
            transform: translateY(-5px);
            box-shadow: 0 10px 20px rgba(0, 0, 0, 0.1);
        }

        .sidebar {
            position: fixed;
            left: -300px;
            top: 0;
            width: 300px;
            height: 100vh;
            background: white;
            box-shadow: 0 0 20px rgba(0, 0, 0, 0.1);
            transition: left 0.3s ease;
            z-index: 1000;
        }

        .sidebar.active {
            left: 0;
        }

        .sidebar-overlay {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: rgba(0, 0, 0, 0.5);
            z-index: 999;
            display: none;
        }

        .sidebar-overlay.active {
            display: block;
        }

        .sidebar-header {
            padding: 1.5rem;
            border-bottom: 1px solid #eee;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .sidebar-content {
            padding: 1.5rem;
        }

        .sidebar-menu {
            list-style: none;
            padding: 0;
            margin: 0;
        }

        .sidebar-menu li {
            margin-bottom: 0.5rem;
        }

        .sidebar-menu a {
            display: flex;
            align-items: center;
            padding: 0.75rem 1rem;
            color: #333;
            text-decoration: none;
            border-radius: 0.5rem;
            transition: all 0.3s ease;
        }

        .sidebar-menu a:hover {
            background: #f3f4f6;
            color: #10b981;
        }

        .sidebar-menu i {
            margin-right: 0.75rem;
            width: 20px;
            text-align: center;
        }

        .menu-toggle {
            display: flex;
            align-items: center;
            gap: 0.5rem;
            padding: 0.5rem 1rem;
            background: #10b981;
            color: white;
            border-radius: 0.5rem;
            cursor: pointer;
            transition: all 0.3s ease;
        }

        .menu-toggle:hover {
            background: #059669;
        }
    </style>
</head>

<body class="font-['Poppins'] bg-gray-50">
    <?php include 'navigation.php'; ?>

    <!-- Add this before the navigation -->
    <div class="sidebar-overlay"></div>
    <div class="sidebar">
        <div class="sidebar-header">
            <div class="flex items-center gap-2">
                <i class="fas fa-recycle text-emerald-600 text-2xl"></i>
                <span class="text-xl font-bold text-emerald-600">EcoRecycle</span>
            </div>
            <button class="close-sidebar">
                <i class="fas fa-times text-gray-500"></i>
            </button>
        </div>
        <div class="sidebar-content">
            <ul class="sidebar-menu">
                <li>
                    <a href="Home.php">
                        <i class="fas fa-home"></i>
                        Home
                    </a>
                </li>
                <li>
                    <a href="Facility.php">
                        <i class="fas fa-map-marker-alt"></i>
                        Facilities
                    </a>
                </li>
                <li>
                    <a href="Resources.php">
                        <i class="fas fa-book"></i>
                        Resources
                    </a>
                </li>
                <li>
                    <a href="contact.php">
                        <i class="fas fa-envelope"></i>
                        Contact
                    </a>
                </li>
                <li>
                    <a href="profile.php">
                        <i class="fas fa-user"></i>
                        Profile
                    </a>
                </li>
                <li>
                    <a href="recycle.php">
                        <i class="fas fa-recycle"></i>
                        Recycle Device
                    </a>
                </li>
                <li>
                    <a href="logout.php" class="text-red-600">
                        <i class="fas fa-sign-out-alt"></i>
                        Logout
                    </a>
                </li>
            </ul>
        </div>
    </div>

    <!-- Hero Section -->
    <section class="hero-bg text-white py-32 h-[600px]">
        <div class="container mx-auto px-4 text-center">
            <h1 class="text-4xl md:text-5xl font-bold mb-4">Find E-Waste Collection Centers Near You</h1>
            <p class="text-xl mb-8 max-w-2xl mx-auto">Recycle responsibly. Protect the planet.</p>
            <div class="max-w-xl mx-auto">
                <form method="POST" action="" class="w-full">
                    <div class="flex flex-col sm:flex-row gap-2">
                        <input
                            type="text"
                            name="pincode"
                            placeholder="Enter 6-digit Indian pincode"
                            class="flex-grow px-4 py-3 rounded-lg text-gray-800 focus:outline-none focus:ring-2 focus:ring-emerald-400"
                            maxlength="6"
                            pattern="\d{6}"
                            title="Please enter a valid 6-digit Indian pincode"
                            required
                            value="<?= isset($_POST['pincode']) ? htmlspecialchars($_POST['pincode']) : '' ?>">
                        <button
                            type="submit"
                            class="bg-emerald-500 hover:bg-emerald-600 text-white font-bold px-6 py-3 rounded-lg transition">
                            Locate Now <i class="fas fa-search ml-2"></i>
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </section>


    <!-- Search Results (Conditional Display) -->
    <?php if (!empty($search_results)): ?>
        <section class="py-12 bg-gray-50">
            <div class="container mx-auto px-4">
                <h2 class="text-3xl font-bold text-emerald-600 mb-8">
                    Results for Pincode: <?= htmlspecialchars($search_pincode) ?>
                </h2>
                <div class="grid gap-6 md:grid-cols-2">
                    <?php foreach ($search_results as $facility): ?>
                        <div class="bg-white p-6 rounded-lg shadow-sm card-hover">
                            <h3 class="text-xl font-semibold text-emerald-600"><?= $facility["name"] ?></h3>
                            <p class="text-gray-600 mt-2">
                                <i class="fas fa-map-marker-alt mr-2"></i> <?= $facility["address"] ?>
                            </p>
                            <p class="text-gray-600 mt-1">
                                <i class="fas fa-phone mr-2"></i> <?= $facility["contact"] ?>
                            </p>
                        </div>
                    <?php endforeach; ?>
                </div>
            </div>
        </section>
    <?php elseif ($_SERVER["REQUEST_METHOD"] == "POST"): ?>
        <section class="py-12 bg-gray-50">
            <div class="container mx-auto px-4 text-center">
                <p class="text-red-500">No facilities found for pincode: <?= htmlspecialchars($search_pincode) ?>. Try another pincode.</p>
            </div>
        </section>
    <?php endif; ?>

    <div class="flex space-x-[80px] h-[650px]">
        <div id="waste-Ani" class="w-[600px] h-[600px] m-[50px] ml-[100px]"></div>
        <div class="mt-[300px] text-center">
            <h1 class="font-bold text-5xl"><span class="text-green-500">"Turning</span> Electronic<span class="text-stone-400"> Waste</span> into <span class="text-green-400">Sustainable Resources."</span></h1>
        </div>
    </div>


    <script>
        var animation = lottie.loadAnimation({
            container: document.getElementById('waste-Ani'),
            renderer: 'svg',
            loop: true,
            autoplay: true,
            path: 'Waste_Ani.json'
        });
    </script>
   
    <div>
        <h2 class="text-3xl font-bold text-center text-emerald-600 mb-12">Resources</h2>
        <div class="flex justify-center space-x-8">
 
            <a href="Resources.php">
                <div class="group relative p-8 w-[280px] h-[280px] bg-gray-100 rounded-lg text-center flex flex-col items-center justify-between transition-all duration-300 hover:scale-105 hover:shadow-lg hover:bg-gray-300">
                    <h2 class="text-3xl font-bold text-emerald-600">
                        <i class="fas fa-book mr-2"></i>Guide
                    </h2>
                    <div class="w-[150px] h-[150px]" id="guide-Ani"></div>
                    <span class="text-emerald-600 text-4xl font-bold">→</span>
                </div>
            </a>

            <a href="videos.html">
                <div class="group relative p-8 w-[280px] h-[280px] bg-gray-100 rounded-lg text-center flex flex-col items-center justify-between transition-all duration-300 hover:scale-105 hover:shadow-lg hover:bg-gray-300">
                    <h2 class="text-3xl font-bold text-emerald-600">
                        <i class="fas fa-video mr-2"></i>Videos
                    </h2>
                    <div class="w-[150px] h-[150px]" id="video-Ani"></div>
                    <span class="text-emerald-600 text-4xl font-bold">→</span>
                </div>
            </a>

            <a href="Resources.php?filter=articles">
                <div class="group relative p-8 w-[280px] h-[280px] bg-gray-100 rounded-lg text-center flex flex-col items-center justify-between transition-all duration-300 hover:scale-105 hover:shadow-lg hover:bg-gray-300">
                    <h2 class="text-3xl font-bold text-emerald-600">
                        <i class="fas fa-newspaper mr-2"></i>Articles
                    </h2>
                    <div class="w-[150px] h-[150px]" id="article-Ani"></div>
                    <span class="text-emerald-600 text-4xl font-bold">→</span>
                </div>
            </a>

            <a href="http://www.ewasterecyclingplant.com/PCB_circuit_board_recycling_machine/e_waste_recycling_equipment_list_238.html">
                <div class="group relative p-8 w-[280px] h-[280px] bg-gray-100 rounded-lg text-center flex flex-col items-center justify-between transition-all duration-300 hover:scale-105 hover:shadow-lg hover:bg-gray-300">
                    <h2 class="text-3xl font-bold text-emerald-600">
                        <i class="fas fa-tools mr-2"></i>Tools
                    </h2>
                    <div class="w-[150px] h-[150px]" id="tools-Ani"></div>
                    <span class="text-emerald-600 text-4xl font-bold">→</span>
                </div>
            </a>
        </div>
    </div>



    <script>
        // Lottie animation for Guide card
        var animation = lottie.loadAnimation({
            container: document.getElementById('guide-Ani'),
            renderer: 'svg',
            loop: true,
            autoplay: true,
            path: 'Guide.json'
        });
        var animation = lottie.loadAnimation({
            container: document.getElementById('video-Ani'),
            renderer: 'svg',
            loop: true,
            autoplay: true,
            path: 'Video.json'
        });
        var animation = lottie.loadAnimation({
            container: document.getElementById('article-Ani'),
            renderer: 'svg',
            loop: true,
            autoplay: true,
            path: 'Article.json'
        });
        var animation = lottie.loadAnimation({
            container: document.getElementById('tools-Ani'),
            renderer: 'svg',
            loop: true,
            autoplay: true,
            path: 'Tools.json'
        });
    </script>



    <!-- Testimonials with Indian Names -->
    <section class="py-16 bg-white">
        <div class="container mx-auto px-4">
            <h2 class="text-3xl font-bold text-center text-emerald-600 mb-12">User Experiences</h2>
            <div class="grid md:grid-cols-2 gap-8">
                <div class="bg-gray-50 p-6 rounded-lg">
                    <div class="flex items-center mb-4">
                        <div class="w-12 h-12 bg-emerald-100 rounded-full flex items-center justify-center text-emerald-600 font-bold mr-4">PP</div>
                        <div>
                            <h4 class="font-semibold">Priya Patel</h4>
                            <p class="text-gray-500 text-sm">Small Business Owner</p>
                        </div>
                    </div>
                    <p class="text-gray-700 mb-3">"EcoRecycle made it simple to dispose of our old office computers responsibly. The facility was professional and even provided documentation for our records."</p>
                    <div class="text-amber-400">
                        <i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i>
                    </div>
                </div>
                <div class="bg-gray-50 p-6 rounded-lg">
                    <div class="flex items-center mb-4">
                        <div class="w-12 h-12 bg-emerald-100 rounded-full flex items-center justify-center text-emerald-600 font-bold mr-4">RS</div>
                        <div>
                            <h4 class="font-semibold">Rahul Sharma</h4>
                            <p class="text-gray-500 text-sm">IT Manager</p>
                        </div>
                    </div>
                    <p class="text-gray-700 mb-3">"As someone who deals with a lot of electronic waste, I appreciate having a reliable directory of certified recycling centers. This service saves me hours of research."</p>
                    <div class="text-amber-400">
                        <i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star-half-alt"></i>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Footer with Indian Address -->
    <footer class="bg-gray-800 text-white pt-12 pb-6">
        <div class="container mx-auto px-4">
            <div class="grid md:grid-cols-4 gap-8 mb-8">
                <div>
                    <h3 class="text-xl font-bold mb-4 flex items-center gap-2">
                        <i class="fas fa-recycle"></i> EcoRecycle
                    </h3>
                    <p class="mb-4 text-gray-300">Helping India recycle electronics responsibly since 2023.</p>
                    <div class="flex gap-4">
                        <a href="#" class="text-gray-300 hover:text-white"><i class="fab fa-facebook-f"></i></a>
                        <a href="#" class="text-gray-300 hover:text-white"><i class="fab fa-twitter"></i></a>
                        <a href="#" class="text-gray-300 hover:text-white"><i class="fab fa-instagram"></i></a>
                    </div>
                </div>
                <div>
                    <h4 class="text-lg font-semibold mb-4">Quick Links</h4>
                    <ul class="space-y-2">
                        <li><a href="index.php" class="text-gray-300 hover:text-white">Home</a></li>
                        <li><a href="Facility.php" class="text-gray-300 hover:text-white">Find Centers</a></li>
                        <li><a href="Resources.php" class="text-gray-300 hover:text-white">Accepted Items</a></li>
                        <li><a href="contact.php" class="text-gray-300 hover:text-white">FAQ</a></li>
                    </ul>
                </div>
                <div>
                    <h4 class="text-lg font-semibold mb-4">Resources</h4>
                    <ul class="space-y-2">
                        <li><a href="#" class="text-gray-300 hover:text-white">E-Waste Facts</a></li>
                        <li><a href="#" class="text-gray-300 hover:text-white">Recycling Process</a></li>
                        <li><a href="#" class="text-gray-300 hover:text-white">Data Security</a></li>
                    </ul>
                </div>
                <div>
                    <h4 class="text-lg font-semibold mb-4">Contact</h4>
                    <ul class="space-y-2 text-gray-300">
                        <li class="flex items-start gap-2">
                            <i class="fas fa-map-marker-alt mt-1"></i>
                            <span>456 Green Towers, Bengaluru, KA 560001</span>
                        </li>
                        <li class="flex items-center gap-2">
                            <i class="fas fa-phone"></i>
                            <span>+91 80 4040 5050</span>
                        </li>
                        <li class="flex items-center gap-2">
                            <i class="fas fa-envelope"></i>
                            <span>info@ecorecycle.in</span>
                        </li>
                    </ul>
                </div>
            </div>
            <div class="border-t border-gray-700 pt-6 text-center text-gray-400">
                <p>This initiative supports responsible e-waste management and sustainability.</p>
                <p class="mt-2">© 2023 EcoRecycle. All rights reserved.</p>
            </div>
        </div>
    </footer>

    <script>
        // Mobile menu toggle
        const sidebar = document.querySelector('.sidebar');
        const overlay = document.querySelector('.sidebar-overlay');
        const menuToggle = document.querySelector('.menu-toggle');
        const closeSidebar = document.querySelector('.close-sidebar');

        menuToggle.addEventListener('click', function() {
            sidebar.classList.add('active');
            overlay.classList.add('active');
        });

        closeSidebar.addEventListener('click', function() {
            sidebar.classList.remove('active');
            overlay.classList.remove('active');
        });

        overlay.addEventListener('click', function() {
            sidebar.classList.remove('active');
            overlay.classList.remove('active');
        });

        // Close sidebar when clicking on menu items
        document.querySelectorAll('.sidebar-menu a').forEach(link => {
            link.addEventListener('click', function() {
                sidebar.classList.remove('active');
                overlay.classList.remove('active');
            });
        });

        // Animated counters (unchanged from your original)
        function animateCounter(elementId, target, duration = 2000) {
            const element = document.getElementById(elementId);
            const start = 0;
            const increment = target / (duration / 16);
            let current = start;
            const timer = setInterval(() => {
                current += increment;
                if (current >= target) {
                    clearInterval(timer);
                    current = target;
                }
                element.textContent = Math.floor(current).toLocaleString();
            }, 16);
        }

        const observer = new IntersectionObserver((entries) => {
            if (entries[0].isIntersecting) {
                animateCounter('ewasteCounter', 12500);
                animateCounter('facilityCounter', 850);
                animateCounter('cityCounter', 120);
                observer.unobserve(entries[0].target);
            }
        }, {
            threshold: 0.5
        });

        observer.observe(document.querySelector('section.bg-emerald-600'));
    </script>
</body>

</html>