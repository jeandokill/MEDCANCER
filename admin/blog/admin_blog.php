<?php
// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Database connection
    $servername = "localhost"; // Change this if your MySQL server is hosted elsewhere
    $username = "root"; // Change this to your MySQL username
    $password = ""; // Change this to your MySQL password
    $dbname = "event"; // Change this if your database name is different

    // Create connection
    $conn = new mysqli($servername, $username, $password, $dbname);

    // Check connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    // Prepare and bind parameters
    $stmt = $conn->prepare("INSERT INTO blog (image, title, author_name, author_image, author_social_twitter, author_social_facebook, author_social_instagram, author_bio, publish_date, paragraph, blockquote, content1_subtitle, content1_content, content2_subtitle, content2_content, content3_subtitle, content3_content, content_image) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");

    $stmt->bind_param("ssssssssssssssssss", $image, $title, $author_name, $author_image, $author_social_twitter, $author_social_facebook, $author_social_instagram, $author_bio, $publish_date, $paragraph, $blockquote, $content1_subtitle, $content1_content, $content2_subtitle, $content2_content, $content3_subtitle, $content3_content, $content_image);

    // Set parameters and execute
    $image = $_FILES['image']['name'];
    $title = $_POST['title'];
    $author_name = $_POST['author_name'];
    $author_image = $_FILES['author_image']['name'];
    $author_social_twitter = $_POST['author_social_twitter'];
    $author_social_facebook = $_POST['author_social_facebook'];
    $author_social_instagram = $_POST['author_social_instagram'];
    $author_bio = $_POST['author_bio'];
    $publish_date = $_POST['publish_date'];
    $paragraph = $_POST['paragraph'];
    $blockquote = $_POST['blockquote'];
    $content1_subtitle = $_POST['content1_subtitle'];
    $content1_content = $_POST['content1_content'];
    $content2_subtitle = $_POST['content2_subtitle'];
    $content2_content = $_POST['content2_content'];
    $content3_subtitle = $_POST['content3_subtitle'];
    $content3_content = $_POST['content3_content'];
    $content_image = $_FILES['content_image']['name'];

    // Move uploaded files to desired location
    move_uploaded_file($_FILES['image']['tmp_name'], 'uploads/' . $image);
    move_uploaded_file($_FILES['author_image']['tmp_name'], 'uploads/' . $author_image);
    move_uploaded_file($_FILES['content_image']['tmp_name'], 'uploads/' . $content_image);

    // Execute prepared statement
    if ($stmt->execute()) {
        echo "Blog added successfully!";
    } else {
        echo "Error: " . $stmt->error;
    }

    // Close statement and connection
    $stmt->close();
    $conn->close();
}
?>