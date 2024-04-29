<?php
include 'data.php';

// Function to add a testimonial
function addTestimonial($name, $location, $comment, $image) {
    global $testimonials;
    $newTestimonial = array('name' => $name, 'location' => $location, 'comment' => $comment, 'image' => $image);
    $testimonials[] = $newTestimonial;
    saveTestimonials();
}

// Function to delete a testimonial by index
function deleteTestimonial($index) {
    global $testimonials;
    if (isset($testimonials[$index])) {
        $imagePath = $testimonials[$index]['image'];
        if (file_exists($imagePath)) {
            unlink($imagePath); // Delete the associated image file
        }
        unset($testimonials[$index]);
        saveTestimonials();
    }
}

// Function to save testimonials data
function saveTestimonials() {
    global $testimonials;
    $data = '<?php $testimonials = ' . var_export($testimonials, true) . '; ?>';
    file_put_contents('data.php', $data);
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

// Display testimonials
$testimonials = isset($testimonials) ? $testimonials : array();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Testimonials</title>
    <link href="/Medcancer/Home/assets/img/favicon.png" rel="icon">
    <link href="/Medcancer/Home/assets/img/favicon.png" rel="apple-touch-icon">
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <style>
        .card {
            margin-bottom: 20px;
        }

        .card-body {
            position: relative;
        }

        .delete-button {
            position: absolute;
            bottom: 10px;
            right: 10px;
        }

        .btn-add-testimonial {
            margin-top: 20px;
        }
    </style>
</head>
<body>

<div class="container mt-5">
    <h2 class="mb-4">Admin Testimonials</h2>

    <!-- Display testimonials -->
    <div class="row">
        <?php
    foreach ($testimonials as $index => $testimonial) {
        echo '<div class="col-md-4">';
        echo '<div class="card">';
        echo '<img src="' . $testimonial['image'] . '" class="card-img-top" alt="Testimonial Image">';
        echo '<div class="card-body">';
        echo '<h5 class="card-title">' . $testimonial['name'] . '</h5>';
        echo '<p class="card-text"><strong>Location:</strong> ' . $testimonial['location'] . '</p>';
        echo '<p class="card-text"><strong>Comment:</strong> ' . $testimonial['comment'] . '</p>';
        echo '<form method="get" action="edit_testimonial.php" enctype="multipart/form-data">';
        echo '<input type="hidden" name="index" value="' . $index . '">';
        echo '<button type="submit" name="edit" class="btn btn-primary mr-2">Edit</button>';
        echo '</form>';

        // Update form action for delete
        echo '<form method="get" action="delete_testimonial.php" enctype="multipart/form-data">';
        echo '<input type="hidden" name="index" value="' . $index . '">';
        echo '<button type="submit" name="delete" class="btn btn-danger delete-button">Delete</button>';
        echo '</form>';

        echo '</div>';
        echo '</div>';
        echo '</div>';
    }
    ?>

    </div>

    <!-- Add testimonial button -->
    <a href="/Medcancer/admin/pages/services/testmonial%20section/add_testmonial.php" class="btn btn-success btn-add-testimonial">Add testmonial
    <div>

<!-- Bootstrap JS and Popper.js (optional) -->
<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.0.8/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

</body>
</html>
