<?php
session_start();

// Check if user is logged in
if (!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] !== true) {
    header("Location: login.php");
    exit;
}

// Get the action type (facility or resource)
$action = $_POST['action'] ?? '';
$email = $_SESSION['email'];

if (!empty($action)) {
    $users_file = 'users.json';
    if (file_exists($users_file)) {
        $users_data = json_decode(file_get_contents($users_file), true);
        
        // Find and update the user's stats
        foreach ($users_data['users'] as &$user) {
            if ($user['email'] === $email) {
                switch ($action) {
                    case 'facility':
                        $user['facilities_found'] = ($user['facilities_found'] ?? 0) + 1;
                        break;
                    case 'resource':
                        $user['resources_viewed'] = ($user['resources_viewed'] ?? 0) + 1;
                        break;
                }
                
                // Save updated user data
                file_put_contents($users_file, json_encode($users_data, JSON_PRETTY_PRINT));
                echo json_encode(['success' => true]);
                exit;
            }
        }
    }
}

echo json_encode(['success' => false]);
?> 