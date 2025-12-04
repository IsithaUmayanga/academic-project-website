<?php 
require_once 'config.php';

// Redirect to login if not logged in
if (!isLoggedIn()) {
    $_SESSION['redirect_url'] = 'job-details.php' . (isset($_GET['id']) ? '?id=' . $_GET['id'] : '');
    redirect('login.php');
}

// Get job details
$job_id = isset($_GET['id']) ? (int)$_GET['id'] : 0;
$stmt = $pdo->prepare("SELECT * FROM jobs WHERE id = ?");
$stmt->execute([$job_id]);
$job = $stmt->fetch();

if (!$job) {
    die("Job not found");
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo htmlspecialchars($job['title']); ?> - JobPortal</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }
        
        body {
            background-color: #f8f9fa;
            line-height: 1.6;
            color: #333;
            min-height: 100vh;
            display: flex;
            flex-direction: column;
        }
        
        .header {
            background: linear-gradient(135deg, #2c3e50, #3498db);
            color: white;
            padding: 1rem 2rem;
            display: flex;
            justify-content: space-between;
            align-items: center;
            box-shadow: 0 2px 10px rgba(0,0,0,0.1);
        }
        
        .logo {
            font-size: 1.8rem;
            font-weight: bold;
            display: flex;
            align-items: center;
        }
        
        .logo i {
            margin-right: 10px;
            font-size: 1.5rem;
        }
        
        .nav {
            display: flex;
            gap: 1.5rem;
        }
        
        .nav a {
            color: white;
            text-decoration: none;
            padding: 0.5rem 1rem;
            border-radius: 4px;
            transition: all 0.3s ease;
        }
        
        .nav a:hover, .nav a.active {
            background: rgba(255,255,255,0.2);
        }
        
        .auth-buttons {
            display: flex;
            gap: 1rem;
            align-items: center;
        }
        
        .btn {
            padding: 0.75rem 1.5rem;
            text-decoration: none;
            border-radius: 4px;
            display: inline-block;
            font-weight: 500;
            transition: all 0.3s ease;
            border: none;
            cursor: pointer;
            font-size: 1rem;
        }
        
        .btn-outline {
            border: 1px solid #3498db;
            color: #3498db;
            background: white;
        }
        
        .btn-outline:hover {
            background: #3498db;
            color: white;
        }
        
        .btn-primary {
            background: #e74c3c;
            color: white;
        }
        
        .btn-primary:hover {
            background: #c0392b;
            transform: translateY(-2px);
        }
        
        .container {
            max-width: 1200px;
            margin: 0 auto;
            padding: 2rem;
            flex: 1;
        }
        
        .page-title {
            text-align: center;
            margin: 2rem 0;
            color: #2c3e50;
            font-size: 2.5rem;
        }
        
        .job-details {
            background: white;
            border-radius: 10px;
            box-shadow: 0 10px 30px rgba(0,0,0,0.1);
            padding: 2.5rem;
            margin-bottom: 2rem;
        }
        
        .job-header {
            border-bottom: 2px solid #f1f1f1;
            padding-bottom: 1.5rem;
            margin-bottom: 2rem;
        }
        
        .job-title {
            color: #2c3e50;
            font-size: 2rem;
            margin-bottom: 0.5rem;
        }
        
        .job-company {
            color: #3498db;
            font-size: 1.5rem;
            margin-bottom: 1rem;
            font-weight: 600;
        }
        
        .job-meta {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
            gap: 1rem;
            margin: 1.5rem 0;
        }
        
        .meta-item {
            display: flex;
            align-items: center;
            gap: 0.5rem;
        }
        
        .meta-icon {
            font-size: 1.2rem;
            color: #3498db;
        }
        
        .meta-label {
            font-weight: 500;
            color: #2c3e50;
        }
        
        .meta-value {
            color: #555;
        }
        
        .job-section {
            margin-bottom: 2rem;
        }
        
        .job-section h3 {
            color: #2c3e50;
            margin-bottom: 1rem;
            font-size: 1.5rem;
            border-bottom: 1px solid #f1f1f1;
            padding-bottom: 0.5rem;
        }
        
        .job-description {
            line-height: 1.8;
            color: #555;
        }
        
        .application-info {
            background: #f8f9fa;
            padding: 1.5rem;
            border-radius: 8px;
            margin: 1.5rem 0;
        }
        
        .application-info h4 {
            color: #2c3e50;
            margin-bottom: 1rem;
            font-size: 1.3rem;
        }
        
        .contact-details {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
            gap: 1rem;
            margin-top: 1rem;
        }
        
        .contact-item {
            display: flex;
            align-items: center;
            gap: 0.5rem;
        }
        
        .contact-icon {
            font-size: 1.2rem;
            color: #3498db;
        }
        
        .contact-link {
            color: #3498db;
            text-decoration: none;
            font-weight: 500;
        }
        
        .contact-link:hover {
            text-decoration: underline;
        }
        
        .action-buttons {
            display: flex;
            gap: 1rem;
            margin-top: 2rem;
            flex-wrap: wrap;
        }
        
        .footer {
            background: #2c3e50;
            color: white;
            text-align: center;
            padding: 2rem;
            margin-top: auto;
        }
        
        .social-links {
            display: flex;
            justify-content: center;
            gap: 1rem;
            margin: 1rem 0;
        }
        
        .social-links a {
            color: white;
            font-size: 1.5rem;
            transition: color 0.3s ease;
        }
        
        .social-links a:hover {
            color: #3498db;
        }
        
        .footer-links {
            display: flex;
            justify-content: center;
            gap: 2rem;
            margin: 1rem 0;
        }
        
        .footer-links a {
            color: #bdc3c7;
            text-decoration: none;
            transition: color 0.3s ease;
        }
        
        .footer-links a:hover {
            color: white;
        }
        
        @media (max-width: 768px) {
            .header {
                flex-direction: column;
                padding: 1rem;
            }
            
            .nav {
                margin: 1rem 0;
                flex-wrap: wrap;
                justify-content: center;
            }
            
            .auth-buttons {
                margin-top: 1rem;
            }
            
            .job-title {
                font-size: 1.7rem;
            }
            
            .job-company {
                font-size: 1.3rem;
            }
            
            .job-meta {
                grid-template-columns: 1fr;
            }
            
            .action-buttons {
                flex-direction: column;
            }
            
            .action-buttons .btn {
                text-align: center;
            }
            
            .footer-links {
                flex-direction: column;
                gap: 1rem;
            }
        }
    </style>
</head>
<body>
    <header class="header">
        <div class="logo">
            <i>💼</i> JobPortal
        </div>
        <nav class="nav">
            <a href="index.php">Home</a>
            <a href="jobs.php">Jobs</a>
            <a href="companies.php">Companies</a>
            <a href="about.php">About</a>
            <a href="contact.php">Contact</a>
        </nav>
        <div class="auth-buttons">
            <span style="color: white;">Welcome, <?php echo $_SESSION['user_name']; ?></span>
            <a href="dashboard.php" class="btn btn-outline">Dashboard</a>
            <a href="logout.php" class="btn btn-primary">Logout</a>
        </div>
    </header>

    <div class="container">
        <div class="job-details">
            <div class="job-header">
                <h1 class="job-title"><?php echo htmlspecialchars($job['title']); ?></h1>
                <div class="job-company"><?php echo htmlspecialchars($job['company_name']); ?></div>
                
                <div class="job-meta">
                    <div class="meta-item">
                        <span class="meta-icon">📍</span>
                        <div>
                            <div class="meta-label">Location</div>
                            <div class="meta-value"><?php echo htmlspecialchars($job['location']); ?></div>
                        </div>
                    </div>
                    
                    <div class="meta-item">
                        <span class="meta-icon">💰</span>
                        <div>
                            <div class="meta-label">Salary</div>
                            <div class="meta-value"><?php echo htmlspecialchars($job['salary']); ?></div>
                        </div>
                    </div>
                    
                    <div class="meta-item">
                        <span class="meta-icon">⏱️</span>
                        <div>
                            <div class="meta-label">Job Type</div>
                            <div class="meta-value"><?php echo htmlspecialchars($job['job_type']); ?></div>
                        </div>
                    </div>
                    
                    <div class="meta-item">
                        <span class="meta-icon">📅</span>
                        <div>
                            <div class="meta-label">Posted</div>
                            <div class="meta-value"><?php echo date('M j, Y', strtotime($job['created_at'])); ?></div>
                        </div>
                    </div>
                </div>
            </div>
            
            <div class="job-section">
                <h3>Job Description</h3>
                <div class="job-description">
                    <?php echo nl2br(htmlspecialchars($job['description'])); ?>
                </div>
            </div>
            
            <div class="application-info">
                <h4>How to Apply</h4>
                <p>Contact the company directly using the information below:</p>
                
                <div class="contact-details">
                    <div class="contact-item">
                        <span class="contact-icon">🌐</span>
                        <div>
                            <div class="meta-label">Company Website</div>
                            <a href="<?php echo htmlspecialchars($job['company_website']); ?>" target="_blank" class="contact-link"><?php echo htmlspecialchars($job['company_website']); ?></a>
                        </div>
                    </div>
                    
                    <div class="contact-item">
                        <span class="contact-icon">📧</span>
                        <div>
                            <div class="meta-label">Contact Email</div>
                            <a href="mailto:<?php echo htmlspecialchars($job['contact_email']); ?>" class="contact-link"><?php echo htmlspecialchars($job['contact_email']); ?></a>
                        </div>
                    </div>
                </div>
            </div>
            
            <div class="action-buttons">
                <a href="<?php echo htmlspecialchars($job['company_website']); ?>" target="_blank" class="btn btn-primary">Visit Company Website</a>
                <a href="mailto:<?php echo htmlspecialchars($job['contact_email']); ?>" class="btn btn-primary">Send Email Application</a>
                <a href="jobs.php" class="btn btn-outline">Back to Jobs</a>
            </div>
        </div>
    </div>

   <footer class="footer">
    <div class="social-links">
      <a href="https://web.facebook.com/?_rdc=1&_rdr#" title="Facebook">📘</a>
      <a href="https://x.com/i/flow/login" title="Twitter">🐦</a>
      <a href="https://www.linkedin.com" title="LinkedIn">💼</a>
      <a href="https://www.instagram.com" title="Instagram">📷</a>
    </div>

    <div class="footer-links">
      <a href="index.php">Home</a>
      <a href="jobs.php">Jobs</a>
      <a href="companies.php">Companies</a>
      <a href="about.php">About</a>
      <a href="contact.php">Contact</a>
      <a href="https://en.wikipedia.org/wiki/Privacy_policy">Privacy Policy</a>
      <a href="contact.php">Terms of Service</a>
    </div>
    <p>&copy; 2025 JobPortal. All rights reserved. | Job Board System</p>
  </footer>
</body>
</html>