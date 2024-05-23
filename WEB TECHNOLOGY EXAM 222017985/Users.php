<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Our Users</title>
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
  </script></head>
<body bgcolor="yellow">
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
        <li style="display: inline; margin-right: 10px;"><a href="./Users.php">USERS</a></li>
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
  <h1>Users Form</h1>
  <form method="post" onsubmit="return confirmInsert();">
    <label for="userid">User ID:</label>
    <input type="number" id="userid" name="userid"><br><br>

    <label for="usern">User Name:</label>
    <input type="text" id="usern" name="usern" required><br><br>

    <label for="email">Email:</label>
    <input type="email" id="email" name="email" required><br><br>

    <label for="passh">Password Hash:</label>
    <input type="password" id="passh" name="passh" required><br><br>

    <label for="created_at">Created At:</label>
    <input type="date" id="created_at" name="created_at" required><br><br>

    <input type="submit" name="add" value="Insert"><br><br>

    <a href="./home.html">Go Back to Home</a>
  </form>

  <?php
  include('database_connection.php');

  if ($_SERVER["REQUEST_METHOD"] == "POST") {
      $stmt = $connection->prepare("INSERT INTO Users(user_id, username, email, password_hash, created_at) VALUES (?, ?, ?, ?, ?)");
      $stmt->bind_param("issss", $userid, $usern, $email, $passh, $created_at);

      $userid = $_POST['userid'];
      $usern = $_POST['usern'];
      $email = $_POST['email'];
      $passh = $_POST['passh'];
      $created_at = $_POST['created_at'];

      if ($stmt->execute()) {
          echo "New record has been added successfully";
      } else {
          echo "Error: " . $stmt->error;
      }
      $stmt->close();
  }
  $connection->close();
  ?>
</section>

<section>
  <h2>Table of Users</h2>
  <table border="5">
    <tr>
      <th>User ID</th>
      <th>User Name</th>
      <th>Email</th>
      <th>Password Hash</th>  
      <th>Created At</th>
      <th>Delete</th>
      <th>Update</th>
    </tr>
    <?php
    include "database_connection.php";
    $sql = "SELECT * FROM Users";
    $result = $connection->query($sql);

    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            $userid = $row['user_id'];
            echo "<tr>
                    <td>" . $row['user_id'] . "</td>
                    <td>" . $row['username'] . "</td>
                    <td>" . $row['email'] . "</td>
                    <td>" . $row['password_hash'] . "</td>
                    <td>" . $row['created_at'] . "</td>
                    <td><a style='padding:4px' href='delete_Users.php?user_id=$userid'>Delete</a></td> 
                    <td><a style='padding:4px' href='update_Users.php?user_id=$userid'>Update</a></td> 
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
    <b><h2>UR CBE BIT &copy, 2024 &reg222017985, Designer by: BYIRINGIRO VIANNEY</h2></b>
  </marquee>
</footer>
</body>
</html>