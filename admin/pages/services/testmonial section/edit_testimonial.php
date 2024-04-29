<?php
include 'data.php';

// Function to save testimonials data
function saveTestimonials() {
    global $testimonials;
    $data = '<?php $testimonials = ' . var_export($testimonials, true) . '; ?>';
    file_put_contents('data.php', $data);
}

// Check if index is set in the query parameters
if (isset($_GET['index'])) {
    $index = $_GET['index'];

    // Check if the testimonial exists
    if (isset($testimonials[$index])) {
        $testimonial = $testimonials[$index];

        // Handle form submission for editing testimonial
        if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['edit_testimonial'])) {
            // Update testimonial details
            $testimonials[$index]['name'] = $_POST['name'];
            $testimonials[$index]['location'] = $_POST['location'];
            $testimonials[$index]['comment'] = $_POST['comment'];

            // Check if a new image is uploaded
            if ($_FILES['image']['error'] === UPLOAD_ERR_OK) {
                // Delete the existing image
                $existingImagePath = $testimonials[$index]['image'];
                if (file_exists($existingImagePath)) {
                    unlink($existingImagePath);
                }

                // Upload the new image
                $newImage = uploadImage($_FILES['image']);
                if ($newImage) {
                    $testimonials[$index]['image'] = $newImage;
                }
            }

            // Save the updated testimonials data
            saveTestimonials();

            // Redirect back to admin_testimonials.php after editing
            header('Location: admin_testmonial.php');
            exit();
        }
    } else {
        // Redirect back to admin_testimonials.php if testimonial index is not valid
        header('Location: admin_testmonial.php');
        exit();
    }
} else {
    // Redirect back to admin_testimonials.php if index is not set
    header('Location: admin_testmonial.php');
    exit();
}

// Function to handle image upload
function uploadImage($file) {
    $uploadsDirectory = 'uploads/';
    $targetFile = $uploadsDirectory . basename($file['name']);

    if (move_uploaded_file($file['tmp_name'], $targetFile)) {
        return $targetFile;
    } else {
        return false;
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
    <title>Edit Testimonial - Admin Panel</title>
    <!-- Bootstrap CSS link -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <style>
        body {
            background-color: #f8f9fa;
        }

        .container {
            background-color: #ffffff;
            padding: 20px;
            border-radius: 5px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            margin-top: 50px;
        }

        h2 {
            color: #007bff;
        }

        label {
            font-weight: bold;
        }

        .btn-primary {
            background-color: #007bff;
            color: #ffffff;
        }
    </style>
</head>
<body>
    <div class="container">
        <h2 class="mb-4">Edit Testimonial</h2>
        <form method="post" enctype="multipart/form-data">
            <div class="form-group">
                <label for="name">Name</label>
                <input type="text" class="form-control" name="name" value="<?php echo $testimonial['name']; ?>" required>
            </div>

            <div class="form-group">
                <label for="location">Location</label>
                <input type="text" class="form-control" name="location" value="<?php echo $testimonial['location']; ?>" required>
            </div>

            <div class="form-group">
                <label for="comment">Comment</label>
                <textarea class="form-control" name="comment" rows="5" required><?php echo $testimonial['comment']; ?></textarea>
            </div>

            <div class="form-group">
                <label for="image">Upload New Image</label>
                <input type="file" class="form-control-file" name="image">
            </div>

            <button type="submit" name="edit_testimonial" class="btn btn-primary">Save Changes</button>
        </form>
    </div>

    <!-- Include necessary scripts here -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
