<?php
include('database_connection.php');

// Check if option_id is set
if (isset($_REQUEST['option_id'])) {
    $option_id = $_REQUEST['option_id'];

    $cvp = $connection->prepare("SELECT * FROM options WHERE option_id=?");
    $cvp->bind_param("i", $option_id);
    $cvp->execute();
    $result = $cvp->get_result();
    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $b = $row['poll_id'];
        $c = $row['option_text']; 
    } else {
        echo "Options not found.";
    }
}
?>
<!DOCTYPE html>
<html>
<head>
    <title>Update Options</title>
    <!-- JavaScript validation and content load for update or modify data-->
    <script>
        function confirmUpdate() {
            return confirm('Are you sure you want to update this record?');
        }
    </script>
</head>
<body>
    <center>
        <!-- Update Options form -->
        <h2><u>Update Form of Options</u></h2>
        <form method="POST" onsubmit="return confirmUpdate();">
            <label for="optid">option_id:</label>
            <input type="number" name="optid" value="<?php echo isset($option_id) ? $option_id : ''; ?>">
            <br><br>
            <label for="pollid">poll_id:</label>
            <input type="number" name="pollid" value="<?php echo isset($b) ? $b : ''; ?>">
            <br><br>

            <label for="opttext">option_text:</label> 
            <input type="text" name="opttext" value="<?php echo isset($c) ? $c : ''; ?>"> 
            <br><br>
            
            <input type="hidden" name="option_id" value="<?php echo $option_id; ?>">
            <!-- Adding a hidden input field to send option_id -->
            
            <input type="submit" name="up" value="Update">
        </form>
    </center>
</body>
</html>

<?php
include('database_connection.php');
if (isset($_POST['up'])) {
    // Retrieve updated values from the form
    $poll_id = $_POST['pollid']; 
    $option_text = $_POST['opttext']; 
    $option_id = $_POST['option_id']; // Retrieve option_id from hidden input
    
    // Update the record in the database
    $cvp = $connection->prepare("UPDATE options SET poll_id=?, option_text=? WHERE option_id=?");
    $cvp->bind_param("isi", $poll_id, $option_text, $option_id);
    $cvp->execute();

    // Redirect to Options.php
    header('Location: Options.php');
    exit(); // Ensure that no other content is sent after the header redirection
}
?>
