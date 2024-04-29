<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>View Blog</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        /* Add custom styles for the container */
        .container {
            padding-left: 15px;
            padding-right: 15px;
        }

        /* Add margin to the back button for spacing */
        .btn-back {
            margin-top: 20px;
        }

        /* Style for content subtitles */
        .content-subtitle {
            color: black;
            font-weight: bold;
            font-size: 1.2rem; /* Increase font size */
        }

        /* Style for author image */
        .author-img {
            width: 80px; /* Set width */
            height: auto; /* Maintain aspect ratio */
        }

        /* Style for author info */
        .author-info {
            margin-left: 20px; /* Add margin for spacing */
        }
    </style>
</head>

<body>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
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

                if (isset($_GET['id'])) {
                    $blogId = $_GET['id'];

                    $blog = getBlogById($blogId);

                    if (!empty($blog)) {
                        echo "<article class='entry entry-single'>";

                        echo "<div class='entry-img'>";
                        echo "<img src='/Medcancer/admin/blog/uploads/" . $blog['image'] . "' alt='' class='img-fluid'>";
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
                        echo "<p class='content-subtitle'>" . $blog['content1_subtitle'] . "</p>";
                        echo "<p class='content'>" . $blog['content1_content'] . "</p>";
                        echo "<p class='content-subtitle'>" . $blog['content2_subtitle'] . "</p>";
                        echo "<p class='content'>" . $blog['content2_content'] . "</p>";
                        echo "<p class='content-subtitle'>" . $blog['content3_subtitle'] . "</p>";
                        echo "<p class='content'>" . $blog['content3_content'] . "</p>";

                        // Display content image
                        echo "<img src='/Medcancer/admin/blog/uploads/" . $blog['content_image'] . "' class='img-fluid' alt='Content Image'>";

                        // Display author info
                        echo "<div class='blog-author d-flex align-items-center'>";
                        echo "<img src='/Medcancer/admin/blog/uploads/" . $blog['author_image'] . "' class='rounded-circle float-left img-thumbnail author-img' alt='Author Image'>";
                        echo "<div class='author-info'>";
                        echo "<h4>" . $blog['author_name'] . "</h4>";
                        echo "<p class='author-bio'>" . $blog['author_bio'] . "</p>";
                        echo "</div>";
                        echo "</div><!-- End blog author bio -->";

                        echo "</div>";

                        echo "</article><!-- End blog entry -->";
                    } else {
                        echo "Blog not found.";
                    }
                } else {
                    echo "Invalid blog ID.";
                }
                ?>
            </div>
        </div>
        <!-- Back button with margin -->
        <div class="row justify-content-center">
            <div class="col-md-8">
                <a href="add_blog.php" class="btn btn-primary btn-back">BACK TO BLOG PAGE</a>
            </div>
        </div>
    </div>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.0/js/bootstrap.bundle.min.js"></script>
</body>

</html>
