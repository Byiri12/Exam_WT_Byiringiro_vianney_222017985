<?php
include('database_connection.php');

// Check if result_id is set
if (isset($_REQUEST['result_id'])) {
    $result_id = $_REQUEST['result_id'];

    $cvp = $connection->prepare("SELECT * FROM results WHERE result_id=?");
    $cvp->bind_param("i", $result_id);
    $cvp->execute();
    $result = $cvp->get_result();
    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $b = $row['poll_id'];
        $c = $row['option_id']; 
        $d = $row['vote_count'];
    } else {
        echo "Result not found.";
    }
}
?>
<!DOCTYPE html>
<html>
<head>
    <title>Update results</title>
    <!-- JavaScript validation and content load for update or modify data-->
    <script>
        function confirmUpdate() {
            return confirm('Are you sure you want to update this record?');
        }
    </script>
</head>
<body>
    <center>
        <!-- Update results form -->
        <h2><u>Update Form of results</u></h2>
        <form method="POST" onsubmit="return confirmUpdate();">
            <label for="poll_id">poll_id:</label>
            <input type="number" name="poll_id" value="<?php echo isset($b) ? $b : ''; ?>">
            <br><br>

            <label for="opt_id">option_id:</label> 
            <input type="text" name="opt_id" value="<?php echo isset($c) ? $c : ''; ?>"> 
            <br><br>

            <label for="vote_count">vote_count:</label> 
            <input type="number" name="vote_count" value="<?php echo isset($d) ? $d : ''; ?>">
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
    $poll_id = $_POST['poll_id']; 
    $opt_id = $_POST['opt_id']; 
    $vote_count = $_POST['vote_count']; 

    // Update the result in the database
    $cvp = $connection->prepare("UPDATE results SET poll_id=?, option_id=?, vote_count=? WHERE result_id=?");
    $cvp->bind_param("iiii", $poll_id, $opt_id, $vote_count, $result_id);
    $cvp->execute();

    // Redirect to results.php
    header('Location: results.php');
    exit(); // Ensure that no other content is sent after the header redirection
}
?>
