<?php
include('db_connection.php');

// Check if EnrollmentID is set
if (isset($_REQUEST['enrollment_id'])) {
  $enrollment_id = $_REQUEST['enrollment_id'];

  // Prepare statement with parameterized query to prevent SQL injection
  $stmt = $connection->prepare("SELECT * FROM enrollment WHERE EnrollmentID=?");
  $stmt->bind_param("i", $enrollment_id);
  $stmt->execute();
  $result = $stmt->get_result();

  if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();
    $WorkshopID = $row['WorkshopID'];
    $AttendeeID = $row['AttendeeID'];
    $EnrollmentDate = $row['EnrollmentDate'];
  } else {
    echo "Enrollment not found.";
  }
}

$stmt->close(); // Close the statement after use

?>

<!DOCTYPE html>
<html>
<head>
    <title>Update Enrollment Information</title>
    <!-- JavaScript validation and content load for update or modify data-->
    <script>
        function confirmUpdate() {
            return confirm('Are you sure you want to update this record?');
        }
    </script>
</head>
<body>
    <center>
        <!-- Update enrollment information form -->
        <h2><u>Update Enrollment Information</u></h2>
        <form method="POST" onsubmit="return confirmUpdate();">
            <label for="WorkshopID">Workshop ID:</label>
            <input type="number" name="WorkshopID" value="<?php echo isset($WorkshopID) ? $WorkshopID : ''; ?>">
            <br><br>

            <label for="AttendeeID">Attendee ID:</label>
            <input type="number" name="AttendeeID" value="<?php echo isset($AttendeeID) ? $AttendeeID : ''; ?>">
            <br><br>

            <label for="EnrollmentDate">Enrollment Date:</label>
            <input type="date" name="EnrollmentDate" value="<?php echo isset($EnrollmentDate) ? $EnrollmentDate : ''; ?>">
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
  $EnrollmentDate = $_POST['EnrollmentDate'];

  // Update the enrollment in the database
  $stmt = $connection->prepare("UPDATE enrollment SET WorkshopID=?, AttendeeID=?, EnrollmentDate=? WHERE EnrollmentID=?");
  $stmt->bind_param("iisi", $WorkshopID, $AttendeeID, $EnrollmentDate, $enrollment_id);
  $stmt->execute();

  // Redirect to appropriate page after update
  header('Location: enrollment.php');
  exit(); // Ensure no other content is sent after redirection
}

// Close the connection
mysqli_close($connection);
?>
