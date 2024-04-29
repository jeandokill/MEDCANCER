<?php
function getBlogById($blogId) {
    global $conn;

    // Query to retrieve blog details by ID
    $sql = "SELECT * FROM blog WHERE id = $blogId";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        // Fetch the blog details as an associative array
        $blog = $result->fetch_assoc();
        return $blog;
    } else {
        // Return an empty array if the blog is not found
        return [];
    }
}
include("blog_db.php");


if (isset($_GET['id'])) {
    $blogId = $_GET['id'];

    // Fetch blog data
    $blog = getBlogById($blogId);

    if (!empty($blog)) {
        // Display confirmation message and delete button
        echo "<h2>Delete Blog</h2>";
        echo "<p>Are you sure you want to delete the blog titled '" . $blog['title'] . "'?</p>";
        echo "<form action='process_delete.php' method='post'>";
        echo "<input type='hidden' name='blog_id' value='" . $blog['id'] . "'>";
        echo "<input type='submit' value='Delete Blog'>";
        echo "</form>";
    } else {
        echo "Blog not found.";
    }
} else {
    echo "Invalid blog ID.";
}
?>
