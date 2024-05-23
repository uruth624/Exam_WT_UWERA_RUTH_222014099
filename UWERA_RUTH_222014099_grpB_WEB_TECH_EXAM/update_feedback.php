<?php
include('db_connection.php');

// Check if FeedbackID is set
if (isset($_REQUEST['feedback_id'])) {
  $feedback_id = $_REQUEST['feedback_id'];

  // Prepare statement with parameterized query to prevent SQL injection
  $stmt = $connection->prepare("SELECT * FROM feedback WHERE FeedbackID=?");
  $stmt->bind_param("i", $feedback_id);
  $stmt->execute();
  $result = $stmt->get_result();

  if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();
    $WorkshopID = $row['WorkshopID'];
    $AttendeeID = $row['AttendeeID'];
    $Rating = $row['Rating'];
    $Comments = $row['Comments'];
  } else {
    echo "Feedback not found.";
  }
}

$stmt->close(); // Close the statement after use

?>

<!DOCTYPE html>
<html>
<head>
    <title>Update Feedback Information</title>
    <!-- JavaScript validation and content load for update or modify data-->
    <script>
        function confirmUpdate() {
            return confirm('Are you sure you want to update this record?');
        }
    </script>
</head>
<body>
    <center>
        <!-- Update feedback information form -->
        <h2><u>Update Feedback Information</u></h2>
        <form method="POST" onsubmit="return confirmUpdate();">
            <label for="WorkshopID">Workshop ID:</label>
            <input type="number" name="WorkshopID" value="<?php echo isset($WorkshopID) ? $WorkshopID : ''; ?>">
            <br><br>

            <label for="AttendeeID">Attendee ID:</label>
            <input type="number" name="AttendeeID" value="<?php echo isset($AttendeeID) ? $AttendeeID : ''; ?>">
            <br><br>

            <label for="Rating">Rating:</label>
            <input type="number" name="Rating" min="1" max="5" value="<?php echo isset($Rating) ? $Rating : ''; ?>">
            <br><br>

            <label for="Comments">Comments:</label>
            <textarea name="Comments"><?php echo isset($Comments) ? $Comments : ''; ?></textarea>
            <br><br>

            <input type="submit" name="up" value="Update">
        </form>
    </center>
</body>
</html>

<?php
if (isset($_POST['up'])) {
  // Retrieve updated values from form
  $WorkshopID = $_POST['WorkshopID'];
  $AttendeeID = $_POST['AttendeeID'];
  $Rating = $_POST['Rating'];
  $Comments = $_POST['Comments'];

  // Update the feedback in the database
  $stmt = $connection->prepare("UPDATE feedback SET WorkshopID=?, AttendeeID=?, Rating=?, Comments=? WHERE FeedbackID=?");
  $stmt->bind_param("iiisi", $WorkshopID, $AttendeeID, $Rating, $Comments, $feedback_id);
  $stmt->execute();

  // Redirect to appropriate page after update
  header('Location: feedback.php');
  exit(); // Ensure no other content is sent after redirection
}

// Close the connection
mysqli_close($connection);
?>
