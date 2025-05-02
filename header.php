<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

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
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>E-Waste Management</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <style>
        .back-button {
            position: fixed;
            top: 1rem;
            left: 1rem;
            background: none;
            border: none;
            color: #9b59b6;
            font-size: 1.2rem;
            cursor: pointer;
            display: flex;
            align-items: center;
            gap: 0.5rem;
            z-index: 1000;
        }

        .back-button:hover {
            color: #8e44ad;
        }

        .small-back-button {
            position: fixed;
            top: 1rem;
            left: 1rem;
            background: #9b59b6;
            border: none;
            color: white;
            font-size: 1rem;
            cursor: pointer;
            display: flex;
            align-items: center;
            gap: 0.3rem;
            z-index: 1000;
            padding: 0.5rem 1rem;
            border-radius: 0.5rem;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
        }

        .small-back-button:hover {
            background: #8e44ad;
            transform: translateY(-1px);
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        }

        .small-back-button svg {
            width: 16px;
            height: 16px;
        }

        .logout-button {
            position: fixed;
            top: 1rem;
            right: 1rem;
            background: #9b59b6;
            color: white;
            border: none;
            padding: 0.5rem 1rem;
            border-radius: 5px;
            cursor: pointer;
            z-index: 1000;
        }

        .logout-button:hover {
            background: #8e44ad;
        }
    </style>
</head>
<body class="bg-gray-100">
    <?php if($current_page !== 'Facility.php'): ?>
    <nav class="bg-white shadow-lg">
        <div class="max-w-6xl mx-auto px-4">
            <div class="flex justify-between">
                <div class="flex space-x-7">
                    <div>
                        <a href="Home.php" class="flex items-center py-4">
                            <i class="fas fa-recycle text-green-500 text-2xl mr-2"></i>
                            <span class="font-semibold text-gray-500 text-lg">E-Waste Management</span>
                        </a>
                    </div>
                    <div class="hidden md:flex items-center space-x-1">
                        <a href="Home.php" class="py-4 px-2 text-gray-500 font-semibold hover:text-green-500 transition duration-300">Home</a>
                        <a href="Facility.php" class="py-4 px-2 text-gray-500 font-semibold hover:text-green-500 transition duration-300">Facilities</a>
                        <a href="Resources.php" class="py-4 px-2 text-gray-500 font-semibold hover:text-green-500 transition duration-300">Resources</a>
                        <a href="contact.php" class="py-4 px-2 text-gray-500 font-semibold hover:text-green-500 transition duration-300">Contact</a>
                    </div>
                </div>
                <div class="hidden md:flex items-center space-x-3">
                    <?php if(isset($_SESSION['loggedin']) && $_SESSION['loggedin'] === true): ?>
                        <a href="profile.php" class="py-2 px-2 text-gray-500 font-semibold hover:text-green-500 transition duration-300">
                            <i class="fas fa-user-circle text-xl"></i>
                        </a>
                        <a href="logout.php" class="py-2 px-2 text-gray-500 font-semibold hover:text-green-500 transition duration-300">
                            <i class="fas fa-sign-out-alt text-xl"></i>
                        </a>
                    <?php else: ?>
                        <a href="login.php" class="py-2 px-2 text-gray-500 font-semibold hover:text-green-500 transition duration-300">
                            <i class="fas fa-sign-in-alt text-xl"></i>
                        </a>
                    <?php endif; ?>
                </div>
                <div class="md:hidden flex items-center">
                    <button class="outline-none mobile-menu-button">
                        <i class="fas fa-bars text-gray-500 text-xl"></i>
                    </button>
                </div>
            </div>
        </div>
        <div class="hidden mobile-menu">
            <ul class="">
                <li><a href="Home.php" class="block text-sm px-2 py-4 text-gray-500 hover:bg-green-500 hover:text-white transition duration-300">Home</a></li>
                <li><a href="Facility.php" class="block text-sm px-2 py-4 text-gray-500 hover:bg-green-500 hover:text-white transition duration-300">Facilities</a></li>
                <li><a href="Resources.php" class="block text-sm px-2 py-4 text-gray-500 hover:bg-green-500 hover:text-white transition duration-300">Resources</a></li>
                <li><a href="contact.php" class="block text-sm px-2 py-4 text-gray-500 hover:bg-green-500 hover:text-white transition duration-300">Contact</a></li>
                <?php if(isset($_SESSION['loggedin']) && $_SESSION['loggedin'] === true): ?>
                    <li><a href="profile.php" class="block text-sm px-2 py-4 text-gray-500 hover:bg-green-500 hover:text-white transition duration-300">Profile</a></li>
                    <li><a href="logout.php" class="block text-sm px-2 py-4 text-gray-500 hover:bg-green-500 hover:text-white transition duration-300">Logout</a></li>
                <?php else: ?>
                    <li><a href="login.php" class="block text-sm px-2 py-4 text-gray-500 hover:bg-green-500 hover:text-white transition duration-300">Login</a></li>
                <?php endif; ?>
            </ul>
        </div>
    </nav>
    <?php endif; ?>

    <?php if($current_page === 'Resources.php' || $current_page === 'contact.php'): ?>
        <button class="small-back-button" onclick="window.history.back()">
            <svg width="16" height="16" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                <path d="M15 18L9 12L15 6" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
            </svg>
            Back
        </button>
    <?php endif; ?>

    <?php if($current_page !== 'Facility.php'): ?>
        <button class="logout-button" onclick="window.location.href='logout.php'">Logout</button>
    <?php endif; ?>

    <script>
        const btn = document.querySelector("button.mobile-menu-button");
        const menu = document.querySelector(".mobile-menu");
        if (btn && menu) {
            btn.addEventListener("click", () => {
                menu.classList.toggle("hidden");
            });
        }

        // Handle page refresh
        window.onload = function() {
            if (window.performance && window.performance.navigation.type === 1) {
                // Page was refreshed
                const currentPage = window.location.pathname.split('/').pop();
                if (currentPage !== 'login.php' && currentPage !== 'signup.php') {
                    // Redirect to last visited page or home if not set
                    const lastPage = '<?php echo $_SESSION['last_page'] ?? 'Home.php'; ?>';
                    window.location.href = lastPage;
                }
            }
        };
    </script>
</body>
</html> 