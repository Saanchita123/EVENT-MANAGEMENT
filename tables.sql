-- This file contains the SQL queries to create the tables in the database
--

--TABLE FOR STUDENT REGISTRATION

CREATE TABLE event_registration_students (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(100) NOT NULL,
    email VARCHAR(100) NOT NULL,
    phone_number VARCHAR(15) NOT NULL,
    education_level VARCHAR(15) NOT NULL,
    degree_obtained VARCHAR(15) NOT NULL,
    institution_name VARCHAR(255) NOT NULL, -- Name of the institution
    graduation_year INT NULL,
    event_name VARCHAR(100) NOT NULL,
    registration_date TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    aadhaar_card_image BLOB, -- This field stores the image (if you plan to store the actual image)
    house_address VARCHAR(255) -- Optional address field
);


-- table for offline event

CREATE TABLE offline_event (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(100) NOT NULL,
    email VARCHAR(100) NOT NULL,
    phone VARCHAR(15) NOT NULL,
    eventname VARCHAR(100) NOT NULL,
    eventdescription TEXT NOT NULL,
    eventtype VARCHAR(100) NOT NULL,
    eventdatefrom DATE NOT NULL,
    eventdateto DATE NOT NULL,
    participants INT NOT NULL,
    image   BLOB,
    eventplace VARCHAR(255) NOT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);



-- table for online event
    CREATE TABLE online_event (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(100) NOT NULL,
    email VARCHAR(100) NOT NULL,
    phone VARCHAR(15) NOT NULL,
    event_name VARCHAR(100) NOT NULL,
    event_description TEXT NOT NULL,
    event_type VARCHAR(100) NOT NULL,
    event_date_from DATE NOT NULL,
    event_date_to DATE NOT NULL,
    participants INT NOT NULL,
    image   BLOB,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);


CREATE TABLE users (
    id INT PRIMARY KEY AUTO_INCREMENT,
    username VARCHAR(50) UNIQUE NOT NULL,
    email VARCHAR(100) UNIQUE NOT NULL,
    full_name VARCHAR(100),
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
);

CREATE TABLE students (
    studentid INT PRIMARY KEY AUTO_INCREMENT,
    name VARCHAR(100) NOT NULL,
    email VARCHAR(100) UNIQUE NOT NULL,
    password_hash VARCHAR(255) NOT NULL,
    phone VARCHAR(20) UNIQUE,
    address TEXT,
    dateofbirth DATE,
    gender ENUM('Male', 'Female', 'Other'),
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    FULLTEXT(name, email, address)
);
