<?php
$f4Content = array(
    'image' => 'assets/img/features-4.jpg',
    'heading' => 'What is the effect of cancer on individuals',
    'introduction' => '',
    'paragraph' => '',
    'continue_reading' => '',
);

// Check if the form is submitted
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['update_f4'])) {
    // Update f4 content based on the submitted form data
    $f4Content = [
        'image' => saveImage('image', 'uploads'), // Save the uploaded image
        'heading' => $_POST['heading'],
        'introduction' => $_POST['introduction'],
        'paragraph' => $_POST['paragraph'],
        'continue_reading' => $_POST['continue_reading'],
    ];

    // Save the updated content to f4_code.php
    file_put_contents('f4_code.php', '<?php $f4Content = ' . var_export($f4Content, true) . '; ?>');

    // Redirect back to admin/index.php
    header('Location: /Medcancer/admin/index.php');
    exit(); // Ensure that the script stops here
}

// Function to save the uploaded image
function saveImage($inputName, $uploadDir) {
    $uploadedFile = $_FILES[$inputName];
    $fileName = $uploadedFile['name'];
    $fileTmpName = $uploadedFile['tmp_name'];
    $fileError = $uploadedFile['error'];

    if ($fileError === UPLOAD_ERR_OK) {
        $destination = $uploadDir . '/' . $fileName;
        move_uploaded_file($fileTmpName, $destination);
        return $destination;
    } else {
        // Handle error (you can customize this part)
        echo 'Error uploading image.';
        exit();
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="/Medcancer/Home/assets/img/favicon.png" rel="icon">
    <link href="/Medcancer/Home/assets/img/favicon.png" rel="apple-touch-icon">
    <title>Admin Panel - F4 Section</title>
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

        textarea {
            width: 100%;
            padding: 0.375rem 0.75rem;
            margin-bottom: 1rem;
            border: 1px solid #ced4da;
            border-radius: 0.25rem;
            box-sizing: border-box;
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
        <h2 class="mb-4">F4 Section Content</h2>
        <form method="post" enctype="multipart/form-data">
            <!-- F4 Section Fields -->
            <div class="form-group">
                <label for="heading">Heading</label>
                <textarea class="form-control" name="heading" rows="2" required><?php echo $f4Content['heading']; ?></textarea>
            </div>
            <div class="form-group">
                <label for="image">Image</label>
                <input type="file" class="form-control-file" name="image" required>
            </div>
            <div class="form-group">
                <label for="introduction">Introduction</label>
                <textarea class="form-control" name="introduction" rows="3" required><?php echo $f4Content['introduction']; ?></textarea>
            </div>
            <div class="form-group">
                <label for="paragraph">Paragraph</label>
                <textarea class="form-control" name="paragraph" rows="4" required><?php echo $f4Content['paragraph']; ?></textarea>
            </div>
            <div class="form-group">
                <label for="continue_reading">Continue Reading</label>
                <textarea class="form-control" name="continue_reading" rows="4" required><?php echo $f4Content['continue_reading']; ?></textarea>
            </div>

            <button type="submit" name="update_f4" class="btn btn-primary update-button">Update F4 Content</button>
        </form>
    </div>

    <!-- Bootstrap JS and Popper.js scripts (required for Bootstrap components) -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>

</html>
