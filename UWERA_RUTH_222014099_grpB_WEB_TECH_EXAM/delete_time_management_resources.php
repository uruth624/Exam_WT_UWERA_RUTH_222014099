<?php
include('db_connection.php');

// Check if ResourceID is set
if (isset($_REQUEST['ResourceID'])) {
    $ResourceID = $_REQUEST['ResourceID'];
    
    // Prepare and execute the DELETE statement
    $stmt = $connection->prepare("DELETE FROM time_management_resources WHERE ResourceID=?");
    $stmt->bind_param("i", $ResourceID);
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
        <input type="hidden" name="ResourceID" value="<?php echo $ResourceID; ?>">
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
    echo "ResourceID is not set.";
}

$connection->close();
?>
