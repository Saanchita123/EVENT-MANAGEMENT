


<?php
session_start();


// Database connection
$conn = new mysqli("localhost", "root", "", "event-registration");
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Fetch user details from the user table
$user_id = $_SESSION['user_id'];
$sql = "SELECT * FROM users WHERE id = $user_id";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    $user = $result->fetch_assoc();
} else {
    die("User not found.");
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Profile Page</title>
    <style>
        body {
    font-family: Arial, sans-serif;
    margin: 0;
    padding: 0;
    background-color: #f4f4f9;
}

.profile-container {
    width: 90%;
    max-width: 800px;
    margin: auto;
    background: #fff;
    padding: 20px;
    border-radius: 10px;
    box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
    margin-top: 50px;
    text-align: center;
}

.profile-header {
    margin-bottom: 20px;
}

.profile-picture {
    width: 150px;
    height: 150px;
    border-radius: 50%;
    object-fit: cover;
    margin-bottom: 10px;
}

.profile-header h1 {
    font-size: 24px;
    margin: 10px 0;
}

.profile-header p {
    color: #666;
    margin: 5px 0;
}

.logout-btn {
    display: inline-block;
    margin-top: 10px;
    padding: 10px 20px;
    background: #e74c3c;
    color: #fff;
    text-decoration: none;
    border-radius: 5px;
    font-size: 14px;
    transition: background 0.3s;
}

.logout-btn:hover {
    background: #c0392b;
}

.profile-details {
    text-align: left;
    margin-top: 20px;
}

.profile-details h2 {
    margin-bottom: 10px;
    color: #444;
}

.profile-details p {
    margin: 5px 0;
    color: #555;
    font-size: 14px;
}

    </style>
</head>
<body>
<header>
            <div class="logo">LOGO</div>
            <nav>
                <ul>
                    <li><a href="#">Home</a></li>
                    <li><a href="#">Help Center</a></li>
                    <li><a href="#">profile</a></li>
                </ul>
            </nav>
        </header>
    <div class="profile-container">
        <!-- Profile Header -->
        <div class="profile-header">
            <img src="<?php echo htmlspecialchars($user['profile_image']); ?>" alt="Profile Picture" class="profile-picture">
            <h1><?php echo htmlspecialchars($user['name']); ?></h1>
            <p><?php echo htmlspecialchars($user['email']); ?></p>
            <a href="logout.php" class="logout-btn">Logout</a>
        </div>

        <!-- Profile Details -->
        <div class="profile-details">
            <h2>Personal Information</h2>
            <p><strong>Phone:</strong> <?php echo htmlspecialchars($user['phone']); ?></p>
            <p><strong>Address:</strong> <?php echo htmlspecialchars($user['address']); ?></p>
            <p><strong>Joined:</strong> <?php echo htmlspecialchars($user['created_at']); ?></p>
        </div>
    </div>
</body>
</html>
