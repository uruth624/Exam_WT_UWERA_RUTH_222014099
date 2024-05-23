<?php
include('db_connection.php');

// Check if AttendeeID is set
if (isset($_REQUEST['AttendeeID'])) {
    $AttendeeID = $_REQUEST['AttendeeID'];
    
    // Prepare and execute the DELETE statement
    $stmt = $connection->prepare("DELETE FROM attendees WHERE AttendeeID=?");
    $stmt->bind_param("i", $AttendeeID);
?>
<!DOCTYPE html>
<html>
<head>
    <title>Delete Record</title>
    <script>
        function confirmDelete() {
            return confirm("Are you sure you want to delete this record?");
        }
    </script>
</head>
<body>
    <form method="post" onsubmit="return confirmDelete();">
        <input type="hidden" name="AttendeeID" value="<?php echo $AttendeeID; ?>">
        <input type="submit" value="Delete">
    </form>

    <?php
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        if ($stmt->execute()) {
            echo "Record deleted successfully.";
        } else {
            echo "Error deleting data: " . $stmt->error;
        }
    }
    ?>
</body>
</html>
<?php

    $stmt->close();
} else {
    echo "AttendeeID is not set.";
}

$connection->close();
?>
