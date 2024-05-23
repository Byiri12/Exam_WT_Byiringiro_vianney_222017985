<?php
include('database_connection.php');

// Check if Results_id is set
if(isset($_REQUEST['result_id'])) {
    $result_id = $_REQUEST['result_id'];
    
    // Prepare and execute the DELETE statement
    $cvp = $connection->prepare("DELETE FROM results WHERE result_id=?");
    $cvp->bind_param("i", $result_id);
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
            <input type="hidden" name="result_id" value="<?php echo $result_id; ?>">
            <input type="submit" value="Delete">
        </form>

        <?php
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if ($cvp->execute()) {
        echo "Record deleted successfully.<br><br>
        <a href='Results.php'>ok</a>";
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
    echo "result_id is not set.";
}

$connection->close();
?>
