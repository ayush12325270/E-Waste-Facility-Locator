<?php
session_start();

// Check if user is logged in
if (!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] !== true) {
    header("Location: login.php");
    exit;
}

$email = $_SESSION['email'];
$name = $_SESSION['name'];

// Load user data from JSON file
$users_file = 'users.json';
$user_data = null;

if (file_exists($users_file)) {
    $users_data = json_decode(file_get_contents($users_file), true);
    foreach ($users_data['users'] as $user) {
        if ($user['email'] === $email) {
            $user_data = $user;
            break;
        }
    }
}

// If user data not found, redirect to login
if (!$user_data) {
    header("Location: login.php");
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Profile Dashboard</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: 'Arial', sans-serif;
        }

        body {
            background: #f5f5f5;
            min-height: 100vh;
        }

        .dashboard-container {
            max-width: 1200px;
            margin: 0 auto;
            padding: 2rem;
        }

        .header {
            background: white;
            padding: 1rem 2rem;
            box-shadow: 0 2px 4px rgba(0,0,0,0.1);
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 2rem;
        }

        .logo {
            font-size: 1.5rem;
            font-weight: bold;
            color: #9b59b6;
        }

        .nav-links a {
            margin-left: 1rem;
            text-decoration: none;
            color: #333;
        }

        .nav-links a:hover {
            color: #9b59b6;
        }

        .profile-card {
            background: white;
            border-radius: 10px;
            padding: 2rem;
            box-shadow: 0 2px 4px rgba(0,0,0,0.1);
            margin-bottom: 2rem;
        }

        .profile-header {
            display: flex;
            align-items: center;
            margin-bottom: 2rem;
        }

        .profile-avatar {
            width: 80px;
            height: 80px;
            background: #9b59b6;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
            font-size: 2rem;
            margin-right: 1.5rem;
        }

        .profile-info h2 {
            color: #333;
            margin-bottom: 0.5rem;
        }

        .profile-info p {
            color: #666;
        }

        .stats-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
            gap: 1.5rem;
            margin-top: 2rem;
        }

        .stat-card {
            background: #f8f9fa;
            padding: 1.5rem;
            border-radius: 8px;
            text-align: center;
        }

        .stat-card h3 {
            color: #9b59b6;
            margin-bottom: 0.5rem;
        }

        .stat-card p {
            color: #666;
            font-size: 1.5rem;
            font-weight: bold;
        }

        .logout-btn {
            background: #e74c3c;
            color: white;
            padding: 0.5rem 1rem;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            text-decoration: none;
        }

        .logout-btn:hover {
            background: #c0392b;
        }

        .join-date {
            color: #666;
            font-size: 0.9rem;
            margin-top: 0.5rem;
        }

        .recycled-devices {
            background: rgba(255, 255, 255, 0.1);
            padding: 1.5rem;
            border-radius: 10px;
            margin-top: 2rem;
        }

        .recycled-devices h3 {
            color: #333;
            margin-bottom: 1rem;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 1rem;
        }

        th, td {
            padding: 0.8rem;
            text-align: left;
            border-bottom: 1px solid rgba(0, 0, 0, 0.1);
        }

        th {
            background: rgba(0, 0, 0, 0.05);
            font-weight: 600;
        }

        tr:hover {
            background: rgba(0, 0, 0, 0.02);
        }
    </style>
</head>
<body>
    <?php include 'navigation.php'; ?>

    <div class="dashboard-container">
        <div class="profile-card">
            <div class="profile-header">
                <div class="profile-avatar">
                    <?php echo strtoupper(substr($name, 0, 1)); ?>
                </div>
                <div class="profile-info">
                    <h2>Welcome, <?php echo htmlspecialchars($name); ?></h2>
                    <p><?php echo htmlspecialchars($email); ?></p>
                    <p class="join-date">Member since <?php echo date('F j, Y', strtotime($user_data['join_date'])); ?></p>
                </div>
            </div>

            <div class="stats-grid">
                <div class="stat-card">
                    <h3>Total Visits</h3>
                    <p><?php echo $user_data['visits']; ?></p>
                </div>
                <div class="stat-card">
                    <h3>Facilities Found</h3>
                    <p><?php echo $user_data['facilities_found']; ?></p>
                </div>
                <div class="stat-card">
                    <h3>Resources Viewed</h3>
                    <p><?php echo $user_data['resources_viewed']; ?></p>
                </div>
            </div>

            <div class="profile-stats">
                <div class="stat-item">
                    <h3>Total Credits</h3>
                    <p><?php echo number_format($user_data['credits'] ?? 0, 2); ?></p>
                </div>
                <div class="stat-item">
                    <h3>Recycled Devices</h3>
                    <p><?php echo count($user_data['recycled_devices'] ?? []); ?></p>
                </div>
                <div class="stat-item">
                    <h3>Join Date</h3>
                    <p><?php echo $user_data['join_date']; ?></p>
                </div>
            </div>

            <div class="recycled-devices">
                <h3>Your Recycled Devices</h3>
                <?php if (!empty($user_data['recycled_devices'])): ?>
                    <table>
                        <thead>
                            <tr>
                                <th>Date</th>
                                <th>Device Type</th>
                                <th>Model</th>
                                <th>Credits Earned</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach (array_reverse($user_data['recycled_devices']) as $device): ?>
                                <tr>
                                    <td><?php echo $device['date']; ?></td>
                                    <td><?php echo ucfirst($device['type']); ?></td>
                                    <td><?php echo $device['model']; ?></td>
                                    <td><?php echo number_format($device['credits_earned'], 2); ?></td>
                                </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                <?php else: ?>
                    <p>No devices recycled yet. <a href="device_recycle.php">Recycle your first device</a> to earn credits!</p>
                <?php endif; ?>
            </div>
        </div>
    </div>
</body>
</html> 