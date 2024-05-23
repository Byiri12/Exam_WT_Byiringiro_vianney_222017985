<?php
include('database_connection.php');

// Check if favorite_id is set
if (isset($_REQUEST['favorite_id'])) {
    $favorite_id = $_REQUEST['favorite_id'];

    $cvp = $connection->prepare("SELECT * FROM favorites WHERE favorite_id=?");
    $cvp->bind_param("i", $favorite_id);
    $cvp->execute();
    $result = $cvp->get_result();
    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $b = $row['user_id'];
        $c = $row['poll_id']; 
    } else {
        echo "Favorites not found.";
    }
}
?>
<!DOCTYPE html>
<html>
<head>
    <title>Update Favorites</title>
    <!-- JavaScript validation and content load for update or modify data-->
    <script>
        function confirmUpdate() {
            return confirm('Are you sure you want to update this record?');
        }
    </script>
</head>
<body>
    <center>
        <!-- Update Favorites form -->
        <h2><u>Update Form of Favorites</u></h2>
        <form method="POST" onsubmit="return confirmUpdate();">
            <label for="favid">favorite_id:</label>
            <input type="number" name="favid" value="<?php echo isset($favorite_id) ? $favorite_id : ''; ?>">
            <br><br>
            <label for="usid">user_id:</label>
            <input type="number" name="usid" value="<?php echo isset($b) ? $b : ''; ?>">
            <br><br>

            <label for="pollid">poll_id:</label> 
            <input type="number" name="pollid" value="<?php echo isset($c) ? $c : ''; ?>"> 
            <br><br>
                
            <input type="submit" name="up" value="Update">
        </form>
    </center>
</body>
</html>

<?php
include('database_connection.php');
if (isset($_POST['up'])) {
    // Retrieve updated values from the form
    $user_id = $_POST['usid']; 
    $poll_id = $_POST['pollid']; 
    $favorite_id = $_POST['favid']; 
    
    // Update the record in the database
    $cvp = $connection->prepare("UPDATE favorites SET user_id=?, poll_id=? WHERE favorite_id=?");
    $cvp->bind_param("iii", $user_id, $poll_id, $favorite_id);
    $cvp->execute();

    // Redirect to Favorites.php
    header('Location: Favorites.php');
    exit(); // Ensure that no other content is sent after the header redirection
}
?>
