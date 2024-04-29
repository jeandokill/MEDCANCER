<?php
include 'data.php';

// Check if the index is provided in the URL
if (isset($_GET['index'])) {
    $index = $_GET['index'];

    // Check if the index is valid
    if ($index >= 0 && $index < count($servicesContent['cards'])) {
        $card = $servicesContent['cards'][$index];

        // Handle form submission for card update
        if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['update_card'])) {
            // Update the card content
            $servicesContent['cards'][$index]['title'] = $_POST['edit_card_title'];
            $servicesContent['cards'][$index]['content'] = $_POST['edit_card_content'];
            $servicesContent['cards'][$index]['introduction'] = $_POST['introduction'];
            $servicesContent['cards'][$index]['paragraphs'][0] = $_POST['paragraph1'];
            $servicesContent['cards'][$index]['paragraphs'][1] = $_POST['paragraph2'];
            $servicesContent['cards'][$index]['paragraphs'][2] = $_POST['paragraph3'];
            $servicesContent['cards'][$index]['conclusion'] = $_POST['conclusion'];

            // Handle image uploads
            if ($_FILES['hero_image']['name']) {
                $servicesContent['cards'][$index]['hero_image'] = $_FILES['hero_image']['name'];
                move_uploaded_file($_FILES['hero_image']['tmp_name'], 'uploads/' . $_FILES['hero_image']['name']);
            }
            if ($_FILES['image1']['name']) {
                $servicesContent['cards'][$index]['images'][0] = $_FILES['image1']['name'];
                move_uploaded_file($_FILES['image1']['tmp_name'], 'uploads/' . $_FILES['image1']['name']);
            }
            if ($_FILES['image2']['name']) {
                $servicesContent['cards'][$index]['images'][1] = $_FILES['image2']['name'];
                move_uploaded_file($_FILES['image2']['tmp_name'], 'uploads/' . $_FILES['image2']['name']);
            }
            if ($_FILES['image3']['name']) {
                $servicesContent['cards'][$index]['images'][2] = $_FILES['image3']['name'];
                move_uploaded_file($_FILES['image3']['tmp_name'], 'uploads/' . $_FILES['image3']['name']);
            }

            // Save the updated content to data_services.php
            file_put_contents('data.php', '<?php $servicesContent = ' . var_export($servicesContent, true) . '; ?>');

            // Redirect back to admin/index.php
            header('Location: /Medcancer/admin/index.php');
            exit();
        }
    } else {
        // Invalid index, redirect to admin/index.php or handle accordingly
        header('Location: /Medcancer/admin/index.php');
        exit();
    }
} else {
    // No index provided, redirect to admin/index.php or handle accordingly
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
    <title>Edit Card</title>
    <!-- Bootstrap CSS link -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>
<body>
    <div class="container mt-5">
        <h2 class="mb-4">Edit Card</h2>
        <form method="post" enctype="multipart/form-data">
            <div class="form-group">
                <label for="edit_card_title">Card Title</label>
                <input type="text" class="form-control" name="edit_card_title" value="<?php echo $card['title']; ?>" required>
            </div>

            <div class="form-group">
                <label for="edit_card_content">Card Content</label>
                <textarea class="form-control" name="edit_card_content" rows="5" required><?php echo $card['content']; ?></textarea>
            </div>

            <div class="form-group">
                <label for="hero_image">Hero Image</label>
                <input type="file" class="form-control-file" name="hero_image" accept="image/*">
            </div>

            <div class="form-group">
                <label for="introduction">Introduction</label>
                <textarea class="form-control" name="introduction" rows="3" required><?php echo $card['introduction']; ?></textarea>
            </div>

            <div class="form-group">
                <label for="paragraph1">Paragraph 1</label>
                <textarea class="form-control" name="paragraph1" rows="3" required><?php echo $card['paragraphs'][0]; ?></textarea>
            </div>

            <div class="form-group">
                <label for="image1">Image 1</label>
                <input type="file" class="form-control-file" name="image1" accept="image/*">
            </div>

            <div class="form-group">
                <label for="paragraph2">Paragraph 2</label>
                <textarea class="form-control" name="paragraph2" rows="3" required><?php echo $card['paragraphs'][1]; ?></textarea>
            </div>

            <div class="form-group">
                <label for="image2">Image 2</label>
                <input type="file" class="form-control-file" name="image2" accept="image/*">
            </div>

            <div class="form-group">
                <label for="paragraph3">Paragraph 3</label>
                <textarea class="form-control" name="paragraph3" rows="3" required><?php echo $card['paragraphs'][2]; ?></textarea>
            </div>

            <div class="form-group">
                <label for="image3">Image 3</label>
                <input type="file" class="form-control-file" name="image3" accept="image/*">
            </div>

            <div class="form-group">
                <label for="conclusion">Conclusion</label>
                <textarea class="form-control" name="conclusion" rows="3" required><?php echo $card['conclusion']; ?></textarea>
            </div>

            <button type="submit" name="update_card" class="btn btn-primary">Update Card</button>
        </form>
    </div>

    <!-- Include necessary scripts here -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
