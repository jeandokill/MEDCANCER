<?php
// Include your database connection file
include("blog_db.php");

// Initialize the blog post ID
$blogPostId = isset($_GET['id']) ? $_GET['id'] : null;

// Validate and sanitize the input
$blogPostId = filter_var($blogPostId, FILTER_VALIDATE_INT);

if ($blogPostId === false || $blogPostId === null) {
    // Handle invalid or missing blog post ID
    echo "Invalid or missing blog post ID.";
    exit; // Stop execution
}

// Fetch blog post data from the database based on the ID
$sql = "SELECT id, title, author_name, publish_date, image, paragraph, author_social_twitter, author_social_facebook, author_social_instagram,
        blockquote, content1_subtitle, content1_content, content2_subtitle, content2_content, 
        content3_subtitle, content3_content, content_image, author_bio, author_image
        FROM blog WHERE id = ?";

// Use prepared statement to prevent SQL injection
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $blogPostId);
$stmt->execute();

$result = $stmt->get_result();

if ($result === false) {
    // Handle SQL error more gracefully
    error_log("Error in SQL query: " . $conn->error);
    // You may redirect the user or show an error message
    echo "Error fetching blog post data.";
    exit; // Stop execution
}

$blog = [];

if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();

    // Assign retrieved data to the $blog array
    $blog['image'] = $row['image'];
    $blog['title'] = $row['title'];
    $blog['author_name'] = $row['author_name'];
    $blog['publish_date'] = $row['publish_date'];
    $blog['author_social_twitter'] = $row['author_social_twitter'];
    $blog['author_social_facebook'] = $row['author_social_facebook'];
    $blog['author_social_instagram'] = $row['author_social_instagram'];

    // Paragraphs
    $blog['paragraph'] = $row['paragraph'];

    // Additional fields
    $blog['blockquote'] = $row['blockquote'];
    $blog['content1_subtitle'] = $row['content1_subtitle'];
    $blog['content1_content'] = $row['content1_content'];
    $blog['content2_subtitle'] = $row['content2_subtitle'];
    $blog['content2_content'] = $row['content2_content'];
    $blog['content3_subtitle'] = $row['content3_subtitle'];
    $blog['content3_content'] = $row['content3_content'];
    $blog['content_image'] = $row['content_image'];
    
    // Author bio
    $blog['author_bio'] = $row['author_bio'];
    
    // Author image
    $blog['author_image'] = $row['author_image'];

} else {
    // Handle the case where the blog post is not found
    // You may redirect the user or show an error message
    echo "Blog post not found.";
}

// Close the prepared statement
$stmt->close();

// Close the database connection
$conn->close();
?>
