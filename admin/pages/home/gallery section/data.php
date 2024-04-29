<?php

$host = "localhost";
$user = "root";
$password = "";
$database = "event";

$connection = mysqli_connect($host, $user, $password, $database);

if (!$connection) {
    die("Connection failed: " . mysqli_connect_error());
}

// data.php
function getGalleryImages() {
    global $connection;

    $result = mysqli_query($connection, "SELECT * FROM gallery_images");

    if (!$result) {
        die("Query failed: " . mysqli_error($connection));
    }

    return mysqli_fetch_all($result, MYSQLI_ASSOC);
}

function addGalleryImage($imagePath) {
    global $connection;

    $query = "INSERT INTO gallery_images (image_path) VALUES ('$imagePath')";

    $result = mysqli_query($connection, $query);

    if (!$result) {
        die("Query failed: " . mysqli_error($connection));
    }

    return $result;
}

function removeGalleryImage($id, $imagePath) {
    global $connection;

    // Delete from the database
    $deleteQuery = "DELETE FROM gallery_images WHERE id = '$id'";
    $deleteResult = mysqli_query($connection, $deleteQuery);

    if (!$deleteResult) {
        die("Delete query failed: " . mysqli_error($connection));
    }

    // Delete the file from the server
    if (file_exists($imagePath)) {
        unlink($imagePath);
    }

    return $deleteResult;
}

function getGalleryImagePath($id) {
    global $connection;

    $result = mysqli_query($connection, "SELECT image_path FROM gallery_images WHERE id = '$id'");

    if (!$result) {
        die("Query failed: " . mysqli_error($connection));
    }

    $row = mysqli_fetch_assoc($result);

    return $row['image_path'];
}
