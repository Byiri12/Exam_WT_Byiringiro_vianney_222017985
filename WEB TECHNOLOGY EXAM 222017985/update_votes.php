<?php
include('database_connection.php');

// Check if vote_id is set
if (isset($_REQUEST['vote_id'])) {
    $vote_id = $_REQUEST['vote_id'];

    $cvp = $connection->prepare("SELECT * FROM votes WHERE vote_id = ?");
    $cvp->bind_param("i", $vote_id);
    $cvp->execute();
    $result = $cvp->get_result();
    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $b = $row['user_id'];
        $c = $row['option_id'];
        $d = $row['voted_at'];
    } else {
        echo "Votes not found.";
    }
}
?>
<!DOCTYPE html>
<html>
<head>
    <title>Update votes</title>
    <!-- JavaScript validation and content load for update or modify data-->
    <script>
        function confirmUpdate() {
            return confirm('Are you sure you want to update this record?');
        }
    </script>
</head>
<body>
    <center>
        <!-- Update votes form -->
        <h2><u>Update Form of votes</u></h2>
        <form method="POST" onsubmit="return confirmUpdate();">
            <label for="votid">vot_id:</label>
            <input type="number" name="votid" value="<?php echo isset($b) ? $b : ''; ?>">
            <br><br>
            <label for="usid">user_id:</label>
            <input type="number" name="usid" value="<?php echo isset($b) ? $b : ''; ?>">
            <br><br>

            <label for="optid">option_id:</label>
            <input type="number" name="optid" value="<?php echo isset($c) ? $c : ''; ?>">
            <br><br>

            <label for="votat">voted_at:</label>
            <input type="date" name="votat" value="<?php echo isset($d) ? $d : ''; ?>">
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
    $usid = $_POST['usid'];
    $optid = $_POST['optid'];
    $votat = $_POST['votat'];

    // Update the vote in the database
    $cvp = $connection->prepare("UPDATE votes SET user_id=?, option_id=?, voted_at=? WHERE vote_id = ?");
    $cvp->bind_param("iiii", $usid, $optid, $votat, $vote_id);
    $cvp->execute();

    // Redirect to votes.php
    header('Location: votes.php');
    exit(); // Ensure that no other content is sent after the header redirection
}
?>
