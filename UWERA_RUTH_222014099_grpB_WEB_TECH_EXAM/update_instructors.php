<?php
include('db_connection.php');

// Check if Instructor ID is set
if (isset($_REQUEST['instructor_id'])) {
  $instructor_id = $_REQUEST['instructor_id'];

  // Prepare statement with parameterized query to prevent SQL injection
  $stmt = $connection->prepare("SELECT * FROM instructors WHERE InstructorID=?");
  $stmt->bind_param("i", $instructor_id);
  $stmt->execute();
  $result = $stmt->get_result();

  if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();
    $UserID = $row['UserID'];
    $Bio = $row['Bio'];
    $Expertise = $row['Expertise'];
  } else {
    echo "Instructor not found.";
  }
}

$stmt->close(); // Close the statement after use

?>

<!DOCTYPE html>
<html>
<head>
    <title>Update Instructor Information</title>
    <!-- JavaScript validation and content load for update or modify data-->
    <script>
        function confirmUpdate() {
            return confirm('Are you sure you want to update this record?');
        }
    </script>
</head>
<body>
    <center>
        <!-- Update instructor information form -->
        <h2><u>Update Instructor Information</u></h2>
        <form method="POST" onsubmit="return confirmUpdate();">
            <label for="UserID">User ID:</label>
            <input type="number" name="UserID" value="<?php echo isset($UserID) ? $UserID : ''; ?>">
            <br><br>

            <label for="Bio">Bio:</label>
            <textarea name="Bio"><?php echo isset($Bio) ? $Bio : ''; ?></textarea>
            <br><br>

            <label for="Expertise">Expertise:</label>
            <input type="text" name="Expertise" value="<?php echo isset($Expertise) ? $Expertise : ''; ?>">
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
  $Bio = $_POST['Bio'];
  $Expertise = $_POST['Expertise'];

  // Update the instructor in the database
  $stmt = $connection->prepare("UPDATE instructors SET UserID=?, Bio=?, Expertise=? WHERE InstructorID=?");
  $stmt->bind_param("issi", $UserID, $Bio, $Expertise, $instructor_id);
  $stmt->execute();

  // Redirect to appropriate page after update
  header('Location: instructor.php');
  exit(); // Ensure no other content is sent after redirection
}

// Close the connection
mysqli_close($connection);
?>
