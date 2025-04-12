-- Create Database
CREATE DATABASE IF NOT EXISTS emzor_goods_outward_register;

-- Use the Database
USE emzor_goods_outward_register;

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
('admin_username', '$2y$10$/P.OjKt7DQsOjXq0Sy.jLOUJXCti2H59atNhrUJieGrvMn.buOni.', 'Administrator'),
('user_username', '$2y$10$lkQKXtXQhGlpRBKDBx3hYuerSoKwM/Tt0cjt2ZIJE.vGWfH1jid3m', 'GOB_User');