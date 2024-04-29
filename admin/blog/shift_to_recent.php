<?php
include("blog_db.php");

if ($_SERVER["REQUEST_METHOD"] == "GET" && isset($_GET["id"])) {
    $blogId = $_GET["id"];

    try {
        // Begin a transaction
        $conn->begin_transaction();

        // Check if the blog exists in the 'blogs' table
        $checkBlogSql = "SELECT * FROM blog WHERE id = $blogId";
        $result = $conn->query($checkBlogSql);

        if ($result->num_rows > 0) {
            $blogData = $result->fetch_assoc();

            // Insert the blog into the 'recent_posts' table
            $insertSql = "INSERT INTO recent_posts (title, author_name, author_image, author_social_twitter, author_social_facebook, author_social_instagram, author_bio, publish_date, paragraph, blockquote, content1_subtitle, content1_content, content2_subtitle, content2_content, content3_subtitle, content3_content, content_image, image)
            VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";

            $stmt = $conn->prepare($insertSql);
            $stmt->bind_param("ssssssssssssssssss", $blogData['title'], $blogData['author_name'], $blogData['author_image'], $blogData['author_social_twitter'], $blogData['author_social_facebook'], $blogData['author_social_instagram'], $blogData['author_bio'], $blogData['publish_date'], $blogData['paragraph'], $blogData['blockquote'], $blogData['content1_subtitle'], $blogData['content1_content'], $blogData['content2_subtitle'], $blogData['content2_content'], $blogData['content3_subtitle'], $blogData['content3_content'], $blogData['content_image'], $blogData['image']);

            if ($stmt->execute()) {
                // Delete the blog from the 'blogs' table
                $deleteSql = "DELETE FROM blog WHERE id = $blogId";
                $conn->query($deleteSql);

                // Commit the transaction
                $conn->commit();

                header("Location: /Medcancer/admin/blog/recent_post.php");
                exit();

            } else {
                // Rollback the transaction if insertion fails
                $conn->rollback();
                echo "Error shifting blog to recent posts: " . $stmt->error;
            }
        } else {
            echo "Blog not found in the main blog table.";
        }
    } catch (Exception $e) {
        // Handle any exceptions
        $conn->rollback();
        echo "Error: " . $e->getMessage();
    } finally {
        // Always close the connection
        $conn->close();
    }
} else {
    echo "Invalid request.";
}