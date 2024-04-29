<?php

// Function to retrieve comments for a specific blog post// Function to retrieve comments for a specific blog post
function getComments($blogId) {
    $comments = loadCommentsFromFile();
    return isset($comments[$blogId]) ? $comments[$blogId] : [];
}

// Function to add a new comment
function addComment($blogId, $email, $comment) {
    $comments = loadCommentsFromFile();

    // Get user details (including profile picture) by email
    $userDetails = getUserDetailsByEmail($email);

    // Add the new comment with user details
    $newComment = [
        'email' => $email,
        'comment' => $comment,
        'date' => date('Y-m-d H:i:s'), // You can adjust the date format
        'profile_picture' => $userDetails['profile_picture'] // Add profile picture to the comment
    ];

    // Add the comment to the array
    $comments[$blogId][] = $newComment;

    // Save the updated comments to the file
    saveCommentsToFile($comments);

    // Return the comment ID (useful for identifying the added comment)
    return count($comments[$blogId]) - 1;
}


// Function to load comments from file
function loadCommentsFromFile() {
    $filename = 'comments.txt';

    if (file_exists($filename)) {
        $content = file_get_contents($filename);
        return unserialize($content) ?: [];
    }

    return [];
}

// Function to save comments to file
function saveCommentsToFile($comments) {
    $filename = 'comments.txt';
    $content = serialize($comments);
    file_put_contents($filename, $content);
}

// Function to retrieve user details by email
function getUserDetailsByEmail($email) {
    // Connect to your database (replace with your database credentials)
    $host = 'localhost';
    $username = "root";
    $password = "";
    $database = 'login_otp_db';

    $conn = new mysqli($host, $username, $password, $database);

    // Check connection
    if ($conn->connect_error) {
        die('Connection failed: ' . $conn->connect_error);
    }

    // Prepare and execute the SQL query to get user details
    $stmt = $conn->prepare('SELECT firstname, profile_picture FROM users WHERE email = ?');
    $stmt->bind_param('s', $email);
    $stmt->execute();
    $stmt->bind_result($firstname, $profilePicture);
    $stmt->fetch();

    // Close the database connection
    $stmt->close();
    $conn->close();

    return ['firstname' => $firstname, 'profile_picture' => $profilePicture];
}
