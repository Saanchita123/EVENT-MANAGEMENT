
<!DOCTYPE html>
<html lang="en">
    <style>

@import url('https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap');
body {
    font-family: poppins;
    margin: 0;
    padding: 0;
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
#background
{
    height: 600px;
    /* border: 10px solid red; */
    display: flex;
    position: relative;
    justify-content: center;
}
#background h1
{
    color: white;
    font-size: 3rem;
    text-align: center;
    margin-top: 200px;
    z-index: 1;
    position: relative;
}

#background img
{
    width: 100%;
    height: 100%;
   
    filter: brightness(50%);
    z-index: -1;
    position: absolute;
   
 

}
#background1
{
   width: 100%;
    height: 600px;
    /* border: 10px solid red; */
    display: flex;
    position: absolute;
    background: rgba(0, 0, 0, 0.5);
    /* border: 10px solid green; */
}
/* main {
    margin: 20px 0;
} */

h1 {
    text-align: center;
    color: #444;
}

.event-section {
    /* margin-top: 20px; */
    /* border: 10px solid red; */
    display: flex;
    flex-direction: column;
    align-items: center;
    justify-content: center;

;
}

.event-section h2 {
    margin-bottom: 10px;
    color: #444;
}

.events {
   
    display: flex;
    flex-wrap: wrap;
    gap: 50px;
}

.event-card {
    padding: 20px;
    /* border: 10px solid blue; */
    background: white;
    border-radius: 10px;
    box-shadow: 0px 4px 8px rgba(5, 5, 5, 0.45);
    border: 1px solid #ddd;
    width: 500px;
  height:auto;
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
   text-align: center;

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
    padding: 10px ;
    border-radius: 5px;
    cursor: pointer;
    margin: 20px;
}
.details-btn
{
    background: #007BFF;
    color: white;
    border: none;
    padding: 10px ;
    border-radius: 5px;
    cursor: pointer;
    margin: 20px;
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
        
           
            <nav>
            <div class="logo">LOGO</div>
                <ul>
                    <li><a href="#">Home</a></li>
                    <li><a href="#">My Events</a></li>
                    <li><a href="studentprofilepage.php">profile</a></li>
                </ul>
            </nav>
    
        <main>
            <div id="background">
               
                <h1>Discover the Joy of Learning</h1>
                <div id="background1"> </div>
                <img src="stem-list-EVgsAbL51Rk-unsplash.jpg"alt="">
            </div>
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
                echo '<a href="onlineeventstudentregister.php?event_id=' . $row["id"] . '" class="register-btn">Register</a>';
                echo '<a href="onlinestudenteventdetails.php?event_id=' . $row["id"] . '" class="details-btn">View Details</a>';
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




        // ------------------------------------


   

    </script>
</body>
</html>
