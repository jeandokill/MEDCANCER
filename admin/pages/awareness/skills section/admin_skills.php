<?php
include 'data.php';

// Check if the form is submitted
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['update_skills'])) {
    // Update skills content based on the submitted form data
    $skillsContent = [
        'heading' => $_POST['skills_heading'],
        'paragraph' => $_POST['skills_paragraph'],
        'image' => $_POST['skills_image'], // Add image field
        'progress_values' => $_POST['progress_values'], // Add progress values field
        'progress_names' => $_POST['progress_names'], // Add progress names field
    ];

    // Handle image upload
    if ($_FILES['skills_image_upload']['size'] > 0) {
        $uploadDir = 'uploads/';
        $uploadFile = $uploadDir . basename($_FILES['skills_image_upload']['name']);

        if (move_uploaded_file($_FILES['skills_image_upload']['tmp_name'], $uploadFile)) {
            $skillsContent['image'] = $uploadFile;
        } else {
            echo "Error uploading image.";
        }
    }

    // Ensure that the progress_names array is initialized
    if (!isset($skillsContent['progress_names'])) {
        $skillsContent['progress_names'] = array();
    }

    // Save the updated content to data.php
    file_put_contents('data.php', '<?php $skillsContent = ' . var_export($skillsContent, true) . '; ?>');

    // Redirect back to admin/index.php
    header('Location: /Medcancer/admin/index.php');
    exit(); // Ensure that the script stops here
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="/Medcancer/Home/assets/img/favicon.png" rel="icon">
    <link href="/Medcancer/Home/assets/img/favicon.png" rel="apple-touch-icon">
    <title>Admin Panel</title>
    <!-- Bootstrap CSS link -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <style>
        /* Custom form styling */
        form {
            max-width: 600px;
            margin: auto;
        }

        label {
            font-weight: bold;
            margin-bottom: 0.5rem;
        }

        input[type="text"],
        textarea {
            width: 100%;
            padding: 0.375rem 0.75rem;
            margin-bottom: 1rem;
            border: 1px solid #ced4da;
            border-radius: 0.25rem;
            box-sizing: border-box;
        }

        textarea {
            resize: vertical; /* Allow vertical resizing */
        }

        .update-button {
            background-color: #007bff;
            color: #fff;
            padding: 0.5rem 1rem;
            border: none;
            border-radius: 0.25rem;
            cursor: pointer;
        }
    </style>
</head>

<body>
    <div class="container mt-5">
        <h2 class="mb-4">Skills Section Content</h2>
        <form method="post" enctype="multipart/form-data">
            <!-- Skills Section -->
            <div class="form-group">
                <label for="skills_heading">Heading</label>
                <input type="text" class="form-control" name="skills_heading" value="<?php echo $skillsContent['heading']; ?>" required>
            </div>

            <div class="form-group">
                <label for="skills_paragraph">Paragraph</label>
                <textarea class="form-control" name="skills_paragraph" rows="5" required><?php echo $skillsContent['paragraph']; ?></textarea>
            </div>

            <div class="form-group">
                <label for="skills_image" class="mt-3">Image URL</label>
                <input type="text" class="form-control" name="skills_image" value="<?php echo $skillsContent['image']; ?>">
            </div>

            <div class="form-group">
                <label for="skills_image_upload" class="mt-3">Upload New Image</label>
                <input type="file" class="form-control" name="skills_image_upload">
            </div>

            <!-- Add input fields for progress bar values and names -->
            <label for="progress_values">Progress Bars</label>
            <?php for ($i = 0; $i < count($skillsContent['progress_values']); $i++) : ?>
                <div class="form-group">
                    <label for="progress_names[]">Progress Bar <?php echo $i + 1; ?> Name</label>
                    <input type="text" name="progress_names[]" value="<?php echo isset($skillsContent['progress_names'][$i]) ? $skillsContent['progress_names'][$i] : ''; ?>" required>
                    <label for="progress_values[]">Progress Bar <?php echo $i + 1; ?> Value</label>
                    <input type="number" name="progress_values[]" min="0" max="100" value="<?php echo $skillsContent['progress_values'][$i]; ?>" required>
                </div>
            <?php endfor; ?>

            <button type="submit" name="update_skills" class="btn btn-primary update-button">Update Skills Content</button>
        </form>
    </div>

    <!-- Bootstrap JS and Popper.js scripts (required for Bootstrap components) -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>

</html>
