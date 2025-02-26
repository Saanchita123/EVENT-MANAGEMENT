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
@import url('https://fonts.googleapis.com/css2?family=Jost:ital,wght@0,100..900;1,100..900&family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&family=Quicksand:wght@300..700&family=Space+Grotesk:wght@300..700&display=swap');
</style>
    <style>
        body {
            font-family: Quicksand;
            margin: 0;
            padding: 0;
            background-color: #f9f9f9;
        }

        .container {
            /* width: 90%; */
            margin: auto;
            height: auto;
        }
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
}
nav ul li a
{
    color: white;
    text-decoration: none;
    padding:10px;
    margin: 0 1rem;
    transition: all 0.3s ease;
}

        header {
            background-color: black;
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
            background-color: rgba(0, 0, 0, 0.97);
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
            line-height: 1.6;
            border-radius: 10px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }

        iframe {
            border-radius: 10px;
        }

        .share-and-register {
            text-align: center;
            height: 100px;
        }

        .register-btn {
            background: #28a745;
    color: white;
    padding: 10px 20px;
    text-decoration: none;
    border-radius: 25px;
        }

        .register-btn:hover {
            background: #218838;
        }
    </style>
</head>
<body>
<!-- <header>
            <div class="logo">LOGO</div> -->
            <nav>
            <div class="logo">LOGO</div>
                <ul>
                    <li><a href="#">Home</a></li>
                    <li><a href="myevents.php">My Events</a></li>
                    <li><a href="studentprofilepage.php">profile</a></li>
                </ul>
            </nav>
        <!-- </header> -->
    <div class="container">
       

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
                <a href="onlineeventstudentregisternew.php?event_id=<?php echo $event_id; ?>" class="register-btn">Register Now</a>
            </section>
        </main>
    </div>
</body>
</html>
