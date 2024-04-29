<?php
// edit_entry.php
if ($_SERVER["REQUEST_METHOD"] == "GET" && isset($_GET['id'])) {
    // Include database connection code here
    $host = "localhost";
    $user = "root";
    $password = "";
    $database = "event";
    
    $connection = mysqli_connect($host, $user, $password, $database);

    if (!$connection) {
        die("Connection failed: " . mysqli_connect_error());
    }

    // Get the ID from the URL
    $id = mysqli_real_escape_string($connection, $_GET['id']);

    // Retrieve the data from the database
    $query = "SELECT * FROM hero_section WHERE id = '$id'";
    $result = mysqli_query($connection, $query);

    if ($result) {
        $row = mysqli_fetch_assoc($result);

        // Now you can display a form with pre-filled data for editing
        // Make sure to use htmlspecialchars to prevent XSS attacks
        echo '<form action="update_entry.php" method="post">';
        echo '<input type="hidden" name="id" value="' . $row['id'] . '">';
        echo 'Link: <input type="text" name="link" value="' . htmlspecialchars($row['link']) . '"><br>';
        echo 'Current Video Path: ' . $row['video_path'] . '<br>';
        echo 'Choose New Video: <input type="file" name="new_video"><br>';
        echo '<input type="submit" value="Update Entry">';
        echo '</form>';
    } else {
        echo "Error: " . mysqli_error($connection);
    }

    // Close the database connection
    mysqli_close($connection);
}
?>
