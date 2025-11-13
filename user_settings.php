<?php
session_start();

// Check if user is logged in
if (!isset($_SESSION['user_email'])) {
    header('Location: login.php');
    exit;
}

$user_name = $_SESSION['user_name'];
$user_role = $_SESSION['user_role'];
$user_email = $_SESSION['user_email'];

// Handle settings update
if ($_POST) {
    $success_message = "Settings updated successfully!";
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Settings - ZU Tutors</title>
    <link rel="stylesheet" href="styling.css">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
</head>
<body class="dashboard-body">
    <div class="dashboard-container">
        <!-- Sidebar -->
        <div class="sidebar">
            <div class="sidebar-header">
                <h2 class="sidebar-logo">ZU Tutors</h2>
                <p class="sidebar-tagline">Connect. Learn. Succeed.</p>
            </div>
            
            <nav class="sidebar-nav">
                <ul>
                    <li><a href="dashboard.php" class="nav-link"><i class="fas fa-home"></i> Dashboard</a></li>
                    <li><a href="user_settings.php" class="nav-link active"><i class="fas fa-cog"></i> User Settings</a></li>
                    <li><a href="edit_profile.php" class="nav-link"><i class="fas fa-user-edit"></i> Edit Profile</a></li>
                </ul>
            </nav>
            
            <div class="sidebar-footer">
                <div class="user-info">
                    <div class="user-avatar">
                        <i class="fas fa-user"></i>
                    </div>
                    <div class="user-details">
                        <p class="user-name"><?php echo htmlspecialchars($user_name); ?></p>
                        <p class="user-role"><?php echo ucfirst($user_role); ?></p>
                    </div>
                </div>
                <a href="logout.php" class="logout-btn"><i class="fas fa-sign-out-alt"></i> Logout</a>
            </div>
        </div>
        
        <!-- Main Content -->
        <div class="main-content">
            <header class="content-header">
                <h1>User Settings</h1>
                <p>Manage your account preferences and settings</p>
            </header>
            
            <div class="content-body">
                <?php if (isset($success_message)): ?>
                    <div class="success-message">
                        <i class="fas fa-check-circle"></i> <?php echo $success_message; ?>
                    </div>
                <?php endif; ?>
                
                <div class="settings-container">
                    <div class="settings-section">
                        <h2><i class="fas fa-bell"></i> Notification Settings</h2>
                        <form action="" method="POST">
                            <div class="setting-group">
                                <div class="setting-item">
                                    <label class="switch">
                                        <input type="checkbox" name="email_notifications" checked>
                                        <span class="slider"></span>
                                    </label>
                                    <div class="setting-info">
                                        <h4>Email Notifications</h4>
                                        <p>Receive email notifications for important updates</p>
                                    </div>
                                </div>
                                
                                <div class="setting-item">
                                    <label class="switch">
                                        <input type="checkbox" name="push_notifications" checked>
                                        <span class="slider"></span>
                                    </label>
                                    <div class="setting-info">
                                        <h4>Push Notifications</h4>
                                        <p>Get instant notifications on your device</p>
                                    </div>
                                </div>
                                
                                <div class="setting-item">
                                    <label class="switch">
                                        <input type="checkbox" name="session_reminders">
                                        <span class="slider"></span>
                                    </label>
                                    <div class="setting-info">
                                        <h4>Session Reminders</h4>
                                        <p>Receive reminders before scheduled sessions</p>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                    
                    <div class="settings-section">
                        <h2><i class="fas fa-shield-alt"></i> Privacy Settings</h2>
                        <form action="" method="POST">
                            <div class="setting-group">
                                <div class="setting-item">
                                    <label class="switch">
                                        <input type="checkbox" name="profile_visibility" checked>
                                        <span class="slider"></span>
                                    </label>
                                    <div class="setting-info">
                                        <h4>Public Profile</h4>
                                        <p>Make your profile visible to other users</p>
                                    </div>
                                </div>
                                
                                <div class="setting-item">
                                    <label class="switch">
                                        <input type="checkbox" name="show_online_status" checked>
                                        <span class="slider"></span>
                                    </label>
                                    <div class="setting-info">
                                        <h4>Show Online Status</h4>
                                        <p>Let others see when you're online</p>
                                    </div>
                                </div>
                                
                                <div class="setting-item">
                                    <label class="switch">
                                        <input type="checkbox" name="allow_messages">
                                        <span class="slider"></span>
                                    </label>
                                    <div class="setting-info">
                                        <h4>Allow Direct Messages</h4>
                                        <p>Let other users send you direct messages</p>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                    
                    <div class="settings-section">
                        <h2><i class="fas fa-palette"></i> Appearance Settings</h2>
                        <form action="" method="POST">
                            <div class="setting-group">
                                <div class="setting-item full-width">
                                    <div class="setting-info">
                                        <h4>Theme Preference</h4>
                                        <p>Choose your preferred theme</p>
                                    </div>
                                    <select name="theme" class="setting-select">
                                        <option value="light" selected>Light Theme</option>
                                        <option value="dark">Dark Theme</option>
                                        <option value="auto">Auto (System)</option>
                                    </select>
                                </div>
                                
                                <div class="setting-item full-width">
                                    <div class="setting-info">
                                        <h4>Language</h4>
                                        <p>Select your preferred language</p>
                                    </div>
                                    <select name="language" class="setting-select">
                                        <option value="en" selected>English</option>
                                        <option value="es">Español</option>
                                        <option value="fr">Français</option>
                                        <option value="de">Deutsch</option>
                                    </select>
                                </div>
                            </div>
                        </form>
                    </div>
                    
                    <div class="settings-section">
                        <h2><i class="fas fa-lock"></i> Security Settings</h2>
                        <div class="setting-group">
                            <div class="setting-item full-width">
                                <div class="setting-info">
                                    <h4>Change Password</h4>
                                    <p>Update your account password</p>
                                </div>
                                <button class="setting-btn">Change Password</button>
                            </div>
                            
                            <div class="setting-item full-width">
                                <div class="setting-info">
                                    <h4>Two-Factor Authentication</h4>
                                    <p>Add an extra layer of security to your account</p>
                                </div>
                                <button class="setting-btn secondary">Enable 2FA</button>
                            </div>
                            
                            <div class="setting-item full-width">
                                <div class="setting-info">
                                    <h4>Active Sessions</h4>
                                    <p>Manage your active login sessions</p>
                                </div>
                                <button class="setting-btn secondary">Manage Sessions</button>
                            </div>
                        </div>
                    </div>
                    
                    <div class="settings-actions">
                        <button type="submit" class="save-settings-btn">
                            <i class="fas fa-save"></i> Save All Settings
                        </button>
                        <button type="button" class="reset-settings-btn">
                            <i class="fas fa-undo"></i> Reset to Default
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
</html>