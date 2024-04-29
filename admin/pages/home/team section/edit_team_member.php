<?php
include("data.php");

if ($_SERVER["REQUEST_METHOD"] == "GET" && isset($_GET['id'])) {
    $id = mysqli_real_escape_string($connection, $_GET['id']);
    $result = mysqli_query($connection, "SELECT * FROM team_members WHERE id = '$id'");
    $row = mysqli_fetch_assoc($result);

    // Do not redirect here; let the user edit the team member first
} else {
    // If the form is submitted, process it
    if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['id'])) {
        // Validate and sanitize form data
        $id = mysqli_real_escape_string($connection, $_POST['id']);
        $newName = mysqli_real_escape_string($connection, $_POST['name']);
        $newRole = mysqli_real_escape_string($connection, $_POST['role']);
        $newTwitterLink = mysqli_real_escape_string($connection, $_POST['twitter']);
        $newFacebookLink = mysqli_real_escape_string($connection, $_POST['facebook']);
        $newLinkedInLink = mysqli_real_escape_string($connection, $_POST['linkedin']);
        $newInstagramLink = mysqli_real_escape_string($connection, $_POST['instagram']);

        // Update team member data
        updateTeamMemberData($id, $newName, $newRole, $newTwitterLink, $newFacebookLink, $newLinkedInLink, $newInstagramLink);
        // Redirect back to admin_team.php
        header("Location: admin_team.php");
        exit();
    } else {
        // If the form is not submitted, redirect back to admin_team.php
        header("Location: admin_team.php");
        exit();
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
    <title>Edit Team Member</title>
    <!-- Include Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
</head>
<body>
<div class="container mt-5">
    <form action="edit_team_member.php" method="post" enctype="multipart/form-data">
        <input type="hidden" name="id" value="<?= $row['id'] ?>">

        <div class="form-group">
            <label for="name">Name:</label>
            <input type="text" name="name" class="form-control" value="<?= $row['name'] ?>" required>
        </div>

        <div class="form-group">
            <label for="role">Role:</label>
            <input type="text" name="role" class="form-control" value="<?= $row['role'] ?>" required>
        </div>

        <div class="form-group">
            <label for="image">Image:</label>
            <input type="file" name="image" class="form-control-file">
            <img src="<?= $row['image_path'] ?>" alt="<?= $row['name'] ?>" style="max-width: 200px;">
        </div>

        <div class="form-group">
            <label for="twitter">Twitter:</label>
            <input type="text" name="twitter" class="form-control" placeholder="Paste the link here" value="<?= $row['twitter'] ?? '' ?>">
        </div>

        <div class="form-group">
            <label for="linkedin">LinkedIn:</label>
            <input type="text" name="linkedin" class="form-control" placeholder="Paste the link here" value="<?= $row['linkedin'] ?? '' ?>">
        </div>

        <div class="form-group">
            <label for="instagram">Instagram:</label>
            <input type="text" name="instagram" class="form-control" placeholder="Paste the link here" value="<?= $row['instagram'] ?? '' ?>">
        </div>

        <div class="form-group">
            <label for="facebook">Facebook:</label>
            <input type="text" name="facebook" class="form-control" placeholder="Paste the link here" value="<?= $row['facebook'] ?? '' ?>">
        </div>

        <!-- Add more input fields for other social media links -->

        <button type="submit" class="btn btn-primary">Update Team Member</button>
        </form>

    <a href="admin_team.php" class="btn btn-secondary mt-3">Back</a>
</div>

    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
</body>
</html>
