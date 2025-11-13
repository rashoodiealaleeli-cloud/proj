<?php
session_start();

// Check if user is logged in and is a tutor
if (!isset($_SESSION['user_email']) || $_SESSION['user_role'] !== 'tutor') {
    header('Location: login.php');
    exit;
}

$user_name = $_SESSION['user_name'];
$user_role = $_SESSION['user_role'];
$user_email = $_SESSION['user_email'];

// Sample help requests (in real app, fetch from database)
$help_requests = [
    [
        'id' => 1,
        'student_name' => 'Sarah Wilson',
        'subject' => 'Chemistry - Organic Reactions',
        'title' => 'Need help with reaction mechanisms',
        'description' => 'I\'m struggling with understanding electron flow in organic chemistry reactions, particularly SN1 and SN2 mechanisms. I have an exam next week and need to understand how to predict products.',
        'difficulty' => 'intermediate',
        'urgency' => 'high',
        'budget_min' => 20,
        'budget_max' => 30,
        'created_at' => '2 hours ago',
        'files' => ['reaction_problems.pdf'],
        'status' => 'pending'
    ],
    [
        'id' => 2,
        'student_name' => 'Alex Chen',
        'subject' => 'Mathematics - Linear Algebra',
        'title' => 'Matrix operations and eigenvalues',
        'description' => 'I need help understanding matrix operations, particularly finding eigenvalues and eigenvectors. I\'m preparing for my linear algebra final exam.',
        'difficulty' => 'advanced',
        'urgency' => 'medium',
        'budget_min' => 25,
        'budget_max' => 35,
        'created_at' => '4 hours ago',
        'files' => [],
        'status' => 'pending'
    ],
    [
        'id' => 3,
        'student_name' => 'Maria Garcia',
        'subject' => 'Physics - Thermodynamics',
        'title' => 'Heat engine efficiency calculations',
        'description' => 'I\'m having trouble with Carnot cycles and calculating efficiency of heat engines. Need help with problem-solving strategies.',
        'difficulty' => 'intermediate',
        'urgency' => 'low',
        'budget_min' => 15,
        'budget_max' => 25,
        'created_at' => '1 day ago',
        'files' => ['thermo_hw.pdf', 'cycle_diagram.jpg'],
        'status' => 'pending'
    ]
];

// Handle request actions
if ($_POST) {
    $action = $_POST['action'] ?? '';
    $request_id = $_POST['request_id'] ?? '';
    
    if ($action === 'accept') {
        $success_message = "Request accepted! A board has been created with the student.";
    } elseif ($action === 'decline') {
        $success_message = "Request declined successfully.";
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Help Requests - ZU Tutors</title>
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
                    <li><a href="my_boards.php" class="nav-link"><i class="fas fa-comments"></i> My Boards</a></li>
                    <li><a href="help_requests.php" class="nav-link active"><i class="fas fa-inbox"></i> Help Requests</a></li>
                    <li><a href="tutor_profile.php" class="nav-link"><i class="fas fa-user-graduate"></i> My Profile</a></li>
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
                <h1>Help Requests</h1>
                <p>Review and respond to student help requests</p>
            </header>
            
            <div class="content-body">
                <?php if (isset($success_message)): ?>
                    <div class="success-message">
                        <i class="fas fa-check-circle"></i> <?php echo $success_message; ?>
                    </div>
                <?php endif; ?>
                
                <!-- Filter and Sort Options -->
                <div class="requests-filters">
                    <div class="filter-group">
                        <select class="filter-select">
                            <option value="">All Subjects</option>
                            <option value="mathematics">Mathematics</option>
                            <option value="physics">Physics</option>
                            <option value="chemistry">Chemistry</option>
                        </select>
                        <select class="filter-select">
                            <option value="">All Urgency Levels</option>
                            <option value="urgent">Urgent</option>
                            <option value="high">High</option>
                            <option value="medium">Medium</option>
                            <option value="low">Low</option>
                        </select>
                        <select class="filter-select">
                            <option value="">All Difficulty Levels</option>
                            <option value="beginner">Beginner</option>
                            <option value="intermediate">Intermediate</option>
                            <option value="advanced">Advanced</option>
                        </select>
                    </div>
                    <div class="sort-group">
                        <select class="sort-select">
                            <option value="newest">Newest First</option>
                            <option value="oldest">Oldest First</option>
                            <option value="urgency">By Urgency</option>
                            <option value="budget">By Budget (High to Low)</option>
                        </select>
                    </div>
                </div>
                
                <!-- Help Requests List -->
                <div class="help-requests-list">
                    <?php if (empty($help_requests)): ?>
                        <div class="empty-state">
                            <i class="fas fa-inbox"></i>
                            <h3>No help requests available</h3>
                            <p>When students submit help requests that match your expertise, they will appear here.</p>
                        </div>
                    <?php else: ?>
                        <?php foreach ($help_requests as $request): ?>
                        <div class="help-request-card" data-subject="<?php echo strtolower($request['subject']); ?>" data-urgency="<?php echo $request['urgency']; ?>">
                            <div class="request-header">
                                <div class="request-meta">
                                    <div class="student-info">
                                        <div class="student-avatar">
                                            <i class="fas fa-user"></i>
                                        </div>
                                        <div class="student-details">
                                            <h4><?php echo htmlspecialchars($request['student_name']); ?></h4>
                                            <span class="request-time"><?php echo $request['created_at']; ?></span>
                                        </div>
                                    </div>
                                    <div class="request-badges">
                                        <span class="urgency-badge <?php echo $request['urgency']; ?>">
                                            <?php echo ucfirst($request['urgency']); ?>
                                        </span>
                                        <span class="difficulty-badge <?php echo $request['difficulty']; ?>">
                                            <?php echo ucfirst($request['difficulty']); ?>
                                        </span>
                                    </div>
                                </div>
                            </div>
                            
                            <div class="request-content">
                                <div class="request-title">
                                    <h3><?php echo htmlspecialchars($request['title']); ?></h3>
                                    <span class="subject-tag"><?php echo htmlspecialchars($request['subject']); ?></span>
                                </div>
                                
                                <div class="request-description">
                                    <p><?php echo htmlspecialchars($request['description']); ?></p>
                                </div>
                                
                                <?php if (!empty($request['files'])): ?>
                                <div class="request-files">
                                    <h5><i class="fas fa-paperclip"></i> Attached Files:</h5>
                                    <div class="file-list">
                                        <?php foreach ($request['files'] as $file): ?>
                                        <div class="file-item">
                                            <i class="fas fa-file-pdf"></i>
                                            <span><?php echo htmlspecialchars($file); ?></span>
                                            <button class="download-btn"><i class="fas fa-download"></i></button>
                                        </div>
                                        <?php endforeach; ?>
                                    </div>
                                </div>
                                <?php endif; ?>
                                
                                <div class="request-budget">
                                    <div class="budget-info">
                                        <i class="fas fa-dollar-sign"></i>
                                        <span>Budget: $<?php echo $request['budget_min']; ?> - $<?php echo $request['budget_max']; ?> per hour</span>
                                    </div>
                                </div>
                            </div>
                            
                            <div class="request-actions">
                                <button class="view-details-btn" onclick="openRequestDetails(<?php echo $request['id']; ?>)">
                                    <i class="fas fa-eye"></i> View Details
                                </button>
                                <form method="POST" style="display: inline;">
                                    <input type="hidden" name="request_id" value="<?php echo $request['id']; ?>">
                                    <input type="hidden" name="action" value="decline">
                                    <button type="submit" class="decline-request-btn">
                                        <i class="fas fa-times"></i> Decline
                                    </button>
                                </form>
                                <form method="POST" style="display: inline;">
                                    <input type="hidden" name="request_id" value="<?php echo $request['id']; ?>">
                                    <input type="hidden" name="action" value="accept">
                                    <button type="submit" class="accept-request-btn">
                                        <i class="fas fa-check"></i> Accept & Create Board
                                    </button>
                                </form>
                            </div>
                        </div>
                        <?php endforeach; ?>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </div>

    <!-- Request Details Modal -->
    <div class="modal-overlay" id="requestDetailsModal" style="display: none;">
        <div class="modal-content large">
            <div class="modal-header">
                <h3>Request Details</h3>
                <button class="close-modal" onclick="closeRequestDetails()"><i class="fas fa-times"></i></button>
            </div>
            <div class="modal-body" id="requestDetailsContent">
                <!-- Content will be populated by JavaScript -->
            </div>
            <div class="modal-footer">
                <button class="cancel-btn" onclick="closeRequestDetails()">Close</button>
                <button class="decline-request-btn">Decline Request</button>
                <button class="accept-request-btn">Accept & Create Board</button>
            </div>
        </div>
    </div>

    <script>
        // Filter functionality
        document.querySelectorAll('.filter-select').forEach(select => {
            select.addEventListener('change', filterRequests);
        });
        
        function filterRequests() {
            const subjectFilter = document.querySelector('.filter-select').value;
            const urgencyFilter = document.querySelectorAll('.filter-select')[1].value;
            const difficultyFilter = document.querySelectorAll('.filter-select')[2].value;
            
            document.querySelectorAll('.help-request-card').forEach(card => {
                const subject = card.dataset.subject;
                const urgency = card.dataset.urgency;
                const difficulty = card.querySelector('.difficulty-badge').textContent.toLowerCase();
                
                const showSubject = !subjectFilter || subject.includes(subjectFilter);
                const showUrgency = !urgencyFilter || urgency === urgencyFilter;
                const showDifficulty = !difficultyFilter || difficulty === difficultyFilter;
                
                card.style.display = showSubject && showUrgency && showDifficulty ? 'block' : 'none';
            });
        }
        
        // Request details modal
        function openRequestDetails(requestId) {
            // In a real app, fetch details via AJAX
            document.getElementById('requestDetailsModal').style.display = 'flex';
        }
        
        function closeRequestDetails() {
            document.getElementById('requestDetailsModal').style.display = 'none';
        }
        
        // Close modal when clicking outside
        document.getElementById('requestDetailsModal').addEventListener('click', function(e) {
            if (e.target === this) {
                closeRequestDetails();
            }
        });
        
        // Confirm actions
        document.querySelectorAll('.accept-request-btn').forEach(btn => {
            btn.addEventListener('click', function(e) {
                if (!confirm('Are you sure you want to accept this request? A board will be created with the student.')) {
                    e.preventDefault();
                }
            });
        });
        
        document.querySelectorAll('.decline-request-btn').forEach(btn => {
            btn.addEventListener('click', function(e) {
                if (!confirm('Are you sure you want to decline this request?')) {
                    e.preventDefault();
                }
            });
        });
    </script>
</body>
</html>