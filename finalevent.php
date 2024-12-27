<?php
// Include database connection
include 'connect.php'; // Ensure this contains your DB connection

// Check if the Online Form is submitted
if (isset($_POST['submitOnline'])) {
    $name = $_POST['name'];
    $email = $_POST['email'];
    $phone = $_POST['phone'];
    $event_name = $_POST['event-name'];
    $event_description = $_POST['event-description'];
    $event_type = $_POST['event-type'];
    $event_date_from = $_POST['event-date-from'];
    $event_date_to = $_POST['event-date-to'];
    $participants = $_POST['participants'];

    // Handle file upload
    $image = $_FILES['image']['name'] ?? '';
    $target_dir = "uploads/"; // Specify the directory for uploads
    $target_file = $target_dir . basename($image);
    $uploadOk = 1;
    $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));

    // Check if the file is selected and uploaded
    if (!empty($image) && is_uploaded_file($_FILES['image']['tmp_name'])) {
        // Check if the file is an image
        $check = getimagesize($_FILES['image']['tmp_name']);
        if ($check === false) {
            echo "File is not an image.";
            $uploadOk = 0;
        }

        // Check file size (example: limit to 5MB)
        if ($_FILES['image']['size'] > 5000000) {
            echo "Sorry, your file is too large.";
            $uploadOk = 0;
        }

        // Allow certain file formats
        if (!in_array($imageFileType, ['jpg', 'png', 'jpeg', 'gif'])) {
            echo "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
            $uploadOk = 0;
        }

        // Check if $uploadOk is set to 0 by an error
        if ($uploadOk == 0) {
            echo "Sorry, your file was not uploaded.";
        } else {
            // If everything is ok, try to upload the file
            if (move_uploaded_file($_FILES['image']['tmp_name'], $target_file)) {
                // Insert into online_events table
                $stmt = $pdo->prepare("INSERT INTO online_events (name, email, phone, event_name, event_description, event_type, event_date_from, event_date_to, participants, image) 
                                        VALUES (:name, :email, :phone, :event_name, :event_description, :event_type, :event_date_from, :event_date_to, :participants, :image)");
                $stmt->execute([
                    'name' => $name,
                    'email' => $email,
                    'phone' => $phone,
                    'event_name' => $event_name,
                    'event_description' => $event_description,
                    'event_type' => $event_type,
                    'event_date_from' => $event_date_from,
                    'event_date_to' => $event_date_to,
                    'participants' => $participants,
                    'image' => $target_file // Store the path to the uploaded file
                ]);

                echo "<script>
                        alert('Event created successfully');
                      </script>";
            } else {
                echo "Sorry, there was an error uploading your file.";
            }
        }
    } else {
        echo "No file uploaded or invalid file.";
    }
}
?>



<!-- <!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Offline Event Place</title>
    <style>
        /* input[type="text"], input[type="submit"] {
            width: 100%;
            padding: 10px;
            margin: 5px 0;
        } */
    </style>
</head>
<body> -->
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="eventstyle.css">
    <title>Online and Offline Forms</title>
    <style>
        /* Include your styles here */
        * {
          
            margin: 0;
            padding: 0;
            font-family: 'Poppins', sans-serif;
            font-family: poppins;
        }

        body {
        
            color: #005D6C;
        }

        .event-form {
            text-align: center;
            margin: 20px 0;
            background-color: #D0F7F4;
        }

        .button-container {
            display: flex;
            justify-content: center;
            align-items: center;
            margin: 20px 0;
            gap: 10px;
            background-color: #D0F7F4;
        }

        .button-container button {
            display: flex;
            justify-content: center;
            align-items: center;
            gap: 10px;
            width: 200px;
            height: 50px;
            border-radius: 4px;
            border: 1px solid #ccc;
            font-size: 19px;
            font-weight: 600;
            cursor: pointer;
            color: rgb(0, 0, 0);
            transition: background-color 0.3s, border-color 0.3s;

        }

        .highlightable {
            padding: 10px 20px;
            background: #ffffff;
        }

        .highlighted {
            background: linear-gradient(#005D6C, #4ECCA3);
            color: rgb(0, 0, 0);
        }

        .circle1, .circle2 {
            width: 10px;
            height: 10px;
            border-radius: 50%;
        }

        .circle1 {
            background-color: #05FF00;
        }

        .circle2 {
            background-color: #FF0000;
        }

        .form-container {
            display: flex;
            justify-content: center;
            align-items: center;
            flex-direction: column;
            margin-top: 20px;
            padding: 10px;
            background-color: #D0F7F4;
        }
        .submit-button {
            background: linear-gradient(#005D6C, #4ECCA3);
            color: white;
            border: none;
            border-radius: 6px;
            cursor: pointer;
            padding: 10px;
           width: 200px;
           height: 50px;
          
        }

        form {
            display: none; /* Hide forms initially */
            flex-direction: column;
            gap: 15px;
            width: 100%;
            max-width: 1000px;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 0 15px rgba(0, 0, 0, 0.1);
            background-color: #D0F7F4;
        }

        form.active {
            display: flex;
        justify-content: center;
                align-items: left; /* Show active form */
        }
        form.active .submit-button {
          margin: 20px auto;
        }

        form label {
            font-weight: bold;
        }

        form input[type="text"],
        form input[type="email"],
        form input[type="tel"],
        form input[type="date"],
        form select,
        form textarea {
            width: 90%;
            padding: 10px;
            border-radius: 6px;
            border: 1px solid #ccc;
            font-size: 16px;
        }

        form textarea {
            resize: none; /* Prevent resizing */
        }

        form input[type="submit"] {
            background: linear-gradient(#005D6C, #4ECCA3);
            color: white;
            border: none;
            border-radius: 6px;
            cursor: pointer;
            padding: 10px;
            font-size: 16px;
        }
        
.nav-links {
    list-style: none;
    display: flex;
    margin: 0;
    padding: 0;
    transition: transform 0.3s ease-in-out;
    justify-content: center;
    align-items: CENTER;
}

        @media (max-width: 600px) {
            .button-container {
                flex-direction: column; /* Stack buttons on small screens */
            }

            .button-container button {
                width: 100%;
                max-width: 300px;
            }
        }
    </style>
    <script>
        // JavaScript function to toggle between the forms
        function showForm(formType) {
            const onlineForm = document.getElementById('onlineform');
            const offlineForm = document.getElementById('offlineform');
            
            if (formType === 'online') {
                onlineForm.classList.add('active');
                offlineForm.classList.remove('active');
            } else {
                offlineForm.classList.add('active');
                onlineForm.classList.remove('active');
            }
        }

        function highlightButton(button) {
            const buttons = document.getElementsByClassName('highlightable');
            for (let i = 0; i < buttons.length; i++) {
                buttons[i].classList.remove('highlighted');
            }
            button.classList.add('highlighted');
        }

        // Ensure default state on page load
        window.onload = function() {
            // Show the online form and highlight the online button by default
            showForm('online');
        };
    </script>
</head>
<body>

    <nav class="navbar">
        <div class="menu-toggle" id="menu-toggle">
            <div class="hamburger"></div>
        </div>
        <ul class="nav-links" id="nav-links">
            <li><a href="dashboard.php">Dashboard</a></li>
            <li><a href="finalevent.php">Events</a></li>
            <li><a href="collegeupdate.php">College Updates</a></li>
            <li><a href="eventdetails.php">Help Center</a></li>
            <li><div id="logout-button"><a href="logout.php"><img src="images/Group 109.png" alt="" style="width: 50px;cursor: pointer;" onclick=""></a></div> </li>
        </ul>
    </nav>

    <div class="event-form">
        <h1>Host an Event</h1>
        <p>Host and manage an event in just a few clicks!</p>
    </div>

    <div class="button-container">
        <!-- Buttons to choose between Online and Offline forms -->
        <button id="button1" class="highlightable highlighted" onclick="showForm('online'); highlightButton(this)"><div class="circle1"></div>Online Form</button>
        <button id="button2" class="highlightable" onclick="showForm('offline'); highlightButton(this)"><div class="circle2"></div>Offline Form</button>
    </div>

    <div class="form-container">
        <!-- Online Form -->
        <form id="onlineform" method="post" action="" enctype="multipart/form-data">
            <h1>Proceed with your application by filling out the form below</h1>

            <label for="name">Your Name *</label>
            <input type="text" id="name" name="name" required>

            <label for="email">Your Email *</label>
            <input type="email" id="email" name="email" required>

            <label for="phone">Your Phone No. *</label>
            <input type="tel" id="phone" name="phone" required>

            <label for="event-name">Event Name *</label>
            <input type="text" id="event-name" name="event-name" required>

            <label for="event-description">Event Description *</label>
            <textarea id="event-description" name="event-description" rows="4" required></textarea>

            <label for="event-type">Choose Event Type *</label>
            <select id="event-type" name="event-type" required>
                <option value="college-event">College Event</option>
                <option value="corporate-event">Corporate Event</option>
                <option value="wedding">Wedding</option>
                <option value="birthday-party">Birthday Party</option>
            </select>

            <label for="event-date-from">Event Date *</label>
            <div>
                <input type="date" id="event-date-from" name="event-date-from" required><br>
                <span>To</span><br>
                <input type="date" id="event-date-to" name="event-date-to" required>
            </div>

            <label for="participants">Expected Participants Count *</label>
            <input type="text" id="participants" name="participants" required>

            <label for="image">Upload Image *</label>
<input type="file" id="image" name="image" accept="image/*" required>


            <input type="submit" name="submitOnline" value="Submit Online" id="submitOnline" class="submit-button">
        </form>


        <!-- offlineform on the first page -->
<form id="offlineform" method="POST" action="final_eventplace.php" enctype="multipart/form-data">
<h1>Proceed with your application by filling out the form below</h1>
    <label for="name">Your Name *</label>
    <input type="text" id="name" name="name" required>

    <label for="email">Your Email *</label>
    <input type="email" id="email" name="email" required>

    <label for="phone">Your Phone No. *</label>
    <input type="tel" id="phone" name="phone" required>

    <label for="eventname">Event Name *</label>
    <input type="text" id="eventname" name="eventname" required>

    <label for="eventdescription">Event Description *</label>
    <textarea id="eventdescription" name="eventdescription" rows="4" required></textarea>

    <label for="eventtype">Choose Event Type *</label>
    <select id="eventtype" name="eventtype" required>
        <option value="collegeevent">College Event</option>
        <option value="corporateevent">Corporate Event</option>
        <option value="wedding">Wedding</option>
        <option value="birthdayparty">Birthday Party</option>
    </select>

    <label for="eventdatefrom">Event Date *</label>
    <div>
        <input type="date" id="eventdatefrom" name="eventdatefrom" required><br>
        <span>To</span><br>
        <input type="date" id="eventdateto" name="eventdateto" required>
    </div>

    <label for="participants">Expected Participants Count *</label>
    <input type="text" id="participants" name="participants" required>

    <label for="image">Upload Image *</label>
<input type="file" id="image" name="image" accept="image/*" required>


    <input type="submit" name="submitOffline" value="Next">
</form>
    </div>
    <script src="script.js"></script>
</body>
</html>
