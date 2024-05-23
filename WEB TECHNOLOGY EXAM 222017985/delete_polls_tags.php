<?php
include('database_connection.php');

// Check if poll_tag_id is set
if(isset($_REQUEST['poll_tag_id'])) {
    $poll_tagid = $_REQUEST['poll_tag_id'];
    
    // Prepare and execute the DELETE statement
    $stmt = $connection->prepare("DELETE FROM polls_tags WHERE poll_tag_id=?");
    $stmt->bind_param("i", $poll_tagid);

    ?>
    <!DOCTYPE html>
    <html>
    <head>
        <title>Delete Record</title>
        <script>
            function confirmDelete() {
                return confirm("Are you sure you want to delete this record?");
            }
        </script>
    </head>
    <body>
        <form method="post" onsubmit="return confirmDelete();">
            <input type="hidden" name="poll_tag_id" value="<?php echo $poll_tagid; ?>">
            <input type="submit" value="Delete">
        </form>

        <?php
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            if ($stmt->execute()) {
                echo "Record deleted successfully.<br><br>
                      <a href='Polls_tags.php'>OK</a>";
            } else {
                echo "Error deleting data: " . $stmt->error;
            }
        }
        ?>
    </body>
    </html>
    <?php
    $stmt->close();
} else {
    echo "poll_tag_id is not set.";
}

$connection->close();
?>
