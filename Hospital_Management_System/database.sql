CREATE DATABASE IF NOT EXISTS hospital_db CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;
USE hospital_db;

CREATE TABLE IF NOT EXISTS users (
  id INT AUTO_INCREMENT PRIMARY KEY,
  name VARCHAR(100) NOT NULL,
  email VARCHAR(150) NOT NULL UNIQUE,
  password VARCHAR(255) NOT NULL,
  created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

CREATE TABLE IF NOT EXISTS patients (
  id INT AUTO_INCREMENT PRIMARY KEY,
  full_name VARCHAR(120) NOT NULL,
  gender VARCHAR(20) NOT NULL,
  age INT NOT NULL,
  phone VARCHAR(20) NOT NULL,
  email VARCHAR(150) DEFAULT NULL,
  address TEXT,
  created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

CREATE TABLE IF NOT EXISTS doctors (
  id INT AUTO_INCREMENT PRIMARY KEY,
  full_name VARCHAR(120) NOT NULL,
  specialization VARCHAR(100) NOT NULL,
  phone VARCHAR(20) NOT NULL,
  email VARCHAR(150) DEFAULT NULL,
  created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

CREATE TABLE IF NOT EXISTS appointments (
  id INT AUTO_INCREMENT PRIMARY KEY,
  patient_id INT NOT NULL,
  doctor_id INT NOT NULL,
  appointment_date DATE NOT NULL,
  appointment_time TIME NOT NULL,
  reason VARCHAR(255) DEFAULT NULL,
  status ENUM('Scheduled','Completed','Cancelled') DEFAULT 'Scheduled',
  created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
  CONSTRAINT fk_appointment_patient FOREIGN KEY (patient_id) REFERENCES patients(id) ON DELETE CASCADE,
  CONSTRAINT fk_appointment_doctor FOREIGN KEY (doctor_id) REFERENCES doctors(id) ON DELETE CASCADE
);

CREATE TABLE IF NOT EXISTS bills (
  id INT AUTO_INCREMENT PRIMARY KEY,
  patient_id INT NOT NULL,
  description VARCHAR(255) NOT NULL,
  amount DECIMAL(10,2) NOT NULL,
  bill_date DATE NOT NULL,
  status ENUM('Unpaid','Paid') DEFAULT 'Unpaid',
  created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
  CONSTRAINT fk_bill_patient FOREIGN KEY (patient_id) REFERENCES patients(id) ON DELETE CASCADE
);

-- Demo account. Password: password
-- login.php supports this exact demo password for this sample record.
INSERT IGNORE INTO users (name, email, password)
VALUES ('Administrator', 'admin@hospital.com', 'password');

INSERT INTO doctors (full_name, specialization, phone, email)
SELECT 'Dr. Asha Patel', 'Cardiology', '9876543210', 'asha@example.com'
WHERE NOT EXISTS (SELECT 1 FROM doctors WHERE email='asha@example.com');

INSERT INTO doctors (full_name, specialization, phone, email)
SELECT 'Dr. Rahul Shah', 'General Medicine', '9876543211', 'rahul@example.com'
WHERE NOT EXISTS (SELECT 1 FROM doctors WHERE email='rahul@example.com');
