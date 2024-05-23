<?php
include('database_connection.php');

// Check if poll_id is set
if (isset($_REQUEST['poll_id'])) {
    $poll_id = $_REQUEST['poll_id'];

    $cvp = $connection->prepare("SELECT * FROM polls WHERE poll_id=?");
    $cvp->bind_param("i", $poll_id);
    $cvp->execute();
    $result = $cvp->get_result();
    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $b = $row['user_id'];
        $c = $row['question']; 
        $d = $row['created_at'];
        $e = $row['expiration_date'];
    } else {
        echo "Poll not found.";
    }
}
?>
<!DOCTYPE html>
<html>
<head>
    <title>Update Polls</title>
    <!-- JavaScript validation and content load for update or modify data-->
    <script>
        function confirmUpdate() {
            return confirm('Are you sure you want to update this record?');
        }
    </script>
</head>
<body>
    <center>
        <!-- Update Polls form -->
        <h2><u>Update Form of Polls</u></h2>
        <form method="POST" onsubmit="return confirmUpdate();">
            <label for="pollid">poll_id:</label>
            <input type="number" name="pollid" value="<?php echo isset($poll_id) ? $poll_id : ''; ?>">
            <br><br>
            <label for="usid">user_id:</label>
            <input type="number" name="usid" value="<?php echo isset($b) ? $b : ''; ?>">
            <br><br>

            <label for="quest">question:</label> 
            <input type="text" name="quest" value="<?php echo isset($c) ? $c : ''; ?>"> 
            <br><br>

            <label for="Creatat">created_at:</label> 
            <input type="date" name="Creatat" value="<?php echo isset($d) ? $d : ''; ?>">
            <br><br>

            <label for="exp_date">expiration_date:</label>
            <input type="date" name="exp_date" value="<?php echo isset($e) ? $e : ''; ?>">
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
    $poll_id = $_POST['pollid']; 
    $user_id = $_POST['usid']; 
    $question = $_POST['quest']; 
    $created_at = $_POST['Creatat']; 
    $expiration_date = $_POST['exp_date']; 
    
    // Update the record in the database
    $cvp = $connection->prepare("UPDATE polls SET user_id=?, question=?, created_at=?, expiration_date=? WHERE poll_id=?");
    $cvp->bind_param("isssi", $user_id, $question, $created_at, $expiration_date, $poll_id);
    $cvp->execute();

    // Redirect to Polls.php
    header('Location: polls.php');
    exit(); // Ensure that no other content is sent after the header redirection
}
?>
