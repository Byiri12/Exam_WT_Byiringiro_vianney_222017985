<?php
include('database_connection.php');

// Check if user_id is set
if(isset($_REQUEST['user_id'])) {
    $user_id = $_REQUEST['user_id'];
    
    // Prepare and execute the DELETE statement
    $cvp = $connection->prepare("DELETE FROM userss WHERE user_id=?");
    $cvp->bind_param("i", $usid);
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
            <input type="hidden" name="usid" value="<?php echo $usid; ?>">
            <input type="submit" value="Delete">
        </form>

        <?php
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if ($cvp->execute()) {
        echo "Record deleted successfully.<br><br>
        <a href='Users.php'>ok</a>";
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
    echo "user_id is not set.";
}

$connection->close();
?>
