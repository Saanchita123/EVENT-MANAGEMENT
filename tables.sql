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
