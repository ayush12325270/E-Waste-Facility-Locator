<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body>
<style>
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
        position: fixed;
        top: 0;
        left: 0;
        display: flex;
        align-items: center;
        gap: 0.5rem;
        padding: 0.5rem 1rem;
        background: #10b981;
        color: white;
        border-radius: 0.5rem;
        cursor: pointer;
        transition: all 0.3s ease;
        z-index: 1001;
        margin: 0.5rem;
    }

    .menu-toggle:hover {
        background: #059669;
    }

    nav {
        position: fixed;
        top: 0;
        left: 0;
        right: 0;
        background: white;
        box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
        z-index: 1000;
        padding: 0.5rem;
    }

    .nav-content {
        display: flex;
        justify-content: flex-end;
        align-items: center;
        padding-right: 1rem;
    }
</style>

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
                    Recycle
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

<nav>
    <div class="nav-content">
        <a href="Home.php" class="flex items-center gap-2">
            <i class="fas fa-recycle text-emerald-600 text-2xl"></i>
            <span class="text-xl font-bold text-emerald-600">EcoRecycle</span>
        </a>
    </div>
</nav>

<button class="menu-toggle">
    <i class="fas fa-bars"></i>
    Menu
</button>

<script>
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
</script>
</body>
</html> 