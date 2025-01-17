<?php
session_start(); // Start the session

// Prevent caching
header("Cache-Control: no-store, no-cache, must-revalidate, max-age=0");
header("Cache-Control: post-check=0, pre-check=0", false);
header("Pragma: no-cache");

// Check if user is logged in (example: check if phone number is set in session)
if (!isset($_SESSION['user_phone'])) {
    echo "<script>alert('Please log in to continue.'); window.location.href = 'login.html';</script>";
    exit; // Stop script execution if user is not logged in
}

// Your protected page content goes here...
?>












<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="style1.css">
</head>

<style>
*
{
    margin: 0;
    padding: 0;
}
    #collegename
    {
        width: 500px;
        height: 40px;
        border-radius: 22px;
        border: 1px solid #ccc;
        padding: 10px;
    }
    #search
    {
        width: 100px;
        height: 40px;
        border-radius: 22px;
        border: 1px solid #ccc;
        background-color: #4CAF50;
        color: white;
        cursor: pointer;
    }

    #college-in-india
    {
        margin-top: 30px;
        display: flex;
        justify-content: center;
        align-items: center;
        flex-wrap: wrap;
        height: auto;
        flex-direction: column;
    }
    .image-div
    {
        width: 150px;
        height: auto;
        height: 150px;
        border-radius: 10px ;
        padding:10px;
        
    }
    .image-div img{
        width: 100%;
        height: 100%;
        border-radius: 10px ;
    
    }
    .details
    {
        padding: 20px;
        width: 600px;
    }
   .college
    {
        margin-top: 20px;
       display: flex;
        width: 900px;
        height: auto;
        background-color: #ffffff;
        border-radius: 10px;
    }
    #button
    {
        width: 100px;
        background:linear-gradient(#00d0ff,#004965);
        border: 1px solid #004965;
        border-radius: 10px;
    }
    #button-place
    {
    display: flex;
    justify-content: center;
    align-items: end;
    padding: 10px;
    width: 200px;
}
#button-place button
{
    width: 160px;
    height: 40px;
    border-radius: 22px;
    border: 1px solid #ccc;
    background:linear-gradient(#2B9E9E,#55F4B6);
    color: white;
    cursor: pointer;
}
#input-search
{
    display: flex;
    justify-content: center;
    align-items: center;
    padding: 20px;
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
           <li><img src="images/Group 109.png" alt="" style="width: 50px;cursor: pointer;" onclick="hello()"></l>
        </ul>
    </nav>

    <div id="input-search">
        <input type="text" name="collegename" id="collegename" placeholder="enter college name...">
        <button id="search">search</button>
    </div>

    <div id="college-in-india">



        <!-- college 1 -->
        <div id="college1" class="college">
            <div id="img1" class="image-div">
                <img src="images/bgimg1.jpg" alt="">
            </div>

            <div class="details">
                <h2>Heritage Institute of Technology,Kolkata</h2>
                <p style="padding-top:10px;">University in Kolkata, West Bengal</p>
            </div>
            <div id="button-place">
                <button>Calender</button>
            </div>
        </div> 

        <!-- college 2 -->

        <div id="college2" class="college">
            <div id="img1" class="image-div">
                <img src="images/bgimg1.jpg" alt="">
            </div>

            <div class="details">
                <h2>Acharya Girish Chandra Bose College</h2>
                <p style="padding-top:10px;">University in Kolkata, West Bengal</p>
            </div>
            <div id="button-place">
                <button>Calender</button>
            </div>
        </div>

        <!-- college 3 -->

        <div id="college3" class="college">
            <div id="img1" class="image-div">
                <img src="images/bgimg1.jpg" alt="">
            </div>

            <div class="details">
                <h2>University of Engineering and Management,Kolkata</h2>
                <p style="padding-top:10px;">University in Kolkata, West Bengal</p>
            </div>
            <div id="button-place">
                <button><a href="academic_calenders/HOLIDAY-LIST-2024 uem-iem.pdf">Calender</a></button>
            </div>
        </div>

        <!-- college 4 -->

        <div id="college3" class="college">
            <div id="img1" class="image-div">
                <img src="images/bgimg1.jpg" alt="">
            </div>

            <div class="details">
                <h2>Asutosh College</h2>
                <p style="padding-top:10px;">University in Kolkata, West Bengal</p>
            </div>
            <div id="button-place">
                <button><a href="academic_calenders/HOLIDAY-LIST-2024 uem-iem.pdf">Calender</a></button>
            </div>
        </div>


      <!-- college 5 -->

      <div id="college3" class="college">
        <div id="img1" class="image-div">
            <img src="images/bgimg1.jpg" alt="">
        </div>

        <div class="details">
            <h2>Indian School Of Business Management and Administrationt</h2>
            <p style="padding-top:10px;">University in Kolkata, West Bengal</p>
        </div>
        <div id="button-place">
            <button>Calender</button>
        </div>
    </div>


 <!-- college 6 -->

 <div id="college3" class="college">
    <div id="img1" class="image-div">
        <img src="images/bgimg1.jpg" alt="">
    </div>

    <div class="details">
        <h2>University of Engineering and Management</h2>
        <p style="padding-top:10px;">University in Kolkata, West Bengal</p>
    </div>
    <div id="button-place">
        <button><a href="academic_calenders/HOLIDAY-LIST-2024 uem-iem.pdf">Calender</a></button>
    </div>
</div>

</div>


        <script>

    document.getElementById('search').addEventListener('click', function() {
        const searchQuery = document.getElementById('collegename').value.toLowerCase().trim();
        const colleges = document.querySelectorAll('.college');

        colleges.forEach(college => {
            const collegeName = college.querySelector('h2').textContent.toLowerCase();

            if (collegeName.includes(searchQuery)) {
                college.style.display = 'flex'; 
            } else {
                college.style.display = 'none'; 
            }
        });
    });
</script>

    
</body>
</html>