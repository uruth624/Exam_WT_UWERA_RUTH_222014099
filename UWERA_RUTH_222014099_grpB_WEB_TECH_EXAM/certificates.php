
<!DOCTYPE html>
<html lang="en">
<head>
  <!-- Linking to external stylesheet -->
  <link rel="stylesheet" type="text/css" href="style.css" title="style 1" media="screen, tv, projection, handheld, print"/>
  <!-- Defining character encoding -->
  <meta charset="utf-8">
  <!-- Setting viewport for responsive design -->
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>certificates Page</title>
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
    <h1><u> certificates Form </u></h1>

<form method="post" onsubmit="return confirmInsert();">
    <label for="CertificateID">CertificateID:</label>
    <input type="number" id="CertificateID" name="CertificateID" required><br><br>

    <label for="  AttendeeID">AttendeeID:</label>
    <input type="number" id="AttendeeID" name=" AttendeeID" required><br><br>

    <label for="  WorkshopID">WorkshopID:</label>
    <input type="number" id=" WorkshopID" name=" WorkshopID" required><br><br>

    <label for="IssueDate">IssueDate:</label>
    <input type="date" id="IssueDate" name="IssueDate" required><br><br>

    <label for="ExpiryDate">ExpiryDate:</label>
    <input type="date" id="ExpiryDate" name="ExpiryDate" required><br><br>

    <label for="CertificateLink">CertificateLink:</label>
    <input type="link" id="CertificateLink" name="CertificateLink" required><br><br>

    



    <input type="submit" name="add" value="Insert">
</form>

<?php
include('db_connection.php');

// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Prepare and bind the parameters
    $stmt = $connection->prepare("INSERT INTO certificates(CertificateID, AttendeeID,  WorkshopID,  IssueDate, ExpiryDate,  CertificateLink) VALUES (?,?,?,?,?,?)");
    $stmt->bind_param("is", $CertificateID, $AttendeeID  ,$WorkshopID, $IssueDate,$ExpiryDate, $CertificateLink);
    // Set parameters and execute
    $CertificateID = $_POST['CertificateID'];
    $AttendeeID= $_POST['AttendeeID'];
    $WorkshopID= $_POST['WorkshopID'];
    $IssueDate = $_POST['IssueDate'];
    $ExpiryDate = $_POST['ExpiryDate'];
    $CertificateLink = $_POST['CertificateLink'];
   
    if ($stmt->execute() == TRUE) {
        echo "New record has been added successfully";
    } else {
        echo "Error: " . $stmt->error;
    }
    $stmt->close();
}
$connection->close();
?>


<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Detail information of certificates</title>
    <style>
        table {
            width: 100%;
            border-collapse: collapse;
        }

        th, td {
            border: 1px solid #ddd;
            padding: 8px;
            text-align: left;
        }

        th {
            background-color: #f2f2f2;
        }
    </style>
</head>
<body>
    <center><h2>Table of certificates</h2></center>  
    <table border="6">
        <tr>
            <th>CertificateID</th>
            <th>AttendeeID</th>
            <th>WorkshopID</th>
            <th>IssueDate</th>
            <th>ExpiryDate</th>
            <th>CertificateLink</th>
            <th>Delete</th>
            <th>Update</th>
        </tr>
<?php
include('db_connection.php');

// Prepare SQL query to retrieve all certificates
$sql = "SELECT * FROM certificates";
$result = $connection->query($sql);

// Check if there are any certificates
if ($result->num_rows > 0) {
    // Output data for each row
    while ($row = $result->fetch_assoc()) {
        $CertificateID = $row['CertificateID'];
        echo "<tr>
            <td>" . $row['CertificateID'] . "</td>
            <td>" . $row['AttendeeID'] . "</td>
            <td>" . $row['WorkshopID'] . "</td> 
            <td>" . $row['IssueDate'] . "</td>
            <td>" . $row['ExpiryDate'] . "</td>
            <td>" . $row['CertificateLink'] . "</td>
            <td><a style='padding:4px' href='delete_certificates.php?CertificateID=$CertificateID'>Delete</a></td> 
            <td><a style='padding:4px' href='update_certificates.php?order_id=$CertificateID'>Update</a></td> 
        </tr>";
    }

} else {
    echo "<tr><td colspan='8'>No data found</td></tr>";
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
