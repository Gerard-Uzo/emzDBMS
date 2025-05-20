-- Create Database
CREATE DATABASE IF NOT EXISTS ${DB_NAME};

-- Use the Database
USE ${DB_NAME};

-- Create User Table for Authentication
CREATE TABLE users (
    id INT AUTO_INCREMENT PRIMARY KEY,
    username VARCHAR(50) NOT NULL UNIQUE,
    password VARCHAR(255) NOT NULL,
    role ENUM('user', 'admin') NOT NULL
);

-- Create Sent Goods Table
CREATE TABLE sent_goods (
    id INT AUTO_INCREMENT PRIMARY KEY,
    date DATE NOT NULL,
    sender_location VARCHAR(255) NOT NULL,
    sender_name VARCHAR(255) NOT NULL,
    receiver_location VARCHAR(255) NOT NULL,
    receiver_name VARCHAR(255) NOT NULL,
    total_quantity INT NOT NULL,
    description TEXT NOT NULL,
    invoice_number VARCHAR(255),
    authorised_by VARCHAR(255) NOT NULL
);

-- Insert Default Users
INSERT INTO users (username, password, role) VALUES 
('${ADMIN_USERNAME}', '${ADMIN_PASSWORD_HASH}', 'Administrator'),
('${USER_USERNAME}', '${USER_PASSWORD_HASH}', 'GOB_User');