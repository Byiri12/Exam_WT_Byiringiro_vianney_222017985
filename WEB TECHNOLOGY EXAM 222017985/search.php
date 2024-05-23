<?php
include('database_connection.php');

if(isset($_GET['query'])) {
    // Sanitize input to prevent SQL injection
    $searchTerm = $connection->real_escape_string($_GET['query']);

    // Perform the search query
    $sql = "SELECT * FROM comments WHERE comment_id LIKE '%$searchTerm%'";
    $result_comment = $connection->query($sql);

    // Search in the favorites table
    $sql = "SELECT * FROM favorites WHERE favorite_id LIKE '%$searchTerm%'";
    $result_favorite = $connection->query($sql);

    // Search in the notifications table
    $sql = "SELECT * FROM notifications WHERE notification_id LIKE '%$searchTerm%'";
    $result_notification = $connection->query($sql);

    // Search in the options table
    $sql = "SELECT * FROM options WHERE option_id LIKE '%$searchTerm%'";
    $result_option = $connection->query($sql);

    // Search in the polls table
    $sql = "SELECT * FROM polls WHERE poll_id LIKE '%$searchTerm%'";
    $result_poll_id = $connection->query($sql);

    // Search in the polls_tags table
    $sql = "SELECT * FROM polls_tags WHERE poll_tag_id LIKE '%$searchTerm%'";
    $result_polls_tags = $connection->query($sql);

    // Search in the results table
    $sql = "SELECT * FROM results WHERE result_id LIKE '%$searchTerm%'";
    $result_result_id = $connection->query($sql);

    // Search in the tags table
    $sql = "SELECT * FROM tags WHERE tag_name LIKE '%$searchTerm%'";
    $result_tag_name = $connection->query($sql);

    // Search in the users table
    $sql = "SELECT * FROM users WHERE username LIKE '%$searchTerm%'";
    $result_username = $connection->query($sql);

    // Search in the votes table
    $sql = "SELECT * FROM votes WHERE vote_id LIKE '%$searchTerm%'";
    $result_voted = $connection->query($sql);


    // Output search results table
    echo "<h2><u>Search Results:</u></h2>";
    echo "<h3>comments:</h3>";
    if ($result_comment->num_rows > 0) {
        while ($row = $result_comment->fetch_assoc()) {
            echo "<p>" . $row['comment_id'] . "</p>";
        }
    } else {
        echo "<p>No comments found matching the search term: " . $searchTerm . "</p>";
    }

    echo "<h3>favorites:</h3>";
    if ($result_favorite->num_rows > 0) {
        while ($row = $result_favorite->fetch_assoc()) {
            echo "<p>" . $row['favorite_id'] . "</p>";
        }
    } else {
        echo "<p>No favorites found matching the search term: " . $searchTerm . "</p>";
    }

    echo "<h3>notifications:</h3>";
    if ($result_notification->num_rows > 0) {
        while ($row = $result_notification->fetch_assoc()) {
            echo "<p>" . $row['notification_id'] . "</p>";
        }
    } else {
        echo "<p>No notifications found matching the search term: " . $searchTerm . "</p>";
    }

    echo "<h3>options:</h3>";
    if ($result_option->num_rows > 0) {
        while ($row = $result_option->fetch_assoc()) {
            echo "<p>" . $row['option_id'] . "</p>";
        }
    } else {
        echo "<p>No options found matching the search term: " . $searchTerm . "</p>";
    }

    echo "<h3>polls:</h3>";
    if ($result_poll_id->num_rows > 0) {
        while ($row = $result_poll_id->fetch_assoc()) {
            echo "<p>" . $row['poll_id'] . "</p>";
        }
    } else {
        echo "<p>No polls found matching the search term: " . $searchTerm . "</p>";
    }

    echo "<h3>results:</h3>";
    if ($result_result_id->num_rows > 0) {
        while ($row = $result_result_id->fetch_assoc()) {
            echo "<p>" . $row['result_id'] . "</p>";
        }
    } else {
        echo "<p>No results found matching the search term: " . $searchTerm . "</p>";
    }

    echo "<h3>tags:</h3>";
    if ($result_tag_name ->num_rows > 0) {
        while ($row = $result_tag_name ->fetch_assoc()) {
            echo "<p>" . $row['tag_name'] . "</p>";
        }
    } else {
        echo "<p>No tags found matching the search term: " . $searchTerm . "</p>";
    }
 echo "<h3>polls_tags:</h3>";
    if ($result_polls_tags->num_rows > 0) {
        while ($row = $result_polls_tags->fetch_assoc()) {
            echo "<p>" . $row['poll_tag_id'] . "</p>";
        }
    } else {
        echo "<p>No polls_tags found matching the search term: " . $searchTerm . "</p>";
    }

    echo "<h3>users:</h3>";
    if ($result_username->num_rows > 0) {
        while ($row = $result_username->fetch_assoc()) {
            echo "<p>" . $row['username'] . "</p>";
        }
    } else {
        echo "<p>No usera found matching the search term: " . $searchTerm . "</p>";
    }

    echo "<h3>votes:</h3>";
    if ($result_voted->num_rows > 0) {
        while ($row = $result_voted->fetch_assoc()) {
            echo "<p>" . $row['vote_id'] . "</p>";
        }
    } else {
        echo "<p>No votes found matching the search term: " . $searchTerm . "</p>";
    }
    $connection->close();
} else {
    echo "No search term was provided.";
}
?>
