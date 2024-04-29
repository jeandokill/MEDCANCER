<?php
// Include the database connection file
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "event";
$connection = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($connection->connect_error) {
    die("Connection failed: " . $connection->connect_error);
}

// Check if session ID is set and valid
if (isset($_GET['id']) && is_numeric($_GET['id'])) {
    $session_id = $_GET['id'];

    // SQL to delete the record
    $sql = "DELETE FROM council WHERE id = $session_id";

    if ($connection->query($sql) === TRUE) {
        // Alert deleted successfully
        header("Location: index.php"); // Redirect back to the main page
        exit;
    } else {
        echo "Error deleting record: " . $connection->error;
    }
} else {
    // Invalid session ID, redirect to another page or display an error message
    echo "Invalid session ID.";
}

// Close connection
$connection->close();
?>
