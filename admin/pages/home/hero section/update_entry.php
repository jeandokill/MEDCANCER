<?php
// update_entry.php
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
    $id = mysqli_real_escape_string($connection, $_POST['id']);
    $link = mysqli_real_escape_string($connection, $_POST['link']);

    // Handle file upload
    if ($_FILES["new_video"]["size"] > 0) {
        $targetDirectory = "uploads/";
        $targetFile = $targetDirectory . basename($_FILES["new_video"]["name"]);

        if (move_uploaded_file($_FILES["new_video"]["tmp_name"], $targetFile)) {
            // File has been successfully uploaded
            $videoPath = $targetFile;

            // Update data in the database
            $query = "UPDATE hero_section SET link='$link', video_path='$videoPath' WHERE id='$id'";
            mysqli_query($connection, $query);
        } else {
            echo "Sorry, there was an error uploading your file.";
        }
    } else {
        // No new video uploaded, update link only
        $query = "UPDATE hero_section SET link='$link' WHERE id='$id'";
        mysqli_query($connection, $query);
    }

    // Close the database connection
    mysqli_close($connection);

    // Redirect to admin panel or wherever you want
    header("Location: admin_panel.php");
    exit();
}
?>


