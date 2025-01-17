<?php
session_start();
include 'connect.php'; // Your database connection file

// Check if the user is logged in
if (!isset($_SESSION['studentid'])) {
    header("Location: studentlogin1.php");
    exit;
}

// Fetch user details from the database
$user_id = $_SESSION['studentid'];
$query = "SELECT * FROM studentregister WHERE studentid = ?";
$stmt = $conn->prepare($query);
$stmt->bind_param('i', $user_id);
$stmt->execute();
$result = $stmt->get_result();
$user = $result->fetch_assoc();

if (!$user) {
    echo "User not found.";
    exit;
}

// Display user details
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Profile</title>
    <!-- AOS ANUMATIONS -->
    <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">
    <script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
    
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap');


@import url('https://fonts.googleapis.com/css2?family=Jost:ital,wght@0,100..900;1,100..900&family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&family=Quicksand:wght@300..700&family=Space+Grotesk:wght@300..700&display=swap');

          body {
            font-family: quicksand;
            margin: 0;
            padding: 0;
            background-color:rgb(216, 216, 216);
            justify-content: center;
            align-items: center;
            /* display: flex;
            flex-direction: column; */
            height: 100vh;

        }
        /* body h1 {
            color: #333;
            margin-top: -100px;
        } */
        .profile-card {
            background: #fff;
            border-radius: 20px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            max-width: 600px;
            padding: 20px;
            width: 90%;
            display: flex;
            justify-content: center;
            
            color: black;
        }
        .profile-card h1 {
            font-size: 24px;
            color: #333;
            margin-bottom: 10px;

        }
        .profile-card p {
            color: #555;
            font-size: 16px;
            margin: 25px 0;
        }
        .profile-card a {
            display: inline-block;
            margin-top: 20px;
            padding: 10px 20px;
            font-size: 16px;
            color: #fff;
            background-color: #007bff;
            text-decoration: none;
            border-radius: 5px;
            transition: background-color 0.3s;
        }
        .profile-card a:hover {
            background-color: #0056b3;
        }
        .image-comtainer {
            margin:auto;
        
        }
        .image-comtainer img {
            width: 100px;
            height: 100px;
            border-radius: 50%;
        }
        .profile-info
        {
            width: 50%;
        }
        /* NAVBAR */

        
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
main
{
    display: flex;
    justify-content: center;
    align-items: center;
    flex-direction: column;
    height: auto;
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
            <main>
    <h1>Profile</h1>
    <div class="profile-card">
        <div class= "image-comtainer">
            <img src="images/profile.png" alt="User Image" style="width: 200px; height: 200px; border-radius: 50%;">
        </div>

<div class= "profile-info">
    <h1>Name : <?php echo htmlspecialchars($user['name']); ?></h1>
    <p>Email: <?php echo htmlspecialchars($user['email']); ?></p>
    <p>phone number: <?php echo htmlspecialchars($user['phone']); ?></p>
    <p>Address: <?php echo htmlspecialchars($user['address']); ?></p>
    <p>date of birth :<?php echo htmlspecialchars($user['dateofbirth']); ?> </p>
    <p>date of birth :<?php echo htmlspecialchars($user['gender']); ?> </p>
    <a href="logout.php">Logout</a>
    </div>
    </div>
    </main>
    
</body>
</html>
