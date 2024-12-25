<?php
session_start();

// Check if the form for event place is submitted
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['submitEventPlace'])) {
    // Store the event place in the session
    $_SESSION['eventplace'] = $_POST['eventplace'];

    // Database connection setup
    $host = 'localhost';
    $db = 'event-registration';
    $user = 'root';
    $pass = '';

    // Create a connection to the database
    $conn = new mysqli($host, $user, $pass, $db);

    // Check the connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    // Retrieve data from session variables
    $name = $_SESSION['name'] ?? null;
    $email = $_SESSION['email'] ?? null;
    $phone = $_SESSION['phone'] ?? null;
    $eventname = $_SESSION['eventname'] ?? null;
    $eventdescription = $_SESSION['eventdescription'] ?? null;
    $eventtype = $_SESSION['eventtype'] ?? null;
    $eventdatefrom = $_SESSION['eventdatefrom'] ?? null;
    $eventdateto = $_SESSION['eventdateto'] ?? null;
    $participants = $_SESSION['participants'] ?? null;
    $eventplace = $_SESSION['eventplace'] ?? null;
    $imagePath = $_SESSION['image'] ?? null; // Path to the uploaded image file

    // Check if required fields are present
    if (!$name || !$email || !$phone || !$eventname || !$eventdescription || !$eventtype || !$eventdatefrom || !$eventdateto || !$participants || !$eventplace || !$imagePath) {
        echo "Error: One or more required fields are missing.";
        exit;
    }

    // Insert data into the database
    $sql = "INSERT INTO offline_events (name, email, phone, eventname, eventdescription, eventtype, eventdatefrom, eventdateto, participants, eventplace, image)
            VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";

    // Prepare the SQL statement
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("sssssssssss", $name, $email, $phone, $eventname, $eventdescription, $eventtype, $eventdatefrom, $eventdateto, $participants, $eventplace, $imagePath);

    // Execute the statement
    if ($stmt->execute()) {
        echo "<script>
            alert('Submission Successful! Thank you, $name! Your event \"$eventname\" has been successfully submitted.');
            window.location.href = 'dashboard.php';
        </script>";
    } else {
        echo "<p>Error: " . $stmt->error . "</p>";
    }

    // Close the statement and connection
    $stmt->close();
    $conn->close();

    // Clear session data after submission
    session_unset();
    session_destroy();
}
?>
