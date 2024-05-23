<?php
include('database_connection.php');

// Check if tag_id is set
if (isset($_REQUEST['tag_id'])) {
    $tagid = $_REQUEST['tag_id'];

    $cvp = $connection->prepare("SELECT * FROM tags WHERE tag_id = ?");
    $cvp->bind_param("i", $tagid);
    $cvp->execute();
    $result = $cvp->get_result();
    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $b = $row['tag_name'];
    } else {
        echo "Tag not found.";
    }
}
?>
<!DOCTYPE html>
<html>
<head>
    <title>Update tags</title>
    <!-- JavaScript validation and content load for update or modify data-->
    <script>
        function confirmUpdate() {
            return confirm('Are you sure you want to update this record?');
        }
    </script>
</head>
<body>
    <center>
        <!-- Update tags form -->
        <h2><u>Update Form of tags</u></h2>
        <form method="POST" onsubmit="return confirmUpdate();">
            <label for="tid">tag_id:</label>
            <input type="number" name="tid" value="<?php echo isset($tagid) ? $tagid : ''; ?>">
            <br><br>

            <label for="tname">tag_name:</label>
            <input type="text" name="tname" value="<?php echo isset($b) ? $b : ''; ?>">
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
    $tagid = $_POST['tid'];
    $tname = $_POST['tname'];

    // Update the tags in the database
    $cvp = $connection->prepare("UPDATE tags SET tag_name=? WHERE tag_id = ?");
    $cvp->bind_param("si", $tname, $tagid);
    $cvp->execute();

    // Redirect to Tags.php
    header('Location: Tags.php');
    exit(); // Ensure that no other content is sent after the header redirection
}
?>
