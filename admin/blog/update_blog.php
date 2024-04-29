<?php
include("blog_db.php");

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

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve form data
    $blogId = $_POST['blog_id'];
    $title = $_POST["title"];
    $authorName = $_POST['author_name'];
    $publishDate = $_POST['publish_date'];
    $author_social_twitter = $_POST["author_social_twitter"];
    $author_social_facebook = $_POST["author_social_facebook"];
    $author_social_instagram = $_POST["author_social_instagram"];
    $paragraph = $_POST['paragraph'];
    $blockquote = $_POST['blockquote']; // Fix field name
    $content1Subtitle = $_POST['content1_subtitle'];
    $content1Content = $_POST['content1_content'];
    $content2Subtitle = $_POST['content2_subtitle'];
    $content2Content = $_POST['content2_content'];
    $content3Subtitle = $_POST['content3_subtitle'];
    $content3Content = $_POST['content3_content'];
    $authorBio = $_POST['author_bio'];

    // Handle file uploads
    $image = ''; // Placeholder for image URL, you can use the existing URL if not updated
    if (isset($_FILES['image']) && $_FILES['image']['error'] === 0) {
        $imagePath = 'uploads/';
        $imageName = $_FILES['image']['name'];
        move_uploaded_file($_FILES['image']['tmp_name'], $imagePath . $imageName);
        $image = $imagePath . $imageName;
    }

    $authorImage = ''; // Placeholder for author image URL, you can use the existing URL if not updated
    if (isset($_FILES['author_image']) && $_FILES['author_image']['error'] === 0) {
        $authorImagePath = 'uploads/';
        $authorImageName = $_FILES['author_image']['name'];
        move_uploaded_file($_FILES['author_image']['tmp_name'], $authorImagePath . $authorImageName);
        $authorImage = $authorImagePath . $authorImageName;
    }

    $contentImage = ''; // Placeholder for content image URL, you can use the existing URL if not updated
    if (isset($_FILES['content_image']) && $_FILES['content_image']['error'] === 0) {
        $contentImagePath = 'uploads/';
        $contentImageName = $_FILES['content_image']['name'];
        move_uploaded_file($_FILES['content_image']['tmp_name'], $contentImagePath . $contentImageName);
        $contentImage = $contentImagePath . $contentImageName;
    }

    // Update data in 'blog' table
    $sql = "UPDATE blog SET 
    title=?, 
    author_name=?, 
    publish_date=?,  
    paragraph=?, 
    author_social_twitter=?,
    author_social_facebook=?,
    author_social_instagram=?,
    blockquote=?, 
    content1_subtitle=?, 
    content1_content=?, 
    content2_subtitle=?, 
    content2_content=?, 
    content3_subtitle=?, 
    content3_content=?, 
    content_image=?, 
    author_bio=?";

// ...

$bindParams = ['ssssssssssssssss', &$title, &$authorName, &$publishDate, &$paragraph, &$author_social_twitter, &$author_social_facebook, &$author_social_instagram, &$blockquote, &$content1Subtitle, &$content1Content, &$content2Subtitle, &$content2Content, &$content3Subtitle, &$content3Content, &$contentImage, &$authorBio];

// Check if image is provided for update
if (!empty($image)) {
    $sql .= ", image=?";
    $bindParams[0] .= 's';
    $bindParams[] = &$image;
}

// Check if author image is provided for update
if (!empty($authorImage)) {
    $sql .= ", author_image=?";
    $bindParams[0] .= 's';
    $bindParams[] = &$authorImage;
}

// Check if content image is provided for update
if (!empty($contentImage)) {
    $sql .= ", content_image=?";
    $bindParams[0] .= 's';
    $bindParams[] = &$contentImage;
}

$sql .= " WHERE id=?";
$bindParams[0] .= 'i';
$bindParams[] = &$blogId;

$stmt = $conn->prepare($sql);

// Bind parameters
call_user_func_array([$stmt, 'bind_param'], $bindParams);

if ($stmt->execute()) {
    echo "Blog updated successfully!";
} else {
    echo "Error updating blog: " . $stmt->error . " (" . $stmt->errno . ")";
}
}
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


