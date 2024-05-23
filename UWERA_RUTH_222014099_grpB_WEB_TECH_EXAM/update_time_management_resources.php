<?php
include('db_connection.php');

// Check if Resource ID is set
if (isset($_REQUEST['resource_id'])) {
  $resource_id = $_REQUEST['resource_id'];

  // Prepare statement with parameterized query to prevent SQL injection
  $stmt = $connection->prepare("SELECT * FROM time_management_resources WHERE ResourceID=?");
  $stmt->bind_param("i", $resource_id);
  $stmt->execute();
  $result = $stmt->get_result();

  if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();
    $title = $row['Title'];
    $description = $row['Description'];
    $link = $row['Link'];
  } else {
    echo "Resource not found.";
  }
}

$stmt->close(); // Close the statement after use

?>

<!DOCTYPE html>
<html>
<head>
    <title>Update Resource Information</title>
    <!-- JavaScript validation and content load for update or modify data-->
    <script>
        function confirmUpdate() {
            return confirm('Are you sure you want to update this record?');
        }
    </script>
</head>
<body>
    <center>
        <!-- Update resource information form -->
        <h2><u>Update Resource Information</u></h2>
        <form method="POST" onsubmit="return confirmUpdate();">
            <label for="title">Title:</label>
            <input type="text" name="title" value="<?php echo isset($title) ? $title : ''; ?>">
            <br><br>

            <label for="description">Description:</label>
            <textarea name="description"><?php echo isset($description) ? $description : ''; ?></textarea>
            <br><br>

            <label for="link">Link:</label>
            <input type="text" name="link" value="<?php echo isset($link) ? $link : ''; ?>">
            <br><br>

            <input type="submit" name="up" value="Update">
        </form>
    </center>
</body>
</html>

<?php
if (isset($_POST['up'])) {
  // Retrieve updated values from form
  $title = $_POST['title'];
  $description = $_POST['description'];
  $link = $_POST['link'];

  // Update the resource in the database
  $stmt = $connection->prepare("UPDATE time_management_resources SET Title=?, Description=?, Link=? WHERE ResourceID=?");
  $stmt->bind_param("sssi", $title, $description, $link, $resource_id);
  $stmt->execute();

  // Redirect to appropriate page after update
  header('Location: resource.php');
  exit(); // Ensure no other content is sent after redirection
}

// Close the connection
mysqli_close($connection);
?>
