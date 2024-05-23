
<!DOCTYPE html>
<html lang="en">
<head>
  <!-- Linking to external stylesheet -->
  <link rel="stylesheet" type="text/css" href="style.css" title="style 1" media="screen, tv, projection, handheld, print"/>
  <!-- Defining character encoding -->
  <meta charset="utf-8">
  <!-- Setting viewport for responsive design -->
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>workshops Page</title>
  <style>
    /* Normal link */
    a {
      padding: 10px;
      color: white;
      background-color: yellow;
      text-decoration: none;
      margin-right: 15px;
    }

    /* Visited link */
    a:visited {
      color: purple;
    }
    /* Unvisited link */
    a:link {
      color: brown; /* Changed to lowercase */
    }
    /* Hover effect */
    a:hover {
      background-color: white;
    }

    /* Active link */
    a:active {
      background-color: red;
    }

    /* Extend margin left for search button */
    button.btn {
      margin-left: 15px; /* Adjust this value as needed */
      margin-top: 4px;
    }
    /* Extend margin left for search button */
    input.form-control {
      margin-left: 1200px; /* Adjust this value as needed */

      padding: 8px;
     
    }
  </style>
  <!-- JavaScript validation and content load for insert data-->
        <script>
            function confirmInsert() {
                return confirm('Are you sure you want to insert this record?');
            }
        </script>
        
  </head>

  <header>

<body bgcolor="brown">
  <form class="d-flex" role="search" action="search.php">
      <input class="form-control me-2" type="search" placeholder="Search" aria-label="Search" name="query">
      <button class="btn btn-outline-success" type="submit">Search</button>
    </form>
  <ul style="list-style-type: none; padding: 0;">
    <li style="display: inline; margin-right: 10px;">
    <img src="./image/logoimge.jpeg" width="90" height="60" alt="Logo">
  </li>
    <li style="display: inline; margin-right: 10px;"><a href="./home.html">HOME</a>
  </li>
    <li style="display: inline; margin-right: 10px;"><a href="./about.html">ABOUT</a>
  </li>
    <li style="display: inline; margin-right: 10px;"><a href="./contact.html">CONTACT</a>
  </li>
    <li style="display: inline; margin-right: 10px;"><a href="./attendees.php">Attendees</a>
  </li>
    <li style="display: inline; margin-right: 10px;"><a href="./certificates.php">Certificates</a>
  </li>
    <li style="display: inline; margin-right: 10px;"><a href="./enrollment.php">Enrollment</a>
  </li>
    <li style="display: inline; margin-right: 10px;"><a href="./feedback.php">Feedback</a>
  </li>
    <li style="display: inline; margin-right: 10px;"><a href="./instructors.php">Instructors</a>
  </li>

   <li style="display: inline; margin-right: 10px;"><a href="./materials.php">Materials</a>
  </li>
    <li style="display: inline; margin-right: 10px;"><a href="./sessions.php">Sessions</a>
  </li>
    <li style="display: inline; margin-right: 10px;"><a href="./time_management_resources.php">Time_management_resources</a>
  </li>
    <li style="display: inline; margin-right: 10px;"><a href="./workshops.php">Workshops</a>
  </li>
   
    <li class="dropdown" style="display: inline; margin-right: 10px;">
      <a href="#" style="padding: 10px; color: white; background-color: skyblue; text-decoration: none; margin-right: 15px;">Settings</a>
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
    <h1><u>Workshops Form</u></h1> 

    <form method="post" onsubmit="return confirmInsert();">
        <label for="WorkshopID">WorkshopID:</label>
        <input type="number" id="WorkshopID" name="WorkshopID" required><br><br>

        <label for="InstructorID">InstructorID:</label>
        <input type="number" id="InstructorID" name="InstructorID" required><br><br>

        <label for="Title">Title:</label>
        <input type="text" id="Title" name="Title" required><br><br>

        <label for="Description">Description:</label>
        <input type="text" id="Description" name="Description" required><br><br>

        <label for="Date">Date:</label>
        <input type="date" id="Date" name="Date" required><br><br>

        <label for="Time">Time:</label>
        <input type="time" id="Time" name="Time" required><br><br>

        <label for="Duration">Duration:</label>
        <input type="number" id="Duration" name="Duration" required><br><br>

        <label for="Capacity">Capacity:</label>
        <input type="number" id="Capacity" name="Capacity" required><br><br>

        <input type="submit" name="add" value="Insert">
    </form>
</section>

<?php
include('db_connection.php');

// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Prepare and bind the parameters
    $stmt = $connection->prepare("INSERT INTO workshops (WorkshopID, InstructorID, Title, Description, Date, Time, Duration, Capacity) VALUES (?, ?, ?, ?, ?, ?, ?, ?)");
    $stmt->bind_param("iissssii", $WorkshopID, $InstructorID, $Title, $Description, $Date, $Time, $Duration, $Capacity);
    
    // Set parameters and execute
    $WorkshopID = $_POST['WorkshopID'];
    $InstructorID = $_POST['InstructorID'];
    $Title = $_POST['Title'];
    $Description = $_POST['Description'];
    $Date = $_POST['Date'];
    $Time = $_POST['Time'];
    $Duration = $_POST['Duration'];
    $Capacity = $_POST['Capacity'];
    
    if ($stmt->execute()) {
        echo "New record has been added successfully";
    } else {
        echo "Error: " . $stmt->error;
    }
    $stmt->close();
}
$connection->close();
?>

<section>
    <center><h2>Table of Workshops</h2></center>
    <table border="1"> 
        <tr>
            <th>WorkshopID</th>
            <th>InstructorID</th>
            <th>Title</th>
            <th>Description</th>
            <th>Date</th>
            <th>Time</th>
            <th>Duration</th>
            <th>Capacity</th>
            <th>Delete</th>
            <th>Update</th>
        </tr>
        <?php
        include('db_connection.php');

        // Prepare SQL query to retrieve all workshops
        $sql = "SELECT * FROM workshops";
        $result = $connection->query($sql);

        // Check if there are any workshops
        if ($result->num_rows > 0) {
            // Output data for each row
            while ($row = $result->fetch_assoc()) {
                $WorkshopID = $row['WorkshopID']; // Fetch the WorkshopID
                echo "<tr>
                    <td>" . $row['WorkshopID'] . "</td>
                    <td>" . $row['InstructorID'] . "</td>
                    <td>" . $row['Title'] . "</td>
                    <td>" . $row['Description'] . "</td>
                    <td>" . $row['Date'] . "</td>
                    <td>" . $row['Time'] . "</td>
                    <td>" . $row['Duration'] . "</td>
                    <td>" . $row['Capacity'] . "</td>
                    <td><a style='padding:4px' href='delete_workshops.php?WorkshopID=$WorkshopID'>Delete</a></td> 
                    <td><a style='padding:4px' href='update_workshops.php?WorkshopID=$WorkshopID'>Update</a></td> 
                </tr>";
            }
        } else {
            echo "<tr><td colspan='10'>No data found</td></tr>";
        }
        // Close the database connection
        $connection->close();
        ?>
    </table>
</body>

</section>
 
<footer>
  <center> 
    <b><h2>UR CBE BIT &copy, 2024 &reg, Designer by:UWERA RUTH</h2></b>
  </center>
</footer>
  
</body>
</html>
