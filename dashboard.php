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
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard - ZU Tutors</title>
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
                    <?php if ($user_role === 'student'): ?>
                        <li><a href="dashboard.php" class="nav-link active"><i class="fas fa-home"></i> Dashboard</a></li>
                        <li><a href="find_tutors.php" class="nav-link"><i class="fas fa-search"></i> Find Tutors</a></li>
                        <li><a href="my_boards.php" class="nav-link"><i class="fas fa-comments"></i> My Boards</a></li>
                        <li><a href="request_help.php" class="nav-link"><i class="fas fa-hand-paper"></i> Request Help</a></li>
                    <?php elseif ($user_role === 'tutor'): ?>
                        <li><a href="dashboard.php" class="nav-link active"><i class="fas fa-home"></i> Dashboard</a></li>
                        <li><a href="my_boards.php" class="nav-link"><i class="fas fa-comments"></i> My Boards</a></li>
                        <li><a href="help_requests.php" class="nav-link"><i class="fas fa-inbox"></i> Help Requests</a></li>
                        <li><a href="tutor_profile.php" class="nav-link"><i class="fas fa-user-graduate"></i> My Profile</a></li>
                    <?php else: ?>
                        <li><a href="dashboard.php" class="nav-link active"><i class="fas fa-home"></i> Dashboard</a></li>
                        <li><a href="manage_users.php" class="nav-link"><i class="fas fa-users"></i> Manage Users</a></li>
                        <li><a href="platform_stats.php" class="nav-link"><i class="fas fa-chart-bar"></i> Statistics</a></li>
                    <?php endif; ?>
                    <li><a href="user_settings.php" class="nav-link"><i class="fas fa-cog"></i> Settings</a></li>
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
                <h1>Welcome back, <?php echo htmlspecialchars($user_name); ?>!</h1>
                <p>Here's your personalized dashboard</p>
            </header>
            
            <div class="content-body">
                <!-- Role-specific Content -->
                <?php if ($user_role === 'student'): ?>
                    <div class="role-specific-content">
                        <h2>Student Dashboard</h2>
                        
                        <div class="student-sections">
                            <div class="section-card">
                                <h3><i class="fas fa-comments"></i> Active Boards</h3>
                                <div class="board-list">
                                    <div class="board-item">
                                        <div class="board-info">
                                            <div class="board-title">Mathematics Help - Calculus</div>
                                            <div class="board-tutor">with Dr. Sarah Johnson</div>
                                            <div class="board-last-message">Last message: 2 hours ago</div>
                                        </div>
                                        <div class="board-status active">Active</div>
                                        <button class="board-enter-btn">Enter Board</button>
                                    </div>
                                    <div class="board-item">
                                        <div class="board-info">
                                            <div class="board-title">Physics Lab Questions</div>
                                            <div class="board-tutor">with Prof. Mike Chen</div>
                                            <div class="board-last-message">Last message: 1 day ago</div>
                                        </div>
                                        <div class="board-status active">Active</div>
                                        <button class="board-enter-btn">Enter Board</button>
                                    </div>
                                </div>
                                <div class="empty-state" style="display: none;">
                                    <i class="fas fa-comments"></i>
                                    <p>No active boards yet. Request help from tutors to start learning!</p>
                                </div>
                            </div>
                            
                            <div class="section-card">
                                <h3><i class="fas fa-paper-plane"></i> Pending Requests</h3>
                                <div class="request-list">
                                    <div class="request-item">
                                        <div class="request-info">
                                            <div class="request-subject">Chemistry - Organic Reactions</div>
                                            <div class="request-details">General help request</div>
                                            <div class="request-time">Submitted 3 hours ago</div>
                                        </div>
                                        <div class="request-status pending">Waiting for tutor</div>
                                    </div>
                                </div>
                                <div class="empty-state" style="display: none;">
                                    <i class="fas fa-paper-plane"></i>
                                    <p>No pending requests. Create a new help request!</p>
                                </div>
                            </div>
                            
                            <div class="quick-actions">
                                <a href="find_tutors.php" class="quick-action-btn">
                                    <i class="fas fa-search"></i>
                                    <span>Find Tutors</span>
                                </a>
                                <a href="request_help.php" class="quick-action-btn">
                                    <i class="fas fa-hand-paper"></i>
                                    <span>Request Help</span>
                                </a>
                            </div>
                        </div>
                    </div>
                    
                <?php elseif ($user_role === 'tutor'): ?>
                    <div class="role-specific-content">
                        <h2>Tutor Dashboard</h2>
                        
                        <div class="tutor-sections">
                            <div class="section-card">
                                <h3><i class="fas fa-comments"></i> Active Boards</h3>
                                <div class="board-list">
                                    <div class="board-item">
                                        <div class="board-info">
                                            <div class="board-title">Mathematics Help - Calculus</div>
                                            <div class="board-student">Student: John Doe</div>
                                            <div class="board-last-message">Last message: 30 minutes ago</div>
                                        </div>
                                        <div class="board-status active">Active</div>
                                        <button class="board-enter-btn">Enter Board</button>
                                    </div>
                                    <div class="board-item">
                                        <div class="board-info">
                                            <div class="board-title">Physics Lab Questions</div>
                                            <div class="board-student">Student: Emily Watson</div>
                                            <div class="board-last-message">Last message: 2 hours ago</div>
                                        </div>
                                        <div class="board-status active">Active</div>
                                        <button class="board-enter-btn">Enter Board</button>
                                    </div>
                                </div>
                                <div class="empty-state" style="display: none;">
                                    <i class="fas fa-comments"></i>
                                    <p>No active boards yet. Accept help requests to start tutoring!</p>
                                </div>
                            </div>
                            
                            <div class="section-card">
                                <h3><i class="fas fa-inbox"></i> Pending Help Requests</h3>
                                <div class="request-list">
                                    <div class="request-item">
                                        <div class="request-info">
                                            <div class="request-subject">Chemistry - Organic Reactions</div>
                                            <div class="request-student">Student: Sarah Wilson</div>
                                            <div class="request-details">"I need help understanding reaction mechanisms and electron flow in organic chemistry reactions."</div>
                                            <div class="request-time">Received 1 hour ago</div>
                                        </div>
                                        <div class="request-actions">
                                            <button class="accept-btn">Accept</button>
                                            <button class="decline-btn">Decline</button>
                                        </div>
                                    </div>
                                    <div class="request-item">
                                        <div class="request-info">
                                            <div class="request-subject">Mathematics - Linear Algebra</div>
                                            <div class="request-student">Student: Alex Chen</div>
                                            <div class="request-details">"Need help with matrix operations and eigenvalues for my exam next week."</div>
                                            <div class="request-time">Received 3 hours ago</div>
                                        </div>
                                        <div class="request-actions">
                                            <button class="accept-btn">Accept</button>
                                            <button class="decline-btn">Decline</button>
                                        </div>
                                    </div>
                                </div>
                                <div class="empty-state" style="display: none;">
                                    <i class="fas fa-inbox"></i>
                                    <p>No pending requests. Students will find you based on your profile!</p>
                                </div>
                            </div>
                            
                            <div class="section-card">
                                <h3><i class="fas fa-user-graduate"></i> Profile Status</h3>
                                <div class="profile-status-info">
                                    <div class="status-item">
                                        <span class="status-label">Profile Completeness</span>
                                        <div class="progress-bar">
                                            <div class="progress-fill" style="width: 85%"></div>
                                        </div>
                                        <span class="status-value">85%</span>
                                    </div>
                                    <div class="status-item">
                                        <span class="status-label">Visibility</span>
                                        <span class="status-value visible">Visible to Students</span>
                                    </div>
                                    <div class="status-item">
                                        <span class="status-label">Subjects</span>
                                        <span class="status-value">Mathematics, Physics</span>
                                    </div>
                                </div>
                                <a href="tutor_profile.php" class="update-profile-btn">Update Profile</a>
                            </div>
                        </div>
                    </div>
                    
                <?php elseif ($user_role === 'admin'): ?>
                    <div class="role-specific-content">
                        <h2>Admin Dashboard</h2>
                        
                        <div class="admin-sections">
                            <div class="section-card">
                                <h3><i class="fas fa-chart-bar"></i> Platform Statistics</h3>
                                <div class="admin-stats">
                                    <div class="admin-stat-item">
                                        <span class="stat-label">Total Users</span>
                                        <span class="stat-value">1,247</span>
                                    </div>
                                    <div class="admin-stat-item">
                                        <span class="stat-label">Active Tutors</span>
                                        <span class="stat-value">89</span>
                                    </div>
                                    <div class="admin-stat-item">
                                        <span class="stat-label">Students</span>
                                        <span class="stat-value">1,158</span>
                                    </div>
                                    <div class="admin-stat-item">
                                        <span class="stat-label">Sessions Today</span>
                                        <span class="stat-value">45</span>
                                    </div>
                                </div>
                            </div>
                            
                            <div class="section-card">
                                <h3><i class="fas fa-exclamation-triangle"></i> Recent Reports</h3>
                                <div class="report-list">
                                    <div class="report-item">
                                        <div class="report-type">User Report</div>
                                        <div class="report-description">Inappropriate behavior reported</div>
                                        <div class="report-status pending">Pending Review</div>
                                    </div>
                                    <div class="report-item">
                                        <div class="report-type">Technical Issue</div>
                                        <div class="report-description">Video chat not working</div>
                                        <div class="report-status resolved">Resolved</div>
                                    </div>
                                </div>
                            </div>
                            
                            <div class="section-card">
                                <h3><i class="fas fa-tools"></i> Quick Actions</h3>
                                <div class="admin-actions">
                                    <button class="action-btn">Manage Users</button>
                                    <button class="action-btn">View Reports</button>
                                    <button class="action-btn">System Settings</button>
                                    <button class="action-btn">Analytics</button>
                                </div>
                            </div>
                        </div>
                    </div>
                <?php endif; ?>
            </div>
        </div>
    </div>
</body>
</html>
