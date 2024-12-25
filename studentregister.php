<?php
// Connect to the database
$conn = new mysqli("localhost", "root", "", "event-registration");

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Fetch event details based on event_id
if (isset($_GET['event_id'])) {
    $event_id = $_GET['event_id'];

    $sql = "SELECT * FROM offline_events WHERE id = $event_id";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        $event = $result->fetch_assoc();
    } else {
        die("Event not found.");
    }
} else {
    die("Invalid request.");
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register for Event</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    <div class="container">
        <h1>Register for <?php echo htmlspecialchars($event['eventname']); ?></h1>
        <p><?php echo htmlspecialchars($event['eventdescription']); ?></p>
        <p><strong>Date:</strong> <?php echo htmlspecialchars($event['eventdatefrom']) . " to " . htmlspecialchars($event['eventdateto']); ?></p>
        <p><strong>Place:</strong> <?php echo htmlspecialchars($event['eventplace']); ?></p>

        <form action="submit_registration.php" method="POST">
            <input type="hidden" name="event_id" value="<?php echo $event_id; ?>">

            <label for="name">Name:</label>
            <input type="text" name="name" id="name" required>

            <label for="email">Email:</label>
            <input type="email" name="email" id="email" required>

            <label for="phone">Phone:</label>
            <input type="text" name="phone" id="phone" required>

            <button type="submit" class="register-btn">Submit Registration</button>
        </form>
    </div>
</body>
</html>
