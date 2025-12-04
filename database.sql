CREATE DATABASE IF NOT EXISTS job_portal;
USE job_portal;

-- Users table
CREATE TABLE users (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(100) NOT NULL,
    email VARCHAR(100) UNIQUE NOT NULL,
    password VARCHAR(255) NOT NULL,
    user_type ENUM('jobseeker', 'employer') DEFAULT 'jobseeker',
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

-- Jobs table
CREATE TABLE jobs (
    id INT AUTO_INCREMENT PRIMARY KEY,
    company_name VARCHAR(100) NOT NULL,
    title VARCHAR(200) NOT NULL,
    description TEXT NOT NULL,
    location VARCHAR(100),
    salary VARCHAR(100),
    job_type VARCHAR(50),
    company_website VARCHAR(200),
    contact_email VARCHAR(100),
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

-- Sample data
INSERT INTO users (name, email, password) VALUES 
('John Doe', 'john@example.com', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi'), -- password
('Admin User', 'admin@jobs.com', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi');

INSERT INTO jobs (company_name, title, description, location, salary, job_type, company_website, contact_email) VALUES 
('Tech Solutions', 'Frontend Developer', 'We are looking for a skilled frontend developer with experience in HTML, CSS, and JavaScript. You will be responsible for building user interfaces and ensuring web design is optimized for smartphones.', 'Kandy', '$120,00 - $150,00', 'Full-time', 'https://techsolutions.com', 'careers@techsolutions.com'),
('Global Brands', 'Marketing Manager', 'Seeking an experienced Marketing Manager to develop and implement marketing strategies. You will lead our marketing team and drive brand awareness campaigns.', 'Colombo', '$85,00 - $105,00', 'Full-time', 'https://globalbrands.com', 'hr@globalbrands.com'),
('Creative Studio', 'UX/UI Designer', 'Join our design team to create beautiful and intuitive user interfaces. Portfolio required. Remote work options available.', 'Remote', '$75,00 - $95,00', 'Full-time', 'https://creativestudio.com', 'jobs@creativestudio.com'),
('Data Insights', 'Data Analyst', 'Help businesses make data-driven decisions by analyzing complex datasets. Experience with SQL and Python required.', 'malabe', '$80,000 - $100,000', 'Full-time', 'https://datainsights.com', 'careers@datainsights.com');