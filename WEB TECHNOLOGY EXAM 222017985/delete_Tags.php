<?php
include('database_connection.php');

// Check if tag_id is set
if(isset($_REQUEST['tag_id'])) {
    $tag_id = $_REQUEST['tag_id'];
    
    // Prepare and execute the DELETE statement
    $cvp = $connection->prepare("DELETE FROM tags WHERE tag_id=?");
    $cvp->bind_param("i", $tagid);
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
            <input type="hidden" name="tagid" value="<?php echo $tagid; ?>">
            <input type="submit" value="Delete">
        </form>

        <?php
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if ($cvp->execute()) {
        echo "Record deleted successfully.<br><br>
        <a href='Tags.php'>ok</a>";
    } else {
        echo "Error deleting data: " . $cvp->error;
    }
    }
?>
</body>
</html>
<?php

    $cvp->close();
} else {
    echo "tag_id is not set.";
}

$connection->close();
?>
