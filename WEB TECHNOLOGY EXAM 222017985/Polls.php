<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>About our Polls</title>
  <!-- Linking to external stylesheet -->
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
    <li style="display: inline; margin-right: 10px;">
      <img src="./images/Online-Voting.png" width="90" height="60" alt="Logo">
    </li>
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
        <!-- Links inside the dropdown menu -->
        <a href="login.html">Login</a>
        <a href="register.html">Register</a>
        <a href="logout.php">Logout</a>
      </div>
    </li><br><br>
  </ul>
</header>

<section>
  <h1>Polls Form</h1>
  <form method="post" onsubmit="return confirmInsert();">
    <label for="poll_id">poll_id:</label>
    <input type="number" id="poll_id" name="poll_id" required><br><br>

    <label for="user_id">user_id:</label>
    <input type="number" id="user_id" name="user_id" required><br><br>

    <label for="quest"> question:</label>
    <input type="text" id="quest" name="quest" required><br><br>

    <label for="creat_at">created_at:</label>
    <input type="date" id="creat_at" name="creat_at" required><br><br>

    <label for="exp_date">expiration_date:</label>
    <input type="date" id="exp_date" name="exp_date" required><br><br>

    <input type="submit" name="insert" value="Insert"><br><br>

    <a href="./home.html">Go Back to Home</a>
  </form>

  <?php
  include('database_connection.php');

  // Check if the form is submitted for insert
  if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['insert'])) {
      // Insert section
      $cvp = $connection->prepare("INSERT INTO polls(poll_id, user_id, question, created_at, expiration_date) VALUES (?, ?, ?, ?, ?)");
      $cvp->bind_param("iisss", $pollid, $userid, $quest, $creat_at, $exp_date);

      // Set parameters from POST and execute
      $pollid = $_POST['poll_id'];
      $userid = $_POST['user_id'];
      $quest = $_POST['quest'];
      $creat_at = $_POST['creat_at'];
      $exp_date = $_POST['exp_date'];

      if ($cvp->execute()) {
          echo "New record has been added successfully.<br><br>
                 <a href='polls.html'>Back to Form</a>";
      } else {
          echo "Error inserting data: " . $cvp->error;
      }

      $cvp->close();
  }
  ?>

  <center><h2>Table of Polls</h2></center>
  <table border="5">
    <tr>
      <th>poll_id</th>
      <th>user_id</th>
      <th>question</th>
      <th>created_at</th>
      <th>expiration_date</th>
      <th>Delete</th>
      <th>Update</th>
    </tr>

    <?php
    include('database_connection.php');
    // SQL query to fetch data from the polls table
    $sql = "SELECT * FROM polls";
    $result = $connection->query($sql);

    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            $pollid = $row["poll_id"];
            echo "<tr>
                    <td>" . $row["poll_id"] . "</td>
                    <td>" . $row["user_id"] . "</td>
                    <td>" . $row["question"] . "</td> 
                    <td>" . $row["created_at"] . "</td>
                    <td>" . $row["expiration_date"] . "</td>
                    <td><a style='padding:4px' href='delete_polls.php?poll_Id=$pollid'>Delete</a></td> 
                    <td><a style='padding:4px' href='update_polls.php?poll_Id=$pollid'>Update</a></td> 
                </tr>";
        }
    } else {
        echo "<tr><td colspan='7'>No data found</td></tr>";
    }
    // Close connection
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
