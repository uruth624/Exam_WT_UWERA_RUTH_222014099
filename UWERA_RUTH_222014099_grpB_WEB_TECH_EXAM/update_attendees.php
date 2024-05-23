<?php
include('db_connection.php');

// Check if AttendeeID is set
if (isset($_REQUEST['AttendeeID'])) {
  $AttendeeID = $_REQUEST['AttendeeID'];

  // Prepare statement with parameterized query to prevent SQL injection
  $stmt = $connection->prepare("SELECT * FROM attendees WHERE AttendeeID=?");
  $stmt->bind_param("i", $AttendeeID);
  $stmt->execute();
  $result = $stmt->get_result();

  if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();
    $UserID = $row['UserID'];
  } else {
    echo "Attendee not found.";
  }
  $stmt->close(); // Close the statement after use
}

?>

<!DOCTYPE html>
<html>
<head>
    <title>Update Attendee Information</title>
    <!-- JavaScript validation and content load for update or modify data-->
    <script>
        function confirmUpdate() {
            return confirm('Are you sure you want to update this record?');
        }
    </script>
</head>
<body>
    <center>
        <!-- Update attendee information form -->
        <h2><u>Update Attendee Information</u></h2>
        <form method="POST" onsubmit="return confirmUpdate();">
            <label for="UserID">User ID:</label>
            <input type="text" name="UserID" value="<?php echo isset($UserID) ? $UserID : ''; ?>">
            <br><br>

            <input type="submit" name="up" value="Update">
        </form>
    </center>
</body>
</html>

<?php
if (isset($_POST['up'])) {
  // Retrieve updated values from form
  $UserID = $_POST['UserID'];

  // Update the attendee in the database
  $stmt = $connection->prepare("UPDATE attendees SET UserID=? WHERE AttendeeID=?");
  $stmt->bind_param("ii", $UserID, $AttendeeID);
  $stmt->execute();

  // Redirect to appropriate page after update
  header('Location: attendees.php');
  exit(); // Ensure no other content is sent after redirection
}

// Close the connection
mysqli_close($connection);
?>
