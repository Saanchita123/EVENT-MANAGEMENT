<?php
// Connect to the database
$conn = new mysqli("localhost", "root", "", "event-registration");

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Fetch online event details based on event_id
if (isset($_GET['event_id'])) {
    $event_id = (int)$_GET['event_id']; // Ensure it's an integer

    // Query to fetch the event from the online_events table
    $sql = "SELECT * FROM online_events WHERE id = $event_id";
    $result = $conn->query($sql);

    if ($result && $result->num_rows > 0) {
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
    <title><?php echo htmlspecialchars($event['event_name']); ?> - Details</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f9f9f9;
        }

        .container {
            width: 90%;
            margin: auto;
        }

        header {
            background-color: #333;
            color: #fff;
            padding: 10px 0;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        header .logo {
            margin-left: 20px;
            font-size: 24px;
        }

        header nav ul {
            list-style: none;
            margin: 0;
            padding: 0;
            display: flex;
        }

        header nav ul li {
            margin-right: 20px;
        }

        header nav ul li a {
            color: #fff;
            text-decoration: none;
        }

        .event-banner {
            position: relative;
            text-align: center;
            margin-bottom: 20px;
        }

        .event-banner img {
            width: 100%;
            height: 400px;
            object-fit: cover;
        }

        .event-banner .event-title {
            position: absolute;
            bottom: 20px;
            left: 20px;
            color: white;
            background-color: rgba(0, 0, 0, 0.5);
            padding: 10px 20px;
            border-radius: 5px;
        }

        .event-details {
            display: flex;
            justify-content: space-between;
            gap: 20px;
            margin-bottom: 20px;
        }

        .description, .join-online {
            width: 48%;
            background: white;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }

        iframe {
            border-radius: 10px;
        }

        .share-and-register {
            text-align: center;
            margin-top: 20px;
        }

        .register-btn {
            background: #28a745;
            color: white;
            padding: 10px 20px;
            text-decoration: none;
            border-radius: 5px;
        }

        .register-btn:hover {
            background: #218838;
        }
    </style>
</head>
<body>
    <div class="container">
        <header>
            <div class="logo">LOGO</div>
            <nav>
                <ul>
                    <li><a href="#">Home</a></li>
                    <li><a href="#">Help Center</a></li>
                    <li><a href="studentprofilepage.php">Profile</a></li>
                </ul>
            </nav>
        </header>

        <main>
            <section class="event-banner">
                <img src="<?php echo htmlspecialchars($event['image']); ?>" alt="Event Image">
                <div class="event-title">
                    <h1><?php echo htmlspecialchars($event['event_name']); ?></h1>
                </div>
            </section>

            <section class="event-details">
                <div class="description">
                    <h2>Description</h2>
                    <p><?php echo htmlspecialchars($event['event_description']); ?></p>
                </div>
                <div class="join-online">
                    <h2>Event date</h2>
                    <p><?php echo htmlspecialchars($event['event_date_from']); ?></p>
                    <h2>to</h2>
                    <p><?php echo htmlspecialchars($event['event_date_to']); ?></p>
                   
                </div>
            </section>

            <section class="share-and-register">
                <a href="onlineeventstudentregister.php?event_id=<?php echo $event_id; ?>" class="register-btn">Register Now</a>
            </section>
        </main>
    </div>
</body>
</html>
