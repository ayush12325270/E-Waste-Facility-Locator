<?php
session_start();

// Check if user is logged in
if (!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] !== true) {
    header("Location: login.php");
    exit;
}

// Device credit values (in grams of precious metals)
$device_credits = [
    'iphone_13' => ['gold' => 0.034, 'silver' => 0.34, 'copper' => 12.5],
    'samsung_s21' => ['gold' => 0.031, 'silver' => 0.32, 'copper' => 11.8],
    'macbook_pro' => ['gold' => 0.12, 'silver' => 1.2, 'copper' => 45.0],
    'ipad_pro' => ['gold' => 0.045, 'silver' => 0.45, 'copper' => 16.7],
    'default' => ['gold' => 0.025, 'silver' => 0.25, 'copper' => 9.3]
];

$success = '';
$error = '';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $device_model = trim($_POST['device_model'] ?? '');
    $device_type = trim($_POST['device_type'] ?? '');
    
    if (empty($device_model) || empty($device_type)) {
        $error = "Please fill in all fields";
    } else {
        // Calculate credits based on device type
        $device_key = strtolower(str_replace(' ', '_', $device_model));
        $credits = isset($device_credits[$device_key]) ? $device_credits[$device_key] : $device_credits['default'];
        
        // Calculate total credits (1 credit = 1g of precious metals)
        $total_credits = array_sum($credits);
        
        // Update user's credits in the database
        $users_file = 'users.json';
        $users_data = json_decode(file_get_contents($users_file), true);
        
        foreach ($users_data['users'] as &$user) {
            if ($user['email'] === $_SESSION['email']) {
                $user['credits'] = ($user['credits'] ?? 0) + $total_credits;
                $user['recycled_devices'][] = [
                    'model' => $device_model,
                    'type' => $device_type,
                    'credits_earned' => $total_credits,
                    'date' => date('Y-m-d')
                ];
                break;
            }
        }
        
        file_put_contents($users_file, json_encode($users_data, JSON_PRETTY_PRINT));
        $success = "Device submitted successfully! You earned " . number_format($total_credits, 2) . " credits.";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Recycle Device - EcoRecycle</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: 'Arial', sans-serif;
        }

        body {
            background: linear-gradient(rgba(0, 0, 0, 0.5), rgba(0, 0, 0, 0.5)), url('slider_2.jpg');
            background-size: cover;
            background-position: center;
            background-repeat: no-repeat;
            min-height: 100vh;
            padding: 2rem;
        }

        .container {
            max-width: 1200px;
            margin: 0 auto;
            padding-top: 4rem;
        }

        .recycle-container {
            background: rgba(255, 255, 255, 0.3);
            padding: 2rem;
            border-radius: 10px;
            box-shadow: 0 0 20px rgba(0, 0, 0, 0.2);
            width: 100%;
            max-width: 600px;
            margin: 0 auto;
            backdrop-filter: blur(5px);
        }

        .recycle-container h2 {
            text-align: center;
            color: #333;
            margin-bottom: 1.5rem;
            font-size: 2rem;
            font-weight: 600;
        }

        .form-group {
            margin-bottom: 1rem;
        }

        .form-group label {
            display: block;
            margin-bottom: 0.5rem;
            color: #555;
            font-weight: 500;
        }

        .form-group input,
        .form-group select {
            width: 100%;
            padding: 0.8rem;
            border: 1px solid #ddd;
            border-radius: 5px;
            font-size: 1rem;
            transition: all 0.3s ease;
        }

        .form-group input:focus,
        .form-group select:focus {
            outline: none;
            border-color: #9b59b6;
            box-shadow: 0 0 5px rgba(155, 89, 182, 0.3);
        }

        .error-message {
            color: #e74c3c;
            text-align: center;
            margin-bottom: 1rem;
            padding: 0.5rem;
            background: rgba(231, 76, 60, 0.1);
            border-radius: 5px;
        }

        .success-message {
            color: #1e40af;
            text-align: center;
            margin-bottom: 1rem;
            padding: 0.5rem;
            background: rgba(30, 64, 175, 0.10);
            border-radius: 5px;
            font-weight: bold;
        }

        .submit-btn {
            width: 100%;
            padding: 0.8rem;
            background: #9b59b6;
            color: white;
            border: none;
            border-radius: 5px;
            font-size: 1rem;
            cursor: pointer;
            transition: all 0.3s ease;
            font-weight: 500;
        }

        .submit-btn:hover {
            background: #8e44ad;
            transform: translateY(-2px);
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }

        .back-link {
            text-align: center;
            margin-top: 1.5rem;
        }

        .back-link a {
            color: #9b59b6;
            text-decoration: none;
            font-weight: 500;
            transition: color 0.3s ease;
        }

        .back-link a:hover {
            color: #8e44ad;
            text-decoration: underline;
        }

        .credits-info {
            background: rgba(255, 255, 255, 0.2);
            padding: 1rem;
            border-radius: 5px;
            margin-bottom: 1.5rem;
        }

        .credits-info h3 {
            color: #333;
            margin-bottom: 0.5rem;
        }

        .credits-info p {
            color: #555;
            font-size: 0.9rem;
        }
    </style>
</head>
<body>
    <?php include 'navigation.php'; ?>

    <div class="container mx-auto px-4 py-8">
        <div class="recycle-container">
            <h2>Recycle Your Device</h2>
            
            <div class="credits-info">
                <h3>How Credits Work</h3>
                <p>Earn credits based on the precious metals in your device. Credits can be redeemed for rewards or donations to environmental causes.</p>
                <p>1 credit = 1 gram of precious metals (gold, silver, copper)</p>
            </div>

            <?php if ($error): ?>
                <div class="error-message"><?php echo htmlspecialchars($error); ?></div>
            <?php endif; ?>

            <?php if ($success): ?>
                <div class="success-message"><?php echo htmlspecialchars($success); ?></div>
            <?php endif; ?>

            <form method="POST" action="">
                <div class="form-group">
                    <label for="device_type">Device Type</label>
                    <select id="device_type" name="device_type" required>
                        <option value="">Select Device Type</option>
                        <option value="smartphone">Smartphone</option>
                        <option value="laptop">Laptop</option>
                        <option value="tablet">Tablet</option>
                        <option value="other">Other</option>
                    </select>
                </div>
                
                <div class="form-group">
                    <label for="device_model">Device Model</label>
                    <input type="text" id="device_model" name="device_model" required 
                           placeholder="e.g., iPhone 13, Samsung S21, MacBook Pro">
                </div>

                <button type="submit" class="submit-btn">Submit Device</button>
            </form>

            <div class="back-link">
                <a href="profile.php">Back to Profile</a>
            </div>
        </div>
    </div>
</body>
</html> 