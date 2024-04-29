<?php
// add_entry.php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Include database connection code here
    $host = "localhost";
    $user = "root";
    $password = "";
    $database = "event";;

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
        header("Location: /Medcancer/admin/index.php"); // Adjust the path as needed
        exit();
    } else {
        echo "Sorry, there was an error uploading your file.";
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <link href="/Medcancer/Home/assets/img/favicon.png" rel="icon">
    <link href="/Medcancer/Home/assets/img/favicon.png" rel="apple-touch-icon">
    <!-- Styles and meta tags go here -->
    <style>
    body {
        font-family: 'Arial', sans-serif;
        background-color: #f4f4f4;
        margin: 0;
        padding: 0;
        display: flex;
        justify-content: center;
        align-items: center;
        height: 100vh;
    }

    .entry {
        background-color: #fff;
        padding: 20px;
        border-radius: 8px;
        box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        margin-bottom: 15px;
    }

    .entry p {
        margin: 5px 0;
    }

    .edit-btn,
    .delete-btn,
    .add-btn {
        background-color: #4caf50;
        color: white;
        cursor: pointer;
        padding: 8px;
        border: none;
        border-radius: 4px;
        margin-top: 10px;
    }

    .edit-btn {
        background-color: #2196F3;
    }

    .delete-btn {
        background-color: #f44336;
    }

    .add-form {
        background-color: #fff;
        padding: 20px;
        border-radius: 8px;
        box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        width: 300px;
        text-align: center;
    }

    .add-form label {
        display: block;
        margin: 10px 0;
        color: #555;
    }

    .add-form input {
        width: calc(100% - 20px);
        padding: 8px;
        margin: 5px 0;
        box-sizing: border-box;
        border: 1px solid #ccc;
        border-radius: 4px;
        font-size: 14px;
    }

    .add-btn {
        background-color: #4caf50;
        color: white;
        cursor: pointer;
        padding: 8px;
        border: none;
        border-radius: 4px;
        margin-top: 10px;
    }
</style>
</head>
<body>
<form class="add-form" action="add_entry.php" method="post" enctype="multipart/form-data">
    <label for="link">Link:</label>
    <input type="text" name="link" required>
    <label for="video">Video:</label>
    <input type="file" name="video" required>
    <button class="add-btn" type="submit">Add Entry</button>
</form>
</body>
</html>

