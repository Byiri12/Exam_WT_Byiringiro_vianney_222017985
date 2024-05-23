<?php
include('database_connection.php');

// Check if Customer_Id is set
if (isset($_REQUEST['comment_id'])) {
    $comment_id = $_REQUEST['comment_id'];

    $cvp = $connection->prepare("SELECT * FROM comments WHERE comment_id=?");
    $cvp->bind_param("i", $comment_id);
    $cvp->execute();
    $result = $cvp->get_result();
 if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $b = $row['user_id'];
        $c = $row['poll_id']; 
        $d = $row['comment_text'];
        $e = $row['created_at'];
    } else {
        echo "comments not found.";
    }
}
?>
<!DOCTYPE html>
<html>
<head>
    <title>Update comments</title>
 <!-- JavaScript validation and content load for update or modify data-->
    <script>
        function confirmUpdate() {
            return confirm('Are you sure you want to update this record?');
        }
    </script>
</head>
<body><center>
    <!-- Update comments form -->
    <h2><u>Update Form of comments</u></h2>
    <form method="POST" onsubmit="return confirmUpdate();">
<html>
<body>
    <form method="POST">
        <label for="commid">comment-id:</label>
        <input type="number" name="commid" value="<?php echo isset($b) ? $b : ''; ?>">
        <br><br>
        <label for="usid">user_id:</label>
        <input type="number" name="usid" value="<?php echo isset($b) ? $b : ''; ?>">
        <br><br>

        <label for="pollid">poll_id:</label> 
        <input type="number" name="pollid" value="<?php echo isset($c) ? $c : ''; ?>"> 
        <br><br>

        <label for="commtxt">comment_text:</label> 
        <input type="text" name="commtxt" value="<?php echo isset($d) ? $d : ''; ?>">
        <br><br>

 <label for="Creatat">created_at:</label>
        <input type="date" name="Creatat" value="<?php echo isset($e) ? $e : ''; ?>">
        <br><br>
                
        <input type="submit" name="up" value="Update">
        
    </form>
</body>
</html>

<?php
include('database_connection.php');
if (isset($_POST['up'])) {
    // Retrieve updated values from the form
    $usid = $_POST['user_id']; 
    $pollid = $_POST['poll_id']; 
    $commtxt = $_POST['comment_text']; 
    $creatat = $_POST['created_at'];
    
    // Update the customer in the database
    $cvp = $connection->prepare("UPDATE comments SET user_id=?, poll_id=?, comment_text=?, created_at=? WHERE comment_id=?");
    $cvp->bind_param("ssssi", $usid, $pollid, $commtxt, $creatat, $comment_id);
    $cvp->execute();

// Redirect to Customer.php
    header('Location: Comments.php');
    exit(); // Ensure that no other content is sent after the header redirection
}
?>