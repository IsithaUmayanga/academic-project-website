<?php require_once 'config.php'; ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Companies - JobPortal</title>
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
        }
        
        .page-title {
            text-align: center;
            margin: 2rem 0;
            color: #2c3e50;
            font-size: 2.5rem;
        }
        
        .page-subtitle {
            text-align: center;
            margin-bottom: 3rem;
            color: #7f8c8d;
            font-size: 1.2rem;
        }
        
        .cards-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
            gap: 2rem;
            margin: 2rem 0;
        }
        
        .card {
            background: white;
            border-radius: 10px;
            padding: 1.5rem;
            box-shadow: 0 5px 15px rgba(0,0,0,0.1);
            transition: transform 0.3s ease, box-shadow 0.3s ease;
        }
        
        .card:hover {
            transform: translateY(-5px);
            box-shadow: 0 10px 25px rgba(0,0,0,0.15);
        }
        
        .card h3 {
            color: #2c3e50;
            margin-bottom: 1rem;
            font-size: 1.5rem;
        }
        
        .card p {
            margin-bottom: 0.5rem;
            color: #555;
        }
        
        .company-logo {
            width: 80px;
            height: 80px;
            background: #3498db;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            margin-bottom: 1rem;
            color: white;
            font-size: 1.5rem;
            font-weight: bold;
        }
        
        .footer {
            background: #2c3e50;
            color: white;
            text-align: center;
            padding: 2rem;
            margin-top: 3rem;
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
            <a href="companies.php" class="active">Companies</a>
            <a href="about.php">About</a>
            <a href="contact.php">Contact</a>
        </nav>
        <div class="auth-buttons">
            <?php if (isLoggedIn()): ?>
                <span style="color: white;">Welcome, <?php echo $_SESSION['user_name']; ?></span>
                <a href="dashboard.php" class="btn btn-outline">Dashboard</a>
                <a href="logout.php" class="btn btn-primary">Logout</a>
            <?php else: ?>
                <a href="login.php" class="btn btn-outline">Login</a>
                <a href="register.php" class="btn btn-primary">Register</a>
            <?php endif; ?>
        </div>
    </header>

    <div class="container">
        <h1 class="page-title">Featured Companies</h1>
        <p class="page-subtitle">Discover top employers hiring on JobPortal</p>

        <div class="cards-grid">
            <div class="card">
                <div class="company-logo">TS</div>
                <h3>Tech Solutions</h3>
                <p><strong>Industry:</strong> Information Technology</p>
                <p><strong>Location:</strong> Colombo , Malabe</p>
                <p><strong>Open Positions:</strong> 12</p>
                <p>Leading provider of innovative software solutions for businesses worldwide.</p>
            </div>
            
            <div class="card">
                <div class="company-logo">GB</div>
                <h3>Global Brands</h3>
                <p><strong>Industry:</strong> Marketing & Advertising</p>
                <p><strong>Location:</strong> Colombo, Kaduwela</p>
                <p><strong>Open Positions:</strong> 8</p>
                <p>International marketing agency helping brands reach global audiences.</p>
            </div>
            
            <div class="card">
                <div class="company-logo">CS</div>
                <h3>Creative Studio</h3>
                <p><strong>Industry:</strong> Design & Creative</p>
                <p><strong>Location:</strong> Remote</p>
                <p><strong>Open Positions:</strong> 5</p>
                <p>Award-winning design studio specializing in UX/UI and brand identity.</p>
            </div>
            
            <div class="card">
                <div class="company-logo">DI</div>
                <h3>Data Insights</h3>
                <p><strong>Industry:</strong> Analytics & Data Science</p>
                <p><strong>Location:</strong> Badulla, </p>
                <p><strong>Open Positions:</strong> 7</p>
                <p>Data analytics firm helping companies make data-driven decisions.</p>
            </div>
            
            <div class="card">
                <div class="company-logo">IF</div>
                <h3>Innovate Future</h3>
                <p><strong>Industry:</strong> Technology & Research</p>
                <p><strong>Location:</strong> Kandy, Mathale</p>
                <p><strong>Open Positions:</strong> 9</p>
                <p>Research and development company focused on emerging technologies.</p>
            </div>
            
            <div class="card">
                <div class="company-logo">EG</div>
                <h3>EcoGreen</h3>
                <p><strong>Industry:</strong> Environmental Services</p>
                <p><strong>Location:</strong> Colombo, Malabe</p>
                <p><strong>Open Positions:</strong> 6</p>
                <p>Sustainable technology company developing eco-friendly solutions.</p>
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