<?php
session_start(); 
if (!isset($_SESSION['user_phone'])) {
    echo "<script>alert('Please log in to continue.'); window.location.href = 'login1.html';</script>";
    exit;
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>
    <link rel="stylesheet" href="style1.css">
</head>
<style>
    
.calendar1 {
    margin: 30px auto;
    width: 300px;
    border: 1px solid #ccc;
    border-radius: 8px;
    background-color: #fff;
    box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
}
.header {
    display: flex;
    justify-content: space-between;
    align-items: center;
    padding: 10px;
    background-color: #007BFF;
    color: white;
    border-top-left-radius: 8px;
    border-top-right-radius: 8px;
}
#logout-button
{
    
    background: none;
    border: none;
    color: white;
    font-size: 20px;
    cursor: pointer;
   display: flex;
   flex-direction: column;
   justify-content: center;
   align-items: center;

}
.header button {
    background: none;
    border: none;
    color: white;
    font-size: 20px;
    cursor: pointer;
}

.days {
    display: grid;
    grid-template-columns: repeat(7, 1fr);
    background-color: #f0f0f0;
}

.day {
    text-align: center;
    padding: 5px ;
    font-weight: bold;
}

.dates {
    display: grid;
    grid-template-columns: repeat(7, 1fr);
}

.date {
    text-align: center;
    padding: 15px 0;
    cursor: pointer;
}

.date:hover {
    background-color: #007BFF;
    color: white;
}

.today {
    background-color: #FFC107;
    color: white;
    border-radius: 50%;
}
</style>
<body>

    <nav class="navbar">
        <div class="menu-toggle" id="menu-toggle">
            <div class="hamburger"></div>
        </div>
        <ul class="nav-links" id="nav-links">
            <li><a href="dashboard.php">Dashboard</a></li>
            <li><a href="finalevent.php">Events</a></li>
            <li><a href="collegeupdate.php">College Updates</a></li>
            <li><a href="eventdetails.php">Help Center</a></li>
           <li><div id="logout-button"><a href="logout.php"><img src="images/Group 109.png" alt="" style="width: 50px;cursor: pointer;" onclick=""></a></div> </li>
           
        </ul>
      
    </nav>


        <div id="first-part">
        
            <div class="greeting">
               
                <div class="greeting-text">
                     <h1 id="dashboard"> </h1>
                    <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore.
                        Lorem ipsum dolor sit amet consectetur, adipisicing elit. Temporibus repudiandae dolorum, culpa quis ullam eveniet commodi natus soluta harum debitis illum, quas sunt voluptas, excepturi praesentium! Iure modi corrupti sequi.
                    </p>
                </div>

                <div class="greeting-image">
                    <img src="images/EVENT2.png" alt="Greeting">
                </div>

            </div>

           

            <!-- new calender -->
            <div class="calendar1">
                <div class="header">
                    <button id="prev1" onclick="changeMonth(-1)">&#10094;</button>
                    <div id="monthYear1"></div>
                    <button id="next1" onclick="changeMonth(1)">&#10095;</button>
                </div>
                <div class="days">
                    <div class="day">Sun</div>
                    <div class="day">Mon</div>
                    <div class="day">Tue</div>
                    <div class="day">Wed</div>
                    <div class="day">Thu</div>
                    <div class="day">Fri</div>
                    <div class="day">Sat</div>
                </div>
                <div class="dates" id="dates"></div>
            </div>

        </div>

           <div class="second-part">
                <div class="notification">
                    <h2>Notifications</h2>
            <ul>
                <li>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore.</li>
                <li>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore.</li>
                <li>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore.</li>
                <li>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore.</li>
                <li>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore.</li>
            </ul>
                </div>

                <div class="upcoming-events">

                    <p>no upcoming events...</p>
                </div>
             

                </div>
               <script src="script.js"></script>
                <script>

                    // menu


//   


                    
                    document.addEventListener('DOMContentLoaded', function() {
            const name = localStorage.getItem('name'); // Retrieve the name from localStorage
            const dashboard = document.getElementById('dashboard');

            if (name) {
                dashboard.textContent = `Hello, ${name}!`; // Display the name
            } else {
                dashboard.textContent = 'No name found. Please go back to the login page.'; // Fallback message
            }
        });

        // calendar functionality


        const date = new Date();
let currentMonth = date.getMonth();
let currentYear = date.getFullYear();
const monthYearElement = document.getElementById("monthYear1");
const datesElement = document.getElementById("dates");

function renderCalendar(month, year) {
    const firstDay = new Date(year, month, 1).getDay();
    const lastDate = new Date(year, month + 1, 0).getDate();
    const today = new Date();
    
    monthYearElement.innerText = `${date.toLocaleString('default', { month: 'long' })} ${year}`;
    datesElement.innerHTML = '';

    for (let i = 0; i < firstDay; i++) {
        datesElement.innerHTML += `<div class="date"></div>`;
    }

    for (let i = 1; i <= lastDate; i++) {
        const className = (i === today.getDate() && month === today.getMonth() && year === today.getFullYear()) ? 'date today' : 'date';
        datesElement.innerHTML += `<div class="${className}">${i}</div>`;
    }
}

function changeMonth(direction) {
    currentMonth += direction;
    if (currentMonth < 0) {
        currentMonth = 11;
        currentYear--;
    } else if (currentMonth > 11) {
        currentMonth = 0;
        currentYear++;
    }
    renderCalendar(currentMonth, currentYear);
}

// Initial render
renderCalendar(currentMonth, currentYear);


                </script>

</body>
</html>
