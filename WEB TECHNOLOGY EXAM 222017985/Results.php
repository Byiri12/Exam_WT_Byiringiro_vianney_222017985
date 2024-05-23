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
  <!-- Header content -->
  <br>
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
  <h1>Results Form</h1>
  <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" onsubmit="return confirmInsert();">
    <label for="resultid">result_id:</label>
    <input type="number" id="resultid" name="result_id" required><br><br>

    <label for="pollid">poll_id:</label>
    <input type="number" id="pollid" name="poll_id" required><br><br>

    <label for="optid">option_id:</label>
    <input type="text" id="optid" name="option_id" required><br><br>

    <label for="votcount">vote_count:</label>
    <input type="number" id="votcount" name="vote_count" required><br><br>

    <input type="submit" name="insert" value="Insert"><br><br>

    <a href="./home.html">Go Back to Home</a>
  </form>

  <?php
  include('database_connection.php');

  // Check if the form is submitted for insert
  if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['insert'])) {
      // Insert section
      $cvp = $connection->prepare("INSERT INTO results(result_id, poll_id, option_id, vote_count) VALUES (?, ?, ?, ?)");
      $cvp->bind_param("iiis", $resultid, $pollid, $optid, $votcount);

      // Set parameters from POST and execute
      $resultid = $_POST['result_id'];
      $pollid = $_POST['poll_id'];
      $optid = $_POST['option_id'];
      $votcount = $_POST['vote_count'];
      if ($cvp->execute()) {
          echo "New record has been added successfully.<br><br>
                 <a href='results.html'>Back to Form</a>";
      } else {
          echo "Error inserting data: " . $cvp->error;
      }

      $cvp->close();
  }
  ?>

  <center><h2>Table of Results</h2></center>
  <table border="5">
    <tr>
      <th>result_id</th>
      <th>poll_id</th>
      <th>option_id</th>
      <th>vote_count</th>
      <th>Delete</th>
      <th>Update</th>
    </tr>

    <?php
    include('database_connection.php');
    // SQL query to fetch data from the Results table
    $sql = "SELECT * FROM Results"; // Changed to lowercase 'results'
    $result = $connection->query($sql);

    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            $resultid = $row["result_id"];
            echo "<tr>
                    <td>" . $row["result_id"] . "</td>
                    <td>" . $row["poll_id"] . "</td>
                    <td>" . $row["option_id"] . "</td> 
                    <td>" . $row["vote_count"] . "</td>
                    <td><a style='padding:4px' href='delete_Results.php?result_id=$resultid'>Delete</a></td> 
                    <td><a style='padding:4px' href='update_Results.php?result_id=$resultid'>Update</a></td> 
                </tr>";
        }
    } else {
        echo "<tr><td colspan='6'>No data found</td></tr>"; // Corrected colspan value
    }
    // Close connection
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
