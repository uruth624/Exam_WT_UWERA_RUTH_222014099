<?php
include('db_connection.php');

// Check if WorkshopID is set
if (isset($_REQUEST['WorkshopID'])) {
    $WorkshopID = $_REQUEST['WorkshopID'];
    
    // Prepare and execute the DELETE statement
    $stmt = $connection->prepare("DELETE FROM workshops WHERE WorkshopID=?");
    $stmt->bind_param("i", $WorkshopID);
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
        <input type="hidden" name="WorkshopID" value="<?php echo $WorkshopID; ?>">
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
    echo "WorkshopID is not set.";
}

$connection->close();
?>
