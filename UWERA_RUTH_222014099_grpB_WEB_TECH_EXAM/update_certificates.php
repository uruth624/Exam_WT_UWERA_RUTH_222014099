<?php
include('db_connection.php');

// Check if CertificateID is set
if (isset($_REQUEST['certificate_id'])) {
  $certificate_id = $_REQUEST['certificate_id'];

  // Prepare statement with parameterized query to prevent SQL injection
  $stmt = $connection->prepare("SELECT * FROM certificates WHERE CertificateID=?");
  $stmt->bind_param("i", $certificate_id);
  $stmt->execute();
  $result = $stmt->get_result();

  if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();
    $AttendeeID = $row['AttendeeID'];
    $WorkshopID = $row['WorkshopID'];
    $IssueDate = $row['IssueDate'];
    $ExpiryDate = $row['ExpiryDate'];
    $CertificateLink = $row['CertificateLink'];
  } else {
    echo "Certificate not found.";
  }
}

$stmt->close(); // Close the statement after use

?>

<!DOCTYPE html>
<html>
<head>
    <title>Update Certificate Information</title>
    <!-- JavaScript validation and content load for update or modify data-->
    <script>
        function confirmUpdate() {
            return confirm('Are you sure you want to update this record?');
        }
    </script>
</head>
<body>
    <center>
        <!-- Update certificate information form -->
        <h2><u>Update Certificate Information</u></h2>
        <form method="POST" onsubmit="return confirmUpdate();">
            <label for="AttendeeID">Attendee ID:</label>
            <input type="number" name="AttendeeID" value="<?php echo isset($AttendeeID) ? $AttendeeID : ''; ?>">
            <br><br>

            <label for="WorkshopID">Workshop ID:</label>
            <input type="number" name="WorkshopID" value="<?php echo isset($WorkshopID) ? $WorkshopID : ''; ?>">
            <br><br>

            <label for="IssueDate">Issue Date:</label>
            <input type="date" name="IssueDate" value="<?php echo isset($IssueDate) ? $IssueDate : ''; ?>">
            <br><br>

            <label for="ExpiryDate">Expiry Date:</label>
            <input type="date" name="ExpiryDate" value="<?php echo isset($ExpiryDate) ? $ExpiryDate : ''; ?>">
            <br><br>

            <label for="CertificateLink">Certificate Link:</label>
            <input type="text" name="CertificateLink" value="<?php echo isset($CertificateLink) ? $CertificateLink : ''; ?>">
            <br><br>

            <input type="submit" name="up" value="Update">
        </form>
    </center>
</body>
</html>

<?php
if (isset($_POST['up'])) {
  // Retrieve updated values from form
  $AttendeeID = $_POST['AttendeeID'];
  $WorkshopID = $_POST['WorkshopID'];
  $IssueDate = $_POST['IssueDate'];
  $ExpiryDate = $_POST['ExpiryDate'];
  $CertificateLink = $_POST['CertificateLink'];

  // Update the certificate in the database
  $stmt = $connection->prepare("UPDATE certificates SET AttendeeID=?, WorkshopID=?, IssueDate=?, ExpiryDate=?, CertificateLink=? WHERE CertificateID=?");
  $stmt->bind_param("iissii", $AttendeeID, $WorkshopID, $IssueDate, $ExpiryDate, $CertificateLink, $certificate_id);
  $stmt->execute();

  // Redirect to appropriate page after update
  header('Location: certificates.php');
  exit(); // Ensure no other content is sent after redirection
}

// Close the connection
mysqli_close($connection);
?>
