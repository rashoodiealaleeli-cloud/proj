<?php
session_start();

// Check if user is logged in and is a student
if (!isset($_SESSION['user_email']) || $_SESSION['user_role'] !== 'student') {
    header('Location: login.php');
    exit;
}

$user_name = $_SESSION['user_name'];
$user_role = $_SESSION['user_role'];
$user_email = $_SESSION['user_email'];

// Sample tutors data (in real app, fetch from database)
$tutors = [
    [
        'id' => 1,
        'name' => 'Dr. Sarah Johnson',
        'subjects' => ['Mathematics', 'Statistics'],
        'rating' => 4.9,
        'hourly_rate' => 25,
        'experience' => '5+ years',
        'bio' => 'PhD in Mathematics with extensive tutoring experience. Specializes in calculus and linear algebra.',
        'available' => true
    ],
    [
        'id' => 2,
        'name' => 'Prof. Mike Chen',
        'subjects' => ['Physics', 'Engineering'],
        'rating' => 4.8,
        'hourly_rate' => 30,
        'experience' => '8+ years',
        'bio' => 'Professor of Physics with expertise in quantum mechanics and thermodynamics.',
        'available' => true
    ],
    [
        'id' => 3,
        'name' => 'Dr. Emma Wilson',
        'subjects' => ['Chemistry', 'Biochemistry'],
        'rating' => 4.7,
        'hourly_rate' => 28,
        'experience' => '6+ years',
        'bio' => 'Chemistry researcher specializing in organic chemistry and biochemical processes.',
        'available' => false
    ]
];
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Find Tutors - ZU Tutors</title>
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
                    <li><a href="find_tutors.php" class="nav-link active"><i class="fas fa-search"></i> Find Tutors</a></li>
                    <li><a href="my_boards.php" class="nav-link"><i class="fas fa-comments"></i> My Boards</a></li>
                    <li><a href="request_help.php" class="nav-link"><i class="fas fa-hand-paper"></i> Request Help</a></li>
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
                <h1>Find Tutors</h1>
                <p>Browse and connect with qualified tutors</p>
            </header>
            
            <div class="content-body">
                <!-- Search and Filters -->
                <div class="search-section">
                    <div class="search-bar">
                        <i class="fas fa-search"></i>
                        <input type="text" placeholder="Search by subject, tutor name, or keyword..." />
                    </div>
                    <div class="filter-options">
                        <select class="filter-select">
                            <option value="">All Subjects</option>
                            <option value="mathematics">Mathematics</option>
                            <option value="physics">Physics</option>
                            <option value="chemistry">Chemistry</option>
                            <option value="engineering">Engineering</option>
                        </select>
                        <select class="filter-select">
                            <option value="">Price Range</option>
                            <option value="0-20">$0 - $20/hour</option>
                            <option value="20-30">$20 - $30/hour</option>
                            <option value="30+">$30+/hour</option>
                        </select>
                        <select class="filter-select">
                            <option value="">Availability</option>
                            <option value="available">Available Now</option>
                            <option value="all">All Tutors</option>
                        </select>
                    </div>
                </div>
                
                <!-- Tutors Grid -->
                <div class="tutors-grid">
                    <?php foreach ($tutors as $tutor): ?>
                    <div class="tutor-card <?php echo !$tutor['available'] ? 'unavailable' : ''; ?>">
                        <div class="tutor-header">
                            <div class="tutor-avatar-large">
                                <i class="fas fa-user-graduate"></i>
                            </div>
                            <div class="tutor-basic-info">
                                <h3><?php echo htmlspecialchars($tutor['name']); ?></h3>
                                <div class="tutor-rating">
                                    <div class="stars">
                                        <?php for ($i = 1; $i <= 5; $i++): ?>
                                            <i class="fas fa-star <?php echo $i <= floor($tutor['rating']) ? 'filled' : ''; ?>"></i>
                                        <?php endfor; ?>
                                    </div>
                                    <span class="rating-value"><?php echo $tutor['rating']; ?></span>
                                </div>
                                <div class="tutor-experience"><?php echo htmlspecialchars($tutor['experience']); ?> experience</div>
                            </div>
                            <div class="tutor-status">
                                <?php if ($tutor['available']): ?>
                                    <span class="status-badge available">Available</span>
                                <?php else: ?>
                                    <span class="status-badge busy">Busy</span>
                                <?php endif; ?>
                            </div>
                        </div>
                        
                        <div class="tutor-subjects">
                            <?php foreach ($tutor['subjects'] as $subject): ?>
                                <span class="subject-tag"><?php echo htmlspecialchars($subject); ?></span>
                            <?php endforeach; ?>
                        </div>
                        
                        <div class="tutor-bio">
                            <p><?php echo htmlspecialchars($tutor['bio']); ?></p>
                        </div>
                        
                        <div class="tutor-footer">
                            <div class="tutor-rate">
                                <span class="rate-amount">$<?php echo $tutor['hourly_rate']; ?></span>
                                <span class="rate-period">/hour</span>
                            </div>
                            <div class="tutor-actions">
                                <?php if ($tutor['available']): ?>
                                    <button class="request-tutor-btn" data-tutor-id="<?php echo $tutor['id']; ?>" data-tutor-name="<?php echo htmlspecialchars($tutor['name']); ?>">
                                        <i class="fas fa-paper-plane"></i> Request Help
                                    </button>
                                <?php else: ?>
                                    <button class="request-tutor-btn" disabled>
                                        <i class="fas fa-clock"></i> Currently Busy
                                    </button>
                                <?php endif; ?>
                            </div>
                        </div>
                    </div>
                    <?php endforeach; ?>
                </div>
            </div>
        </div>
    </div>

    <!-- Request Modal -->
    <div class="modal-overlay" id="requestModal" style="display: none;">
        <div class="modal-content">
            <div class="modal-header">
                <h3>Request Help from <span id="tutorName"></span></h3>
                <button class="close-modal" onclick="closeModal()"><i class="fas fa-times"></i></button>
            </div>
            <div class="modal-body">
                <form id="requestForm">
                    <div class="form-group">
                        <label for="subject">Subject</label>
                        <input type="text" id="subject" name="subject" placeholder="e.g., Calculus, Organic Chemistry" required>
                    </div>
                    <div class="form-group">
                        <label for="description">Description</label>
                        <textarea id="description" name="description" rows="4" placeholder="Describe what you need help with..." required></textarea>
                    </div>
                    <div class="form-group">
                        <label for="urgency">Urgency</label>
                        <select id="urgency" name="urgency" required>
                            <option value="">Select urgency level</option>
                            <option value="low">Low - Within a week</option>
                            <option value="medium">Medium - Within 3 days</option>
                            <option value="high">High - Today or tomorrow</option>
                        </select>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="cancel-btn" onclick="closeModal()">Cancel</button>
                <button type="submit" form="requestForm" class="submit-request-btn">Send Request</button>
            </div>
        </div>
    </div>

    <script>
        function openModal(tutorId, tutorName) {
            document.getElementById('tutorName').textContent = tutorName;
            document.getElementById('requestModal').style.display = 'flex';
        }

        function closeModal() {
            document.getElementById('requestModal').style.display = 'none';
        }

        // Add event listeners to request buttons
        document.querySelectorAll('.request-tutor-btn:not([disabled])').forEach(button => {
            button.addEventListener('click', function() {
                const tutorId = this.dataset.tutorId;
                const tutorName = this.dataset.tutorName;
                openModal(tutorId, tutorName);
            });
        });

        // Handle form submission
        document.getElementById('requestForm').addEventListener('submit', function(e) {
            e.preventDefault();
            // Here you would normally send the request to the server
            alert('Help request sent successfully!');
            closeModal();
        });

        // Close modal when clicking outside
        document.getElementById('requestModal').addEventListener('click', function(e) {
            if (e.target === this) {
                closeModal();
            }
        });
    </script>
</body>
</html>