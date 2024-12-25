<!DOCTYPE html>
<html lang="en">
    <style>

body {
    font-family: Arial, sans-serif;
    margin: 0;
    padding: 0;
    background-color: #f4f4f9;
}

.container {
    width: 80%;
    margin: auto;
    overflow: hidden;
}

header {
    background: #333;
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
}

header nav ul li {
    display: inline;
    margin-right: 20px;
}

header nav ul li a {
    color: white;
    text-decoration: none;
}

main {
    margin: 20px 0;
}

h1 {
    text-align: center;
    color: #444;
}

.event-section {
    margin-top: 20px;
}

.event-section h2 {
    margin-bottom: 10px;
    color: #444;
}

.events {
    display: flex;
    flex-wrap: wrap;
    gap: 20px;
}

.event-card {
    background: white;
    border-radius: 10px;
    box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
    width: 30%;
    padding: 15px;
    text-align: center;
}

.event-card img {
    width: 100%;
    height: 150px;
    object-fit: cover;
    border-radius: 10px 10px 0 0;
}

.event-card h3 {
    color: #444;
    margin: 10px 0;
}

.event-card p {
    color: #666;
    font-size: 14px;
    margin-bottom: 15px;
}

.register-btn {
    background: #007BFF;
    color: white;
    border: none;
    padding: 10px 15px;
    border-radius: 5px;
    cursor: pointer;
}
.details-btn
{
    background: #007BFF;
    color: white;
    border: none;
    padding: 10px 15px;
    border-radius: 5px;
    cursor: pointer;
}

.register-btn:hover {
    background: #0056b3;
}

    </style>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Event Dashboard</title>
  
</head>

<body>
    <div class="container">
        <header>
            <div class="logo">LOGO</div>
            <nav>
                <ul>
                    <li><a href="#">Home</a></li>
                    <li><a href="#">My Events</a></li>
                    <li><a href="studentprofilepage.php">profile</a></li>
                </ul>
            </nav>
        </header>
        <main>
            <h1>Annual Conference 2024</h1>

            <!-- Featured Events Section -->
            <section class="event-section">
                <h2>Featured Events</h2>
                <div class="events">
                    <?php
                   
                    $conn = new mysqli("localhost", "root", "", "event-registration");

                    if ($conn->connect_error) {
                        die("Connection failed: " . $conn->connect_error);
                    }

                    // Fetch Featured Events
                    $sql = "SELECT * FROM offline_events WHERE eventtype='collegeevent' ORDER BY created_at DESC LIMIT 3";
                    $result = $conn->query($sql);

                    if ($result->num_rows > 0) {
                        while ($row = $result->fetch_assoc()) {
                            echo '<div class="event-card">';
                            echo '<img src="' . $row["image"] . '" alt="Event Image">';
                            echo '<h3>' . $row["eventname"] . '</h3>';
                            echo '<p>' . $row["eventdescription"] . '</p>';
                            echo '<a href="studentregister.php?event_id=' . $row["id"] . '" class="register-btn">Register</a>';
                            echo '<a href="studenteventdetails.php?event_id=' . $row["id"] . '" class="details-btn">View Details</a>';
                            echo '</div>';
                        }
                    } else {
                        echo "<p>No featured events available.</p>";
                    }
                    ?>
                </div>
            </section>

            <!-- Upcoming Events Section -->
            <section class="event-section">
                <h2>Upcoming Events</h2>
                <div class="events">
                    <?php
                    // Fetch Upcoming Events
                    $sql = "SELECT * FROM offline_events WHERE eventdatefrom >= CURDATE() ORDER BY eventdatefrom ASC";
                    $result = $conn->query($sql);

                    if ($result->num_rows > 0) {
                        while ($row = $result->fetch_assoc()) {
                            echo '<div class="event-card">';
                            echo '<img src="' . $row["image"] . '" alt="Event Image">';
                            echo '<h3>' . $row["eventname"] . '</h3>';
                            echo '<p>' . $row["eventdescription"] . '</p>';
                            echo '<p>' . date("M d, Y", strtotime($row["eventdatefrom"])) . ' - ' . date("M d, Y", strtotime($row["eventdateto"])) . '</p>';
                            echo '<button class="register-btn" onclick="registerEvent(' . $row["id"] . ')">Register</button>';
                            echo '</div>';
                        }
                    } else {
                        echo "<p>No upcoming events available.</p>";
                    }
                    ?>
                </div>
            </section>

            <!-- Past Events Section -->
            <section class="event-section">
                <h2>Past Events</h2>
                <div class="events">
                    <?php
                    // Fetch Past Events
                    $sql = "SELECT * FROM offline_events WHERE eventdateto < CURDATE() ORDER BY eventdateto DESC";
                    $result = $conn->query($sql);

                    if ($result->num_rows > 0) {
                        while ($row = $result->fetch_assoc()) {
                            echo '<div class="event-card">';
                            echo '<img src="' . $row["image"] . '" alt="Event Image">';
                            echo '<h3>' . $row["eventname"] . '</h3>';
                            echo '<p>' . $row["eventdescription"] . '</p>';
                            echo '<p>' . date("M d, Y", strtotime($row["eventdatefrom"])) . ' - ' . date("M d, Y", strtotime($row["eventdateto"])) . '</p>';
                            echo '</div>';
                        }
                    } else {
                        echo "<p>No past events available.</p>";
                    }
                    ?>
                </div>
            </section>
            <section class="event-section">
    <h2>Online Events</h2>
    <div class="events">
        <?php
        // Fetch Online Events
        $sql = "SELECT * FROM online_events ORDER BY event_date_from ASC";
        $result = $conn->query($sql);

        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                echo '<div class="event-card">';
                echo '<img src="' . $row["image"] . '" alt="Event Image">';
                echo '<h3>' . $row["event_name"] . '</h3>';
                echo '<p>' . $row["event_description"] . '</p>';
                echo '<p>' . date("M d, Y", strtotime($row["event_date_from"])) . ' - ' . date("M d, Y", strtotime($row["event_date_to"])) . '</p>';
                echo '<a href="studentregister.php?event_id=' . $row["id"] . '" class="register-btn">Register</a>';
                echo '<a href="studenteventdetails.php?event_id=' . $row["id"] . '" class="details-btn">View Details</a>';
                echo '</div>';
            }
        } else {
            echo "<p>No online events available.</p>";
        }
        ?>
    </div>
</section>

        </main>
    </div>

    <script>
        function registerEvent(eventId) {
            alert("You have registered for the event with ID: " + eventId);
            // Add AJAX or redirect to the registration page logic here
        }
    </script>
</body>
</html>
