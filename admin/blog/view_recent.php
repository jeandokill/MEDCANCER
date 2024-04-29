<?php
include("blog_db.php");


function getBlogById($blogId) {
    global $conn;

    // Query to retrieve blog details by ID
    $sql = "SELECT * FROM recent_posts WHERE id = $blogId";
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

if (isset($_GET['id'])) {
    $blogId = $_GET['id'];

    $blog = getBlogById($blogId);

    if (!empty($blog)) {
        echo "<article class='entry entry-single'>";

        echo "<div class='entry-img'>";
        echo "<img src='" . $blog['image'] . "' alt='' class='img-fluid'>";
        echo "</div>";

        echo "<h2 class='entry-title'>" . $blog['title'] . "</h2>";

        echo "<div class='entry-meta'>";
        echo "<ul class='list-inline'>";
        echo "<li class='list-inline-item'><i class='bi bi-person'></i> " . $blog['author_name'] . "</li>";
        echo "<li class='list-inline-item'><i class='bi bi-clock'></i> <time datetime='" . $blog['publish_date'] . "'>" . $blog['publish_date'] . "</time></li>";
        echo "</ul>";
        echo "</div>";

        echo "<div class='entry-content'>";
        echo "<p class='blog-paragraph'>" . $blog['paragraph'] . "</p>";

        // Display additional fields with appropriate class
        echo "<p class='blockquote'>" . $blog['blockquote'] . "</p>";
        echo "<p class='content-subtitle'>" . $blog['content1_subtitle'] . "</p>";
        echo "<p class='content'>" . $blog['content1_content'] . "</p>";
        echo "<p class='content-subtitle'>" . $blog['content2_subtitle'] . "</p>";
        echo "<p class='content'>" . $blog['content2_content'] . "</p>";
        echo "<p class='content-subtitle'>" . $blog['content3_subtitle'] . "</p>";
        echo "<p class='content'>" . $blog['content3_content'] . "</p>";

        // Display author image and bio
        echo "<div class='blog-author d-flex align-items-center'>";
        echo "<img src='" . $blog['author_image'] . "' class='rounded-circle float-left img-thumbnail' alt=''>";
        echo "<div class='author-info'>";
        echo "<h4>" . $blog['author_name'] . "</h4>";
        echo "<div class='social-links'>";
        echo "<a href='" . $blog['author_social_twitter'] . "'><i class='bi bi-twitter'></i></a>";
        echo "<a href='" . $blog['author_social_facebook'] . "'><i class='bi bi-facebook'></i></a>";
        echo "<a href='" . $blog['author_social_instagram'] . "'><i class='bi bi-instagram'></i></a>";
        echo "</div>";
        echo "<p class='author-bio'>" . $blog['author_bio'] . "</p>";
        echo "</div>";
        echo "</div><!-- End blog author bio -->";

        echo "</div>";

        echo "</article><!-- End blog entry -->";
    } else {
        echo " Recent Blog not found.";
    }
} else {
    echo "Invalid blog ID.";
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
        <a href="recent_post.php">
            <h1>BACK ON RECENT BLOG </h1>
        </a>
    </div>
</body>

</html>


