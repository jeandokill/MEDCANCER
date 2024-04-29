<?php
include("blog_db.php");

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve form data
    $blogId = $_POST['blog_id'];

    // Delete data from 'blogs' table
    $sql = "DELETE FROM blog WHERE id=$blogId";

    if ($conn->query($sql) === TRUE) {
        echo "Blog deleted successfully!";
    } else {
        echo "Error deleting blog: " . $conn->error;
    }
}

$conn->close();
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <link href="/Medcancer/Home/assets/img/favicon.png" rel="icon">
    <link href="/Medcancer/Home/assets/img/favicon.png" rel="apple-touch-icon">
    <style>
        .btn {
            cursor: pointer; /* Add this style to indicate it's clickable */
            text-decoration: none; /* Remove the default underline for anchor tags */
            color: inherit; /* Inherit the color from the parent */
            display: inline-block; /* Make it inline-block so it respects padding and margin */
            padding: 10px; /* Add padding for better clickability */
            border: 1px solid #ccc; /* Add a border for a button-like appearance */
            border-radius: 5px; /* Add rounded corners for a softer look */
        }
    </style>
</head>

<body>
    <div class="btn">
        <a href="add_blog.php">
            <h1>BACK ON BLOG PAGE</h1>
        </a>
    </div>
</body>

</html>

