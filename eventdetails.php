<?php

$host = 'localhost'; 
$dbname = 'event-registration'; 
$username = 'root';
$password = ''; 

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
            font-family:  sans-serif;
            color:black;
            text-align: center;
        }
       
        .event-container {
            display: flex;
            flex-wrap: wrap;
            justify-content: center;
            gap: 20px;
            margin-top: 20px;
        }
        .event-card {
    padding: 10px;
    width: 350px;
    background-color: white;
    border-radius: 10px;
    box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
    color: #000000;
    text-align: center;
        }
        .event-card img {
            width: 100%;
            height: 150px;
            object-fit: cover;
        }
        .event-card h4 {
            padding: 10px;
            color:rgb(0, 0, 0);
        }
        .event-card button {
            background-color:rgb(0, 89, 153);
            color:white;
            border: none;
            padding: 10px;
            width: 200px;
            cursor: pointer;
            border-radius:10px;
        }
        #button-to-view-student
        {
            margin-top: 40px;
            width: 150px;
            height:50px;
            border-radius:10px;
            border:1px solid #348FCC;
            align-items:center;
            background-color:#348FCC;
            color:white;
        }
        form
        {
            box-shadow:none;
            display:flex;
            justify-content:center;
            align-items:center;
        }

        /* styling */

    
    .profile-row {
        display: flex;
        align-items: center;
        justify-content: space-between;
        background-color: #f5fbff;
        border: 1px solid #ddd;
        border-radius: 8px;
        padding: 15px;
        box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        margin: 10px auto;
    }

    .profile-info {
        display: flex;
        align-items: center;
        gap: 15px;
    }

    .profile-img {
        width: 50px;
        height: 50px;
        border-radius: 50%;
    }

    .profile-text h4 {
        margin: 0;
        font-size: 16px;
        font-weight: bold;
    }

    .profile-text p {
        margin: 0;
        color: #555;
        font-size: 14px;
    }

    .profile-stats {
        font-size: 14px;
        color: #777;
    }

    .profile-actions button {
        border: none;
        padding: 8px 15px;
        font-size: 14px;
        cursor: pointer;
        border-radius: 20px;
    }
    table
    {
        margin:10px;
        display: flex;
    justify-content: center;
   
    
}
table td 
{
    gap:10px;
}



    
</style>

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
    echo "<p>Events associated with phone number: $loggedInPhone</p>";
    echo "<div class='event-container'>"; // Event container div starts here

    // Offline Events
    if ($resultOffline->num_rows > 0) {
        while ($row = $resultOffline->fetch_assoc()) {
            echo "<div class='event-card'>
                    <img src='{$row['image']}' alt='Event Image'>
                    <h4>{$row['eventname']}</h4>
                    <form action='editevent2.php' method='GET'>
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
    <button type="submit" name="show_students" id="button-to-view-student">Show Registered Students</button>

</form> 

<?php
// Display registered students if requested
if ($_SERVER['REQUEST_METHOD'] === 'POST'&& isset($_POST['show_students']) ) {
    $sqlStudents = "SELECT * FROM event_registration_students";
    $resultStudents = $conn->query($sqlStudents);

    if ($resultStudents->num_rows > 0) {
        // echo "<p>Registered Students</p>";
        echo "<table>
                ";
        while ($row = $resultStudents->fetch_assoc()) {
            echo "<tr class='profile-row'>
            <td class='profile-info'>
            </td>
             
                    <td class='profile-stats'>{$row['name']}</td>
                    <td class='profile-stats'>{$row['phone_number']}</td>
                    <td class='profile-stats'>{$row['email']}</td>
            </td>
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
