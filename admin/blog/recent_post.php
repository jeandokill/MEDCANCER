<?php

include("blog_data.php");

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="/Medcancer/Home/assets/img/favicon.png" rel="icon">
    <link href="/Medcancer/Home/assets/img/favicon.png" rel="apple-touch-icon">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <title> Recent blogs</title>
</head>

<body>
    <div class="container mt-5">
        <h2>All Recent Blogs </h2>

        <!-- Display recent blogs table -->
        <div class="mt-5">
            <h3>Recent Blogs</h3>
            <table class="table">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Date Posted</th>
                        <th>Author</th>
                        <th>Author Image</th>
                        <th>Title</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $recentBlogs = getRecentBlogs();

                    if (!empty($recentBlogs)) {
                        foreach ($recentBlogs as $recentBlog) {
                            echo "<tr>";
                            echo "<td>" . $recentBlog['id'] . "</td>";
                            echo "<td>" . $recentBlog['publish_date'] . "</td>";
                            echo "<td>" . $recentBlog['author_name'] . "</td>";
                            echo "<td><img src='/Medcancer/admin/blog/uploads/" . $recentBlog['author_image'] . "' alt='Author Image' style='max-width: 50px;'></td>";
                            echo "<td>" . $recentBlog['title'] . "</td>";
                            echo "<td>";
                            echo "<a href='/Medcancer/admin/blog/view_recent.php?id=" . $recentBlog['id'] . "' class='btn btn-info btn-sm me-2'>View</a>";
                            echo "<a href='/Medcancer/admin/blog/edit_recent.php?id=" . $recentBlog['id'] . "' class='btn btn-warning btn-sm me-2'>Edit</a>";
                            echo "<a href='/Medcancer/admin/blog/delete_recent.php?id=" . $recentBlog['id'] . "' class='btn btn-danger btn-sm me-2' onclick='return confirm(\"Are you sure you want to delete this blog?\");'>Delete</a>";
                            echo "</td>";
                            echo "</tr>";
                        }
                    } else {
                        echo "<tr><td colspan='6'>No recent blogs found.</td></tr>";
                    }
                    ?>
                </tbody>
            </table>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
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
