<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Our Options</title>
  <link rel="stylesheet" type="text/css" href="style.css" title="style 1" media="screen, tv, projection, handheld, print"/>
  <style>
/* Define your CSS styles here */
    /* Normal link */
    a {
      padding: 10px;
      color: white;
      background-color: green; /* Changed to green */
      text-decoration: none;
      margin-right: 15px;
    }

    /* Visited link */
    a:visited {
      color: white;
    }
    /* Unvisited link */
    a:link {
      color: white; /* Changed to lowercase */
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
      margin-left: 15px; /* Adjust this value as needed */
      padding: 8px;  
    }
    header {
      background-color: #9067;
      padding: 20px;
    }
    section {
      padding: 32px; /* Added space */
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
  <section>
  <h1>Tags Form</h1>
  <form method="post" onsubmit="return confirmInsert();">
    <label for="tagid">Tag ID:</label>
    <input type="number" id="tagid" name="tagid"><br><br>

    <label for="tname">Tag Name:</label>
    <input type="text" id="tname" name="tname" required><br><br>

    <input type="submit" name="add" value="Insert"><br><br>

    <a href="./home.html">Go Back to Home</a>
  </form>

  <?php
  include('database_connection.php');

  if ($_SERVER["REQUEST_METHOD"] == "POST") {
      $tagid = $_POST['tagid']; // Corrected variable name
      $tname = $_POST['tname']; // Corrected variable name
      $cvp = $connection->prepare("INSERT INTO tags(tag_id, tag_name) VALUES (?, ?)");
      $cvp->bind_param("is", $tagid, $tname);

      if ($cvp->execute()) {
          echo "New record has been added successfully";
      } else {
          echo "Error: " . $cvp->error;
      }
      $cvp->close();
  }
  $connection->close();
  ?>
</section>

<section>
  <h2>Table of Tags</h2>
  <table border="5">
    <tr>
      <th>Tag ID</th>
      <th>Tag Name</th>
      <th>Delete</th>
      <th>Update</th>
    </tr>
    <?php
    include "database_connection.php";
    $sql = "SELECT * FROM tags";
    $result = $connection->query($sql);

    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            $tagid = $row['tag_id'];
            echo "<tr>
                    <td>" . $row['tag_id'] . "</td>
                    <td>" . $row['tag_name'] . "</td>
                    <td><a style='padding:4px' href='delete_Tags.php?tag_id=$tagid'>Delete</a></td> 
                    <td><a style='padding:4px' href='update_Tags.php?tag_id=$tagid'>Update</a></td> 
                </tr>";
        }
    } else {
        echo "<tr><td colspan='4'>No data found</td></tr>"; // Corrected colspan value
    }
    $connection->close();
    ?>
  </table>
</section>

<footer>
  <marquee> 
    <b><h2>UR CBE BIT &copy, 2024 &reg222017985, Designer by: BYIRINGIRO VIANNEY</h2></b>
  </marquee>
</footer>
</body>
</html>