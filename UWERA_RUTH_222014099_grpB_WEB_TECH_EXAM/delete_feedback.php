<?php
include('db_connection.php');

// Check if FeedbackID is set
if (isset($_REQUEST['FeedbackID'])) {
    $FeedbackID = $_REQUEST['FeedbackID'];
    
    // Prepare and execute the DELETE statement
    $stmt = $connection->prepare("DELETE FROM feedback WHERE FeedbackID=?");
    $stmt->bind_param("i", $FeedbackID);
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
        <input type="hidden" name="FeedbackID" value="<?php echo $FeedbackID; ?>">
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
    echo "FeedbackID is not set.";
}

$connection->close();
?>
