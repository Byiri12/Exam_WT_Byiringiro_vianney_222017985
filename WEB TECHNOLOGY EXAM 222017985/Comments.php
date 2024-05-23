<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Our Comments</title>
  <link rel="stylesheet" type="text/css" href="style.css" title="style 1" media="screen, tv, projection, handheld, print"/>
  <style>
    /* Define your CSS styles here */
    /* Normal link */
    a {
      padding: 10px;
      color: white;
      background-color: white;
      text-decoration: none;
      margin-right: 15px;
    }

    /* Visited link */
    a:visited {
      color: green;
    }
    /* Unvisited link */
    a:link {
      color: green; /* Changed to lowercase */
    }
    /* Hover effect */
    a:hover {
      background-color: white;
    }

    /* Active link */
    a:active {
      background-color: white;
    }

    /* Extend margin left for search button */
    button.btn {
      margin-left: 15px; /* Adjust this value as needed */
      margin-top: 4px;
    }
    /* Extend margin left for search button */
    input.form-control {
      margin-left: 1300px; /* Adjust this value as needed */
      padding: 8px;  
    }
    header {
      background-color: #9067;
      padding: 20px;
    }
    section {
      padding:32px;
    }
    footer {
      background-color: #9067;
      padding: 20px;
    }
  </style>
  <!-- JavaScript validation and content load for insert data-->
  <script>
    function confirmInsert() {
      return confirm('Are you sure you want to insert this record?');
    }
  </script>
</head>
<body bgcolor="skyblue">
<header>
  <form class="d-flex" role="search" action="search.php">
    <input class="form-control me-2" type="search" placeholder="Search" aria-label="Search" name="query">
    <button class="btn btn-outline-success" type="submit">Search</button>
  </form>
  <ul style="list-style-type: none; padding: 0;">
    <li style="display: inline; margin-right: 10px;"><img src="./images/Online-Voting.png" width="90" height="60" alt="Logo"></li>
    <li style="display: inline; margin-right: 10px;"><a href="./home.html">HOME</a></li>
    <li style="display: inline; margin-right: 10px;"><a href="./about.html">ABOUT</a></li>
    <li style="display: inline; margin-right: 10px;"><a href="./contact.html">CONTACT</a></li>
    <li style="display: inline; margin-right: 10px;"><a href="./Comments.php">COMMENTS</a></li>
    <li style="display: inline; margin-right: 10px;"><a href="./Favorites.php">FAVORITES</a></li>
    <li style="display: inline; margin-right: 10px;"><a href="./Notifications.php">NOTIFICATIONS</a></li>
    <li style="display: inline; margin-right: 10px;"><a href="./Options.php">OPTIONS</a></li>
    <li style="display: inline; margin-right: 10px;"><a href="./Polls.php">POLLS</a></li>
    <li style="display: inline; margin-right: 10px;"><a href="./Polls_tags.php">POLLS_TAGS</a></li>
    <li style="display: inline; margin-right: 10px;"><a href="./Results.php">RESULTS</a></li>
    <li style="display: inline; margin-right: 10px;"><a href="./Tags.php">TAGS</a></li>
    <li style="display: inline; margin-right: 10px;"><a href="./Votes.php">VOTES</a></li>
    <li class="dropdown" style="display: inline; margin-right: 10px;">
      <a href="#" style="padding: 10px; color: white; background-color: greenyellow; text-decoration: none; margin-right: 15px;">Settings</a>
      <div class="dropdown-contents">
        <a href="login.html">Login</a>
        <a href="register.html">Register</a>
        <a href="logout.php">Logout</a>
      </div>
    </li>
  </ul>
</header>

<section>
  <h1>Comments Form</h1>
  <form method="post" onsubmit="return confirmInsert();">
    <label for="comment_id">comment_id:</label>
    <input type="number" id="comment_id" name="comment_id"><br><br>

    <label for="user_id">user_id:</label>
    <input type="number" id="user_id" name="user_id" required><br><br>

    <label for="poll_id">poll_id:</label>
    <input type="number" id="poll_id" name="poll_id" required><br><br>

    <label for="comment_text">comment_text:</label>
    <input type="text" id="comment_text" name="comment_text" required><br><br>

    <label for="created_at">created_at:</label>
    <input type="date" id="created_at" name="created_at" required><br><br>

    <input type="submit" name="add" value="Insert"><br><br>

    <a href="./home.html">Go Back to Home</a>
  </form>

  <?php
  include('database_connection.php');

  if ($_SERVER["REQUEST_METHOD"] == "POST") {
      $comment_id = $_POST['comment_id'];
      $user_id = $_POST['user_id'];
      $poll_id = $_POST['poll_id'];
      $comment_text = $_POST['comment_text'];
      $created_at = $_POST['created_at'];

      $cvp = $connection->prepare("INSERT INTO comments(comment_id, user_id, poll_id, comment_text, created_at) VALUES (?, ?, ?, ?, ?)");
      $cvp->bind_param("iiiss", $comment_id, $user_id, $poll_id, $comment_text, $created_at);

      if ($cvp->execute()) {
          echo "New record has been added successfully";
      } else {
          echo "Error: " . $cvp->error;
      }
      $cvp->close();
  }
  $connection->close();
  ?>

  <h2>Table of Comments</h2>
  <table border="5">
    <tr>
      <th>comment_id</th>
      <th>user_id</th>
      <th>poll_id</th>
      <th>comment_text</th>
      <th>created_at</th>
      <th>Delete</th>
      <th>Update</th>
    </tr>
    <?php
    include "database_connection.php";
    $sql = "SELECT * FROM comments";
    $result = $connection->query($sql);

    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            $comment_id = $row['comment_id'];
            echo "<tr>
                    <td>" . $row['comment_id'] . "</td>
                    <td>" . $row['user_id'] . "</td>
                    <td>" . $row['poll_id'] . "</td>
                    <td>" . $row['comment_text'] . "</td>
                    <td>" . $row['created_at'] . "</td>
                    <td><a style='padding:4px' href='delete_Comments.php?comment_id=$comment_id'>Delete</a></td> 
                    <td><a style='padding:4px' href='update_Comments.php?comment_id=$comment_id'>Update</a></td> 
                </tr>";
        }
    } else {
        echo "<tr><td colspan='7'>No data found</td></tr>";
    }
    $connection->close();
    ?>
  </table>
</section>

<footer>
  <marquee> 
    <b><h2>UR CBE BIT &copy; 2024 &reg; 222017985, Designed by: BYIRINGIRO VIANNEY</h2></b>
  </marquee>
</footer>
</body>
</html>
