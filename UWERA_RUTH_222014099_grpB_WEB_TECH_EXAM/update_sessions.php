<?php
include('db_connection.php');

// Check if Session ID is set
if (isset($_REQUEST['session_id'])) {
  $session_id = $_REQUEST['session_id'];

  // Prepare statement with parameterized query to prevent SQL injection
  $stmt = $connection->prepare("SELECT * FROM sessions WHERE SessionID=?");
  $stmt->bind_param("i", $session_id);
  $stmt->execute();
  $result = $stmt->get_result();

  if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();
    $WorkshopID = $row['WorkshopID'];
    $SessionTitle = $row['SessionTitle'];
    $SessionDescription = $row['SessionDescription'];
    $StartTime = $row['StartTime'];
    $EndTime = $row['EndTime'];
  } else {
    echo "Session not found.";
  }
}

$stmt->close(); // Close the statement after use

?>

<!DOCTYPE html>
<html>
<head>
    <title>Update Session Information</title>
    <!-- JavaScript validation and content load for update or modify data-->
    <script>
        function confirmUpdate() {
            return confirm('Are you sure you want to update this record?');
        }
    </script>
</head>
<body>
    <center>
        <!-- Update session information form -->
        <h2><u>Update Session Information</u></h2>
        <form method="POST" onsubmit="return confirmUpdate();">
            <label for="WorkshopID">Workshop ID:</label>
            <input type="number" name="WorkshopID" value="<?php echo isset($WorkshopID) ? $WorkshopID : ''; ?>">
            <br><br>

            <label for="SessionTitle">Session Title:</label>
            <input type="text" name="SessionTitle" value="<?php echo isset($SessionTitle) ? $SessionTitle : ''; ?>">
            <br><br>

            <label for="SessionDescription">Session Description:</label>
            <textarea name="SessionDescription"><?php echo isset($SessionDescription) ? $SessionDescription : ''; ?></textarea>
            <br><br>

            <label for="StartTime">Start Time:</label>
            <input type="text" name="StartTime" value="<?php echo isset($StartTime) ? $StartTime : ''; ?>">
            <br><br>

            <label for="EndTime">End Time:</label>
            <input type="text" name="EndTime" value="<?php echo isset($EndTime) ? $EndTime : ''; ?>">
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
  $SessionTitle = $_POST['SessionTitle'];
  $SessionDescription = $_POST['SessionDescription'];
  $StartTime = $_POST['StartTime'];
  $EndTime = $_POST['EndTime'];

  // Update the session in the database
  $stmt = $connection->prepare("UPDATE sessions SET WorkshopID=?, SessionTitle=?, SessionDescription=?, StartTime=?, EndTime=? WHERE SessionID=?");
  $stmt->bind_param("issssi", $WorkshopID, $SessionTitle, $SessionDescription, $StartTime, $EndTime, $session_id);
  $stmt->execute();

  // Redirect to appropriate page after update
  header('Location: session.php');
  exit(); // Ensure no other content is sent after redirection
}

// Close the connection
mysqli_close($connection);
?>
