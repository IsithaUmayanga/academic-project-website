<?php 
require_once 'config.php';

$error = '';
$success = '';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $name = trim($_POST['name']);
    $email = trim($_POST['email']);
    $password = $_POST['password'];
    $confirm_password = $_POST['confirm_password'];
    
    // Simple validation
    if (empty($name) || empty($email) || empty($password)) {
        $error = 'All fields are required';
    } elseif ($password !== $confirm_password) {
        $error = 'Passwords do not match';
    } elseif (strlen($password) < 6) {
        $error = 'Password must be at least 6 characters';
    } else {
        // Check if email already exists
        $stmt = $pdo->prepare("SELECT id FROM users WHERE email = ?");
        $stmt->execute([$email]);
        
        if ($stmt->rowCount() > 0) {
            $error = 'Email already registered';
        } else {
            // Create user
            $hashed_password = password_hash($password, PASSWORD_DEFAULT);
            $stmt = $pdo->prepare("INSERT INTO users (name, email, password) VALUES (?, ?, ?)");
            
            if ($stmt->execute([$name, $email, $hashed_password])) {
                $success = 'Registration successful! You can now login.';
            } else {
                $error = 'Registration failed. Please try again.';
            }
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register - JobPortal</title>
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
            display: flex;
            align-items: center;
            justify-content: center;
        }
        
        .form-container {
            background: white;
            padding: 3rem;
            border-radius: 10px;
            box-shadow: 0 10px 30px rgba(0,0,0,0.1);
            width: 100%;
            max-width: 500px;
        }
        
        .page-title {
            text-align: center;
            margin-bottom: 2rem;
            color: #2c3e50;
            font-size: 2rem;
        }
        
        .form-group {
            margin-bottom: 1.5rem;
        }
        
        .form-group label {
            display: block;
            margin-bottom: 0.5rem;
            color: #2c3e50;
            font-weight: 500;
        }
        
        .form-group input {
            width: 100%;
            padding: 0.75rem 1rem;
            border: 1px solid #ddd;
            border-radius: 4px;
            font-size: 1rem;
            transition: border-color 0.3s ease;
        }
        
        .form-group input:focus {
            outline: none;
            border-color: #3498db;
            box-shadow: 0 0 0 3px rgba(52, 152, 219, 0.2);
        }
        
        .submit-btn {
            width: 100%;
            padding: 0.75rem;
            background: #3498db;
            color: white;
            border: none;
            border-radius: 4px;
            font-size: 1.1rem;
            font-weight: 500;
            cursor: pointer;
            transition: all 0.3s ease;
        }
        
        .submit-btn:hover {
            background: #2980b9;
            transform: translateY(-2px);
        }
        
        .alert {
            padding: 1rem;
            border-radius: 4px;
            margin-bottom: 1.5rem;
            text-align: center;
        }
        
        .alert-error {
            background: #f8d7da;
            color: #721c24;
            border: 1px solid #f5c6cb;
        }
        
        .alert-success {
            background: #d4edda;
            color: #155724;
            border: 1px solid #c3e6cb;
        }
        
        .form-footer {
            text-align: center;
            margin-top: 1.5rem;
            color: #7f8c8d;
        }
        
        .form-footer a {
            color: #3498db;
            text-decoration: none;
            font-weight: 500;
        }
        
        .form-footer a:hover {
            text-decoration: underline;
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
            
            .form-container {
                padding: 2rem;
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
            <a href="login.php" class="btn btn-outline">Login</a>
            <a href="register.php" class="btn btn-primary">Register</a>
        </div>
    </header>

    <div class="container">
        <div class="form-container">
            <h2 class="page-title">Create Account</h2>
            
            <?php if ($error): ?>
                <div class="alert alert-error"><?php echo $error; ?></div>
            <?php endif; ?>
            
            <?php if ($success): ?>
                <div class="alert alert-success"><?php echo $success; ?></div>
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
                    <label for="password">Password</label>
                    <input type="password" id="password" name="password" required>
                </div>
                
                <div class="form-group">
                    <label for="confirm_password">Confirm Password</label>
                    <input type="password" id="confirm_password" name="confirm_password" required>
                </div>
                
                <button type="submit" class="submit-btn">Register</button>
            </form>
            
            <p class="form-footer">
                Already have an account? <a href="login.php">Login here</a>
            </p>
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