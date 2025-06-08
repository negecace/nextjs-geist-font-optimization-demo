-- Create the database
CREATE DATABASE IF NOT EXISTS piano_studio;
USE piano_studio;

-- Students table
CREATE TABLE IF NOT EXISTS students (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(100) NOT NULL,
    email VARCHAR(100) NOT NULL UNIQUE,
    phone VARCHAR(20) NOT NULL,
    address TEXT NOT NULL,
    music_level ENUM('beginner', 'intermediate', 'advanced') NOT NULL,
    years_experience INT DEFAULT 0,
    resume_path VARCHAR(255),
    certificate_path VARCHAR(255),
    password_hash VARCHAR(255) NOT NULL,
    registration_date TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    status ENUM('pending', 'active', 'inactive') DEFAULT 'pending',
    last_login TIMESTAMP NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
);

-- Payments table
CREATE TABLE IF NOT EXISTS payments (
    id INT AUTO_INCREMENT PRIMARY KEY,
    student_id INT NOT NULL,
    amount DECIMAL(10,2) NOT NULL,
    description VARCHAR(255) NOT NULL,
    payment_date TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    payment_method ENUM('paypal', 'stripe') NOT NULL,
    transaction_id VARCHAR(100) NOT NULL,
    status ENUM('pending', 'completed', 'failed', 'refunded') DEFAULT 'pending',
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (student_id) REFERENCES students(id)
);

-- Lessons table
CREATE TABLE IF NOT EXISTS lessons (
    id INT AUTO_INCREMENT PRIMARY KEY,
    student_id INT NOT NULL,
    lesson_date DATETIME NOT NULL,
    duration INT NOT NULL COMMENT 'Duration in minutes',
    status ENUM('scheduled', 'completed', 'cancelled') DEFAULT 'scheduled',
    notes TEXT,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    FOREIGN KEY (student_id) REFERENCES students(id)
);

-- Fee Configuration table
CREATE TABLE IF NOT EXISTS fee_configuration (
    id INT AUTO_INCREMENT PRIMARY KEY,
    fee_type VARCHAR(50) NOT NULL,
    amount DECIMAL(10,2) NOT NULL,
    description TEXT,
    is_active BOOLEAN DEFAULT true,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
);

-- Contact Messages table
CREATE TABLE IF NOT EXISTS contact_messages (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(100) NOT NULL,
    email VARCHAR(100) NOT NULL,
    phone VARCHAR(20),
    subject VARCHAR(200) NOT NULL,
    message TEXT NOT NULL,
    status ENUM('new', 'read', 'replied') DEFAULT 'new',
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

-- Admin Users table
CREATE TABLE IF NOT EXISTS admin_users (
    id INT AUTO_INCREMENT PRIMARY KEY,
    username VARCHAR(50) NOT NULL UNIQUE,
    password_hash VARCHAR(255) NOT NULL,
    email VARCHAR(100) NOT NULL UNIQUE,
    is_super_admin BOOLEAN DEFAULT false,
    last_login TIMESTAMP NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
);

-- Insert sample fee configuration
INSERT INTO fee_configuration (fee_type, amount, description) VALUES
('registration', 50.00, 'One-time registration fee'),
('monthly_lesson', 200.00, 'Monthly lesson fee'),
('private_lesson', 75.00, 'Per hour private lesson fee');

-- Insert sample admin user (password: admin123)
INSERT INTO admin_users (username, password_hash, email, is_super_admin) VALUES
('admin', '$2y$10$8K1p/a4SWp.Zq0o3jpqH4eBNqTNHKscqaCpzOEm0M31bGBAIXSAqi', 'admin@roycampbellpiano.com', true);

-- Create indexes for better performance
CREATE INDEX idx_students_email ON students(email);
CREATE INDEX idx_payments_student_id ON payments(student_id);
CREATE INDEX idx_lessons_student_id ON lessons(student_id);
CREATE INDEX idx_lessons_date ON lessons(lesson_date);
