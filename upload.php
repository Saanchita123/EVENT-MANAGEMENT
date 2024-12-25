<?php
// Include database connection
include 'connect.php'; // Ensure this contains your DB connection

// Check if the Online Form is submitted
if (isset($_POST['submitOnline'])) 
{
    // Retrieve form data
    $name = $_POST['name'];
    $email = $_POST['email'];
    $phone = $_POST['phone'];
    $event_name = $_POST['event-name'];
    $event_description = $_POST['event-description'];
    $event_type = $_POST['event-type'];
    $event_date_from = $_POST['event-date-from'];
    $event_date_to = $_POST['event-date-to'];
    $participants = $_POST['participants'];
    $image = $_POST['image'];

    // Handle image upload
    if (isset($_FILES['image'])) {
        $imageFile = $_FILES['image'];
        $imagePath = 'uploads/' . basename($imageFile['name']); // Path to store the image

        // Validate file type (e.g., only allow jpg, png, jpeg)
        $allowedTypes = ['image/jpeg', 'image/png', 'image/gif'];
        if (in_array($imageFile['type'], $allowedTypes)) {
            if (move_uploaded_file($imageFile['tmp_name'], $imagePath)) {
                // Insert into online_events table including the image path
                $stmt = $pdo->prepare("INSERT INTO online_events (name, email, phone, event_name, event_description, event_type, event_date_from, event_date_to, participants, class, image_path) 
                                       VALUES (:name, :email, :phone, :event_name, :event_description, :event_type, :event_date_from, :event_date_to, :participants, :class, :image_path)");
                $stmt->execute([
                    'name' => $name,
                    'email' => $email,
                    'phone' => $phone,
                    'event_name' => $event_name,
                    'event_description' => $event_description,
                    'event_type' => $event_type,
                    'event_date_from' => $event_date_from,
                    'event_date_to' => $event_date_to,
                    'participants' => $participants,
                    'image_path' => $imagePath
                ]);

                echo "<script>
                        alert('Event created successfully');
                        window.location.href = 'eventscreatedbyme.php';
                      </script>";
            } else {
                echo "Error uploading the file.";
            }
        } else {
            echo "Invalid file type. Only JPG, PNG, and GIF files are allowed.";
        }
    }
}
?>