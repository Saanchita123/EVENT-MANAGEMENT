<?php
session_start(); // Start the session

// Unset all session variables
$_SESSION = array(); 

// If you want to delete the session cookie, you can do so:
if (ini_get("session.use_cookies")) {
    $params = session_get_cookie_params();
    setcookie(session_name(), '', time() - 42000,
        $params["path"], $params["domain"],
        $params["secure"], $params["httponly"]
    );
}

// Finally, destroy the session
session_destroy(); 

// Redirect to login page or homepage
echo "<script>alert('successfully logged out :'); window.location.href = 'login1.html';</script>"; // Change 'login.php' to your desired location
exit;
?>
<?php
session_start(); // Start the session

// Prevent caching
header("Cache-Control: no-store, no-cache, must-revalidate, max-age=0");
header("Cache-Control: post-check=0, pre-check=0", false);
header("Pragma: no-cache");

// Check if user is logged in (example: check if phone number is set in session)
if (!isset($_SESSION['user_phone'])) {
    echo "<script>alert('Please log in to continue.'); window.location.href = 'login1.html';</script>";
    exit; // Stop script execution if user is not logged in
}
?>
