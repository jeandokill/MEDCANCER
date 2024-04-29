<?php
include 'data.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['add_card'])) {
    $newCard = [
        'title'   => $_POST['new_card_title'],
        'content' => $_POST['new_card_content'],
        'hero_image' => $_FILES['hero_image']['name'], // Get the filename of the uploaded hero image
        'introduction' => $_POST['introduction'],
        'paragraphs' => [
            $_POST['paragraph1'],
            $_POST['paragraph2'],
            $_POST['paragraph3']
        ],
        'images' => [
            $_FILES['image1']['name'],
            $_FILES['image2']['name'],
            $_FILES['image3']['name']
        ],
        'conclusion' => $_POST['conclusion']
    ];

    // Move uploaded images to the uploads directory
    move_uploaded_file($_FILES['hero_image']['tmp_name'], 'uploads/' . $_FILES['hero_image']['name']);
    move_uploaded_file($_FILES['image1']['tmp_name'], 'uploads/' . $_FILES['image1']['name']);
    move_uploaded_file($_FILES['image2']['tmp_name'], 'uploads/' . $_FILES['image2']['name']);
    move_uploaded_file($_FILES['image3']['tmp_name'], 'uploads/' . $_FILES['image3']['name']);

    // Add the new card
    $servicesContent['cards'][] = $newCard;

    // Save the updated content to data_services.php
    file_put_contents('data.php', '<?php $servicesContent = ' . var_export($servicesContent, true) . '; ?>');

    // Redirect back to admin/index.php
    header('Location: /Medcancer/admin/index.php');
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <link href="/Medcancer/Home/assets/img/favicon.png" rel="icon">
    <link href="/Medcancer/Home/assets/img/favicon.png" rel="apple-touch-icon">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Card - Admin Panel</title>
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

        textarea {
            resize: vertical;
        }

        .btn-success {
            background-color: #28a745;
            color: #ffffff;
        }
    </style>
</head>
<body>
    <div class="container">
        <h2 class="mb-4">Add Card</h2>
        <form method="post" enctype="multipart/form-data">
            <div class="form-group">
                <label for="new_card_title">Card Title</label>
                <input type="text" class="form-control" name="new_card_title" required>
            </div>

            <div class="form-group">
                <label for="new_card_content">Card Content</label>
                <textarea class="form-control" name="new_card_content" rows="5" required></textarea>
            </div>

            <div class="form-group">
                <label for="hero_image">Hero Image</label>
                <input type="file" class="form-control-file" name="hero_image" required accept="image/*">
            </div>

            <div class="form-group">
                <label for="introduction">Introduction</label>
                <textarea class="form-control" name="introduction" rows="3" required></textarea>
            </div>

            <!-- Repeat this section for each paragraph and image -->
            <div class="form-group">
                <label for="paragraph1">Paragraph 1</label>
                <textarea class="form-control" name="paragraph1" rows="3" required></textarea>
            </div>

            <div class="form-group">
                <label for="image1">Image 1</label>
                <input type="file" class="form-control-file" name="image1" required accept="image/*">
            </div>

            <!-- Repeat this section for each paragraph and image -->
            <div class="form-group">
                <label for="paragraph2">Paragraph 2</label>
                <textarea class="form-control" name="paragraph2" rows="3" required></textarea>
            </div>

            <div class="form-group">
                <label for="image2">Image 2</label>
                <input type="file" class="form-control-file" name="image2" required accept="image/*">
            </div>

            <!-- Repeat this section for each paragraph and image -->
            <div class="form-group">
                <label for="paragraph3">Paragraph 3</label>
                <textarea class="form-control" name="paragraph3" rows="3" required></textarea>
            </div>

            <div class="form-group">
                <label for="image3">Image 3</label>
                <input type="file" class="form-control-file" name="image3" required accept="image/*">
            </div>

            <div class="form-group">
                <label for="conclusion">Conclusion</label>
                <textarea class="form-control" name="conclusion" rows="3" required></textarea>
            </div>

            <button type="submit" name="add_card" class="btn btn-success">Add Card</button>
        </form>
    </div>

    <!-- Include necessary scripts here -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
