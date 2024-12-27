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
$sql_event = "SELECT * FROM offline_events WHERE id = ?";
$stmt_event = $conn->prepare($sql_event);
$stmt_event->bind_param("i", $event_id);
$stmt_event->execute();
$event_result = $stmt_event->get_result();
$event = $event_result->fetch_assoc();
//

//new code to het the student register
// Prepare the SQL query
$sql_users = "SELECT s.name, s.email, s.phone
              FROM studentregister s
              INNER JOIN event_registration_students e ON s.email = e.email
              WHERE e.eventname = ?";  
            //   have to change the condition to event_id

// Prepare statement
$stmt_users = $conn->prepare($sql_users);

// Bind the parameter (event_id)
$stmt_users->bind_param("i", $event_id);

// Execute the query
$stmt_users->execute();

// Get the result
$users_result = $stmt_users->get_result();

// Fetch data
while ($user = $users_result->fetch_assoc()) {
    echo "Name: " . $user['firstname'] . " " . $user['lastname'] . "<br>";
    echo "Email: " . $user['email'] . "<br>";
    echo "Phone: " . $user['phone_number'] . "<br>";
    echo "Event: " . $user['eventname'] . "<br><br>";
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Event</title>
    <style>
        /* Global styles */
        body {
            font-family: 'Arial', sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            padding: 0;
            color: #333;
           display: flex;
            justify-content: center;
            align-items: center;
            flex-direction: column;
           
        }

        h1, h2 {
            color: #003366;
        }

        /* Container for the main content */
        .container {
            /* width: 80%; */
            max-width: 1000px;
            margin: 40px auto;
            padding: 20px;
            background-color: #ffffff;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
            border-radius: 8px;
           
        }

        /* Form styles */
        form {
            display: flex;
            flex-direction: column;
            width: 800px;
            box-sizing: border-box;
            border-radius: 8px;
            padding: 10px;
           box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
           
        }

        label {
            font-weight: bold;
            margin-top: 10px;
        }

        input, textarea {
            padding: 10px;
            margin-top: 5px;
            margin-bottom: 15px;
            border: 1px solid #ccc;
            border-radius: 4px;
            font-size: 1rem;
        }

        input[type="date"] {
            padding: 8px;
        }

        input[type="number"] {
            width: 60px;
        }

        button {
            padding: 12px 20px;
            background-color: #003366;
            color: white;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            font-size: 1rem;
            width: 180px;
        }

        button:hover {
            background-color: #00509E;
        }

        /* Registered participants list */
        ul {
            list-style-type: none;
            padding: 0;
        }

        li {
            padding: 10px;
            background-color: #f9f9f9;
            margin-bottom: 10px;
            border: 1px solid #ddd;
            border-radius: 4px;
        }

        li:nth-child(even) {
            background-color: #f1f1f1;
        }

        /* Responsive styling */
        @media (max-width: 768px) {
            .container {
                width: 90%;
            }

            input, textarea {
                font-size: 0.9rem;
            }

            button {
                font-size: 1rem;
                padding: 10px 18px;
            }
        }
    </style>
</head>
<body>
    <h1>Edit Event: <?php echo htmlspecialchars($event['eventname']); ?></h1>
    <form action="updateevent11.php" method="POST">
        <input type="hidden" name="event_id" value="<?php echo $event['id']; ?>">
        <label for="eventname">Event Name:</label><br>
        <input type="text" id="eventname" name="eventname" value="<?php echo htmlspecialchars($event['eventname']); ?>" required><br><br>
        
        <label for="eventtype">Event Type:</label><br>
        <input type="text" id="eventtype" name="eventtype" value="<?php echo htmlspecialchars($event['eventtype']); ?>" required><br><br>
        
        <label for="eventdescription">Event Description:</label><br>
        <textarea id="eventdescription" name="eventdescription" required><?php echo htmlspecialchars($event['eventdescription']); ?></textarea><br><br>
        
        <label for="eventdatefrom">From:</label><br>
        <input type="date" id="eventdatefrom" name="eventdatefrom" value="<?php echo htmlspecialchars($event['eventdatefrom']); ?>" required><br><br>
        
        <label for="eventdateto">To:</label><br>
        <input type="date" id="eventdateto" name="eventdateto" value="<?php echo htmlspecialchars($event['eventdateto']); ?>" required><br><br>
        
        <label for="participants">Participants:</label><br>
        <input type="number" id="participants" name="participants" value="<?php echo htmlspecialchars($event['participants']); ?>" required><br><br>
        
        <button type="submit">Update Event</button>
    </form>
    
    <h2>Registered Participants</h2>
    <?php if ($users_result->num_rows > 0): ?>
        <ul>
            <?php while ($user = $users_result->fetch_assoc()): ?>
                <li><?php echo htmlspecialchars($user['name'] . " " . $user['lastname']) . " (" . htmlspecialchars($user['email']) . ") - " . htmlspecialchars($user['phone']); ?></li>
            <?php endwhile; ?>
        </ul>
    <?php else: ?>
        <p>No participants registered yet.</p>
    <?php endif; ?>
    
    <?php $stmt_event->close(); $stmt_users->close(); $conn->close(); ?>
</body>
</html>
