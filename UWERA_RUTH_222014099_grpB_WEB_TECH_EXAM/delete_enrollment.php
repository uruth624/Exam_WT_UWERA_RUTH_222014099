<?php
include('db_connection.php');

// Check if EnrollmentID is set
if (isset($_REQUEST['EnrollmentID'])) {
    $EnrollmentID = $_REQUEST['EnrollmentID'];
    
    // Prepare and execute the DELETE statement
    $stmt = $connection->prepare("DELETE FROM enrollment WHERE EnrollmentID=?");
    $stmt->bind_param("i", $EnrollmentID);
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
        <input type="hidden" name="EnrollmentID" value="<?php echo $EnrollmentID; ?>">
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
    echo "EnrollmentID is not set.";
}

$connection->close();
?>
