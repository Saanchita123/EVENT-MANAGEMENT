<?php
// Database connection
$host = "localhost";
$user = "root";
$password = "";
$database = "event-registration";

$conn = new mysqli($host, $user, $password, $database);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Ensure all required POST data is set
if (isset($_POST['event_name'], $_POST['event_date_from'], $_POST['event_date_to'],$_POST['event_description'], $_POST['event_id'])) {
    $event_id = $_POST['event_id'];
    $event_name = $_POST['event_name'];
    $event_type = $_POST['event_type'];
    $event_date_from = $_POST['event_date_from'];
    $event_date_to = $_POST['event_date_to'];
    $event_description = $_POST['event_description'];

    // Update query
    $sql = "UPDATE online_events SET event_name = ?, event_date_from = ?, event_date_to = ?, event_description = ? WHERE id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ssssi", $event_name, $event_date_from, $event_date_to, $event_description,$id);

    if ($stmt->execute()) {
        echo "<script>
                alert('Event updated successfully.');
                window.location.href = 'dashboard.php';
              </script>";
        exit();
    } else {
        echo "Error updating event: " . $stmt->error;
    }

    $stmt->close();
} else {
    echo "Required fields are missing.";
}

$conn->close();


?>


