



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
    <title><?php echo htmlspecialchars($event['eventname']); ?> - Details</title>
    <style>
        body {
    font-family: Arial, sans-serif;
    margin: 0;
    padding: 0;
    background-color: #f9f9f9;
}

.container {
   
    margin: auto;
}

nav
{
    display:flex;
    justify-content: space-between;
    align-items: center;
    background:#000000;
    z-index: 1;
    font-family: poppins;
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

.description, .location {
    width: 48%;
    background: white;
    padding: 20px;
    border-radius: 10px;
    box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
}

iframe {
    border-radius: 10px;
}

.event-extras {
    display: flex;
    justify-content: space-between;
    gap: 20px;
}

.hours, .faq {
    width: 48%;
    background: white;
    padding: 20px;
    border-radius: 10px;
    box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
}

details {
    margin-bottom: 10px;
}

.share-and-register {
    text-align: center;
    margin-top: 20px;
}

.social-links {
    display: flex;
    justify-content: center;
    gap: 10px;
    margin-bottom: 10px;
}

.social-btn {
    background: #007bff;
    color: white;
    padding: 10px 20px;
    text-decoration: none;
    border-radius: 5px;
}

.social-btn:hover {
    background: #0056b3;
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
/* Social Links */
/* .social-links {
    position: fixed;
    top: 50%;
    left: 20px;
    transform: translateY(-50%);
    display: flex;
    flex-direction: column;
    gap: 15px;
} */

/* .social-links .social-btn {
    background: #007bff;
    color: white;
    width: 50px;
    height: 50px;
    display: flex;
    justify-content: center;
    align-items: center;
    border-radius: 50%;
    text-decoration: none;
    font-size: 20px;
    box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
    transition: background-color 0.3s, transform 0.3s;
} */

.social-links .social-btn:hover {
    background: #0056b3;
    transform: scale(1.1);
}

/* Responsive Design */
/* @media (max-width: 768px) {
    .social-links {
        left: 10px;
    }

    .event-details {
        flex-direction: column;
    }

    .description, .location, .hours, .faq {
        width: 100%;
    }
}

@media (max-width: 480px) {
    .social-links .social-btn {
        width: 40px;
        height: 40px;
        font-size: 16px;
    }
} */


    </style>
</head>
<body>
    <div class="container">
    <nav>
            <div class="logo">LOGO</div>
                <ul>
                    <li><a href="#">Home</a></li>
                    <li><a href="#">My Events</a></li>
                    <li><a href="studentprofilepage.php">profile</a></li>
                </ul>
            </nav>

        <main>
            <section class="event-banner">
                <img src="<?php echo htmlspecialchars($event['image']); ?>" alt="Event Image">
                <div class="event-title">
                    <h1><?php echo htmlspecialchars($event['eventname']); ?></h1>
                    <p><?php echo htmlspecialchars($event['eventdescription']); ?></p>
                </div>
            </section>

            <section class="event-details">
                <div class="description">
                    <h2>Description</h2>
                    <p><?php echo htmlspecialchars($event['eventdescription']); ?></p>
                </div>
                <div class="location">
                    <h2>Event Location</h2>
                    <p><?php echo htmlspecialchars($event['eventplace']); ?></p>
                    <iframe 
                        src="https://www.google.com/maps?q=<?php echo urlencode($event['eventplace']); ?>&output=embed" 
                        width="100%" 
                        height="300" 
                        style="border:0;" 
                        allowfullscreen="" 
                        loading="lazy"></iframe>
                </div>
            </section>

            <section class="event-extras">
                <div class="hours">
                    <h2>Hours</h2>
                    <p><strong>Start:</strong> <?php echo htmlspecialchars($event['eventdatefrom']); ?></p>
                    <p><strong>End:</strong> <?php echo htmlspecialchars($event['eventdateto']); ?></p>
                </div>
                <div class="faq">
                    <h2>FAQs</h2>
                    <details>
                        <summary>What is the event about?</summary>
                        <p><?php echo htmlspecialchars($event['eventdescription']); ?></p>
                    </details>
                    <details>
                        <summary>Where is the event located?</summary>
                        <p><?php echo htmlspecialchars($event['eventplace']); ?></p>
                    </details>
                </div>
            </section>

            <section class="share-and-register">
                <h2>Share with Friends</h2>
                <div class="social-links">
                    <a href="#" class="social-btn">Facebook</a>
                    <a href="#" class="social-btn">Twitter</a>
                    <a href="#" class="social-btn">LinkedIn</a>
                </div>
 
    <a href="register_event.php?event_id=<?php echo $event_id; ?>" class="register-btn">Register Now</a>
</section>


<!-- 



-->


           
        </main>
    </div>
</body>
</html>
