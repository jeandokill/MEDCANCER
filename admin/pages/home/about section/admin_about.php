<style>
    /* Add your button styling here */
    .update-button {
        background-color: #4CAF50;
        color: white;
        padding: 10px 20px;
        border: none;
        border-radius: 5px;
        cursor: pointer;
    }
</style>

<?php
include 'data.php';

// Check if the form is submitted
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['update_about'])) {
    // Update about content based on the submitted form data
    $aboutContent = [
        'h3' => $_POST['about_h3'],
        'h2' => $_POST['about_h2'],
        'p'  => $_POST['about_p'],
    ];

    // Save the updated content to data.php
    file_put_contents('data.php', '<?php $aboutContent = ' . var_export($aboutContent, true) . '; ?>');

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
        <h2 class="mb-4">About Us Content</h2>
        <form method="post">
            <!-- About Us Section -->
            <div class="form-group">
                <label for="about_h3">Title</label>
                <input type="text" class="form-control" name="about_h3" value="<?php echo $aboutContent['h3']; ?>" required>
            </div>

            <div class="form-group">
                <label for="about_h2">Subtitle</label>
                <input type="text" class="form-control" name="about_h2" value="<?php echo $aboutContent['h2']; ?>" required>
            </div>

            <div class="form-group">
                <label for="about_p" class="mt-3">Paragraph</label>
                <textarea class="form-control" name="about_p" rows="5" required><?php echo $aboutContent['p']; ?></textarea>
            </div>

            <button type="submit" name="update_about" class="btn btn-primary update-button">Update About Content</button>
        </form>
    </div>

    <!-- Bootstrap JS and Popper.js scripts (required for Bootstrap components) -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>

