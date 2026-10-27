CREATE DATABASE job_application_db;
USE job_application_db;

CREATE TABLE applications (
    application_id INT AUTO_INCREMENT PRIMARY KEY,
    first_name VARCHAR(50) NOT NULL,
    last_name VARCHAR(50) NOT NULL,
    email VARCHAR(100) NOT NULL,
    phone VARCHAR(20),
    position_applied VARCHAR(50) NOT NULL,
    years_experience INT DEFAULT 0,
    skills VARCHAR(255),
    portfolio VARCHAR(255),
    date_added TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);
