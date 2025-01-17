<?php
// Start the session
session_start();

// Check if the user is logged in
if (!isset($_SESSION['studentid'])) {
    echo "<script>alert('Please log in to view your events.'); window.location.href = 'login.php';</script>";
    exit();
}

// Database configuration
$host = "localhost";
$username = "root";
$password = "";
$dbname = "event-registration";

// Create a database connection
$conn = new mysqli($host, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Fetch the student ID from the session
$studentid = $_SESSION['studentid'];

// Fetch registered events for the student
$sql = "SELECT eventname, registration_date FROM event_registration_students WHERE studentid = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $studentid);
$stmt->execute();
$result = $stmt->get_result();

// Initialize an array to store events
$events = [];
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $events[] = $row;
    }
} else {
    $events = null;
}

$stmt->close();
$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>My Events</title>
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Jost:ital,wght@0,100..900;1,100..900&family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&family=Quicksand:wght@300..700&family=Space+Grotesk:wght@300..700&display=swap');

        
        body {
            font-family: quicksand;
            margin: 0;
            padding: 0;
            background-color: #f4f4f4;
        }
        .container {
            max-width: 800px;
            margin: 50px auto;
            padding: 20px;
            background: #fff;
            border-radius: 10px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
        }
        h1 {
            text-align: center;
            color: #333;
        }
        .event {
            border-bottom: 1px solid #ddd;
            padding: 10px 0;
        }
        .event:last-child {
            border-bottom: none;
        }
        .event h2 {
            margin: 0;
            color: #444;
        }
        .event p {
            margin: 5px 0;
            color: #666;
        }
        .no-events {
            text-align: center;
            color: #666;
            font-size: 18px;
            margin-top: 20px;
        }



        /* NAV BAR */


        

nav
{
    display:flex;
    justify-content: space-between;
    align-items: center;
    background:#000000;
    z-index: 1;
    /* font-family: poppins; */
    padding: 5px;
    color: #fff;
  
}
.logo
{
    color: white;
    font-size: 1.5rem;
    margin-left: 1rem;
    font-weight: bold;
    text-decoration: none;
    cursor: pointer;
}
nav ul
{
    display: flex;
    justify-content: center;
    align-items: center;
    margin-right: 1rem;
}
nav ul li 
{
    list-style: none;
    border-radius: 5px;
    padding: 5px;
    /* transition: 1s ease; */

}
nav ul li:hover
{
    background: #1D719D;
    transition: 1s ease;
}
nav ul li a
{
    color: white;
    text-decoration: none;
    padding:10px;
    margin: 0 1rem;
    transition: all 0.3s ease;
}
    </style>
</head>
<body>
<nav>
            <div class="logo">LOGO</div>
                <ul>
                    <li><a href="studentdashboard.php">Home</a></li>
                    <li><a href="myevents.php">My Events</a></li>
                    <li><a href="studentprofilepage.php">profile</a></li>
                </ul>
            </nav>
    <div class="container">
        <h1>My Registered Events</h1>
        <?php if ($events): ?>
            <?php foreach ($events as $event): ?>
                <div class="event">
                    <h2><?php echo htmlspecialchars($event['eventname']); ?></h2>
                    <p><strong>Date:</strong> <?php echo htmlspecialchars($event['registration_date']); ?></p>
                   
                </div>
            <?php endforeach; ?>
        <?php else: ?>
            <p class="no-events">You have not registered for any events.</p>
        <?php endif; ?>
    </div>
</body>
</html>
