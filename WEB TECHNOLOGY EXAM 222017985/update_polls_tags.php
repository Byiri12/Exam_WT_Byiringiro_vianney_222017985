<?php
include('database_connection.php');

// Check if poll_tag_id is set
if (isset($_REQUEST['poll_tag_id'])) {
    $poll_tag_id = $_REQUEST['poll_tag_id'];

    $cvp = $connection->prepare("SELECT * FROM polls_tags WHERE poll_tag_id=?");
    $cvp->bind_param("i", $poll_tag_id);
    $cvp->execute();
    $result = $cvp->get_result();
    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $b = $row['poll_id'];
        $c = $row['tag_id']; 
    } else {
        echo "Polls_tags not found.";
    }
}
?>
<!DOCTYPE html>
<html>
<head>
    <title>Update polls_tags</title>
    <!-- JavaScript validation and content load for update or modify data-->
    <script>
        function confirmUpdate() {
            return confirm('Are you sure you want to update this record?');
        }
    </script>
</head>
<body>
    <center>
        <!-- Update polls_tags form -->
        <h2><u>Update Form of polls_tags</u></h2>
        <form method="POST" onsubmit="return confirmUpdate();">
            <label for="poll_tag_id">poll_tag_id:</label>
            <input type="number" name="poll_tag_id" value="<?php echo isset($poll_tag_id) ? $poll_tag_id : ''; ?>">
            <br><br>

            <label for="poll_id">poll_id:</label>
            <input type="number" name="poll_id" value="<?php echo isset($b) ? $b : ''; ?>">
            <br><br>

            <label for="tag_id">tag_id:</label> 
            <input type="number" name="tag_id" value="<?php echo isset($c) ? $c : ''; ?>"> 
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
    $tag_id = $_POST['tag_id']; 

    // Update the record in the database
    $cvp = $connection->prepare("UPDATE polls_tags SET poll_id=?, tag_id=? WHERE poll_tag_id=?");
    $cvp->bind_param("iii", $poll_id, $tag_id, $poll_tag_id);
    $cvp->execute();

    // Redirect to Polls_tags.php
    header('Location: polls_tags.php');
    exit(); // Ensure that no other content is sent after the header redirection
}
?>
