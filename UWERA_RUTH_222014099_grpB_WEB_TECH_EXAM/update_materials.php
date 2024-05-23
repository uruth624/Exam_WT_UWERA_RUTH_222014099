<?php
include('db_connection.php');

// Check if Material ID is set
if (isset($_REQUEST['material_id'])) {
  $material_id = $_REQUEST['material_id'];

  // Prepare statement with parameterized query to prevent SQL injection
  $stmt = $connection->prepare("SELECT * FROM materials WHERE MaterialID=?");
  $stmt->bind_param("i", $material_id);
  $stmt->execute();
  $result = $stmt->get_result();

  if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();
    $WorkshopID = $row['WorkshopID'];
    $Title = $row['Title'];
    $Description = $row['Description'];
    $Link = $row['Link'];
  } else {
    echo "Material not found.";
  }
}

$stmt->close(); // Close the statement after use

?>

<!DOCTYPE html>
<html>
<head>
    <title>Update Material Information</title>
    <!-- JavaScript validation and content load for update or modify data-->
    <script>
        function confirmUpdate() {
            return confirm('Are you sure you want to update this record?');
        }
    </script>
</head>
<body>
    <center>
        <!-- Update material information form -->
        <h2><u>Update Material Information</u></h2>
        <form method="POST" onsubmit="return confirmUpdate();">
            <label for="WorkshopID">Workshop ID:</label>
            <input type="number" name="WorkshopID" value="<?php echo isset($WorkshopID) ? $WorkshopID : ''; ?>">
            <br><br>

            <label for="Title">Title:</label>
            <input type="text" name="Title" value="<?php echo isset($Title) ? $Title : ''; ?>">
            <br><br>

            <label for="Description">Description:</label>
            <textarea name="Description"><?php echo isset($Description) ? $Description : ''; ?></textarea>
            <br><br>

            <label for="Link">Link:</label>
            <input type="text" name="Link" value="<?php echo isset($Link) ? $Link : ''; ?>">
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
  $Title = $_POST['Title'];
  $Description = $_POST['Description'];
  $Link = $_POST['Link'];

  // Update the material in the database
  $stmt = $connection->prepare("UPDATE materials SET WorkshopID=?, Title=?, Description=?, Link=? WHERE MaterialID=?");
  $stmt->bind_param("isssi", $WorkshopID, $Title, $Description, $Link, $material_id);
  $stmt->execute();

  // Redirect to appropriate page after update
  header('Location: material.php');
  exit(); // Ensure no other content is sent after redirection
}

// Close the connection
mysqli_close($connection);
?>
