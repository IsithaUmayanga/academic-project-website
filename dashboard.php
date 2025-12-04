<?php 
require_once 'config.php';

// Redirect to login if not logged in
if (!isLoggedIn()) {
    redirect('login.php');
}

// Get user's registration date (you might want to store this in the database)
$member_since = "Today"; // This should come from your database
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard - JobPortal</title>
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
            padding: 0.5rem 1.5rem;
            text-decoration: none;
            border-radius: 4px;
            display: inline-block;
            font-weight: 500;
            transition: all 0.3s ease;
        }
        
        .btn-outline {
            border: 1px solid white;
            color: white;
        }
        
        .btn-outline:hover {
            background: white;
            color: #2c3e50;
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
        
        .welcome-section {
            background: linear-gradient(135deg, #3498db, #2c3e50);
            color: white;
            padding: 2rem;
            border-radius: 10px;
            margin-bottom: 2rem;
            text-align: center;
            box-shadow: 0 5px 15px rgba(0,0,0,0.1);
        }
        
        .welcome-title {
            font-size: 1.8rem;
            margin-bottom: 0.5rem;
        }
        
        .welcome-subtitle {
            font-size: 1.2rem;
            opacity: 0.9;
        }
        
        .cards-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
            gap: 2rem;
            margin: 3rem 0;
        }
        
        .card {
            background: white;
            padding: 2rem;
            border-radius: 10px;
            box-shadow: 0 5px 15px rgba(0,0,0,0.1);
            transition: transform 0.3s ease;
        }
        
        .card:hover {
            transform: translateY(-5px);
        }
        
        .card h3 {
            color: #2c3e50;
            margin-bottom: 1.5rem;
            font-size: 1.5rem;
            border-bottom: 2px solid #3498db;
            padding-bottom: 0.5rem;
        }
        
        .card p {
            margin-bottom: 0.8rem;
            color: #555;
        }
        
        .card a {
            color: #3498db;
            text-decoration: none;
            font-weight: 500;
            transition: color 0.3s ease;
        }
        
        .card a:hover {
            color: #2980b9;
            text-decoration: underline;
        }
        
        .stats-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
            gap: 1.5rem;
            margin: 2rem 0;
        }
        
        .stat-card {
            background: white;
            padding: 1.5rem;
            border-radius: 10px;
            text-align: center;
            box-shadow: 0 5px 15px rgba(0,0,0,0.1);
        }
        
        .stat-number {
            font-size: 2.5rem;
            font-weight: bold;
            color: #3498db;
            margin-bottom: 0.5rem;
        }
        
        .stat-label {
            color: #7f8c8d;
            font-weight: 500;
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
            
            .cards-grid {
                grid-template-columns: 1fr;
            }
            
            .stats-grid {
                grid-template-columns: 1fr;
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
        <h1 class="page-title">Dashboard</h1>
        
        <div class="welcome-section">
            <h2 class="welcome-title">Welcome back, <?php echo $_SESSION['user_name']; ?>!</h2>
            <p class="welcome-subtitle">Manage your job search and profile from your personal dashboard</p>
        </div>
        
        <div class="stats-grid">
            <div class="stat-card">
                <div class="stat-number">0</div>
                <div class="stat-label">Jobs Applied</div>
            </div>
            <div class="stat-card">
                <div class="stat-number">0</div>
                <div class="stat-label">Saved Jobs</div>
            </div>
            <div class="stat-card">
                <div class="stat-number">0</div>
                <div class="stat-label">Profile Views</div>
            </div>
        </div>
        
        <div class="cards-grid">
            <div class="card">
                <h3>Your Profile</h3>
                <p><strong>Name:</strong> <?php echo $_SESSION['user_name']; ?></p>
                <p><strong>Email:</strong> <?php echo $_SESSION['user_email']; ?></p>
                <p><strong>Member since:</strong> <?php echo $member_since; ?></p>
                
            </div>
            
            <div class="card">
                <h3>Quick Actions</h3>
                <p><a href="jobs.php">Browse Jobs</a></p>
                <p><a href="companies.php">View Companies</a></p>
                <p><a href="index.php">Back to Home</a></p>
                
            </div>
            
            <div class="card">
                <h3>Job Search Tips</h3>
                <p>• Update your resume regularly</p>
                <p>• Research companies before applying</p>
                <p>• Customize your application for each job</p>
                <p>• Follow up after applying</p>
                <p>• Network with professionals in your field</p>
            </div>
        </div>
        
        <div class="cards-grid">
            <div class="card">
                <h3>Recent Activity</h3>
                <p>No recent activity yet.</p>
                <p><a href="jobs.php">Start browsing jobs</a> to see your activity here.</p>
            </div>
            
            <div class="card">
                <h3>Recommended Jobs</h3>
                <p>Based on your profile, we recommend:</p>
                <p><a href="jobs.php">View recommended jobs</a></p>
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