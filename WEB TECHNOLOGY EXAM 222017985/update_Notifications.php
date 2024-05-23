<?php
include('database_connection.php');

// Check if notifications is set
if (isset($_REQUEST['notification_id'])) {
    $notification_id = $_REQUEST['notification_id'];

    $cvp = $connection->prepare("SELECT * FROM comments WHERE notification_id=?");
    $cvp->bind_param("i", $notification_id);
    $cvp->execute();
    $result = $cvp->get_result();
 if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $b = $row['user_id'];
        $c = $row['notification_text']; 
        $d = $row['created_at'];
        $e = $row['is_read'];
    } else {
        echo " notifications not found.";
    }
}
?>
<!DOCTYPE html>
<html>
<head>
    <title>Update  notifications</title>
 <!-- JavaScript validation and content load for update or modify data-->
    <script>
        function confirmUpdate() {
            return confirm('Are you sure you want to update this record?');
        }
    </script>
</head>
<body><center>
    <!-- Update  notifications form -->
    <h2><u>Update Form of  Notifications</u></h2>
    <form method="POST" onsubmit="return confirmUpdate();">
<html>
<body>
    <form method="POST">
        <label for="notifid">notification_id:</label>
        <input type="number" name="notifid" value="<?php echo isset($b) ? $b : ''; ?>">
        <br><br>
        <label for="usid">user_id:</label>
        <input type="number" name="usid" value="<?php echo isset($b) ? $b : ''; ?>">
        <br><br>

        <label for="Notfid">notification_text:</label> 
        <input type="text" name="Notfid" value="<?php echo isset($c) ? $c : ''; ?>"> 
        <br><br>

        <label for="Creatat">created_at:</label> 
        <input type="date" name="Creatat" value="<?php echo isset($d) ? $d : ''; ?>">
        <br><br>

 <label for="is_read">is_read:</label>
        <input type="text" name="is_read" value="<?php echo isset($e) ? $e : ''; ?>">
        <br><br>
                
        <input type="submit" name="up" value="Update">
        
    </form>
</body>
</html>

<?php
include('database_connection.php');
if (isset($_POST['up'])) {
    // Retrieve updated values from the form
    $usid = $_POST['user_id']; 
    $notifid = $_POST['notification_id']; 
    $creatat = $_POST['created_at']; 
    $is_read = $_POST['is_read'];
    
    // Update the customer in the database
    $cvp = $connection->prepare("UPDATE notifications SET user_id=?, notification_id=?, created_at=?, is_read=? WHERE notification_id=?");
    $cvp->bind_param("ssssi", $usid, $notifid, $creatat, $is_read, $notification_id);
    $cvp->execute();

// Redirect to Customer.php
    header('Location: Notifications.php');
    exit(); // Ensure that no other content is sent after the header redirection
}
?>