<?php
include("data.php");

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['add_image'])) {
    // Process add image form
    $targetDirectory = "uploads/";
    $targetFile = $targetDirectory . basename($_FILES["image"]["name"]);

    if (move_uploaded_file($_FILES["image"]["tmp_name"], $targetFile)) {
        // File has been successfully uploaded
        $imagePath = $targetFile;

        // Add new image to the database
        addGalleryImage($imagePath);
    } else {
        echo "Sorry, there was an error uploading your file.";
    }
} elseif ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['remove_image'])) {
    // Process remove image form
    $id = mysqli_real_escape_string($connection, $_POST['id']);
    $imagePath = mysqli_real_escape_string($connection, $_POST['image_path']);

    // Remove image from the database and server
    removeGalleryImage($id, $imagePath);
}

// Get all gallery images
$galleryImages = getGalleryImages();
?>

<!-- Bootstrap styles -->
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
<link href="/Medcancer/Home/assets/img/favicon.png" rel="icon">
<link href="/Medcancer/Home/assets/img/favicon.png" rel="apple-touch-icon">

<!-- Display existing images in a Bootstrap table -->
<div class="container mt-5">
    <h1>Gallery Management</h1>

    <form action="admin_gallery.php" method="post" enctype="multipart/form-data">
        <div class="form-group">
            <label for="image">Add Image:</label>
            <input type="file" name="image" class="form-control-file" required>
        </div>
        <button type="submit" name="add_image" class="btn btn-success">Add Image</button>
    </form>

    <h2>Current Gallery Images</h2>

    <table class="table">
        <thead class="thead-light">
            <tr>
                <th>ID</th>
                <th>Image</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($galleryImages as $image): ?>
                <tr>
                    <td><?= $image['id'] ?></td>
                    <td>
                        <div class="gallery-image">
                            <img src="<?= $image['image_path'] ?>" alt="Gallery Image" class="img-thumbnail">
                        </div>
                    </td>
                    <td>
                        <form action="admin_gallery.php" method="post">
                            <input type="hidden" name="id" value="<?= $image['id'] ?>">
                            <input type="hidden" name="image_path" value="<?= $image['image_path'] ?>">
                            <button type="submit" name="remove_image" class="btn btn-danger">Remove</button>
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

<!-- Bootstrap scripts (optional, but might be required for certain features) -->
<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.1/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
