<?php
// Database connection
$host = "localhost";
$user = "root";
$password = "";
$database = "event-registration";

$conn = new mysqli($host, $user, $password, $database);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Fetch event details
$event_id = $_GET['event_id'];
$sql_event = "SELECT * FROM online_events WHERE id = ?";
$stmt_event = $conn->prepare($sql_event);
$stmt_event->bind_param("i", $event_id);
$stmt_event->execute();
$event_result = $stmt_event->get_result();
$event = $event_result->fetch_assoc();

// Fetch participants (users who registered for the event)
// $sql_users = "SELECT firstname, lastname, email, phone FROM users 
//               INNER JOIN registrations ON users.email = registrations.user_email
//               WHERE registrations.event_id = ?";
// $stmt_users = $conn->prepare($sql_users);
// $stmt_users->bind_param("i", $event_id);
// $stmt_users->execute();
// $users_result = $stmt_users->get_result();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Event</title>
</head>
<body>
    <h1>Edit Event: <?php echo htmlspecialchars($event['event_name']); ?></h1>
    <form action="updateevent11.php" method="POST">
        <input type="hidden" name="event_id" value="<?php echo $event['id']; ?>">
        <label for="event_name">Event Name:</label><br>
        <input type="text" id="event_name" name="event_name" value="<?php echo htmlspecialchars($event['event_name']); ?>" required><br><br>
        
        <label for="event_type">Event Type:</label><br>
        <input type="text" id="event_type" name="event_type" value="<?php echo htmlspecialchars($event['event_type']); ?>" required><br><br>
        
        <label for="event_description">Event Description:</label><br>
        <textarea id="event_description" name="event_description" required><?php echo htmlspecialchars($event['event_description']); ?></textarea><br><br>
        
        <label for="event_date_from">From:</label><br>
        <input type="date" id="event_date_from" name="event_date_from" value="<?php echo htmlspecialchars($event['event_date_from']); ?>" required><br><br>
        
        <label for="event_date_to">To:</label><br>
        <input type="date" id="event_date_to" name="event_date_to" value="<?php echo htmlspecialchars($event['event_date_to']); ?>" required><br><br>
        
        <label for="participants">Participants:</label><br>
        <input type="number" id="participants" name="participants" value="<?php echo htmlspecialchars($event['participants']); ?>" required><br><br>
        
        <button type="submit">Update Event</button>
    </form>
    
    <h2>Registered Participants</h2>
    <?php if ($users_result->num_rows > 0): ?>
        <ul>
            <?php while ($user = $users_result->fetch_assoc()): ?>
                <li><?php echo htmlspecialchars($user['firstname'] . " " . $user['lastname']) . " (" . htmlspecialchars($user['email']) . ") - " . htmlspecialchars($user['phone']); ?></li>
            <?php endwhile; ?>
        </ul>
    <?php else: ?>
        <p>No participants registered yet.</p>
    <?php endif; ?>
    
    <?php $stmt_event->close(); $stmt_users->close(); $conn->close(); ?>
</body>
</html>
