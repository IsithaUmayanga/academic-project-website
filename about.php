<?php require_once 'config.php'; ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>About Us - JobPortal</title>
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
            max-width: 800px;
            margin-left: auto;
            margin-right: auto;
        }
        
        .about-content {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 3rem;
            margin: 3rem 0;
        }
        
        .about-text {
            background: white;
            padding: 2rem;
            border-radius: 10px;
            box-shadow: 0 5px 15px rgba(0,0,0,0.1);
        }
        
        .about-text h2 {
            color: #2c3e50;
            margin-bottom: 1rem;
            font-size: 1.8rem;
        }
        
        .about-text p {
            margin-bottom: 1.5rem;
            line-height: 1.8;
        }
        
        .stats {
            display: grid;
            grid-template-columns: repeat(3, 1fr);
            gap: 1rem;
            margin: 2rem 0;
        }
        
        .stat-item {
            text-align: center;
            padding: 1.5rem;
            background: white;
            border-radius: 10px;
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
        
        .team-section {
            margin: 4rem 0;
        }
        
        .team-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
            gap: 2rem;
            margin: 2rem 0;
        }
        
        .team-member {
            background: white;
            border-radius: 10px;
            padding: 1.5rem;
            text-align: center;
            box-shadow: 0 5px 15px rgba(0,0,0,0.1);
            transition: transform 0.3s ease;
        }
        
        .team-member:hover {
            transform: translateY(-5px);
        }
        
        .member-photo {
            width: 120px;
            height: 120px;
            border-radius: 50%;
            background: #3498db;
            margin: 0 auto 1rem;
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
            font-size: 3rem;
        }
        
        .member-name {
            font-size: 1.3rem;
            font-weight: bold;
            color: #2c3e50;
            margin-bottom: 0.5rem;
        }
        
        .member-role {
            color: #e74c3c;
            margin-bottom: 1rem;
            font-weight: 500;
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
            
            .about-content {
                grid-template-columns: 1fr;
            }
            
            .stats {
                grid-template-columns: 1fr;
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
            <a href="about.php" class="active">About</a>
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
        <h1 class="page-title">About JobPortal</h1>
        <p class="page-subtitle">Connecting talented job seekers with top employers since 2023. Our mission is to simplify the job search process and help companies find the perfect candidates.</p>
        
        <div class="stats">
            <div class="stat-item">
                <div class="stat-number">500+</div>
                <div class="stat-label">Jobs Posted</div>
            </div>
            <div class="stat-item">
                <div class="stat-number">200+</div>
                <div class="stat-label">Companies</div>
            </div>
            <div class="stat-item">
                <div class="stat-number">10,000+</div>
                <div class="stat-label">Users</div>
            </div>
        </div>
        
        <div class="about-content">
            <div class="about-text">
                <h2>Our Story</h2>
                <p>JobPortal was founded in 2023 with a simple vision: to create a platform that makes job searching and hiring more efficient, transparent, and human-centered. We noticed that traditional job boards were often cluttered, difficult to navigate, and failed to provide meaningful connections between employers and job seekers.</p>
                <p>Our team of developers, HR professionals, and career coaches came together to build a solution that addresses these pain points. We've created a platform that not only lists job opportunities but also provides resources, insights, and tools to help both job seekers and employers succeed.</p>
            </div>
            
            <div class="about-text">
                <h2>Our Mission</h2>
                <p>We believe that everyone deserves to find work they love and that companies should have access to the best talent. Our mission is to bridge the gap between ambition and opportunity by providing a platform that is intuitive, comprehensive, and effective.</p>
                <p>We're committed to continuously improving our platform based on user feedback and industry trends. Whether you're a recent graduate looking for your first job or an established company seeking specialized talent, JobPortal is designed to meet your needs.</p>
            </div>
        </div>
        
        <div class="team-section">
            <h2 class="page-title" style="font-size: 2rem;">Meet Our Team</h2>
            
            <div class="team-grid">
                <div class="team-member">
                    <div class="member-photo">👨‍💼</div>
                    <div class="member-name">Jnith Chathurva</div>
                    <div class="member-role">CEO & Founder</div>
                    <p>10+ years in HR and recruitment technology</p>
                </div>
                
                <div class="team-member">
                    <div class="member-photo">👩‍💻</div>
                    <div class="member-name">Theekshana Samadhi</div>
                    <div class="member-role">CTO</div>
                    <p>Former software engineer with passion for UX</p>
                </div>
                
                <div class="team-member">
                    <div class="member-photo">👨‍🎓</div>
                    <div class="member-name">Isitha Umayanaga</div>
                    <div class="member-role">Head of Product</div>
                    <p>Product management expert with MBA from Stanford</p>
                </div>
                
                <div class="team-member">
                    <div class="member-photo">👩‍🏫</div>
                    <div class="member-name">Sithumini A </div>
                    <div class="member-role">Career Advisor</div>
                    <p>Certified career coach with 8 years of experience</p>
                </div>
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