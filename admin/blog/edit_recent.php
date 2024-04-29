<?php


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
?>




<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <link href="/Medcancer/Home/assets/img/favicon.png" rel="icon">
    <link href="/Medcancer/Home/assets/img/favicon.png" rel="apple-touch-icon">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Recent Blog</title>
    <!-- Bootstrap CSS from CDN -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous">
    <style>
        body {
            background-color: #f8f9fa;
        }

        .container {
            background-color: #ffffff;
            padding: 40px;
            border-radius: 16px;
            box-shadow: 0 0 20px rgba(0, 0, 0, 0.2);
            margin-top: 50px;
            max-width: 800px;
            margin: auto;
        }

        .form-group {
            margin-bottom: 20px;
        }

        .form-label {
            font-weight: bold;
            font-size: 24px;
            color: #000000;
            margin-bottom: 10px;
            display: block;
        }

        .form-control {
            font-size: 20px;
            width: 100%; /* Set the width to 100% for larger input fields */
        }

        .btn-update {
            font-size: 20px;
            background-color: #007bff;
            color: #ffffff;
            padding: 0.5rem 1rem;
            border: none;
            border-radius: 0.25rem;
            cursor: pointer;
        }
    </style>
</head>

<body>
    <?php
    include("blog_db.php");

    if (isset($_GET['id'])) {
        $blogId = $_GET['id'];

        // Fetch blog data
        $blog = getBlogById($blogId);

        if (!empty($blog)) {
            // Display edit form
            echo "<div class='container'>";
            echo "<h2 class='text-center mb-4'>Edit Blog</h2>";
            echo "<form action='update_recent.php' method='post' enctype='multipart/form-data'>";
            // Add necessary input fields with their current values for editing
            echo "<input type='hidden' name='blog_id' value='" . $blog['id'] . "'>";

            echo "<div class='form-group'>";
            echo "<label for='image' class='form-label'>Image:</label>";
            echo "<input type='file' class='form-control' name='image'>";
            echo "</div>";

            echo "<div class='form-group'>";
            echo "<label for='title' class='form-label'>Title:</label>";
            echo "<input type='text' class='form-control' name='title' value='" . $blog['title'] . "' required>";
            echo "</div>";

            echo "<div class='form-group'>";
            echo "<label for='author_name' class='form-label'>Author Name:</label>";
            echo "<input type='text' class='form-control' name='author_name' value='" . $blog['author_name'] . "'>";
            echo "</div>";

            echo "<div class='form-group'>";
            echo "<label for='author_image' class='form-label'>Author Image:</label>";
            echo "<input type='file' class='form-control' name='author_image'>";
            echo "</div>";

            echo "<div class='form-group'>";
            echo "<label for='author_social_twitter' class='form-label'>Twitter Link:</label>";
            echo "<input type='text' class='form-control' name='author_social_twitter' value='" . $blog['author_social_twitter'] . "'>";
            echo "</div>";

            echo "<div class='form-group'>";
            echo "<label for='author_social_facebook' class='form-label'>Facebook Link:</label>";
            echo "<input type='text' class='form-control' name='author_social_facebook' value='" . $blog['author_social_facebook'] . "'>";
            echo "</div>";

            echo "<div class='form-group'>";
            echo "<label for='author_social_instagram' class='form-label'>Instagram Link:</label>";
            echo "<input type='text' class='form-control' name='author_social_instagram' value='" . $blog['author_social_instagram'] . "'>";
            echo "</div>";

            echo "<div class='form-group'>";
            echo "<label for='author_bio' class='form-label'>Author Bio:</label>";
            echo "<textarea class='form-control' name='author_bio' rows='4'>" . $blog['author_bio'] . "</textarea>";
            echo "</div>";

            echo "<div class='form-group'>";
            echo "<label for='publish_date' class='form-label'>Publish Date:</label>";
            echo "<input type='date' class='form-control' name='publish_date' value='" . $blog['publish_date'] . "'>";
            echo "</div>";

            echo "<div class='form-group'>";
            echo "<label for='paragraph' class='form-label'>Blog Paragraph:</label>";
            echo "<textarea class='form-control' name='paragraph' rows='4'>" . $blog['paragraph'] . "</textarea>";
            echo "</div>";

            echo "<div class='form-group'>";
            echo "<label for='blockquote' class='form-label'>Blog Quote:</label>";
            echo "<textarea class='form-control' name='blockquote' rows='4'>" . $blog['blockquote'] . "</textarea>";
            echo "</div>";

            echo "<div class='form-group'>";
            echo "<label for='content1_subtitle' class='form-label'>Content 1 Subtitle:</label>";
            echo "<input type='text' class='form-control' name='content1_subtitle' value='" . $blog['content1_subtitle'] . "'>";
            echo "</div>";

            echo "<div class='form-group'>";
            echo "<label for='content1_content' class='form-label'>Content 1 Content:</label>";
            echo "<textarea class='form-control' name='content1_content' rows='4'>" . $blog['content1_content'] . "</textarea>";
            echo "</div>";

            // Repeat similar blocks for content 2 and content 3

            echo "<div class='form-group'>";
            echo "<label for='content2_subtitle' class='form-label'>Content 2 Subtitle:</label>";
            echo "<input type='text' class='form-control' name='content2_subtitle' value='" . $blog['content2_subtitle'] . "'>";
            echo "</div>";

            echo "<div class='form-group'>";
            echo "<label for='content2_content' class='form-label'>Content 2 Content:</label>";
            echo "<textarea class='form-control' name='content2_content' rows='4'>" . $blog['content2_content'] . "</textarea>";
            echo "</div>";

            echo "<div class='form-group'>";
            echo "<label for='content3_subtitle' class='form-label'>Content 3 Subtitle:</label>";
            echo "<input type='text' class='form-control' name='content3_subtitle' value='" . $blog['content3_subtitle'] . "'>";
            echo "</div>";

            echo "<div class='form-group'>";
            echo "<label for='content3_content' class='form-label'>Content 3 Content:</label>";
            echo "<textarea class='form-control' name='content3_content' rows='4'>" . $blog['content3_content'] . "</textarea>";
            echo "</div>";

            echo "<div class='form-group'>";
            echo "<label for='content_image' class='form-label'>Content Image:</label>";
            echo "<input type='file' class='form-control' name='content_image'>";
            echo "</div>";

            echo "<div class='form-group text-center'>";
            echo "<input type='submit' class='btn btn-update' value='Update Blog'>";
            echo "</div>";

            echo "</form>";
            echo "</div>";
        } else {
            echo "<div class='container mt-5'> Recent Blog not found.</div>";
        }
    } else {
        echo "<div class='container mt-5'>Invalid blog ID.</div>";
    }
    ?>
    <!-- Bootstrap JS and Popper.js from CDN -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-eWpAV2MIIS2On8UWGOqz76hQagNYOf+C4OvKx9vaLOhIfB+jj6jo23lERdS4lFqJ" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js" integrity="sha384-pzjw8ZNUq0FmTqKepxZ6KC50GBF2q3fMz6fRA5ZAjXMJFKqfRt/5aiQACg/7M9D" crossorigin="anonymous"></script>
</body>

<a href="/Medcancer/admin/index.php" class="btn btn-secondary mt-3" id="backbtn">Back to admin panel</a>
        <style>
            #backbtn
             {
                display: block;
                margin: auto;
                margin-top: 20px; 
                margin-right: 50%;
                margin-left: 30%;
                background-color: blue;
                
                /* You can adjust the margin-top as needed */
            }
        </style>
    </div>

</html>












