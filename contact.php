<?php 
require_once 'config.php';

$success = '';
$error = '';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $name = trim($_POST['name']);
    $email = trim($_POST['email']);
    $subject = trim($_POST['subject']);
    $message = trim($_POST['message']);
    
    // Simple validation
    if (empty($name) || empty($email) || empty($subject) || empty($message)) {
        $error = 'All fields are required';
    } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $error = 'Please enter a valid email address';
    } else {
        // In a real application, you would send an email or save to database
        $success = 'Thank you for your message! We will get back to you within 24 hours.';
        
        // Clear form
        $name = $email = $subject = $message = '';
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Contact Us - JobPortal</title>
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
        
        .contact-container {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 3rem;
            margin: 3rem 0;
        }
        
        .contact-info {
            background: white;
            padding: 2rem;
            border-radius: 10px;
            box-shadow: 0 5px 15px rgba(0,0,0,0.1);
        }
        
        .contact-info h2 {
            color: #2c3e50;
            margin-bottom: 1.5rem;
            font-size: 1.8rem;
        }
        
        .contact-item {
            display: flex;
            align-items: flex-start;
            margin-bottom: 1.5rem;
        }
        
        .contact-icon {
            background: #3498db;
            color: white;
            width: 40px;
            height: 40px;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            margin-right: 1rem;
            font-size: 1.2rem;
        }
        
        .contact-details h3 {
            color: #2c3e50;
            margin-bottom: 0.5rem;
        }
        
        .contact-form {
            background: white;
            padding: 2rem;
            border-radius: 10px;
            box-shadow: 0 5px 15px rgba(0,0,0,0.1);
        }
        
        .form-group {
            margin-bottom: 1.5rem;
        }
        
        .form-group label {
            display: block;
            margin-bottom: 0.5rem;
            font-weight: bold;
            color: #2c3e50;
        }
        
        .form-group input, .form-group textarea {
            width: 100%;
            padding: 0.75rem;
            border: 1px solid #ddd;
            border-radius: 4px;
            font-size: 1rem;
            transition: border-color 0.3s ease;
        }
        
        .form-group input:focus, .form-group textarea:focus {
            outline: none;
            border-color: #3498db;
        }
        
        .form-group textarea {
            height: 150px;
            resize: vertical;
        }
        
        .submit-btn {
            width: 100%;
            padding: 0.75rem;
            background: #3498db;
            color: white;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            font-size: 1rem;
            font-weight: bold;
            transition: background 0.3s ease;
        }
        
        .submit-btn:hover {
            background: #2980b9;
        }
        
        .alert {
            padding: 1rem;
            margin: 1rem 0;
            border-radius: 4px;
            font-weight: 500;
        }
        
        .alert-success {
            background: #d4edda;
            color: #155724;
            border: 1px solid #c3e6cb;
        }
        
        .alert-error {
            background: #f8d7da;
            color: #721c24;
            border: 1px solid #f5c6cb;
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
            
            .contact-container {
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
            <a href="about.php">About</a>
            <a href="contact.php" class="active">Contact</a>
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
        <h1 class="page-title">Contact Us</h1>
        <p class="page-subtitle">Have questions? We're here to help. Send us a message and we'll respond as soon as possible.</p>
        
        <div class="contact-container">
            <div class="contact-info">
                <h2>Get In Touch</h2>
                
                <div class="contact-item">
                    <div class="contact-icon">📍</div>
                    <div class="contact-details">
                        <h3>Our Office</h3>
                        <p>108 Colombo District<br>Malabe, Senanayake Road 45</p>
                    </div>
                </div>
                
                <div class="contact-item">
                    <div class="contact-icon">📞</div>
                    <div class="contact-details">
                        <h3>Phone Number</h3>
                        <p>+94 (555) 546-4567</p>
                    </div>
                </div>
                
                <div class="contact-item">
                    <div class="contact-icon">✉️</div>
                    <div class="contact-details">
                        <h3>Email Address</h3>
                        <p>info@jobportal.com</p>
                    </div>
                </div>
                
                <div class="contact-item">
                    <div class="contact-icon">🕒</div>
                    <div class="contact-details">
                        <h3>Business Hours</h3>
                        <p>Monday - Friday: 9:00 AM - 6:00 PM<br>Saturday: 10:00 AM - 4:00 PM</p>
                    </div>
                </div>
            </div>
            
            <div class="contact-form">
                <h2>Send Us a Message</h2>
                
                <?php if ($success): ?>
                    <div class="alert alert-success"><?php echo $success; ?></div>
                <?php endif; ?>
                
                <?php if ($error): ?>
                    <div class="alert alert-error"><?php echo $error; ?></div>
                <?php endif; ?>
                
                <form method="POST" action="">
                    <div class="form-group">
                        <label for="name">Full Name</label>
                        <input type="text" id="name" name="name" required value="<?php echo isset($_POST['name']) ? htmlspecialchars($_POST['name']) : ''; ?>">
                    </div>
                    
                    <div class="form-group">
                        <label for="email">Email Address</label>
                        <input type="email" id="email" name="email" required value="<?php echo isset($_POST['email']) ? htmlspecialchars($_POST['email']) : ''; ?>">
                    </div>
                    
                    <div class="form-group">
                        <label for="subject">Subject</label>
                        <input type="text" id="subject" name="subject" required value="<?php echo isset($_POST['subject']) ? htmlspecialchars($_POST['subject']) : ''; ?>">
                    </div>
                    
                    <div class="form-group">
                        <label for="message">Message</label>
                        <textarea id="message" name="message" required><?php echo isset($_POST['message']) ? htmlspecialchars($_POST['message']) : ''; ?></textarea>
                    </div>
                    
                    <button type="submit" class="submit-btn">Send Message</button>
                </form>
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