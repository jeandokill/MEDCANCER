
<?php
include("data.php");

// Fetch section data
$teamSectionData = getTeamSectionData() ;

// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Validate and sanitize form data
    $newTitle = htmlspecialchars($_POST['section_title']);
    $newSubtitle = htmlspecialchars($_POST['section_subtitle']);

    // Update team section data
    updateTeamSectionData($newTitle, $newSubtitle);

    // Redirect back to admin_team.php
    header("Location: admin_team.php");
    exit();
}
// Fetch team members data
$teamResult = mysqli_query($connection, "SELECT * FROM team_members");
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="/Medcancer/Home/assets/img/favicon.png" rel="icon">
    <link href="/Medcancer/Home/assets/img/favicon.png" rel="apple-touch-icon">
    <title>Admin - Manage Team</title>
    <!-- Include Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
</head>
<body>
    <div class="container mt-5">
        <h1>Manage Team Section</h1>

        <!-- Editable section title and subtitle -->
        <form action="admin_team.php" method="post">
                <label for="section_title">Section Title:</label>
                <input type="text" name="section_title" class="form-control" value="<?= isset($teamSectionData['title']) ? $teamSectionData['title'] : '' ?>" required>

                <label for="section_subtitle">Section Subtitle:</label>
                <input type="text" name="section_subtitle" class="form-control" style="margin-bottom:20px;" value="<?= isset($teamSectionData['subtitle']) ? $teamSectionData['subtitle'] : '' ?>" required>

            <button type="submit" class="btn btn-primary">Update Section</button>
        </form>

        <hr>
        

        <h2>Manage Team Members</h2>

        <!-- Display existing team members -->
        <div class="row">
            <?php while ($row = mysqli_fetch_assoc($teamResult)): ?>
                <div class="col-md-4 mb-4">
                    <div class="card">
                        <img src="<?= $row['image_path'] ?>" alt="<?= $row['name'] ?>" class="card-img-top">
                        <div class="card-body">
                            <h5 class="card-title"><?= $row['name'] ?></h5>
                            <p class="card-text"><?= $row['role'] ?></p>
                            <div class="d-flex justify-content-between">
                                <!-- Edit and Delete buttons for each team member -->
                                <a href="edit_team_member.php?id=<?= $row['id'] ?>" class="btn btn-primary">Edit</a>
                                <a href="delete_team_member.php?id=<?= $row['id'] ?>" class="btn btn-danger">Delete</a>
                            </div>
                        </div>
                        <!-- Add more fields for social media links -->
                        <div class="card-footer">
                            <?php if (isset($row['twitter']) && !empty($row['twitter'])): ?>
                                <a href="<?= $row['twitter'] ?>" target="_blank">Twitter</a>
                            <?php endif; ?>

                            <?php if (isset($row['facebook']) && !empty($row['facebook'])): ?>
                                <a href="<?= $row['facebook'] ?>" target="_blank">Facebook</a>
                            <?php endif; ?>
                            <?php if (isset($row['linkedin']) && !empty($row['linkedin'])): ?>
                                <a href="<?= $row['linkedin'] ?>" target="_blank">linkedIn</a>
                            <?php endif; ?>
                            <?php if (isset($row['instagram']) && !empty($row['instagram'])): ?>
                                <a href="<?= $row['instagram'] ?>" target="_blank">Instagrm</a>
                            <?php endif; ?>

                            <!-- Add more social media links as needed -->
                        </div>
                    </div>
                </div>
            <?php endwhile; ?>
        </div>

        <hr>

        <!-- Add new team member form -->
        <button id="toggleFormBtn" class="btn btn-primary">Click to Add Team Member</button>
        <style>
            #toggleFormBtn {
                display: block;
                margin: auto;
                margin-top: 20px; /* You can adjust the margin-top as needed */
            }
        </style>

<!-- Add the form with inline styles to hide it initially -->
        <form id="addTeamMemberForm" action="add_team_member.php" method="post" enctype="multipart/form-data" style="display: none;">
            <div class="form-group">
                <label for="name">Name:</label>
                <input type="text" name="name" class="form-control" required>
            </div>

            <div class="form-group">
                <label for="role">Role:</label>
                <input type="text" name="role" class="form-control" required>
            </div>

            <div class="form-group">
                <label for="image">Image:</label>
                <input type="file" name="image" class="form-control-file" required>
            </div>

            <div class="form-group">
                <label for="twitter">Twitter:</label>
                <input type="text" name="twitter" class="form-control" placeholder="past the link here">
            </div>
            <div class="form-group">
                <label for="linkedin">linkedIn:</label>
                <input type="text" name="linkedin" class="form-control" placeholder="past the link here">
            </div>
            <div class="form-group">
                <label for="instagram">instagram:</label>
                <input type="text" name="instagram" class="form-control" placeholder="past the link here">
            </div>

            <div class="form-group">
                <label for="facebook">Facebook:</label>
                <input type="text" name="facebook" class="form-control" placeholder="past the link here">
                <!-- Add more input fields for other social media links -->
            </div>

            <button type="submit" class="btn btn-success">Add Team Member</button>
        </form>
        <script>
    document.addEventListener('DOMContentLoaded', function() {
        // Get references to the button and form
        var toggleFormBtn = document.getElementById('toggleFormBtn');
        var addTeamMemberForm = document.getElementById('addTeamMemberForm');

        // Add a click event listener to the button
        toggleFormBtn.addEventListener('click', function() {
            // Toggle the form's visibility
            if (addTeamMemberForm.style.display === 'none') {
                addTeamMemberForm.style.display = 'block';
            } else {
                addTeamMemberForm.style.display = 'none';
            }
        });
    });
</script>


        <!-- Back button to return to the main admin page -->
        <a href="/Medcancer/admin/index.php" class="btn btn-secondary mt-3" id="backbtn">Back to admin panel</a>
        <style>
            #backbtn
             {
                display: block;
                margin: auto;
                margin-top: 20px; /* You can adjust the margin-top as needed */
            }
        </style>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            var socialLinks = document.querySelectorAll('.social a');
            socialLinks.forEach(function(link) {
                link.addEventListener('click', function(event) {
                    event.preventDefault();
                    var redirectUrl = link.getAttribute('href');
                    window.location.href = redirectUrl;
                });
            });
        });
    </script>

    <!-- Include Bootstrap JS and Popper.js -->
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
</body>
</html>
