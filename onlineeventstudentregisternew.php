<!-- PHO CODE  -->


<?php


// Start the session
session_start();

// Check if the user is logged in
if (!isset($_SESSION['studentid'])) {
    echo "<script>alert('Please log in to register for events.'); window.location.href = 'login.php';</script>";
    exit();
}



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

    //  NEW PART OF PHP CODE TO FETCH THE USER DETSILS THROUGH THE STUDENT ID

    // Start the session
    

     // Fetch student details from the session
     $studentid = $_SESSION['studentid'];

     // Fetch additional details from the database (optional, based on your schema)
     $sql = "SELECT name, email FROM studentregister WHERE studentid = ?";
     $stmt = $conn->prepare($sql);
     $stmt->bind_param("i", $studentid);
     $stmt->execute();
     $result = $stmt->get_result();
     $student = $result->fetch_assoc();
 
     if (!$student) {
         echo "<script>alert('Student not found. Please log in again.'); window.location.href = 'login.php';</script>";
         exit();
     }

    //  NEW PART OF PHP CODE TO FETCH THE USER DETSILS THROUGH THE STUDENT ID

    // Get form input values
    $name = $conn->real_escape_string($_POST['name']);
    $email = $conn->real_escape_string($_POST['email']);
    $phone = $conn->real_escape_string($_POST['phone']);
    $education_level = $conn->real_escape_string($_POST['education_level']);
    $zip_code = $conn->real_escape_string($_POST['zip_code']);
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
    $sql = "INSERT INTO event_registration_students (name, email, phone_number, education_level, zip_code, institution_name, graduation_year, eventname, house_address, aadhaar_card_image , studentid) 
            VALUES ('$name', '$email', '$phone', '$education_level', '$zip_code', '$institution_name', '$graduation_year', '" . $event['eventname'] . "', '$house_address', ?, '$studentid')";

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

<!-- PHP CODE -->


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Address Form</title>
    
    <style>



      
@import url('https://fonts.googleapis.com/css2?family=Jost:ital,wght@0,100..900;1,100..900&family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&family=Quicksand:wght@300..700&family=Space+Grotesk:wght@300..700&display=swap');

        




/*  */
        body {
            font-family:quicksand;
            background-color: #f5f5f5;
            display: flex;
            justify-content: center;
            align-items: center;
            /* height: 100vh; */
            margin: 0;
            flex-direction: column;
        }
        a
        {
            text-decoration: none;
            color: black;
        }

        .form-container {
            background-color: #fff;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            width: 500px;
            position: relative;
        }

        .form-container h2 {
            margin-bottom: 20px;
            font-size: 18px;
            text-align: center;
        }

        .form-group {
            display: flex;
            flex-direction: column;
            margin-bottom: 15px;
        }

        .form-group label {
            margin-bottom: 5px;
            font-size: 14px;
            color: #333;
        }

        .form-group input, .form-group select {
            width: 100%;
            padding: 10px;
            font-size: 14px;
            border: 1px solid #ccc;
            border-radius: 5px;
            box-sizing: border-box;
        }

        .form-group input:focus, .form-group select:focus {
            border-color: #6200ea;
            outline: none;
        }

        .file-upload {
            display: flex;
            align-items: center;
            justify-content: center;
            border: 2px dashed #ccc;
            border-radius: 5px;
            padding: 10px;
            height: 100px;
            text-align: center;
            cursor: pointer;
            position: relative;
        }

        .file-upload:hover {
            border-color: #6200ea;
        }

        .file-upload input[type="file"] {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            opacity: 0;
            cursor: pointer;
        }

        .file-upload span {
            color: #999;
            font-size: 14px;
        }

        .file-upload .file-name {
            font-size: 14px;
            color: #333;
            margin-top: 10px;
        }

        .row {
            display: flex;
            justify-content: space-between;
            gap: 10px;
        }

        .row .form-group {
            flex: 1;
        }

        .submit-button {
            width: 100%;
            padding: 10px;
            font-size: 16px;
            background-color: #6200ea;
            color: #fff;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            text-align: center;
        }

        .submit-button:hover {
            background-color: #5300d6;
        }

        .close-button {
            position: absolute;
            top: 10px;
            right: 10px;
            background: none;
            border: none;
            font-size: 18px;
            cursor: pointer;
        }
    </style>
</head>
<body>
    <h1>Event Registration</h1>
    <div class="form-container">
        <button class="close-button"><a href="studentdashboard.php">&times;</a></button>
        <h2><?php echo htmlspecialchars($event['event_name']); ?></h2>
        <form method="post" enctype="multipart/form-data">
            <div class="form-group">
                <label for="name">Name</label>
                <input type="text" id="name" name="name" placeholder="John Doe">
            </div>
            <div class="form-group">
                <label for="email">Email</label>
                <input type="email" id="email" name="email" placeholder="john.doe@gmail.com">
            </div>
            <div class="form-group">
                <label for="address">Address</label>
                <input type="text" id="address" name="house_address" placeholder="Address">
            </div>
            <div class="row" >
                <div class="form-group " >
                    <label for="zip-code">Zip Code</label>
                    <input type="text" id="zip-code" name="zip_code" placeholder="700000" >
                </div>
                <div class="form-group">
                    <label for="contact">Contact</label>
                    <div style="display: flex; gap: 5px;">
                        <select id="country-code" name="country_code" style="width:60%;">
                          
                        </select>
                        <input type="text" id="contact" name="phone" placeholder="0000 000000">
                    </div>
                </div>
            </div>
            <div class="form-group">
                <label for="institute">Institute Name</label>
                <input type="text" id="institute" name="institution_name" placeholder="Institute Name">
            </div>
            <div class="row">
                <div class="form-group">
                    <label for="education">Education Level</label>
                    <input type="text" id="education" name="education_level" placeholder="B. Tech">
                </div>
                <div class="form-group">
                    <label for="graduation">Graduation Year</label>
                    <input type="text" id="graduation" name="graduation_year" placeholder="2026">
                </div>
            </div>
            <div class="form-group">
                <label for="aadhaar">Upload Aadhaar Card</label>
                <div class="file-upload">
                    <input type="file" id="aadhaar" name="aadhaar_card_image" onchange="displayFileName(this)">
                    <span>Please upload an image, size less than 100KB</span>
                </div>
                <div class="file-name" id="file-name"></div>
            </div>
            <button type="submit" class="submit-button">Submit</button>
        </form>
    </div>

    <script>
        function displayFileName(input) {
            const fileNameDisplay = document.getElementById('file-name');
            if (input.files && input.files[0]) {
                fileNameDisplay.textContent = `Uploaded file: ${input.files[0].name}`;
            } else {
                fileNameDisplay.textContent = '';
            }
        }

        async function fetchCountryCodes() {
            const select = document.getElementById('country-code');
            try {
                const response = await fetch('https://restcountries.com/v3.1/all');
                const countries = await response.json();
                const options = countries
    .map(
        (country) => {
            const root = country.idd?.root || '';
            const suffix = country.idd?.suffixes?.[0] || '';
            return root && suffix
                ? `<option value="${root}${suffix}">${country.flag} ${root}${suffix}</option>`
                : '';
        }
    )
    .join('');
    select.innerHTML = `<option value="+91">🇮🇳 +91</option>` + options;


            } catch (error) {
                select.innerHTML = '<option value="">Error loading codes</option>';
                console.error('Error fetching country codes:', error);
            }
        }

        fetchCountryCodes();
    </script>
</body>
</html>
