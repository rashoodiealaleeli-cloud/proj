<?php
session_start();

// Simple user authentication (in real app, use database)
$users = [
    'student@example.com' => ['password' => 'password123', 'role' => 'student', 'name' => 'John Doe'],
    'tutor@example.com' => ['password' => 'password123', 'role' => 'tutor', 'name' => 'Jane Smith'],
    'admin@example.com' => ['password' => 'password123', 'role' => 'admin', 'name' => 'Admin User']
];

if ($_POST) {
    $email = $_POST['email'] ?? '';
    $password = $_POST['password'] ?? '';
    
    if (isset($users[$email]) && $users[$email]['password'] === $password) {
        $_SESSION['user_email'] = $email;
        $_SESSION['user_role'] = $users[$email]['role'];
        $_SESSION['user_name'] = $users[$email]['name'];
        header('Location: dashboard.php');
        exit;
    } else {
        $error = 'Invalid email or password';
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - ZU Tutors</title>
    <link rel="stylesheet" href="styling.css">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
</head>
<body>
    <div class="login-container">
        <div class="login-card">
            <div class="logo-section">
                <h1 class="logo">ZU Tutors</h1>
                <p class="tagline">Connect. Learn. Succeed.</p>
            </div>
            
            <div class="login-form-section">
                <h2 class="form-title">Welcome Back</h2>
                <p class="form-subtitle">Sign in to your account</p>
                
                <?php if (isset($error)): ?>
                    <div class="error-message">
                        <?php echo htmlspecialchars($error); ?>
                    </div>
                <?php endif; ?>
                
                <div class="demo-credentials">
                    <h4>Demo Credentials:</h4>
                    <p><strong>Student:</strong> student@example.com / password123</p>
                    <p><strong>Tutor:</strong> tutor@example.com / password123</p>
                    <p><strong>Admin:</strong> admin@example.com / password123</p>
                </div>
                
                <form class="login-form" action="" method="POST">
                    <div class="form-group">
                        <label for="email">Email Address</label>
                        <input type="email" id="email" name="email" placeholder="Enter your email" required>
                    </div>
                    
                    <div class="form-group">
                        <label for="password">Password</label>
                        <input type="password" id="password" name="password" placeholder="Enter your password" required>
                    </div>
                    
                    <div class="form-options">
                        <div class="remember-me">
                            <input type="checkbox" id="remember" name="remember">
                            <label for="remember">Remember me</label>
                        </div>
                        <a href="#" class="forgot-password">Forgot password?</a>
                    </div>
                    
                    <button type="submit" class="login-btn">Sign In</button>
                </form>
                
                <div class="signup-link">
                    <p>Don't have an account? <a href="#" class="signup-btn">Sign up here</a></p>
                </div>
                
                <div class="user-type-info">
                    <div class="info-card">
                        <h4>For Students</h4>
                        <p>Find expert tutors and boost your academic performance</p>
                    </div>
                    <div class="info-card">
                        <h4>For Tutors</h4>
                        <p>Share your knowledge and earn while teaching</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
</html>