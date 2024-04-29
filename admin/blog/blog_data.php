<?php

// Database connection (replace with your credentials)
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "event";

function connectToDatabase() {
    global $servername, $username, $password, $dbname;
    $conn = new mysqli($servername, $username, $password, $dbname);
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }
    return $conn;
}
// Function to fetch blog data
function getBlogs() {
    $conn = connectToDatabase();

    $sql = "SELECT * FROM blog";
    $result = $conn->query($sql);

    $blogs = array();

    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            $row['comment_count'] = count(getCommentCount($row['id'])); // Add comment count to each blog row
            $blogs[] = $row;
        }
    }

    $conn->close();

    return $blogs;
}

function getCommentCount($blogId) {
    $conn = connectToDatabase();

    // Update the SQL query to use the correct column name for the blog ID
    $sql = "SELECT * FROM comments WHERE blog_id = $blogId";
    $result = $conn->query($sql);

    $comments = array();

    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            $comments[] = $row;
        }
    }

    $conn->close();

    return $comments;
}


// Function to fetch a blog post by its ID
function getBlogPostById($blogPostId) {
    $conn = connectToDatabase();

    $sql = "SELECT * FROM recent_posts WHERE id = $blogPostId";
    $result = $conn->query($sql);

    $blogPost = null;

    if ($result->num_rows > 0) {
        $blogPost = $result->fetch_assoc();
    }

    $conn->close();

    return $blogPost;
}

// Include this function in your PHP code
function getRecentPosts() {
    include("blog_db.php"); // Assuming you have your database connection in blog_db.php

    $recentPosts = array();

    // Fetch recent posts from the 'recent_posts' table
    $sql = "SELECT * FROM recent_posts";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            $recentPosts[] = $row;
        }
    }

    $conn->close();

    return $recentPosts;
}

// Add this function in your PHP code
function getRecentBlogs() {
    include("blog_db.php");

    $recentBlogs = array(); // Initialize an array to store recent blogs

    // Perform a query to get recent blogs from the 'recent_posts' table
    $sql = "SELECT * FROM recent_posts";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        // Fetch the data and add it to the $recentBlogs array
        while ($row = $result->fetch_assoc()) {
            $recentBlogs[] = $row;
        }
    }

    // Close the database connection
    $conn->close();

    return $recentBlogs;
}

$recentPosts = getRecentPosts();

// Fetch blog data
$blogs = getBlogs();

// Example usage:
// $blogPost = getBlogPostById($blogPostId);
?>
