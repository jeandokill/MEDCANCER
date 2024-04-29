<?php
// Include your database connection file
include("blog_db.php");

// Function to fetch current blogs from the database
function getBlogs() {
    global $conn; // Assuming $conn is your database connection variable

    // Prepare SQL statement to select all blogs
    $sql = "SELECT id, publish_date, author_name, title FROM blog";

    // Execute SQL statement
    $result = $conn->query($sql);

    // Check if query was successful
    if ($result === false) {
        // Handle error here (e.g., log error, return empty array)
        return [];
    }

    // Fetch all rows from the result set
    $blogs = $result->fetch_all(MYSQLI_ASSOC);

    // Free result set
    $result->free();

    // Return fetched blogs
    return $blogs;
}
?>





<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="/Medcancer/Home/assets/img/favicon.png" rel="icon">
    <link href="/Medcancer/Home/assets/img/favicon.png" rel="apple-touch-icon">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <title>Add Blog</title>

    <script src="https://cdn.jsdelivr.net/npm/tinymce/tinymce.min.js"></script>
    <script>
        tinymce.init({
            selector: 'textarea',
            width: 1000,
            height: 300,
            plugins: [
                'advlist', 'autolink', 'link', 'image', 'lists', 'charmap', 'preview', 'anchor', 'pagebreak',
                'searchreplace', 'wordcount', 'visualblocks', 'code', 'fullscreen', 'insertdatetime', 'media',
                'table', 'emoticons', 'template', 'codesample'
            ],
            toolbar: 'undo redo | styles | bold italic underline | alignleft aligncenter alignright alignjustify |' +
                'bullist numlist outdent indent | link image | print preview media fullscreen | ' +
                'forecolor backcolor emoticons',
            menu: {
                favs: {
                    title: 'menu',
                    items: 'code visualaid | searchreplace | emoticons'
                }
            },
            menubar: 'favs file edit view insert format tools table',
            content_style: 'body{font-family:Helvetica,Arial,sans-serif; font-size:16px}'
        });
    </script>
</head>

<body>
    <div class="container mt-5">
        <h2>Add Blog</h2>
        <!-- HTML form for blog submission -->
        <form id="blogForm" action="admin_blog.php" method="post" enctype="multipart/form-data">
        <div class="mb-3">
                <label for="image" class="form-label">Image:</label>
                <input type="file" class="form-control" name="image">
            </div>

            <div class="mb-3">
                <label for="title" class="form-label">Title:</label>
                <input type="text" class="form-control" name="title">
            </div>

            <div class="mb-3">
                <label for="author_name" class="form-label">Author Name:</label>
                <input type="text" class="form-control" name="author_name">
            </div>

            <div class="mb-3">
                <label for="author_image" class="form-label">Author Image:</label>
                <input type="file" class="form-control" name="author_image">
            </div>

            <div class="mb-3">
                <label for="author_social_twitter" class="form-label">Twitter Link:</label>
                <input type="text" class="form-control" name="author_social_twitter">
            </div>

            <div class="mb-3">
                <label for="author_social_facebook" class="form-label">Facebook Link:</label>
                <input type="text" class="form-control" name="author_social_facebook">
            </div>

            <div class="mb-3">
                <label for="author_social_instagram" class="form-label">Instagram Link:</label>
                <input type="text" class="form-control" name="author_social_instagram">
            </div>

            <div class="mb-3">
                <label for="author_bio" class="form-label">Author Bio:</label>
                <textarea class="form-control" name="author_bio" rows="4"></textarea>
            </div>

            <div class="mb-3">
                <label for="publish_date" class="form-label">Publish Date:</label>
                <input type="date" class="form-control" name="publish_date">
            </div>

            <div class="mb-3">
                <label for="paragraph" class="form-label">Blog Paragraph:</label>
                <textarea class="form-control" name="paragraph" rows="4"></textarea>
            </div>

            <div class="mb-3">
                <label for="blockquote" class="form-label">Blog Quote:</label>
                <textarea class="form-control" name="blockquote" rows="4"></textarea>
            </div>

            <div class="mb-3">
                <label for="content1_subtitle" class="form-label">Content 1 Subtitle:</label>
                <input type="text" class="form-control" name="content1_subtitle">
            </div>

            <div class="mb-3">
                <label for="content1_content" class="form-label">Content 1 Content:</label>
                <textarea class="form-control" name="content1_content" rows="4"></textarea>
            </div>

            <!-- Repeat similar blocks for content 2 and content 3 -->

            <div class="mb-3">
                <label for="content2_subtitle" class="form-label">Content 2 Subtitle:</label>
                <input type="text" class="form-control" name="content2_subtitle">
            </div>

            <div class="mb-3">
                <label for="content2_content" class="form-label">Content 2 Content:</label>
                <textarea class="form-control" name="content2_content" rows="4"></textarea>
            </div>

            <div class="mb-3">
                <label for="content3_subtitle" class="form-label">Content 3 Subtitle:</label>
                <input type="text" class="form-control" name="content3_subtitle">
            </div>

            <div class="mb-3">
                <label for="content3_content" class="form-label">Content 3 Content:</label>
                <textarea class="form-control" name="content3_content" id= "default" rows="4"></textarea>
            </div>

            <div class="mb-3">
                <label for="content_image" class="form-label">Content Image:</label>
                <input type="file" class="form-control" name="content_image">
            </div>

            <button type="submit" class="btn btn-primary">Submit</button>
            <button type="button" class="btn btn-primary" onclick="resetForm()">Add Blog</button>

        </form>
</body>
</html>

</head>

<body>
    <div class="container mt-5">
        <h2>Add Blog</h2>
        <!-- HTML form for blog submission -->
        <form id="blogForm" action="admin_blog.php" method="post" enctype="multipart/form-data">
            <!-- Form fields here -->
        </form>

        <!-- Table for current blogs -->
        <div class="mt-5">
            <h2>Current Blogs</h2>
            <table class="table">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Date Posted</th>
                        <th>Author</th>
                        <th>Title</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $currentBlogs = getBlogs();

                    if (!empty($currentBlogs)) {
                        foreach ($currentBlogs as $currentBlog) {
                            echo "<tr>";
                            echo "<td>" . $currentBlog['id'] . "</td>";
                            echo "<td>" . $currentBlog['publish_date'] . "</td>";
                            echo "<td>" . $currentBlog['author_name'] . "</td>";
                            echo "<td>" . $currentBlog['title'] . "</td>";
                            echo "<td>";
                            echo "<a href='view_blog.php?id=" . $currentBlog['id'] . "' class='btn btn-info btn-sm me-2'>View</a>";
                            echo "<a href='shift_to_recent.php?id=" . $currentBlog['id'] . "' class='btn btn-info btn-sm me-2'>shift to recent posts</a>";
                            echo "<a href='edit_blog.php?id=" . $currentBlog['id'] . "' class='btn btn-warning btn-sm me-2'>Edit</a>";
                            echo "<a href='delete_blog.php?id=" . $currentBlog['id'] . "' class='btn btn-danger btn-sm me-2' onclick='return confirm(\"Are you sure you want to delete this blog?\");'>Delete</a>";
                            echo "</td>";
                            echo "</tr>";
                        }
                    } else {
                        echo "<tr><td colspan='5'>No blogs found.</td></tr>";
                    }
                    ?>
                </tbody>
            </table>
        </div>
    </div>
</body>

</html>