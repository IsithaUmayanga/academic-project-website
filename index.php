<?php require_once 'config.php'; ?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>JobPortal - Find Your Dream Job</title>
  <style>
    * {
      margin: 0;
      padding: 0;
      box-sizing: border-box;
      font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
    }

    body {
      
      background: url("pexels.jpg") no-repeat center center fixed;
      background-size: cover;
      margin: 0;
      padding: 0;
      font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
      animation: fadeBg 2s ease-in-out;
      
    }

    /* ---------------- HEADER ---------------- */
    .header {
      background: linear-gradient(135deg, #2c3e50, #3498db);
      color: white;
      padding: 1rem 2rem;
      display: flex;
      justify-content: space-between;
      align-items: center;
      box-shadow: 0 2px 10px rgba(0,0,0,0.1);
      position: sticky;
      top: 0;
      z-index: 100;
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
      background: rgba(255, 255, 255, 0.9);
      border-radius: 15px;
      margin-top: 2rem;
      margin-bottom: 2rem;
      box-shadow: 0 5px 15px rgba(0,0,0,0.1);
    }

    /* ---------------- HERO SECTION ---------------- */
    .hero-section {
      position: relative;
      text-align: center;
      padding: 6rem 2rem;
      color: white;
      border-radius: 15px;
      margin: 2rem 0;
      overflow: hidden;
      box-shadow: 0 10px 30px rgba(0,0,0,0.3);
      background: linear-gradient(135deg, rgba(44, 62, 80, 0.85), rgba(52, 152, 219, 0.85)), url('pexels.jpg') center/cover no-repeat;
    }

    .hero-title {
      font-size: 3rem;
      margin-bottom: 1.5rem;
      font-weight: 700;
      text-shadow: 2px 2px 4px rgba(0,0,0,0.5);
    }

    .hero-subtitle {
      font-size: 1.3rem;
      margin-bottom: 2.5rem;
      opacity: 0.9;
      text-shadow: 1px 1px 2px rgba(0,0,0,0.5);
      max-width: 800px;
      margin-left: auto;
      margin-right: auto;
    }

    .hero-btn {
      padding: 1rem 2.5rem;
      font-size: 1.1rem;
      background: #e74c3c;
      border: none;
      border-radius: 50px;
      color: white;
      cursor: pointer;
      transition: all 0.3s ease;
      text-decoration: none;
      display: inline-block;
      animation: float 3s ease-in-out infinite;
      box-shadow: 0 4px 15px rgba(0,0,0,0.2);
    }

    .hero-btn:hover {
      background: #c0392b;
      transform: translateY(-3px);
      box-shadow: 0 5px 15px rgba(0,0,0,0.3);
    }

    @keyframes float {
      0%, 100% { transform: translateY(0); }
      50% { transform: translateY(-6px); }
    }

    /* ---------------- HOW IT WORKS SECTION ---------------- */
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

    .cards-grid {
      display: grid;
      grid-template-columns: repeat(auto-fit, minmax(280px, 1fr));
      gap: 2rem;
      justify-items: center;
      margin: 3rem 0;
    }

    .card {
      background: white;
      padding: 2.5rem 2rem;
      border-radius: 10px;
      text-align: center;
      box-shadow: 0 5px 15px rgba(0,0,0,0.1);
      transition: transform 0.3s ease;
      border: 1px solid #e0e0e0;
      position: relative;
      overflow: hidden;
    }

    .card::before {
      content: '';
      position: absolute;
      top: 0;
      left: 0;
      width: 100%;
      height: 5px;
      background: linear-gradient(90deg, #3498db, #2c3e50);
    }

    .card:hover {
      transform: translateY(-10px);
      box-shadow: 0 15px 30px rgba(0,0,0,0.15);
    }

    .card h3 {
      color: #2c3e50;
      margin-bottom: 1rem;
      font-size: 1.5rem;
    }

    .card p {
      color: #7f8c8d;
      line-height: 1.6;
    }

    .card-icon {
      font-size: 3rem;
      margin-bottom: 1.5rem;
      display: inline-block;
      width: 80px;
      height: 80px;
      line-height: 80px;
      border-radius: 50%;
      background: #f8f9fa;
      color: #3498db;
    }

    .card button {
      background: linear-gradient(135deg, #3498db, #2c3e50);
      color: white;
      border: none;
      padding: 12px 24px;
      margin-top: 15px;
      border-radius: 6px;
      cursor: pointer;
      font-size: 14px;
      font-weight: bold;
      transition: all 0.3s ease;
      box-shadow: 0 2px 5px rgba(0,0,0,0.2);
    }

    .card button:hover {
      background: linear-gradient(135deg, #2c3e50, #3498db);
      transform: scale(1.05);
      box-shadow: 0 4px 8px rgba(0,0,0,0.3);
    }

    .card button:active {
      transform: scale(0.95);
    }

    /* ---------------- FEATURED JOBS SECTION ---------------- */
    .featured-section {
      margin: 4rem 0;
    }

    .job-cards {
      display: grid;
      grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
      gap: 1.5rem;
      margin-top: 2rem;
    }

    .job-card {
      background: white;
      border-radius: 10px;
      padding: 1.5rem;
      box-shadow: 0 5px 15px rgba(0,0,0,0.08);
      transition: all 0.3s ease;
      border-left: 4px solid #3498db;
    }

    .job-card:hover {
      transform: translateY(-5px);
      box-shadow: 0 8px 20px rgba(0,0,0,0.12);
    }

    .job-title {
      font-size: 1.2rem;
      color: #2c3e50;
      margin-bottom: 0.5rem;
    }

    .job-company {
      color: #7f8c8d;
      margin-bottom: 1rem;
      font-size: 0.9rem;
    }

    .job-meta {
      display: flex;
      justify-content: space-between;
      margin-top: 1rem;
      font-size: 0.85rem;
      color: #7f8c8d;
    }

    .job-tag {
      display: inline-block;
      background: #e1f0fa;
      color: #3498db;
      padding: 0.3rem 0.8rem;
      border-radius: 20px;
      font-size: 0.8rem;
      margin-top: 0.5rem;
    }

    /* ---------------- ANIMATIONS ---------------- */
    .fade-in {
      opacity: 0;
      transform: translateY(30px);
      transition: all 0.8s ease-out;
    }

    .fade-in.visible {
      opacity: 1;
      transform: translateY(0);
    }

    /* ---------------- FOOTER ---------------- */
    footer.footer {
      background: #2c3e50;
      color: white;
      text-align: center;
      padding: 2rem;
      margin-top: 2rem;
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
      flex-wrap: wrap;
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

      .hero-title {
        font-size: 2.2rem;
      }

      .hero-subtitle {
        font-size: 1.1rem;
      }

      .cards-grid {
        grid-template-columns: 1fr;
      }
      
      .container {
        margin: 1rem;
        padding: 1rem;
      }
      
      .job-cards {
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
      <a href="index.php" class="active">Home</a>
      <a href="jobs.php">Jobs</a>
      <a href="companies.php">Companies</a>
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
    <div class="hero-section">
      <h1 class="hero-title">Find Your Dream Job Today</h1>
      <p class="hero-subtitle">Connect with top employers and discover opportunities that match your skills and aspirations. Join thousands who have found their perfect career through JobPortal.</p>
      <?php if (!isLoggedIn()): ?>
        <a href="register.php" class="hero-btn">Get Started - Register Free</a>
      <?php else: ?>
        <a href="jobs.php" class="hero-btn">Browse Jobs</a>
      <?php endif; ?>
    </div>

    <h2 class="page-title">How It Works</h2>
    <p class="page-subtitle">Our simple 3-step process makes job hunting efficient and effective.</p>

    <div class="cards-grid">
      <div class="card fade-in">
        <h3>1. Register Account</h3>
        <div class="card-icon">👤</div>
        <p>Create your free account in less than 2 minutes and set up your professional profile.</p>
        <button onclick="cardAction('Register Account')">Get Started</button>
      </div>

      <div class="card fade-in">
        <h3>2. Browse Jobs</h3>
        <div class="card-icon">🔍</div>
        <p>Explore thousands of job opportunities across various industries and locations.</p>
        <button onclick="cardAction('Browse Jobs')">Browse Now</button>
      </div>

      <div class="card fade-in">
        <h3>3. Apply Directly</h3>
        <div class="card-icon">📝</div>
        <p>Submit your application to companies in just one click with our streamlined process.</p>
        <button onclick="cardAction('Apply Directly')">Apply Now</button>
      </div>
    </div>

    <div class="featured-section">
      <h2 class="page-title">Featured Jobs</h2>
      <p class="page-subtitle">Discover exciting opportunities from top companies</p>
      
      <div class="job-cards">
        <div class="job-card fade-in">
          <h3 class="job-title">Frontend Developer</h3>
          <p class="job-company">Tech Solutions Inc.</p>
          <p>We're looking for a skilled frontend developer with React experience to join our growing team.</p>
          <div class="job-meta">
            <span>📍 Kandy, </span>
            <span>💼 Full-time</span>
          </div>
          <span class="job-tag">React</span>
          <span class="job-tag">JavaScript</span>
        </div>
        
        <div class="job-card fade-in">
          <h3 class="job-title">Marketing Manager</h3>
          <p class="job-company">Global Brands Co.</p>
          <p>Lead our marketing initiatives and drive brand awareness across multiple channels.</p>
          <div class="job-meta">
            <span>📍 COLOMBO, Malabe</span>
            <span>💼 Full-time</span>
          </div>
          <span class="job-tag">Digital Marketing</span>
          <span class="job-tag">Strategy</span>
        </div>
        
        <div class="job-card fade-in">
          <h3 class="job-title">Data Analyst</h3>
          <p class="job-company">Data Insights LLC</p>
          <p>Transform complex data into actionable insights to drive business decisions.</p>
          <div class="job-meta">
            <span>📍 Remote</span>
            <span>💼 Contract</span>
          </div>
          <span class="job-tag">SQL</span>
          <span class="job-tag">Python</span>
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

  <script>
    // Redirect card button clicks to appropriate pages
    function cardAction(step) {
      if (step === 'Register Account') {
        window.location.href = "register.php";
      } else {
        window.location.href = "jobs.php";
      }
    }

    // Fade-in animation when scrolling
    document.addEventListener("DOMContentLoaded", () => {
      const fadeElems = document.querySelectorAll('.fade-in');
      const onScroll = () => {
        fadeElems.forEach(elem => {
          const rect = elem.getBoundingClientRect();
          if (rect.top < window.innerHeight - 100) {
            elem.classList.add('visible');
          }
        });
      };
      window.addEventListener('scroll', onScroll);
      onScroll(); // Initial call
    });
  </script>
</body>
</html>