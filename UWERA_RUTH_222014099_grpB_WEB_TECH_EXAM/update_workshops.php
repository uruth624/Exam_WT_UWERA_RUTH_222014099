<?php
include('db_connection.php');

// Check if Workshop ID is set
if (isset($_REQUEST['workshop_id'])) {
  $workshop_id = $_REQUEST['workshop_id'];

  // Prepare statement with parameterized query to prevent SQL injection
  $stmt = $connection->prepare("SELECT * FROM workshops WHERE WorkshopID=?");
  $stmt->bind_param("i", $workshop_id);
  $stmt->execute();
  $result = $stmt->get_result();

  if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();
    $instructor_id = $row['InstructorID'];
    $title = $row['Title'];
    $description = $row['Description'];
    $date = $row['Date'];
    $time = $row['Time'];
    $duration = $row['Duration'];
    $capacity = $row['Capacity'];
  } else {
    echo "Workshop not found.";
  }
}

$stmt->close(); // Close the statement after use

?>

<!DOCTYPE html>
<html>
<head>
    <title>Update Workshop Information</title>
    <!-- JavaScript validation and content load for update or modify data-->
    <script>
        function confirmUpdate() {
            return confirm('Are you sure you want to update this record?');
        }
    </script>
</head>
<body>
    <center>
        <!-- Update workshop information form -->
        <h2><u>Update Workshop Information</u></h2>
        <form method="POST" onsubmit="return confirmUpdate();">
            <label for="instructor_id">Instructor ID:</label>
            <input type="text" name="instructor_id" value="<?php echo isset($instructor_id) ? $instructor_id : ''; ?>">
            <br><br>

            <label for="title">Title:</label>
            <input type="text" name="title" value="<?php echo isset($title) ? $title : ''; ?>">
            <br><br>

            <label for="description">Description:</label>
            <textarea name="description"><?php echo isset($description) ? $description : ''; ?></textarea>
            <br><br>

            <label for="date">Date:</label>
            <input type="date" name="date" value="<?php echo isset($date) ? $date : ''; ?>">
            <br><br>

            <label for="time">Time:</label>
            <input type="time" name="time" value="<?php echo isset($time) ? $time : ''; ?>">
            <br><br>

            <label for="duration">Duration:</label>
            <input type="text" name="duration" value="<?php echo isset($duration) ? $duration : ''; ?>">
            <br><br>

            <label for="capacity">Capacity:</label>
            <input type="number" name="capacity" value="<?php echo isset($capacity) ? $capacity : ''; ?>">
            <br><br>

            <input type="submit" name="up" value="Update">
        </form>
    </center>
</body>
</html>

<?php
if (isset($_POST['up'])) {
  // Retrieve updated values from form
  $instructor_id = $_POST['instructor_id'];
  $title = $_POST['title'];
  $description = $_POST['description'];
  $date = $_POST['date'];
  $time = $_POST['time'];
  $duration = $_POST['duration'];
  $capacity = $_POST['capacity'];

  // Update the workshop in the database
  $stmt = $connection->prepare("UPDATE workshops SET InstructorID=?, Title=?, Description=?, Date=?, Time=?, Duration=?, Capacity=? WHERE WorkshopID=?");
  $stmt->bind_param("issssiii", $instructor_id, $title, $description, $date, $time, $duration, $capacity, $workshop_id);
  $stmt->execute();

  // Redirect to appropriate page after update
  header('Location: workshop.php');
  exit(); // Ensure no other content is sent after redirection
}

// Close the connection
mysqli_close($connection);
?>
