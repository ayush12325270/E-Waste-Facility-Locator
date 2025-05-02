<?php
session_start();

// Check if user is logged in
if (!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] !== true) {
    header("Location: login.php");
    exit;
}

// Store current page as last visited
$current_page = basename($_SERVER['PHP_SELF']);
if ($current_page !== 'login.php' && $current_page !== 'signup.php') {
    $_SESSION['last_page'] = $current_page;
}

// Include header
include 'header.php';

// Update user's facilities found count
if (isset($_SESSION['email'])) {
    $email = $_SESSION['email'];
    $users_file = 'users.json';
    if (file_exists($users_file)) {
        $users_data = json_decode(file_get_contents($users_file), true);
        foreach ($users_data['users'] as &$user) {
            if ($user['email'] === $email) {
                $user['facilities_found'] = ($user['facilities_found'] ?? 0) + 1;
                file_put_contents($users_file, json_encode($users_data, JSON_PRETTY_PRINT));
                break;
            }
        }
    }
}

$facilities = [
    // Maharashtra
    [
        "name" => "EcoRecycle Mumbai",
        "pincode" => "400001",
        "state" => "Maharashtra",
        "address" => "Fort, Mumbai",
        "contact" => "Rahul Sharma - 9876543210",
        "types" => ["drop-off", "certified"],
        "description" => "Accepts all types of e-waste with proper documentation",
        "rating" => 4.5,
        "icon" => "recycle"
    ],
    [
        "name" => "GreenTech Pune",
        "pincode" => "411001",
        "state" => "Maharashtra",
        "address" => "Shivajinagar, Pune",
        "contact" => "Priya Patel - 8765432109",
        "types" => ["pickup", "drop-off"],
        "description" => "Specializes in computer and mobile recycling",
        "rating" => 4.2,
        "icon" => "computer"
    ],
    [
        "name" => "EcoCycle Nagpur",
        "pincode" => "440001",
        "state" => "Maharashtra",
        "address" => "Sitabuldi, Nagpur",
        "contact" => "Amit Deshmukh - 7654321098",
        "types" => ["drop-off", "certified"],
        "description" => "Government approved e-waste collection center",
        "rating" => 4.0,
        "icon" => "recycle"
    ],
    [
        "name" => "E-Waste Thane",
        "pincode" => "400601",
        "state" => "Maharashtra",
        "address" => "Ghodbunder Road, Thane",
        "contact" => "Rajesh Mehta - 9876543211",
        "types" => ["pickup", "drop-off"],
        "description" => "Comprehensive e-waste management services",
        "rating" => 4.3,
        "icon" => "recycle"
    ],
    [
        "name" => "GreenTech Nashik",
        "pincode" => "422001",
        "state" => "Maharashtra",
        "address" => "College Road, Nashik",
        "contact" => "Suresh Patil - 8765432110",
        "types" => ["drop-off", "certified"],
        "description" => "Specialized in industrial e-waste",
        "rating" => 4.1,
        "icon" => "recycle"
    ],
    [
        "name" => "EcoRecycle Aurangabad",
        "pincode" => "431001",
        "state" => "Maharashtra",
        "address" => "Jalna Road, Aurangabad",
        "contact" => "Vikram Singh - 7654321109",
        "types" => ["pickup", "certified"],
        "description" => "Authorized e-waste collection center",
        "rating" => 4.2,
        "icon" => "recycle"
    ],
    [
        "name" => "GreenTech Solapur",
        "pincode" => "413001",
        "state" => "Maharashtra",
        "address" => "Pandharpur Road, Solapur",
        "contact" => "Anita Desai - 9876543212",
        "types" => ["drop-off"],
        "description" => "Regional e-waste management center",
        "rating" => 4.0,
        "icon" => "recycle"
    ],
    [
        "name" => "E-Waste Kolhapur",
        "pincode" => "416001",
        "state" => "Maharashtra",
        "address" => "Shivaji Peth, Kolhapur",
        "contact" => "Rahul Patil - 8765432111",
        "types" => ["pickup", "drop-off", "certified"],
        "description" => "Comprehensive e-waste solutions",
        "rating" => 4.4,
        "icon" => "recycle"
    ],
    [
        "name" => "EcoCycle Amravati",
        "pincode" => "444601",
        "state" => "Maharashtra",
        "address" => "Rajapeth, Amravati",
        "contact" => "Priya Sharma - 7654321110",
        "types" => ["drop-off"],
        "description" => "Authorized collection center",
        "rating" => 3.9,
        "icon" => "recycle"
    ],
    [
        "name" => "GreenTech Sangli",
        "pincode" => "416416",
        "state" => "Maharashtra",
        "address" => "Vishrambag, Sangli",
        "contact" => "Amit Joshi - 9876543213",
        "types" => ["pickup", "certified"],
        "description" => "E-waste recycling with certification",
        "rating" => 4.1,
        "icon" => "recycle"
    ],
    [
        "name" => "E-Waste Latur",
        "pincode" => "413512",
        "state" => "Maharashtra",
        "address" => "Ausa Road, Latur",
        "contact" => "Neha Gupta - 8765432112",
        "types" => ["drop-off"],
        "description" => "Regional collection center",
        "rating" => 3.8,
        "icon" => "recycle"
    ],
    [
        "name" => "EcoRecycle Jalgaon",
        "pincode" => "425001",
        "state" => "Maharashtra",
        "address" => "Navipeth, Jalgaon",
        "contact" => "Rajiv Mehta - 7654321111",
        "types" => ["pickup", "drop-off", "certified"],
        "description" => "Comprehensive e-waste management",
        "rating" => 4.2,
        "icon" => "recycle"
    ],
    [
        "name" => "GreenTech Akola",
        "pincode" => "444001",
        "state" => "Maharashtra",
        "address" => "Civil Lines, Akola",
        "contact" => "Sneha Patel - 9876543214",
        "types" => ["drop-off"],
        "description" => "Authorized collection point",
        "rating" => 3.9,
        "icon" => "recycle"
    ],
    [
        "name" => "E-Waste Nanded",
        "pincode" => "431601",
        "state" => "Maharashtra",
        "address" => "Vazirabad, Nanded",
        "contact" => "Vikram Deshmukh - 8765432113",
        "types" => ["pickup", "certified"],
        "description" => "E-waste recycling with proper documentation",
        "rating" => 4.0,
        "icon" => "recycle"
    ],
    [
        "name" => "EcoCycle Ratnagiri",
        "pincode" => "415612",
        "state" => "Maharashtra",
        "address" => "Ganpati Peth, Ratnagiri",
        "contact" => "Anil Kulkarni - 7654321112",
        "types" => ["drop-off"],
        "description" => "Coastal e-waste collection center",
        "rating" => 3.8,
        "icon" => "recycle"
    ],

    // Delhi/NCR
    [
        "name" => "E-Waste Delhi",
        "pincode" => "110001",
        "state" => "Delhi",
        "address" => "Connaught Place, New Delhi",
        "contact" => "Vikram Singh - 9876543211",
        "types" => ["pickup", "drop-off", "certified"],
        "description" => "Largest e-waste collection center in Delhi",
        "rating" => 4.7,
        "icon" => "recycle"
    ],
    [
        "name" => "GreenTech Noida",
        "pincode" => "201301",
        "state" => "Uttar Pradesh",
        "address" => "Sector 62, Noida",
        "contact" => "Neha Gupta - 8765432110",
        "types" => ["pickup", "certified"],
        "description" => "Specialized in IT equipment recycling",
        "rating" => 4.3,
        "icon" => "computer"
    ],
    [
        "name" => "EcoRecycle Gurgaon",
        "pincode" => "122001",
        "state" => "Haryana",
        "address" => "Sector 14, Gurgaon",
        "contact" => "Rahul Sharma - 9876543212",
        "types" => ["pickup", "drop-off", "certified"],
        "description" => "Corporate e-waste management",
        "rating" => 4.5,
        "icon" => "recycle"
    ],
    [
        "name" => "E-Waste Faridabad",
        "pincode" => "121001",
        "state" => "Haryana",
        "address" => "Sector 16, Faridabad",
        "contact" => "Priya Patel - 8765432111",
        "types" => ["drop-off"],
        "description" => "Industrial e-waste collection",
        "rating" => 4.2,
        "icon" => "recycle"
    ],
    [
        "name" => "GreenTech Ghaziabad",
        "pincode" => "201001",
        "state" => "Uttar Pradesh",
        "address" => "Raj Nagar, Ghaziabad",
        "contact" => "Amit Kumar - 7654321109",
        "types" => ["pickup", "certified"],
        "description" => "Authorized e-waste recycler",
        "rating" => 4.1,
        "icon" => "recycle"
    ],
    [
        "name" => "EcoCycle South Delhi",
        "pincode" => "110017",
        "state" => "Delhi",
        "address" => "Hauz Khas, New Delhi",
        "contact" => "Rajesh Mehta - 9876543213",
        "types" => ["drop-off", "certified"],
        "description" => "South Delhi collection center",
        "rating" => 4.4,
        "icon" => "recycle"
    ],
    [
        "name" => "E-Waste East Delhi",
        "pincode" => "110092",
        "state" => "Delhi",
        "address" => "Preet Vihar, Delhi",
        "contact" => "Suresh Singh - 8765432112",
        "types" => ["pickup", "drop-off"],
        "description" => "East Delhi e-waste facility",
        "rating" => 4.0,
        "icon" => "recycle"
    ],
    [
        "name" => "GreenTech West Delhi",
        "pincode" => "110018",
        "state" => "Delhi",
        "address" => "Rajouri Garden, Delhi",
        "contact" => "Anita Sharma - 7654321110",
        "types" => ["drop-off", "certified"],
        "description" => "West Delhi collection point",
        "rating" => 4.2,
        "icon" => "recycle"
    ],
    [
        "name" => "EcoRecycle North Delhi",
        "pincode" => "110006",
        "state" => "Delhi",
        "address" => "Civil Lines, Delhi",
        "contact" => "Vikram Patel - 9876543214",
        "types" => ["pickup"],
        "description" => "North Delhi e-waste center",
        "rating" => 4.1,
        "icon" => "recycle"
    ],
    [
        "name" => "E-Waste Dwarka",
        "pincode" => "110075",
        "state" => "Delhi",
        "address" => "Sector 12, Dwarka",
        "contact" => "Rahul Gupta - 8765432113",
        "types" => ["drop-off", "certified"],
        "description" => "Dwarka e-waste facility",
        "rating" => 4.3,
        "icon" => "recycle"
    ],
    [
        "name" => "GreenTech Rohini",
        "pincode" => "110085",
        "state" => "Delhi",
        "address" => "Sector 3, Rohini",
        "contact" => "Priya Singh - 7654321111",
        "types" => ["pickup", "drop-off"],
        "description" => "Rohini collection center",
        "rating" => 4.0,
        "icon" => "recycle"
    ],
    [
        "name" => "EcoCycle Greater Noida",
        "pincode" => "201310",
        "state" => "Uttar Pradesh",
        "address" => "Knowledge Park, Greater Noida",
        "contact" => "Amit Kumar - 9876543215",
        "types" => ["pickup", "certified"],
        "description" => "Greater Noida e-waste facility",
        "rating" => 4.2,
        "icon" => "recycle"
    ],
    [
        "name" => "E-Waste Sonipat",
        "pincode" => "131001",
        "state" => "Haryana",
        "address" => "Sector 15, Sonipat",
        "contact" => "Rajiv Sharma - 8765432114",
        "types" => ["drop-off"],
        "description" => "Sonipat collection center",
        "rating" => 3.9,
        "icon" => "recycle"
    ],
    [
        "name" => "GreenTech Bahadurgarh",
        "pincode" => "124507",
        "state" => "Haryana",
        "address" => "Delhi Road, Bahadurgarh",
        "contact" => "Neha Patel - 7654321112",
        "types" => ["pickup", "drop-off", "certified"],
        "description" => "Bahadurgarh e-waste facility",
        "rating" => 4.1,
        "icon" => "recycle"
    ],
    [
        "name" => "EcoRecycle Meerut",
        "pincode" => "250001",
        "state" => "Uttar Pradesh",
        "address" => "Begum Bridge Road, Meerut",
        "contact" => "Vikram Singh - 9876543216",
        "types" => ["drop-off"],
        "description" => "Meerut collection center",
        "rating" => 4.0,
        "icon" => "recycle"
    ],

    // Karnataka
    [
        "name" => "EcoRecycle Bangalore",
        "pincode" => "560001",
        "state" => "Karnataka",
        "address" => "MG Road, Bangalore",
        "contact" => "Arjun Kumar - 9876543212",
        "types" => ["pickup", "drop-off", "certified"],
        "description" => "Tech hub e-waste management center",
        "rating" => 4.6,
        "icon" => "recycle"
    ],
    [
        "name" => "GreenTech Hubli",
        "pincode" => "580001",
        "state" => "Karnataka",
        "address" => "Vidyanagar, Hubli",
        "contact" => "Suresh Patil - 8765432111",
        "types" => ["drop-off"],
        "description" => "Regional e-waste collection point",
        "rating" => 4.1,
        "icon" => "recycle"
    ],

    // Tamil Nadu
    [
        "name" => "E-Waste Chennai",
        "pincode" => "600001",
        "state" => "Tamil Nadu",
        "address" => "Mount Road, Chennai",
        "contact" => "Rajesh Kumar - 9876543213",
        "types" => ["pickup", "certified"],
        "description" => "Authorized e-waste recycler",
        "rating" => 4.4,
        "icon" => "recycle"
    ],
    [
        "name" => "EcoCycle Coimbatore",
        "pincode" => "641001",
        "state" => "Tamil Nadu",
        "address" => "Gandhipuram, Coimbatore",
        "contact" => "Deepak Rajan - 8765432112",
        "types" => ["drop-off"],
        "description" => "Industrial e-waste collection center",
        "rating" => 4.0,
        "icon" => "recycle"
    ],

    // Gujarat
    [
        "name" => "GreenTech Ahmedabad",
        "pincode" => "380001",
        "state" => "Gujarat",
        "address" => "Ashram Road, Ahmedabad",
        "contact" => "Mitesh Patel - 9876543214",
        "types" => ["pickup", "drop-off", "certified"],
        "description" => "Comprehensive e-waste management",
        "rating" => 4.5,
        "icon" => "recycle"
    ],
    [
        "name" => "EcoRecycle Surat",
        "pincode" => "395001",
        "state" => "Gujarat",
        "address" => "Ring Road, Surat",
        "contact" => "Jignesh Shah - 8765432113",
        "types" => ["drop-off"],
        "description" => "Diamond city e-waste center",
        "rating" => 4.2,
        "icon" => "recycle"
    ],

    // West Bengal
    [
        "name" => "E-Waste Kolkata",
        "pincode" => "700001",
        "state" => "West Bengal",
        "address" => "Park Street, Kolkata",
        "contact" => "Amitava Das - 9876543215",
        "types" => ["pickup", "certified"],
        "description" => "Eastern India's largest e-waste facility",
        "rating" => 4.3,
        "icon" => "recycle"
    ],

    // Telangana
    [
        "name" => "EcoRecycle Hyderabad",
        "pincode" => "500001",
        "state" => "Telangana",
        "address" => "Abids, Hyderabad",
        "contact" => "Ravi Kumar - 9876543216",
        "types" => ["pickup", "drop-off", "certified"],
        "description" => "IT city e-waste management",
        "rating" => 4.4,
        "icon" => "recycle"
    ],

    // Kerala
    [
        "name" => "GreenTech Kochi",
        "pincode" => "682001",
        "state" => "Kerala",
        "address" => "MG Road, Kochi",
        "contact" => "Anand Menon - 9876543217",
        "types" => ["drop-off", "certified"],
        "description" => "Coastal e-waste recycling center",
        "rating" => 4.1,
        "icon" => "recycle"
    ],

    // Rajasthan
    [
        "name" => "E-Waste Jaipur",
        "pincode" => "302001",
        "state" => "Rajasthan",
        "address" => "MI Road, Jaipur",
        "contact" => "Vijay Singh - 9876543218",
        "types" => ["pickup", "drop-off"],
        "description" => "Pink city e-waste facility",
        "rating" => 4.0,
        "icon" => "recycle"
    ],

    // Punjab
    [
        "name" => "EcoRecycle Ludhiana",
        "pincode" => "141001",
        "state" => "Punjab",
        "address" => "Ferozepur Road, Ludhiana",
        "contact" => "Harpreet Singh - 9876543221",
        "types" => ["pickup", "drop-off", "certified"],
        "description" => "Industrial city e-waste management",
        "rating" => 4.3,
        "icon" => "recycle"
    ],
    [
        "name" => "GreenTech Jalandhar",
        "pincode" => "144001",
        "state" => "Punjab",
        "address" => "Model Town, Jalandhar",
        "contact" => "Gurpreet Kaur - 8765432115",
        "types" => ["pickup", "certified"],
        "description" => "Authorized e-waste recycler",
        "rating" => 4.2,
        "icon" => "recycle"
    ],
    [
        "name" => "E-Waste Amritsar",
        "pincode" => "143001",
        "state" => "Punjab",
        "address" => "Lawrence Road, Amritsar",
        "contact" => "Rajinder Singh - 7654321113",
        "types" => ["drop-off", "certified"],
        "description" => "Golden city e-waste facility",
        "rating" => 4.1,
        "icon" => "recycle"
    ],
    [
        "name" => "EcoCycle Patiala",
        "pincode" => "147001",
        "state" => "Punjab",
        "address" => "Leela Bhawan, Patiala",
        "contact" => "Manpreet Singh - 9876543222",
        "types" => ["pickup", "drop-off"],
        "description" => "Royal city e-waste center",
        "rating" => 4.0,
        "icon" => "recycle"
    ],
    [
        "name" => "GreenTech Bathinda",
        "pincode" => "151001",
        "state" => "Punjab",
        "address" => "Guru Nanak Dev Marg, Bathinda",
        "contact" => "Jaspreet Kaur - 8765432116",
        "types" => ["drop-off", "certified"],
        "description" => "City of lakes e-waste facility",
        "rating" => 3.9,
        "icon" => "recycle"
    ],

    // Bihar
    [
        "name" => "EcoRecycle Patna",
        "pincode" => "800001",
        "state" => "Bihar",
        "address" => "Fraser Road, Patna",
        "contact" => "Rajesh Kumar - 9876543223",
        "types" => ["pickup", "drop-off", "certified"],
        "description" => "Capital city e-waste management",
        "rating" => 4.2,
        "icon" => "recycle"
    ],
    [
        "name" => "GreenTech Gaya",
        "pincode" => "823001",
        "state" => "Bihar",
        "address" => "Bodh Gaya Road, Gaya",
        "contact" => "Anand Kumar - 8765432117",
        "types" => ["drop-off", "certified"],
        "description" => "Pilgrimage city e-waste center",
        "rating" => 4.0,
        "icon" => "recycle"
    ],
    [
        "name" => "E-Waste Muzaffarpur",
        "pincode" => "842001",
        "state" => "Bihar",
        "address" => "Saraiyaganj, Muzaffarpur",
        "contact" => "Vikash Kumar - 7654321114",
        "types" => ["pickup", "drop-off"],
        "description" => "Lychee city e-waste facility",
        "rating" => 3.9,
        "icon" => "recycle"
    ],
    [
        "name" => "EcoCycle Bhagalpur",
        "pincode" => "812001",
        "state" => "Bihar",
        "address" => "Sabour Road, Bhagalpur",
        "contact" => "Rahul Kumar - 9876543224",
        "types" => ["drop-off", "certified"],
        "description" => "Silk city e-waste center",
        "rating" => 3.8,
        "icon" => "recycle"
    ],
    [
        "name" => "GreenTech Darbhanga",
        "pincode" => "846001",
        "state" => "Bihar",
        "address" => "Laheriasarai, Darbhanga",
        "contact" => "Priya Kumari - 8765432118",
        "types" => ["pickup", "certified"],
        "description" => "Cultural city e-waste facility",
        "rating" => 3.7,
        "icon" => "recycle"
    ],

    // Madhya Pradesh
    [
        "name" => "EcoRecycle Bhopal",
        "pincode" => "462001",
        "state" => "Madhya Pradesh",
        "address" => "MP Nagar, Bhopal",
        "contact" => "Rajesh Sharma - 9876543225",
        "types" => ["pickup", "drop-off", "certified"],
        "description" => "City of lakes e-waste management",
        "rating" => 4.3,
        "icon" => "recycle"
    ],
    [
        "name" => "GreenTech Indore",
        "pincode" => "452001",
        "state" => "Madhya Pradesh",
        "address" => "Vijay Nagar, Indore",
        "contact" => "Anita Verma - 8765432119",
        "types" => ["pickup", "certified"],
        "description" => "Commercial capital e-waste center",
        "rating" => 4.4,
        "icon" => "recycle"
    ],
    [
        "name" => "E-Waste Jabalpur",
        "pincode" => "482001",
        "state" => "Madhya Pradesh",
        "address" => "Civil Lines, Jabalpur",
        "contact" => "Vikram Singh - 7654321115",
        "types" => ["drop-off", "certified"],
        "description" => "Marble city e-waste facility",
        "rating" => 4.1,
        "icon" => "recycle"
    ],
    [
        "name" => "EcoCycle Gwalior",
        "pincode" => "474001",
        "state" => "Madhya Pradesh",
        "address" => "Lashkar, Gwalior",
        "contact" => "Rahul Verma - 9876543226",
        "types" => ["pickup", "drop-off"],
        "description" => "Tourist city e-waste center",
        "rating" => 4.0,
        "icon" => "recycle"
    ],
    [
        "name" => "GreenTech Ujjain",
        "pincode" => "456001",
        "state" => "Madhya Pradesh",
        "address" => "Freeganj, Ujjain",
        "contact" => "Priya Sharma - 8765432120",
        "types" => ["drop-off", "certified"],
        "description" => "Temple city e-waste facility",
        "rating" => 3.9,
        "icon" => "recycle"
    ],

    // Andhra Pradesh
    [
        "name" => "GreenTech Visakhapatnam",
        "pincode" => "530001",
        "state" => "Andhra Pradesh",
        "address" => "Dwarakanagar, Visakhapatnam",
        "contact" => "Srinivas Rao - 9876543220",
        "types" => ["drop-off"],
        "description" => "Port city e-waste management",
        "rating" => 4.1,
        "icon" => "recycle"
    ]
];

// Function to get icon HTML
function getIconHTML($icon) {
    switch ($icon) {
        case 'recycle':
            return '<i class="fas fa-recycle"></i>';
        case 'computer':
            return '<i class="fas fa-laptop"></i>';
        default:
            return '<i class="fas fa-recycle"></i>';
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="kisspng-earth-world-map-globe-vector-hand-planet-5a9af8cfde0632.1928504515201056799094.png" rel="icon"
        type="image/x-icon">
    <title>Find E-Waste Facilities in India | EcoRecycle</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/lottie-web/5.10.2/lottie.min.js"></script>

    <style>
        .facility-card {
            transition: all 0.3s ease;
        }

        .facility-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 10px 20px rgba(0, 0, 0, 0.1);
        }

        .pagination-btn.active {
            background-color: #059669;
            color: white;
        }

        .hindi-text {
            font-family: 'Noto Sans Devanagari', sans-serif;
        }
    </style>
</head>

<body class="font-['Poppins'] bg-gray-50">
    <?php include 'navigation.php'; ?>

    <div class="container mx-auto px-4 py-8">
        <?php
        // Process search if form submitted
        $search_results = [];
        $search_performed = false;
        $search_pincode = "";
        
        if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["pincode"])) {
            $search_pincode = trim($_POST["pincode"]);
            $search_results = array_filter($facilities, function ($f) use ($search_pincode) {
                return $f["pincode"] == $search_pincode;
            });
            $search_performed = true;
        }
        ?>

        <div class="flex space-x-[80px] h-[650px]">
            <div id="waste-Ani" class="w-[600px] h-[600px] m-[50px] ml-[100px]">
                <img src="data:image/png;base64," alt="Checkin Icon" class="hidden">
            </div>
            <div class="mt-[300px] text-center">
                <h1 class="font-bold text-4xl">
                    <span class="text-green-500">"Locate</span> Us
                    <span class="text-stone-400"> Now</span>
                    <span class="text-green-400">"</span>
                </h1>
            </div>
        </div>

        <script>
            var animation = lottie.loadAnimation({
                container: document.getElementById('waste-Ani'), 
                renderer: 'svg', 
                loop: true, 
                autoplay: true, 
                path: 'Locator.json' 
            });
        </script>

        <!-- Search Section -->
        <section class="container mx-auto px-4 py-8">
            <div class="bg-white p-6 rounded-lg shadow-md max-w-3xl mx-auto">
                <h2 class="text-xl font-semibold mb-4 text-center">Search by Indian Pincode</h2>
                <form method="POST" class="flex flex-col sm:flex-row gap-2">
                    <input type="text" name="pincode" id="pincodeInput" placeholder="Enter 6-digit pincode"
                        class="flex-grow px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-emerald-400"
                        pattern="[0-9]{6}" title="Please enter a valid 6-digit Indian pincode" required
                        value="<?php echo htmlspecialchars($search_pincode); ?>">
                    <button type="submit"
                        class="bg-emerald-500 hover:bg-emerald-600 text-white font-medium px-6 py-2 rounded-lg transition">
                        Search <i class="fas fa-search ml-1"></i>
                    </button>
                </form>
                <p class="text-sm text-gray-500 mt-2">Example: 400001 for Mumbai, 110001 for Delhi</p>
            </div>
        </section>

        <!-- Facilities List -->
        <main class="container mx-auto px-4 py-8">
            <?php if ($search_performed): ?>
                <?php if (!empty($search_results)): ?>
                    <h3 class="text-xl font-semibold mb-6">
                        Found <?php echo count($search_results); ?> facilities for pincode <?php echo htmlspecialchars($search_pincode); ?>
                    </h3>
                    <div class="grid md:grid-cols-2 lg:grid-cols-3 gap-6">
                        <?php foreach ($search_results as $facility): ?>
                            <div class="bg-white rounded-lg shadow-md overflow-hidden facility-card">
                                <div class="h-40 bg-emerald-100 flex items-center justify-center">
                                    <i class="fas fa-<?php echo getIconHTML($facility['icon']); ?> text-2xl text-emerald-500"></i>
                                </div>
                                <div class="p-6">
                                    <h3 class="text-xl font-semibold mb-2"><?php echo htmlspecialchars($facility['name']); ?></h3>
                                    <p class="text-gray-600 mb-4">
                                        <i class="fas fa-map-marker-alt text-emerald-500 mr-2"></i>
                                        <?php echo htmlspecialchars($facility['address']); ?>
                                    </p>
                                    <?php if (isset($facility['types']) && is_array($facility['types'])): ?>
                                        <div class="mb-4">
                                            <?php foreach ($facility['types'] as $type): ?>
                                                <span class="bg-emerald-100 text-emerald-800 text-sm px-2 py-1 rounded mr-1">
                                                    <?php echo ucfirst($type); ?>
                                                </span>
                                            <?php endforeach; ?>
                                        </div>
                                    <?php endif; ?>
                                    <?php if (isset($facility['description'])): ?>
                                        <p class="text-gray-700 mb-4"><?php echo htmlspecialchars($facility['description']); ?></p>
                                    <?php endif; ?>
                                    <div class="flex justify-between items-center">
                                        <a href="https://maps.google.com/?q=<?php echo urlencode($facility['address']); ?>"
                                            target="_blank"
                                            class="text-emerald-500 hover:underline">
                                            View on Map
                                        </a>
                                        <?php if (isset($facility['rating'])): ?>
                                            <span class="text-yellow-500">
                                                <?php
                                                $fullStars = floor($facility['rating']);
                                                $hasHalfStar = ($facility['rating'] - $fullStars) >= 0.5;

                                                for ($i = 0; $i < $fullStars; $i++) {
                                                    echo '<i class="fas fa-star"></i>';
                                                }
                                                if ($hasHalfStar) {
                                                    echo '<i class="fas fa-star-half-alt"></i>';
                                                }
                                                for ($i = $fullStars + ($hasHalfStar ? 1 : 0); $i < 5; $i++) {
                                                    echo '<i class="far fa-star"></i>';
                                                }
                                                ?>
                                            </span>
                                        <?php endif; ?>
                                    </div>
                                </div>
                            </div>
                        <?php endforeach; ?>
                    </div>
                <?php else: ?>
                    <div class="text-center py-12 bg-white rounded-lg shadow-md">
                        <i class="fas fa-search text-2xl text-emerald-500 mb-4"></i>
                        <h3 class="text-xl font-semibold text-gray-600 mb-2">No E-Waste Facilities Found</h3>
                        <p class="text-gray-500 mb-4">Sorry, there are no e-waste facilities available for pincode <?php echo htmlspecialchars($search_pincode); ?> at the moment.</p>
                        <p class="text-gray-500 mb-4">We are working to expand our network and will be available in your area shortly.</p>
                        <div class="flex justify-center gap-4">
                            <a href="contact.php" class="bg-emerald-500 hover:bg-emerald-600 text-white px-4 py-2 rounded-lg transition">
                                Contact Us
                            </a>
                            <a href="Facility.php" class="bg-gray-200 hover:bg-gray-300 text-gray-700 px-4 py-2 rounded-lg transition">
                                Try Another Pincode
                            </a>
                        </div>
                    </div>
                <?php endif; ?>
            <?php else: ?>
                <!-- Default view when no search performed -->
                <div class="grid md:grid-cols-2 lg:grid-cols-3 gap-6">
                    <?php
                    // Show sample facilities (first 6) when no search is performed
                    $sample_facilities = array_slice($facilities, 0, 6);
                    foreach ($sample_facilities as $facility): ?>
                        <div class="bg-white rounded-lg shadow-md overflow-hidden facility-card">
                            <div class="h-40 bg-emerald-100 flex items-center justify-center">
                                <i class="fas fa-<?php echo getIconHTML($facility['icon']); ?> text-2xl text-emerald-500"></i>
                            </div>
                            <div class="p-6">
                                <h3 class="text-xl font-semibold mb-2"><?php echo htmlspecialchars($facility['name']); ?></h3>
                                <p class="text-gray-600 mb-4">
                                    <i class="fas fa-map-marker-alt text-emerald-500 mr-2"></i>
                                    <?php echo htmlspecialchars($facility['address']); ?>
                                </p>
                                <div class="mb-4">
                                    <?php foreach ($facility['types'] as $type): ?>
                                        <span class="bg-emerald-100 text-emerald-800 text-sm px-2 py-1 rounded mr-1">
                                            <?php echo ucfirst($type); ?>
                                        </span>
                                    <?php endforeach; ?>
                                </div>
                                <p class="text-gray-700 mb-4"><?php echo htmlspecialchars($facility['description']); ?></p>
                                <div class="flex justify-between items-center">
                                    <span class="text-emerald-500">Pincode: <?php echo $facility['pincode']; ?></span>
                                    <span class="text-yellow-500">
                                        <?php
                                        $fullStars = floor($facility['rating']);
                                        $hasHalfStar = ($facility['rating'] - $fullStars) >= 0.5;

                                        for ($i = 0; $i < $fullStars; $i++) {
                                            echo '<i class="fas fa-star"></i>';
                                        }
                                        if ($hasHalfStar) {
                                            echo '<i class="fas fa-star-half-alt"></i>';
                                        }
                                        for ($i = $fullStars + ($hasHalfStar ? 1 : 0); $i < 5; $i++) {
                                            echo '<i class="far fa-star"></i>';
                                        }
                                        ?>
                                    </span>
                                </div>
                            </div>
                        </div>
                    <?php endforeach; ?>
                </div>
            <?php endif; ?>
        </main>
    </div>

    <!-- Footer -->
    <footer class="bg-gray-800 text-white pt-12 pb-6">
        <div class="container mx-auto px-4">
            <div class="grid md:grid-cols-4 gap-8 mb-8">
                <div>
                    <h3 class="text-xl font-bold mb-4 flex items-center gap-2">
                        <i class="fas fa-recycle"></i> EcoRecycle India
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
                        <li><a href="Home.php" class="text-gray-300 hover:text-white">Home</a></li>
                        <li><a href="facilities.html" class="text-gray-300 hover:text-white">Find Centers</a></li>
                        <li><a href="#" class="text-gray-300 hover:text-white">Accepted Items</a></li>
                        <li><a href="#" class="text-gray-300 hover:text-white">FAQ</a></li>
                    </ul>
                </div>
                <div>
                    <h4 class="text-lg font-semibold mb-4">Resources</h4>
                    <ul class="space-y-2">
                        <li><a href="Home.html" class="text-gray-300 hover:text-white">E-Waste Facts</a></li>
                        <li><a href="Facility.html" class="text-gray-300 hover:text-white">Recycling Process</a></li>
                        <li><a href="Resources.php" class="text-gray-300 hover:text-white">Data Security</a></li>
                        <li><a href="Contact.html" class="text-gray-300 hover:text-white">Blog</a></li>
                    </ul>
                </div>
                <div>
                    <h4 class="text-lg font-semibold mb-4">Contact</h4>
                    <ul class="space-y-2 text-gray-300">
                        <li class="flex items-start gap-2">
                            <i class="fas fa-map-marker-alt mt-1"></i>
                            <span>Tech Park, Sector V, Salt Lake, Kolkata - 700091</span>
                        </li>
                        <li class="flex items-center gap-2">
                            <i class="fas fa-phone"></i>
                            <span>1800-123-456 (Toll Free)</span>
                        </li>
                        <li class="flex items-center gap-2">
                            <i class="fas fa-envelope"></i>
                            <span>info@ecorecycleindia.org</span>
                        </li>
                    </ul>
                </div>
            </div>
            <div class="border-t border-gray-700 pt-6 text-center text-gray-400">
                <p>This initiative supports responsible e-waste management and sustainability in India.</p>
                <p class="mt-2">© 2023 EcoRecycle India. All rights reserved.</p>
            </div>
        </div>
    </footer>

    <script>
        // Mobile menu toggle
        const mobileMenuBtn = document.getElementById('mobileMenuBtn');
        const mobileMenu = document.getElementById('mobileMenu');

        mobileMenuBtn.addEventListener('click', () => {
            mobileMenu.classList.toggle('hidden');
        });

        // Pincode input validation
        const pincodeInput = document.getElementById('pincodeInput');
        if (pincodeInput) {
            pincodeInput.addEventListener('input', function() {
                this.value = this.value.replace(/[^0-9]/g, '');
                if (this.value.length > 6) {
                    this.value = this.value.slice(0, 6);
                }
            });
        }
    </script>
</body>
</html>