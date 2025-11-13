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

// Handle form submission
if ($_POST) {
    $success_message = "Help request submitted successfully! Tutors will be notified and can accept your request.";
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Request Help - ZU Tutors</title>
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
                    <li><a href="find_tutors.php" class="nav-link"><i class="fas fa-search"></i> Find Tutors</a></li>
                    <li><a href="my_boards.php" class="nav-link"><i class="fas fa-comments"></i> My Boards</a></li>
                    <li><a href="request_help.php" class="nav-link active"><i class="fas fa-hand-paper"></i> Request Help</a></li>
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
                <h1>Request Help</h1>
                <p>Submit a general help request and let qualified tutors come to you</p>
            </header>
            
            <div class="content-body">
                <?php if (isset($success_message)): ?>
                    <div class="success-message">
                        <i class="fas fa-check-circle"></i> <?php echo $success_message; ?>
                    </div>
                <?php endif; ?>
                
                <div class="request-help-container">
                    <div class="help-info-section">
                        <div class="info-card">
                            <div class="info-icon">
                                <i class="fas fa-lightbulb"></i>
                            </div>
                            <div class="info-content">
                                <h3>How it works</h3>
                                <ol>
                                    <li>Submit your help request with detailed information</li>
                                    <li>Qualified tutors will see your request</li>
                                    <li>When a tutor accepts, a board will be created</li>
                                    <li>Start learning in your private board!</li>
                                </ol>
                            </div>
                        </div>
                        
                        <div class="tips-card">
                            <h4><i class="fas fa-tips"></i> Tips for better responses</h4>
                            <ul>
                                <li>Be specific about your learning goals</li>
                                <li>Mention your current level of understanding</li>
                                <li>Include any deadlines or urgency</li>
                                <li>Attach relevant materials if possible</li>
                            </ul>
                        </div>
                    </div>
                    
                    <div class="request-form-section">
                        <form action="" method="POST" class="help-request-form" enctype="multipart/form-data">
                            <div class="form-section">
                                <h3><i class="fas fa-info-circle"></i> Request Details</h3>
                                
                                <div class="form-group">
                                    <label for="subject">Subject/Topic</label>
                                    <input type="text" id="subject" name="subject" placeholder="e.g., Calculus, Organic Chemistry, Linear Algebra" required>
                                </div>
                                
                                <div class="form-group">
                                    <label for="title">Request Title</label>
                                    <input type="text" id="title" name="title" placeholder="Brief title describing what you need help with" required>
                                </div>
                                
                                <div class="form-group">
                                    <label for="description">Detailed Description</label>
                                    <textarea id="description" name="description" rows="5" placeholder="Describe in detail what you need help with, your current understanding level, specific problems you're facing, etc." required></textarea>
                                </div>
                                
                                <div class="form-row">
                                    <div class="form-group">
                                        <label for="difficulty">Difficulty Level</label>
                                        <select id="difficulty" name="difficulty" required>
                                            <option value="">Select difficulty</option>
                                            <option value="beginner">Beginner</option>
                                            <option value="intermediate">Intermediate</option>
                                            <option value="advanced">Advanced</option>
                                        </select>
                                    </div>
                                    
                                    <div class="form-group">
                                        <label for="urgency">Urgency</label>
                                        <select id="urgency" name="urgency" required>
                                            <option value="">Select urgency</option>
                                            <option value="low">Low - Within a week</option>
                                            <option value="medium">Medium - Within 3 days</option>
                                            <option value="high">High - Today or tomorrow</option>
                                            <option value="urgent">Urgent - ASAP</option>
                                        </select>
                                    </div>
                                </div>
                                
                                <div class="form-group">
                                    <label for="preferred_time">Preferred Time</label>
                                    <input type="text" id="preferred_time" name="preferred_time" placeholder="e.g., Weekday evenings, Weekend mornings, Anytime">
                                </div>
                            </div>
                            
                            <div class="form-section">
                                <h3><i class="fas fa-paperclip"></i> Additional Information</h3>
                                
                                <div class="form-group">
                                    <label for="learning_goals">Learning Goals</label>
                                    <textarea id="learning_goals" name="learning_goals" rows="3" placeholder="What do you hope to achieve? Any specific exam or assignment deadlines?"></textarea>
                                </div>
                                
                                <div class="form-group">
                                    <label for="previous_attempts">Previous Attempts</label>
                                    <textarea id="previous_attempts" name="previous_attempts" rows="3" placeholder="Have you tried learning this before? What resources have you used?"></textarea>
                                </div>
                                
                                <div class="form-group">
                                    <label for="files">Attach Files (Optional)</label>
                                    <div class="file-upload-area">
                                        <input type="file" id="files" name="files[]" multiple accept=".pdf,.doc,.docx,.jpg,.jpeg,.png">
                                        <div class="file-upload-text">
                                            <i class="fas fa-cloud-upload-alt"></i>
                                            <p>Click to upload or drag and drop</p>
                                            <span>PDF, DOC, Images (Max 10MB per file)</span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            
                            <div class="form-section">
                                <h3><i class="fas fa-dollar-sign"></i> Budget & Preferences</h3>
                                
                                <div class="form-row">
                                    <div class="form-group">
                                        <label for="budget_min">Budget Range (per hour)</label>
                                        <div class="budget-range">
                                            <input type="number" id="budget_min" name="budget_min" placeholder="Min" min="5" max="100">
                                            <span>to</span>
                                            <input type="number" id="budget_max" name="budget_max" placeholder="Max" min="5" max="100">
                                        </div>
                                    </div>
                                    
                                    <div class="form-group">
                                        <label for="session_type">Preferred Session Type</label>
                                        <select id="session_type" name="session_type">
                                            <option value="">No preference</option>
                                            <option value="video">Video Call</option>
                                            <option value="chat">Text Chat Only</option>
                                            <option value="screen_share">Screen Sharing</option>
                                        </select>
                                    </div>
                                </div>
                                
                                <div class="form-group">
                                    <label for="tutor_preferences">Tutor Preferences</label>
                                    <textarea id="tutor_preferences" name="tutor_preferences" rows="2" placeholder="Any specific requirements for your tutor? (e.g., experience level, teaching style, language)"></textarea>
                                </div>
                            </div>
                            
                            <div class="form-actions">
                                <button type="submit" class="submit-request-btn">
                                    <i class="fas fa-paper-plane"></i> Submit Help Request
                                </button>
                                <button type="button" class="preview-btn">
                                    <i class="fas fa-eye"></i> Preview Request
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        // File upload handling
        const fileInput = document.getElementById('files');
        const fileUploadArea = document.querySelector('.file-upload-area');
        
        fileUploadArea.addEventListener('click', () => fileInput.click());
        
        fileUploadArea.addEventListener('dragover', (e) => {
            e.preventDefault();
            fileUploadArea.classList.add('dragover');
        });
        
        fileUploadArea.addEventListener('dragleave', () => {
            fileUploadArea.classList.remove('dragover');
        });
        
        fileUploadArea.addEventListener('drop', (e) => {
            e.preventDefault();
            fileUploadArea.classList.remove('dragover');
            fileInput.files = e.dataTransfer.files;
            updateFileDisplay();
        });
        
        fileInput.addEventListener('change', updateFileDisplay);
        
        function updateFileDisplay() {
            const files = fileInput.files;
            const fileText = document.querySelector('.file-upload-text p');
            
            if (files.length > 0) {
                fileText.textContent = `${files.length} file(s) selected`;
            } else {
                fileText.textContent = 'Click to upload or drag and drop';
            }
        }
        
        // Budget range validation
        const budgetMin = document.getElementById('budget_min');
        const budgetMax = document.getElementById('budget_max');
        
        budgetMin.addEventListener('change', () => {
            if (budgetMax.value && parseInt(budgetMin.value) > parseInt(budgetMax.value)) {
                budgetMax.value = budgetMin.value;
            }
        });
        
        budgetMax.addEventListener('change', () => {
            if (budgetMin.value && parseInt(budgetMax.value) < parseInt(budgetMin.value)) {
                budgetMin.value = budgetMax.value;
            }
        });
    </script>
</body>
</html>