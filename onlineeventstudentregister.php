<?php

// Connect to the database
$conn = new mysqli("localhost", "root", "", "event-registration");

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Fetch event details to display
if (isset($_GET['event_id'])) {
    $event_id = (int)$_GET['event_id'];

    // Query to fetch event name
    $sql = "SELECT event_name FROM online_events WHERE id = $event_id";
    $result = $conn->query($sql);

    if ($result && $result->num_rows > 0) {
        $event = $result->fetch_assoc();
    } else {
        die("Event not found.");
    }
} else {
    die("Invalid request.");
}
// Connect to the database


// Handle form submission
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Get form input values
    $name = $conn->real_escape_string($_POST['name']);
    $email = $conn->real_escape_string($_POST['email']);
    $phone = $conn->real_escape_string($_POST['phone']);
    $education_level = $conn->real_escape_string($_POST['education_level']);
    $degree_obtained = $conn->real_escape_string($_POST['degree_obtained']);
    $institution_name = $conn->real_escape_string($_POST['institution_name']);
    $graduation_year = isset($_POST['graduation_year']) ? (int)$_POST['graduation_year'] : NULL;
    
    $house_address = isset($_POST['house_address']) ? $conn->real_escape_string($_POST['house_address']) : NULL;

    // Handle Aadhaar card image upload
    if (isset($_FILES['aadhaar_card_image']) && $_FILES['aadhaar_card_image']['error'] == 0) {
        $aadhaar_card_image = file_get_contents($_FILES['aadhaar_card_image']['tmp_name']);
    } else {
        echo "<script>alert('enter id proof ');</script>";
    }

    // Insert registration details into the database
    $sql = "INSERT INTO event_registration_students (name, email, phone_number, education_level, degree_obtained, institution_name, graduation_year, eventname, house_address, aadhaar_card_image) 
            VALUES ('$name', '$email', '$phone', '$education_level', '$degree_obtained', '$institution_name', '$graduation_year', '" . $event['event_name'] . "', '$house_address', ?)";

    // Prepare the statement to insert the BLOB
    if ($stmt = $conn->prepare($sql)) {
        $stmt->bind_param("s", $aadhaar_card_image);
        if ($stmt->execute()) {
            // Registration successful - show alert
            echo "<script>alert('Registration successful!');
            window.location.href = 'studentdashboard.php';
            </script>";
         
        } else {
            // Error occurred - show alert
            echo "<script>alert('Error: " . $conn->error . "');</script>";
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Event Registration</title>
    <style>
        *
        {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }
        /* Basic styling */
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            padding: 20px;
            background-image: url('images/registerbackground.jpg');
            background-size: cover;
            background-repeat: no-repeat;
            background-attachment: fixed;

        }
        .container {
            max-width: 600px;
            margin: 0 auto;
            background-color: #fff;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            height: 100%;
        }
        h1 {
            text-align: center;
            margin-bottom: 20px;
        }
        label {
            font-size: 14px;
            margin-bottom: 5px;
        }
        input, textarea, button {
            width: 100%;
            padding: 10px;
            margin-bottom: 10px;
            border: 1px solid #ccc;
            border-radius: 4px;
        }
        button {
            background-color: #28a745;
            color: white;
            border: none;
        }
        button:hover {
            background-color: #218838;
        }
    </style>
</head>
<body>
    <h1>Online Event Form Register</h1>
    <div class="container">
        <h1>Register for Event</h1>
        <form method="POST" action="" enctype="multipart/form-data">
            <label for="name">Full Name:</label>
            <input type="text" id="name" name="name" required>

            <label for="email">Email Address:</label>
            <input type="email" id="email" name="email" required>

            <label for="phone">Phone Number:</label>
            <input type="text" id="phone" name="phone" required>

            <label for="education_level">Education Level:</label>
            <input type="text" id="education_level" name="education_level" required>

            <label for="degree_obtained">Degree Obtained:</label>
            <input type="text" id="degree_obtained" name="degree_obtained" required>

            <label for="institution_name">Institution Name:</label>
            <input type="text" id="institution_name" name="institution_name" required>

            <label for="graduation_year">Graduation Year:</label>
            <input type="number" id="graduation_year" name="graduation_year">

          

            <label for="house_address">House Address:</label>
            <textarea id="house_address" name="house_address"></textarea>

            <label for="aadhaar_card_image">Upload Aadhaar Card Image:</label>
            <input type="file" id="aadhaar_card_image" name="aadhaar_card_image">

            <button type="submit">Register</button>
        </form>
    </div>
</body>
</html>
