<?php
include("data.php");

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['add_sponsor'])) {
    // Process add sponsor form only if a file has been uploaded
    if (isset($_FILES["sponsor_logo"])) {
        $targetDirectory = "uploads/";
        $targetFile = $targetDirectory . basename($_FILES["sponsor_logo"]["name"]);

        if (move_uploaded_file($_FILES["sponsor_logo"]["tmp_name"], $targetFile)) {
            // File has been successfully uploaded
            $imagePath = $targetFile;

            // Add new sponsor to the database
            addSponsorImage($imagePath);

            // Redirect to the same page to avoid form resubmission
            header("Location: admin_sponsors.php");
            exit();
        } else {
            echo "Sorry, there was an error uploading your file.";
        }
    }
} elseif ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['remove_sponsor'])) {
    // Process remove sponsor form
    $id = mysqli_real_escape_string($connection, $_POST['id']);
    $imagePath = mysqli_real_escape_string($connection, $_POST['image_path']);

    // Remove sponsor from the database and server
    removeSponsorImage($id, $imagePath);

    // Redirect to the same page to avoid form resubmission
    header("Location: admin_sponsors.php");
    exit();
}

// Get all sponsor images
$sponsorImages = getSponsorImages();
?>

<!-- Styling and Form for Managing Sponsors (Similar to the Gallery Section) -->
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <link href="/Medcancer/Home/assets/img/favicon.png" rel="icon">
    <link href="/Medcancer/Home/assets/img/favicon.png" rel="apple-touch-icon">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sponsors Management</title>

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    
    <style>
        /* Custom Styles */
        .container {
            max-width: 800px;
        }

        .sponsor-table {
            margin-top: 20px;
        }

        .sponsor-logo img {
            max-width: 100%;
            height: auto;
        }
    </style>
</head>
<body>

<div class="container mt-5">
    <h1>Sponsors Management</h1>

    <form action="admin_sponsors.php" method="post" enctype="multipart/form-data">
        <div class="form-group">
            <label for="sponsor_logo">Add Sponsor Logo:</label>
            <input type="file" name="sponsor_logo" class="form-control-file" required>
        </div>
        <button type="submit" name="add_sponsor" class="btn btn-success">Add Sponsor</button>
    </form>

    <h2>Current Sponsor Logos</h2>

    <table class="table sponsor-table">
        <thead>
            <tr>
                <th>ID</th>
                <th>Image</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($sponsorImages as $sponsor): ?>
                <tr>
                    <td><?= $sponsor['id'] ?></td>
                    <td class="sponsor-logo"><img src="<?= $sponsor['image_path'] ?>" alt="Sponsor Logo" class="img-fluid"></td>
                    <td>
                        <form action="admin_sponsors.php" method="post">
                            <input type="hidden" name="id" value="<?= $sponsor['id'] ?>">
                            <input type="hidden" name="image_path" value="<?= $sponsor['image_path'] ?>">
                            <button type="submit" name="remove_sponsor" class="btn btn-danger">Remove Sponsor</button>
                        </form>
                    </td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</div>

<a href="/Medcancer/admin/index.php" class="btn btn-secondary mt-3" id="backbtn">Back to admin panel</a>
        <style>
            #backbtn
             {
                display: block;
                margin: auto;
                margin-top: 20px; /* You can adjust the margin-top as needed */
            }
        </style>

<!-- Bootstrap JS and Popper.js -->
<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

</body>
</html>
