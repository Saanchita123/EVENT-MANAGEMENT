
<!DOCTYPE html>
<html lang="en">
     <!-- AOS ANUMATIONS -->
     <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">
    <script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
    <style>

@import url('https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap');


@import url('https://fonts.googleapis.com/css2?family=Jost:ital,wght@0,100..900;1,100..900&family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&family=Quicksand:wght@300..700&family=Space+Grotesk:wght@300..700&display=swap');


body {
    /* font-family: poppins; */
    font-family:quicksand;
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
#background
{
    height: 450px;
    /* border: 10px solid red; */
    display: flex;
    position: relative;
    justify-content: center;
    
}
#background2 h1
{
    color: white;
    font-size: 3rem;
  
    font-weight: 200;
    z-index: 1;
    /* position: relative; */
}


#background2 p
{
    color: white;
    font-size: 14px;
 
  
    font-weight: 200;
    z-index: 1;
    /* position: relative; */
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
   height: 450px;
  
    display: flex;
    position: absolute;
    background: rgba(0, 0, 0, 0.5);
    /* border: 10px solid green; */
}
#background2
{
        /* position: relative; */
        height: fit-content;
    width: 100%;
    display: flex
;
    justify-content: center;
    align-items: center;
    /* border: 10px solid blue; */
    flex-direction: column;
    margin-top: 92px;
    
}
/* main {
    margin: 20px 0;
} */

h1 {
    text-align: center;
    color: #444;
    margin:0px;
}

.event-section {
    /* margin-top: 20px; */
    /* border: 10px solid red; */
    background:rgb(255, 255, 255);
    display: flex;
    flex-direction: column;
    align-items: center;
    justify-content: center;

;
}

.event-section h2 {
    
    margin-top: 20px;
    color: #444;
}

.events {
    margin-bottom: 10px;
    margin-top: 20px;
    display: flex;
    flex-wrap: wrap;
    gap: 50px;
    
    justify-content: center;
}
.button-box
{
    
    display: flex;
    align-items:start;
    
}
#explore-btn
{

    background: #007BFF;
    color: white;
    border: none;
    padding: 10px 20px;
    border-radius: 20px;
    cursor: pointer;
    /* margin: 10px; */
    /* margin-top: 30px; */
    text-align: center;
    font-size: 13px;
    width: 170px;
}
#explore-btn:hover {
    background:none;
    border: 1px solid rgb(255, 255, 255);
    color: white;
    transition : s ease;
}


.register-btn {
    background: #007BFF;
    color: white;
    border: none;
    padding: 10px ;
    width: 100px;
    border-radius: 25px;
    cursor: pointer;
    margin: 10px;
    text-align: center;
    font-size: 13px;
}
.details-btn
{
    background: #007BFF;
    color: white;
    border: none;
    padding: 10px ;
    width: 90px;
    border-radius: 25px;
    cursor: pointer;
    margin: 10px;
    text-align: center;
    font-size: 13px;
}

.register-btn:hover {
    background: #0056b3;
}

/* slider  */
.slider {
    width: 80%;
    max-width: 800px;
    overflow: hidden;
    border-radius: 10px;
    box-shadow: 0 4px 10px rgba(0, 0, 0, 0.2);
}

.slides {
    display: flex;
    transition: transform 0.5s ease-in-out;
    width: 400%;
}

.slide {
    width: 100%;
    flex-shrink: 0;
}

.slide img {
    width: 100%;
    display: block;
}



/*  */
/* General Styles */


h1 {
    text-align: center;
    margin-top: 50px;
}

/* Footer Styles */

.footer {
    background-color: #333;
    color: #fff;
    padding: 20px 0;
    margin-top: 20px;
}

.footer-container {
    display: flex;
    justify-content: space-around;
    flex-wrap: wrap;
    max-width: 1200px;
    margin: 0 auto;
}

.footer-section {
    flex: 1;
    min-width: 250px;
    margin: 10px;
}

.footer-section h3 {
    margin-bottom: 15px;
    color: #ff6600;
}

.footer-section p, .footer-section ul {
    margin: 0;
    padding: 0;
    list-style: none;
    line-height: 1.8;
}

.footer-section ul li {
    margin: 8px 0;
}

.footer-section ul li a {
    color: #fff;
    text-decoration: none;
    transition: color 0.3s;
}

.footer-section ul li a:hover {
    color: #ff6600;
}

.social-icons {
    display: flex;
    gap: 10px;
}

.social-icons a {
    color: #fff;
    font-size: 20px;
    transition: color 0.3s;
}

.social-icons a:hover {
    color: #ff6600;
}

.footer-bottom {
    text-align: center;
    margin-top: 20px;
    border-top: 1px solid #555;
    padding: 10px 0;
    font-size: 14px;
}


/* new card css */



/* General Styles */

/* Card Styles */
.card {
    width: 300px;
    height: 450px; /* Fixed height for consistent alignment */
    border: 1px solid #ddd;
    border-radius: 8px;
    background-color: #fff;
    box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
    overflow: hidden;
    display: flex;
    flex-direction: column;
    justify-content: space-between;
}

/* Image */
.card-image {
    width: 100%;
    height: 180px; /* Fixed height for images */
    object-fit: contain;
}

/* Content */
.card-content {
    padding: 16px;
    flex: 1; /* Ensures the content takes up the remaining space */
    display: flex;
    flex-direction: column;
    justify-content: space-between;
}

/* Event Name - Truncate after 2 lines */
.event-name {
    margin: 0 0 8px;
    font-size: 1.5em;
    color: #333;
    display: -webkit-box;
    -webkit-line-clamp: 2; /* Limit to 2 lines */
    -webkit-box-orient: vertical;
    overflow: hidden;
    text-overflow: ellipsis;
}

/* Event Description - Truncate after 3 lines */
.event-description {
    /* margin: 12px; */
    font-size: 0.9em;
    color: #555;
    display: -webkit-box;
    -webkit-line-clamp: 3; /* Limit to 3 lines */
    -webkit-box-orient: vertical;
    overflow: hidden;
    text-overflow: ellipsis;
}

/* Event Date */
.event-date {
    /* margin: 0 0 16px; */
    font-size: 0.85em;
    color: #666;
}

/* Button Styles */
.card-buttons {
    
    display: flex;
    justify-content: space-between;
}

.btn {
    text-decoration: none;
    padding: 8px 16px;
    border: none;
    border-radius: 4px;
    font-size: 0.9em;
    cursor: pointer;
    transition: background-color 0.3s ease;
}

.btn.primary {
    background-color: #007bff;
    color: #fff;
}

.btn.primary:hover {
    background-color: #0056b3;
}

.btn.secondary {
    background-color: #6c757d;
    color: #fff;
}

.btn.secondary:hover {
    background-color: #5a6268;
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
                    <li><a href="myevents.php">My Events</a></li>
                    <li><a href="studentprofilepage.php">profile</a></li>
                </ul>
            </nav>
    
        <main>

            <div id="background">
              
               
                <div id="background1">
                     <div  id="background2">
                        <h1>Discover the Joy of Learning</h1>
                        <p style="text-align: center; padding: 0 20px;">
                
                        Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.
                        </p>
                        <button id="explore-btn">
                            Explore
                        </button>
                    </div>
                </div>
                <img src="stem-list-EVgsAbL51Rk-unsplash.jpg"alt="">
    </div>
            
           

            <!-- Featured Events Section -->
            <section class="event-section" >
                <h2>Featured Events</h2>
                <p style="text-align: center; padding: 0 20px;">
                Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.

                </p>
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
                            echo '<div class="card">';
                            echo '<img src="' . $row["image"] . '" alt="Event Image" class="card-image">';
                            echo '<div class="card-content">';
                                echo '<h3 class="event-name">' . $row["eventname"] . '</h3>';
                                echo '<p class="event-description">' . $row["eventdescription"] . '</p>';
                                echo '<p class="event-date">Date: ' . date("M d, Y", strtotime($row["eventdatefrom"])) . ' - ' . date("M d, Y", strtotime($row["eventdateto"])) . '</p>';
                                echo '<div class="card-buttons">';
                                    echo '<a href="studentregisternew.php?event_id=' . $row["id"] . '" class="btn primary">Register</a>';
                                    echo '<a href="studenteventdetails.php?event_id=' . $row["id"] . '" class="btn secondary">View Details</a>';
                                echo '</div>';
                            echo '</div>';
                        echo '</div>';
                        
                        





                            // new card







                     
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
                            // echo '<div class="card">';
                            // echo '<img src="' . $row["image"] . '" alt="Event Image">';
                            // echo '<h3>' . $row["eventname"] . '</h3>';
                            // echo '<p>' . $row["eventdescription"] . '</p>';
                            
                            // echo '<p>' . date("M d, Y", strtotime($row["eventdatefrom"])) . ' - ' . date("M d, Y", strtotime($row["eventdateto"])) . '</p>';
                            // echo '<div class="button-box">';
                            // echo '<button class="register-btn" onclick="registerEvent(' . $row["id"] . ')">Register</button>';
                            // echo '</div>';
                            // echo '</div>';

                            // 




                            echo '<div class="card">';
    echo '<img src="' . $row["image"] . '" alt="Event Image" class="card-image">';
    echo '<div class="card-content">';
        echo '<h3 class="event-name">' . $row["eventname"] . '</h3>';
        echo '<p class="event-description">' . $row["eventdescription"] . '</p>';
        echo '<p class="event-date">' . date("M d, Y", strtotime($row["eventdatefrom"])) . ' - ' . date("M d, Y", strtotime($row["eventdateto"])) . '</p>';
        echo '<div class="card-buttons">';
            echo '<button class="btn primary" onclick="registerEvent(' . $row["id"] . ')">Register</button>';
        echo '</div>';
    echo '</div>';
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
                            echo '<div class="card">';
                            echo '<img src="' . $row["image"] . '" alt="Event Image" class="card-image">';
                            echo '<div class="card-content">';
                                echo '<h3 class="event-name">' . $row["eventname"] . '</h3>';
                                echo '<p class="event-description">' . $row["eventdescription"] . '</p>';
                                echo '<p class="event-date">' . date("M d, Y", strtotime($row["eventdatefrom"])) . ' - ' . date("M d, Y", strtotime($row["eventdateto"])) . '</p>';
                            echo '</div>';
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
                // echo '<div class="event-card">';
                // echo '<img src="' . $row["image"] . '" alt="Event Image">';
                // echo '<h3>' . $row["event_name"] . '</h3>';
                // echo '<p>' . $row["event_description"] . '</p>';
                // echo '<p>' . date("M d, Y", strtotime($row["event_date_from"])) . ' - ' . date("M d, Y", strtotime($row["event_date_to"])) . '</p>';
                // echo '<div class="button-box">';
                // echo '<a href="onlineeventstudentregister.php?event_id=' . $row["id"] . '" class="register-btn">Register</a>';
                // echo '<a href="onlinestudenteventdetails.php?event_id=' . $row["id"] . '" class="details-btn">View Details</a>';
                // echo '</div>';
                // echo '</div>';



                echo '<div class="card">';
    echo '<img src="' . $row["image"] . '" alt="Event Image" class="card-image">';
    echo '<div class="card-content">';
        echo '<h3 class="event-name">' . $row["event_name"] . '</h3>';
        echo '<p class="event-description">' . $row["event_description"] . '</p>';
        echo '<p class="event-date">' . date("M d, Y", strtotime($row["event_date_from"])) . ' - ' . date("M d, Y", strtotime($row["event_date_to"])) . '</p>';
        echo '<div class="card-buttons">';
            echo '<a href="onlineeventstudentregisternew.php?event_id=' . $row["id"] . '" class="btn primary">Register</a>';
            echo '<a href="onlinestudenteventdetails.php?event_id=' . $row["id"] . '" class="btn secondary">View Details</a>';
        echo '</div>';
    echo '</div>';
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
    <!-- FOOTER -->
    <footer class="footer">
        <div class="footer-container">
            <div class="footer-section about">
                <h3>About Us</h3>
                <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Integer nec odio. Praesent libero.</p>
            </div>
            <div class="footer-section links">
                <h3>Quick Links</h3>
                <ul>
                    <li><a href="#">Home</a></li>
                    <li><a href="#">About</a></li>
                    <li><a href="#">Services</a></li>
                    <li><a href="#">Contact</a></li>
                </ul>
            </div>
            <div class="footer-section social">
                <h3>Follow Us</h3>
                <div class="social-icons">
                    <a href="#"><i class="fab fa-facebook"></i></a>
                    <a href="#"><i class="fab fa-twitter"></i></a>
                    <a href="#"><i class="fab fa-instagram"></i></a>
                </div>
            </div>
        </div>
        <div class="footer-bottom">
            <p>&copy; 2025 YourCompany. All rights reserved.</p>
        </div>
    </footer>

    <!-- FOOTER -->

    <script>

        function registerEvent(eventId) {
            alert("You have registered for the event with ID: " + eventId);

            // Add AJAX or redirect to the registration page logic here
        }




        // ------------------------------------


        const slides = document.querySelector('.slides');
const totalSlides = document.querySelectorAll('.slide').length;
let currentIndex = 0;

function showNextSlide() {
    currentIndex = (currentIndex + 1) % totalSlides;
    slides.style.transform = `translateX(-${currentIndex * 100}%)`;
}

setInterval(showNextSlide, 3000);
   

    </script>
</body>
</html>
