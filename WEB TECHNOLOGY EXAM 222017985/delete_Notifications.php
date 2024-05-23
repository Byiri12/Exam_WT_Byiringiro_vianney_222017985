<?php
include('database_connection.php');

// Check if notification_id is set
if (isset($_GET['Notif_id'])) {
    $notfid = (int)$_GET['Notif_id']; // Cast to integer for type safety

    // Prepare and execute the DELETE statement with parameter binding
    if ($stmt = $connection->prepare("DELETE FROM notifications WHERE notification_id = ?")) {
        $stmt->bind_param("i", $notfid);
        $stmt->execute();

        if ($stmt->affected_rows > 0) {
            echo "Record deleted successfully.";
header('Location:Notifications.php');
        } else {
            echo "No record found with the provided notification_id.";
        }

        $stmt->close();
    } else {
        echo "Failed to prepare the SQL statement.";
    }
} 

// Close the database connection
$connection->close();
?>
