<?php
// Database connection details
$host = 'localhost'; // your server
$dbname = 'event-registration'; // replace with your database name
$username = 'root'; // replace with your database username
$password = ''; // replace with your database password

// Create a connection
$conn = new mysqli($host, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

session_start();

// Check if phone number is set in the session
if (!isset($_SESSION['user_phone'])) {
    die("Error: User phone number not set. Please log in.");
}

$loggedInPhone = $_SESSION['user_phone'];

// Check if phone number exists in the users table
$sqlCheckPhone = "SELECT phone FROM users WHERE phone = ?";
$stmtCheckPhone = $conn->prepare($sqlCheckPhone);
$stmtCheckPhone->bind_param("s", $loggedInPhone);
$stmtCheckPhone->execute();
$resultCheckPhone = $stmtCheckPhone->get_result();

if ($resultCheckPhone->num_rows === 0) {
    die("Error: Phone number not found in users table.");
}

// SQL query to fetch events based on phone number
$sqlOffline = "SELECT * FROM offline_events WHERE phone = ?";
$sqlOnline = "SELECT * FROM online_events WHERE phone = ?";

// Prepare statements for offline and online events
$stmtOffline = $conn->prepare($sqlOffline);
$stmtOnline = $conn->prepare($sqlOnline);

// Bind parameters
$stmtOffline->bind_param("s", $loggedInPhone);
$stmtOnline->bind_param("s", $loggedInPhone);

// Execute statements and get results
$stmtOffline->execute();
$resultOffline = $stmtOffline->get_result();

$stmtOnline->execute();
$resultOnline = $stmtOnline->get_result();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Event Dashboard</title>
    <link rel="stylesheet" href="style1.css">
    <style>
        /* Basic styles for layout */
        body {
            font-family: 'Poppins', sans-serif;
            color: white;
            
            text-align: center;
        }
        h2, h3 {
            color: #ffdf91;
            margin-top: 20px;
        }
        .event-container {
            display: flex;
            flex-wrap: wrap;
            justify-content: center;
            gap: 20px;
            margin-top: 20px;
        }
        .event-card {
            width: 250px;
            background-color: #1b4854;
            border-radius: 10px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
            color: white;
            text-align: center;
            overflow: hidden;
        }
        .event-card img {
            width: 100%;
            height: 150px;
            object-fit: cover;
        }
        .event-card h4 {
            padding: 10px;
            color: #ffdf91;
        }
        .event-card button {
            background-color: #ffdf91;
            color: #176368;
            border: none;
            padding: 10px;
            width: 100%;
            cursor: pointer;
        }
        .event-card button:hover {
            background-color: #e5c278;
        }
        form
        {
            box-shadow:none;
            display: inline;
            justify-content:center;
            align-items:center;
        }
    </style>
</head>
<nav class="navbar">
        <div class="menu-toggle" id="menu-toggle">
            <div class="hamburger"></div>
        </div>
        <ul class="nav-links" id="nav-links">
            <li><a href="dashboard.php">Dashboard</a></li>
            <li><a href="finalevent.php">Events</a></li>
            <li><a href="collegeupdate.php">College Updates</a></li>
            <li><a href="eventdetails.php">Help Center</a></li>
           <li><a href="logout.php"><img src="images/Group 109.png" alt="" style="width: 50px;cursor: pointer;" onclick=""></a>
           </li>
        </ul>
    </nav>
<body>

<?php
// Display events if any are found
if ($resultOffline->num_rows > 0 || $resultOnline->num_rows > 0) {
    echo "<h2>Events associated with phone number: $loggedInPhone</h2>";
    echo "<div class='event-container'>"; // Event container div starts here

    // Offline Events
    if ($resultOffline->num_rows > 0) {
        while ($row = $resultOffline->fetch_assoc()) {
            echo "<div class='event-card'>
                    <img src='{$row['image']}' alt='Event Image'>
                    <h4>{$row['eventname']}</h4>
                    <form action='eventdetails1.php' method='GET'>
                        <input type='hidden' name='event_id' value='{$row['id']}'>
                        <button type='submit'>View More</button>
                    </form>
                </div>";
        }
    }

    // Online Events
    if ($resultOnline->num_rows > 0) {
        while ($row = $resultOnline->fetch_assoc()) {
            echo "<div class='event-card'>
                    <img src='{$row['image']}' alt='Event Image'>
                    <h4>{$row['event_name']}</h4>
                    <form action='editevent1.php' method='GET'>
                        <input type='hidden' name='event_id' value='{$row['id']}'>
                        <button type='submit'>View More</button>
                    </form>
                </div>";
        }
    }
    echo "</div>"; // End of event container div
} else {
    echo "<p>No events found for the phone number: $loggedInPhone</p>";
}
?>

<form method="post">
    <button type="submit" name="show_students">Show Registered Students</button>
</form>

<?php
// Display registered students if requested
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['show_students'])) {
    $sqlStudents = "SELECT * FROM users";
    $resultStudents = $conn->query($sqlStudents);

    if ($resultStudents->num_rows > 0) {
        echo "<h3>Registered Students</h3>";
        echo "<table>
                <tr>
                    <th>ID</th>
                    <th>First Name</th>
                    <th>Last Name</th>
                    <th>Phone</th>
                    <th>Email</th>
                </tr>";
        while ($row = $resultStudents->fetch_assoc()) {
            echo "<tr>
                    <td>{$row['id']}</td>
                    <td>{$row['firstname']}</td>
                    <td>{$row['lastname']}</td>
                    <td>{$row['phone']}</td>
                    <td>{$row['email']}</td>
                </tr>";
        }
        echo "</table>";
    } else {
        echo "<p>No registered students found.</p>";
    }
}
?>

<?php
// Close statements and connection
$stmtOffline->close();
$stmtOnline->close();
$stmtCheckPhone->close();
$conn->close();
?>
</body>
</html>
