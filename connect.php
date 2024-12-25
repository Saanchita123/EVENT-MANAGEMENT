<?php
// MySQLi Connection
$servername = "localhost";
$username = "root";
$password = ''; 
$database = "event-registration"; // Your database name

// Create a MySQLi connection
$conn = mysqli_connect($servername, $username, $password, $database);

// Check if the MySQLi connection was successful
if (!$conn) {
    die("MySQLi connection failed: " . mysqli_connect_error());
} else {
    // echo "MySQLi connection was successful<br>";
}
?>

<?php
// PDO Connection
$host = 'localhost';           // Database host
$dbname = 'event-registration'; // Database name
$username = 'root';             // Database username
$password = '';                 // Database password (empty string)

try {
    // Create a PDO connection
    $pdo = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);
    
    // Set the PDO error mode to exception
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    // echo "PDO connection successful<br>"; // Uncomment this for testing PDO connection
} catch (PDOException $e) {
    // If PDO connection fails, display the error
    echo "PDO connection failed: " . $e->getMessage();
}
?>
