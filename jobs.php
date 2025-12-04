<?php 
require_once 'config.php';

// Redirect to login if not logged in
if (!isLoggedIn()) {
    $_SESSION['redirect_url'] = 'jobs.php';
    redirect('login.php');
}

// Get all jobs
$stmt = $pdo->query("SELECT * FROM jobs ORDER BY created_at DESC");
$jobs = $stmt->fetchAll();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Browse Jobs - JobPortal</title>
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
            font-size: 0.9rem;
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
        
        .page-subtitle {
            text-align: center;
            margin-bottom: 3rem;
            color: #7f8c8d;
            font-size: 1.2rem;
            max-width: 800px;
            margin-left: auto;
            margin-right: auto;
        }
        
        .jobs-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 2rem;
            flex-wrap: wrap;
            gap: 1rem;
        }
        
        .jobs-count {
            color: #7f8c8d;
            font-size: 1.1rem;
        }
        
        .search-filter {
            display: flex;
            gap: 1rem;
            flex-wrap: wrap;
        }
        
        .search-box {
            padding: 0.75rem 1rem;
            border: 1px solid #ddd;
            border-radius: 4px;
            font-size: 1rem;
            width: 250px;
        }
        
        .filter-select {
            padding: 0.75rem 1rem;
            border: 1px solid #ddd;
            border-radius: 4px;
            font-size: 1rem;
            background: white;
        }
        
        .cards-grid {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(350px, 1fr));
            gap: 2rem;
            margin: 2rem 0;
        }
        
        .card {
            background: white;
            border-radius: 10px;
            box-shadow: 0 5px 15px rgba(0,0,0,0.1);
            padding: 1.5rem;
            transition: transform 0.3s ease, box-shadow 0.3s ease;
            display: flex;
            flex-direction: column;
            height: 100%;
        }
        
        .card:hover {
            transform: translateY(-5px);
            box-shadow: 0 10px 25px rgba(0,0,0,0.15);
        }
        
        .card-header {
            margin-bottom: 1rem;
            border-bottom: 1px solid #f1f1f1;
            padding-bottom: 1rem;
        }
        
        .card-title {
            color: #2c3e50;
            font-size: 1.4rem;
            margin-bottom: 0.5rem;
            line-height: 1.3;
        }
        
        .card-company {
            color: #3498db;
            font-size: 1.1rem;
            font-weight: 600;
        }
        
        .card-body {
            flex: 1;
            margin-bottom: 1.5rem;
        }
        
        .job-meta {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 0.75rem;
            margin-bottom: 1rem;
        }
        
        .meta-item {
            display: flex;
            align-items: center;
            gap: 0.5rem;
        }
        
        .meta-icon {
            font-size: 1rem;
            color: #3498db;
        }
        
        .meta-label {
            font-weight: 500;
            color: #2c3e50;
            font-size: 0.9rem;
        }
        
        .meta-value {
            color: #555;
            font-size: 0.9rem;
        }
        
        .job-type-badge {
            display: inline-block;
            padding: 0.25rem 0.75rem;
            background: #e8f4fd;
            color: #3498db;
            border-radius: 20px;
            font-size: 0.8rem;
            font-weight: 500;
        }
        
        .card-footer {
            margin-top: auto;
        }
        
        .view-details-btn {
            width: 100%;
            text-align: center;
            padding: 0.75rem;
            background: #3498db;
            color: white;
            border-radius: 4px;
            text-decoration: none;
            display: block;
            font-weight: 500;
            transition: background 0.3s ease;
        }
        
        .view-details-btn:hover {
            background: #2980b9;
        }
        
        .no-jobs {
            text-align: center;
            padding: 3rem;
            color: #7f8c8d;
            background: white;
            border-radius: 10px;
            box-shadow: 0 5px 15px rgba(0,0,0,0.1);
        }
        
        .no-jobs-icon {
            font-size: 4rem;
            margin-bottom: 1rem;
            opacity: 0.5;
        }
        
        .pagination {
            display: flex;
            justify-content: center;
            margin-top: 3rem;
            gap: 0.5rem;
        }
        
        .pagination a {
            padding: 0.5rem 1rem;
            border: 1px solid #ddd;
            border-radius: 4px;
            text-decoration: none;
            color: #3498db;
            transition: all 0.3s ease;
        }
        
        .pagination a:hover, .pagination a.active {
            background: #3498db;
            color: white;
            border-color: #3498db;
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
            
            .jobs-header {
                flex-direction: column;
                align-items: flex-start;
            }
            
           /* .search-filter {
                width: 100%;
            }*/
            
            .search-box {
                width: 100%;
            }
            
            .cards-grid {
                grid-template-columns: 1fr;
            }
            
            .job-meta {
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
            <a href="jobs.php" class="active">Jobs</a>
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
    <h1 class="page-title">Available Jobs</h1>
    <p class="page-subtitle">Browse through our curated list of job opportunities. Click on any job to view details and apply directly.</p>
    
    <div class="jobs-header">
        <div class="jobs-count">
            <?php echo count($jobs); ?> job<?php echo count($jobs) !== 1 ? 's' : ''; ?> available
        </div>
        <div class="search-filter">
            <input type="text" class="search-box" id="searchInput" placeholder="Search jobs...">
            <select class="filter-select" id="typeFilter">
                <option value="">All Job Types</option>
                <option value="Full-time">Full-time</option>
                <option value="Part-time">Part-time</option>
                <option value="Contract">Contract</option>
                <option value="Remote">Remote</option>
            </select>
            <select class="filter-select" id="locationFilter">
                <option value="">All Locations</option>
                <option value="Colombo">Colombo</option>
                <option value="Kandy">Kandy</option>
                <option value="Remote">Remote</option>
            </select>
        </div>
    </div>

    <?php if (empty($jobs)): ?>
        <div class="no-jobs">
            <div class="no-jobs-icon">💼</div>
            <h3>No Jobs Available</h3>
            <p>There are currently no job listings. Please check back later.</p>
        </div>
    <?php else: ?>
        <div class="cards-grid" id="jobsGrid">
            <?php foreach ($jobs as $job): ?>
                <div class="card job-card" 
                     data-title="<?php echo htmlspecialchars(strtolower($job['title'])); ?>"
                     data-company="<?php echo htmlspecialchars(strtolower($job['company_name'])); ?>"
                     data-type="<?php echo htmlspecialchars($job['job_type']); ?>"
                     data-location="<?php echo htmlspecialchars($job['location']); ?>">
                    <div class="card-header">
                        <h3 class="card-title"><?php echo htmlspecialchars($job['title']); ?></h3>
                        <div class="card-company"><?php echo htmlspecialchars($job['company_name']); ?></div>
                    </div>
                    
                    <div class="card-body">
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
                                    <div class="meta-label">Type</div>
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
                        
                        <div class="job-type-badge"><?php echo htmlspecialchars($job['job_type']); ?></div>
                    </div>
                    
                    <div class="card-footer">
                        <a href="job-details.php?id=<?php echo $job['id']; ?>" class="view-details-btn">View Details & Apply</a>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
        
        <!-- Remove or comment out the static pagination since we're filtering client-side -->
        <div class="pagination">
            <a href="#" class="active">1</a>
            <a href="#">2</a>
            <a href="#">3</a>
            <a href="#">Next →</a>
        </div> 
    <?php endif; ?>
</div>

<script>
document.addEventListener('DOMContentLoaded', function() {
    const searchInput = document.getElementById('searchInput');
    const typeFilter = document.getElementById('typeFilter');
    const locationFilter = document.getElementById('locationFilter');
    const jobCards = document.querySelectorAll('.job-card');
    const jobsGrid = document.getElementById('jobsGrid');
    const jobsCount = document.querySelector('.jobs-count');

    function filterJobs() {
        const searchTerm = searchInput.value.toLowerCase();
        const selectedType = typeFilter.value;
        const selectedLocation = locationFilter.value;
        
        let visibleCount = 0;
        
        jobCards.forEach(card => {
            const title = card.getAttribute('data-title');
            const company = card.getAttribute('data-company');
            const type = card.getAttribute('data-type');
            const location = card.getAttribute('data-location');
            
            const matchesSearch = !searchTerm || 
                                title.includes(searchTerm) || 
                                company.includes(searchTerm);
            
            const matchesType = !selectedType || type === selectedType;
            const matchesLocation = !selectedLocation || location === selectedLocation;
            
            if (matchesSearch && matchesType && matchesLocation) {
                card.style.display = 'flex';
                visibleCount++;
            } else {
                card.style.display = 'none';
            }
        });
        
        // Update job count
        jobsCount.textContent = `${visibleCount} job${visibleCount !== 1 ? 's' : ''} available`;
        
        // Show no results message if no jobs match
        if (visibleCount === 0) {
            if (!document.querySelector('.no-results')) {
                const noResults = document.createElement('div');
                noResults.className = 'no-jobs no-results';
                noResults.innerHTML = `
                    <div class="no-jobs-icon">🔍</div>
                    <h3>No Jobs Found</h3>
                    <p>Try adjusting your search criteria or filters.</p>
                `;
                jobsGrid.parentNode.insertBefore(noResults, jobsGrid.nextSibling);
            }
        } else {
            const noResults = document.querySelector('.no-results');
            if (noResults) {
                noResults.remove();
            }
        }
    }
    
    // Add event listeners
    searchInput.addEventListener('input', filterJobs);
    typeFilter.addEventListener('change', filterJobs);
    locationFilter.addEventListener('change', filterJobs);
});
</script> 



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