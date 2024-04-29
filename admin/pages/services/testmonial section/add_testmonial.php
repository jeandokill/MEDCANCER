<?php
include 'data.php';

// Function to add a testimonial
function addTestimonial($name, $location, $comment, $image) {
    global $testimonials;
    $newTestimonial = array('name' => $name, 'location' => $location, 'comment' => $comment, 'image' => $image);
    $testimonials[] = $newTestimonial;
    saveTestimonials();
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

// Add testimonial based on form submission
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['add_testimonial'])) {
    $name = $_POST['name'];
    $location = $_POST['location'];
    $comment = $_POST['comment'];
    $image = uploadImage($_FILES['image']);

    if ($image) {
        addTestimonial($name, $location, $comment, $image);
        // Redirect back to admin_testimonials.php
        header('Location: admin_testmonial.php');
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
    <title>Add Testimonial - Admin Panel</title>
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
        <h2 class="mb-4">Add Testimonial</h2>
        <form method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>" enctype="multipart/form-data">
            <div class="form-group">
                <label for="name">Name</label>
                <input type="text" class="form-control" name="name" required>
            </div>

            <div class="form-group">
                <label for="location">Location</label>
                <input type="text" class="form-control" name="location" required>
            </div>

            <div class="form-group">
                <label for="comment">Comment</label>
                <textarea class="form-control" name="comment" rows="5" required></textarea>
            </div>

            <div class="form-group">
                <label for="image">Image</label>
                <input type="file" class="form-control-file" name="image" accept="image/*" required>
            </div>

            <button type="submit" name="add_testimonial" class="btn btn-primary">Add Testimonial</button>
        </form>
    </div>

    <!-- Include necessary scripts here -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
