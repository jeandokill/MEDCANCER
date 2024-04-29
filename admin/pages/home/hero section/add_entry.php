<?php
// add_entry.php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Include database connection code here
    $host = "localhost";
    $user = "root";
    $password = "";
    $database = "event";

    $connection = mysqli_connect($host, $user, $password, $database);

    if (!$connection) {
        die("Connection failed: " . mysqli_connect_error());
    }

    // Process form data
    $link = mysqli_real_escape_string($connection, $_POST['link']);

    // Handle file upload
    $targetDirectory = "uploads/";
    $targetFile = $targetDirectory . basename($_FILES["video"]["name"]);

    if (move_uploaded_file($_FILES["video"]["tmp_name"], $targetFile)) {
        // File has been successfully uploaded
        $videoPath = $targetFile;

        // Insert data into the database
        $query = "INSERT INTO hero_section (link, video_path) VALUES ('$link', '$videoPath')";
        mysqli_query($connection, $query);

        // Close the database connection
        mysqli_close($connection);

        // Redirect to admin panel or wherever you want
        header("Location: /Medcancer/admin/index.php");
        exit();
    } else {
        echo "Sorry, there was an error uploading your file.";
    }
}
?>
