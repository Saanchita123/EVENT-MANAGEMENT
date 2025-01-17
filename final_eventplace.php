<?php
// session_start(); // Start the session

// // Prevent caching
// header("Cache-Control: no-store, no-cache, must-revalidate, max-age=0");
// header("Cache-Control: post-check=0, pre-check=0", false);
// header("Pragma: no-cache");

// // Check if user is logged in (example: check if phone number is set in session)
// if (!isset($_SESSION['user_phone'])) {
//     echo "<script>alert('Please log in to continue.'); window.location.href = 'login.html';</script>";
//     exit; // Stop script execution if user is not logged in
// }

// Your protected page content goes here...
?>





<?php
// Start session to store form data between pages
// session_start();

// // Capture form data from the previous page
// if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['submitOffline'])) {
//     // Store form inputs in the session
//     $_SESSION['name'] = $_POST['name'];
//     $_SESSION['email'] = $_POST['email'];
//     $_SESSION['phone'] = $_POST['phone'];
//     $_SESSION['eventname'] = $_POST['eventname'];
//     $_SESSION['eventdescription'] = $_POST['eventdescription'];
//     $_SESSION['eventtype'] = $_POST['eventtype'];
//     $_SESSION['eventdatefrom'] = $_POST['eventdatefrom'];
//     $_SESSION['eventdateto'] = $_POST['eventdateto'];
//     $_SESSION['participants'] = $_POST['participants'];

//     // Handle the image upload
//     if (isset($_FILES['image']) && $_FILES['image']['error'] === UPLOAD_ERR_OK) {
//         $uploadDir = 'uploads/'; // Ensure this directory exists and is writable
//         if (!is_dir($uploadDir)) {
//             mkdir($uploadDir, 0777, true); // Create directory if it does not exist
//         }

//         $imageName = basename($_FILES['image']['name']);
//         $uploadFilePath = $uploadDir . $imageName;
//         $imageFileType = strtolower(pathinfo($uploadFilePath, PATHINFO_EXTENSION));

//         // Check if file is a valid image type
//         $allowedTypes = ['jpg', 'jpeg', 'png', 'gif'];
//         if (in_array($imageFileType, $allowedTypes)) {
//             // Move the uploaded file to the target directory
//             if (move_uploaded_file($_FILES['image']['tmp_name'], $uploadFilePath)) {
//                 // Store the path of the uploaded image in the session
//                 $_SESSION['image'] = $uploadFilePath;
//                 header("Location: final_eventplace.php"); // Redirect to the event place entry page
//                 exit;
//             } else {
//                 echo "Error: Failed to move the uploaded file.";
//             }
//         } else {
//             echo "Error: Only JPG, JPEG, PNG, and GIF files are allowed.";
//         }
//     } else {
//         echo "Error: No image uploaded or there was an error in the upload process.";
//     }
// }



?>


<?php
// Start the session
session_start();

// Prevent caching
// header("Cache-Control: no-store, no-cache, must-revalidate, max-age=0");
// header("Cache-Control: post-check=0, pre-check=0", false);
// header("Pragma: no-cache");

// Check if user is logged in (example: check if phone number is set in session)
if (!isset($_SESSION['user_phone'])) {
    echo "<script>alert('Please log in to continue.'); window.location.href = 'dashboard.php';</script>";
    exit; // Stop script execution if user is not logged in
}

// Check if the form has been submitted
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['submitOffline'])) {
    // Store form inputs in the session
    $_SESSION['name'] = $_POST['name'];
    $_SESSION['email'] = $_POST['email'];
    $_SESSION['phone'] = $_POST['phone'];
    $_SESSION['eventname'] = $_POST['eventname'];
    $_SESSION['eventdescription'] = $_POST['eventdescription'];
    $_SESSION['eventtype'] = $_POST['eventtype'];
    $_SESSION['eventdatefrom'] = $_POST['eventdatefrom'];
    $_SESSION['eventdateto'] = $_POST['eventdateto'];
    $_SESSION['participants'] = $_POST['participants'];

    // Handle the image upload
    if (isset($_FILES['image']) && $_FILES['image']['error'] === UPLOAD_ERR_OK) {
        $uploadDir = 'uploads/'; // Ensure this directory exists and is writable
        if (!is_dir($uploadDir)) {
            mkdir($uploadDir, 0777, true); // Create directory if it does not exist
        }

        $imageName = basename($_FILES['image']['name']);
        $uploadFilePath = $uploadDir . $imageName;
        $imageFileType = strtolower(pathinfo($uploadFilePath, PATHINFO_EXTENSION));

        // Check if file is a valid image type
        $allowedTypes = ['jpg', 'jpeg', 'png', 'gif'];
        if (in_array($imageFileType, $allowedTypes)) {
            // Move the uploaded file to the target directory
            if (move_uploaded_file($_FILES['image']['tmp_name'], $uploadFilePath)) {
                // Store the path of the uploaded image in the session
                $_SESSION['image'] = $uploadFilePath;
                header("Location: final_eventplace.php"); // Redirect to the event place entry page
                exit;
            } else {
                echo "<script>alert('Error: Failed to move the uploaded file.');</script>";
            }
        } else {
            echo "<script>alert('Error: Only JPG, JPEG, PNG, and GIF files are allowed.');</script>";
        }
    } else {
        echo "<script>alert('Error: No image uploaded or there was an error in the upload process.');</script>";
    }
}
?>




<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Event Place and Nearby Auditoriums</title>
    <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBZpLZ-XlbYLISkYWUHCWpT0nJKpc33Nts&libraries=places&callback=initMap" async defer></script>
    <style>

@import url('https://fonts.googleapis.com/css2?family=Jost:ital,wght@0,100..900;1,100..900&family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&family=Quicksand:wght@300..700&family=Space+Grotesk:wght@300..700&display=swap');

        *
        {
            margin: 0;
            padding: 0;
        }
        body {
            font-family: poppins;
            background: #D0F7F4;
        }
        /* nav bar --- */

.navbar {
    display:flex;
    justify-content: center;
    align-items: center;
    background: #D0F7F4;
    z-index: 1;
    font-family: poppins;
    padding:1rem;
    position: relative;
}

.nav-links {
    list-style: none;
    display: flex;
    margin: 0;
    padding: 0;
    transition: transform 0.3s ease-in-out;
}

.nav-links li {
    margin: 0 1rem;
}

.nav-links a {
    color: #005D6C;
    font-weight: 600;
    text-decoration: none;
    font-size: 1.2rem;
}

/* Styling the hamburger menu */
.menu-toggle {
    display: none;
    cursor: pointer;
    position: absolute;
    right: 1rem;
    top: 1rem;
    z-index: 2;
}

.hamburger {
    width: 35px; /* Adjust the width of the hamburger menu lines */
    height: 3px;
    background-color: #005D6C;
    border-radius: 3px;
    position: relative;
    transition: 0.3s ease-in-out;
}

.hamburger::before,
.hamburger::after {
    content: '';
    position: absolute;
    height: 3px;
    width: 35px; /* Adjust the width to match the hamburger line */
    background-color: #005D6C;
    border-radius: 3px;
    transition: 0.3s ease-in-out;
}

.hamburger::before {
    top: -8px; /* Adjust space between lines */
}

.hamburger::after {
    top: 8px; /* Adjust space between lines */
}

/* Transform hamburger into a cross when clicked */
.menu-toggle.open .hamburger {
    background-color: transparent;
}

.menu-toggle.open .hamburger::before {
    transform: rotate(45deg);
    top: 0;
    background-color: #ffffff;
}

.menu-toggle.open .hamburger::after {
    transform: rotate(-45deg);
    top: 0;
    background-color: #ffffff;
}

/* Responsive styles for smaller screens */
@media (max-width: 768px) {
    .nav-links {
        position: fixed;
        top: 0;
        right: 0;
        height: 100vh;
        width: 250px;
        flex-direction: column;
        justify-content: center;
        align-items: center;
        background-color: #7fccd7;
        transform: translateX(100%);
        transition: transform 0.3s ease-in-out;
    }

    .nav-links li {
        margin: 1.5rem 0;
    }

    .menu-toggle {
        display: flex;
    }

    .close-menu {
        position: absolute;
        top: 20px;
        right: 20px;
        font-size: 2rem;
        cursor: pointer;
        color: #ffffff;
    }

    .nav-links.open {
        transform: translateX(0);
    }
}
/*  */

        

        form {
            margin-bottom: 30px;
            padding: 20px;
            background: #D0F7F4;
            border-radius: 8px;
            color: #00796b;
        }

        input[type="text"]{
            width: 500px;
            padding: 10px;
            margin: 10px 0;
            border: 1px solid #ccc;
            border-radius: 4px;
        }

        input[type="submit"]{
            width: 100px;
            padding: 10px;
            margin: 10px 0;
            border: 1px solid #ccc;
            border-radius: 4px;
            background: #00796b;
            color: #ffffff;
        }

        /* Container for map and auditoriums */
        .container {
            display: flex;
            justify-content: space-between;
            position: relative; /* Positioning context for absolute children */
        }

        .map-container {
            width: 50vw; /* 50% of viewport width */
            height: 50vh; /* 50% of viewport height */
            border: 1px solid #ccc;
            transition: right 0.3s; /* Smooth transition */
        }

        .auditorium-list {
            width: 50vw; /* 50% of viewport width */
            height: 50vh; /* 50% of viewport height */
            padding: 10px;
            background-color: #e0f7fa;
            border-radius: 8px;
            overflow-y: auto; /* Allows scrolling */
            transition: left 0.3s; /* Smooth transition */
            overflow-x: hidden;
        }
        #locationInput
        {
            width: 80%;
            padding: 10px;
            margin: 10px 0;
            border: 1px solid #ccc;
            border-radius: 4px;
        }

        /* Media query for responsive design */
        @media (max-width: 768px) {
            .map-container, .auditorium-list {
                width: 100vw; /* Full width on smaller screens */
                height: 30vh; /* Smaller height */
            }
        }

        h3 {
            font-size: 18px;
            margin-bottom: 10px;
        }

        #auditoriumNames {
            list-style-type: none;
            padding: 0;
        }

        #auditoriumNames li {
            display: flex;
            align-items: center;
            background-color: #ffffff;
            margin: 5px 0;
            padding: 10px;
            border-radius: 4px;
            box-shadow: 0 1px 3px rgba(0, 0, 0, 0.2);
            font-size: 14px;
        }

        #auditoriumNames li img {
            margin-right: 10px;
            border-radius: 4px; /* Optional: Makes images rounded */
        }
    </style>
</head>
<body>

<!-- <nav class="navbar">
        <div class="menu-toggle" id="menu-toggle">
            <div class="hamburger"></div>
        </div>
        <ul class="nav-links" id="nav-links">
            <li><a href="dashboard.html">Dashboard</a></li>
            <li><a href="events.html">Events</a></li>
            <li><a href="collegeupdate.html">College Updates</a></li>
            <li><a href="#">Help Center</a></li>
           <li><img src="images/Group 109.png" alt="" style="width: 50px;cursor: pointer;" onclick="hello()"></l>
        </ul>
    </nav> -->



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
    
    <!-- Event Place Form -->
    
    <form id="place" method="POST" action="submit_offline_event.php">
        <h2>Enter event place</h2>
        <label for="eventplace">Event Place *</label>
        <input type="text" id="eventplace" name="eventplace" required>

        <input type="submit" name="submitEventPlace" value="Submit Event">
    </form>

    <!-- Container for Map and Auditoriums -->
    <div class="container">
        <div class="map-container" id="map"></div>
        <div class="auditorium-list">
            <h2>AUDITORIUMS</h2>
            <input type="text" id="locationInput" placeholder="Enter a location..." />
            <button onclick="searchNearby()">Search</button>
            <ul id="auditoriumNames"></ul>
        </div>
    </div>
    <script src="script.js"></script>
    <script>
        let map;
        let service;
        let autocomplete;

        function initMap() {
            const defaultLocation = { lat: 22.5726, lng: 88.3639 }; // Kolkata coordinates
            map = new google.maps.Map(document.getElementById("map"), {
                center: defaultLocation,
                zoom: 14,
            });

            // Initialize autocomplete
            autocomplete = new google.maps.places.Autocomplete(document.getElementById("locationInput"));
            autocomplete.bindTo("bounds", map); // Bias results towards the map's viewport

            service = new google.maps.places.PlacesService(map);

            // Add listener for place selection from autocomplete
            autocomplete.addListener('place_changed', searchNearby);
        }

        function searchNearby() {
            const place = autocomplete.getPlace();

            if (!place.geometry || !place.geometry.location) {
                alert("Please select a valid location from the autocomplete suggestions.");
                return;
            }

            const location = place.geometry.location;
            map.setCenter(location);

            const request = {
                location: location,
                radius: '5000', // Search within 5 km radius
                keyword: 'auditorium', // Searching specifically for auditoriums
                type: ['point_of_interest'], // General points of interest (can help include auditoriums)
            };

            service.nearbySearch(request, function (results, status) {
                const auditoriumNames = document.getElementById("auditoriumNames");
                auditoriumNames.innerHTML = ''; // Clear previous results

                if (status === google.maps.places.PlacesServiceStatus.OK) {
                    for (let i = 0; i < results.length; i++) {
                        const li = document.createElement('li');
                        const place = results[i];

                        // Create a div to hold the image and name
                        const placeContainer = document.createElement('div');
                        placeContainer.style.display = 'flex';
                        placeContainer.style.alignItems = 'center';

                        // Add place image if available
                        if (place.photos && place.photos.length > 0) {
                            const placeImage = document.createElement('img');
                            placeImage.src = place.photos[0].getUrl({ maxWidth: 40, maxHeight: 40 });
                            placeImage.alt = place.name;
                            placeImage.style.width = '40px';
                            placeImage.style.height = '40px';
                            placeImage.style.marginRight = '10px';
                            placeContainer.appendChild(placeImage);
                        }

                        // Add place name
                        const placeName = document.createElement('span');
                        placeName.textContent = place.name;
                        placeContainer.appendChild(placeName);

                        // Add the container to the list item
                        li.appendChild(placeContainer);
                        auditoriumNames.appendChild(li);

                        createMarker(results[i]);
                    }
                } else {
                    auditoriumNames.innerHTML = '<li>No auditoriums found.</li>';
                }
            });
        }

        function createMarker(place) {
            const marker = new google.maps.Marker({
                map: map,
                position: place.geometry.location,
            });

            google.maps.event.addListener(marker, "click", function () {
                const infoWindow = new google.maps.InfoWindow({
                    content: place.name,
                });
                infoWindow.open(map, marker);
            });
        }

        // Initialize the map when the window loads
        window.onload = initMap;
        // ------------------

      
    </script>

</body>
</html>
