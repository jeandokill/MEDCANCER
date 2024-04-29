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
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['update_why_choose'])) {
    // Update content based on the submitted form data
    $whyChooseContent = [
        'h3' => $_POST['why_choose_h3'],
        'p' => $_POST['why_choose_p'],
        'boxes' => array(
            array(
                'icon' => $_POST['box1_icon'],
                'title' => $_POST['box1_title'],
                'description' => $_POST['box1_description']
            ),
            array(
                'icon' => $_POST['box2_icon'],
                'title' => $_POST['box2_title'],
                'description' => $_POST['box2_description']
            ),
            array(
                'icon' => $_POST['box3_icon'],
                'title' => $_POST['box3_title'],
                'description' => $_POST['box3_description']
            ),
        )
    ];

    // Save the updated content to data.php
    file_put_contents('data.php', '<?php $whyChooseContent = ' . var_export($whyChooseContent, true) . '; ?>');

    // Redirect back to admin/index.php
    header('Location: /Medcancer/admin/index.php');
    exit(); // Ensure that the script stops here
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <link href="/Medcancer/Home/assets/img/favicon.png" rel="icon">
    <link href="/Medcancer/Home/assets/img/favicon.png" rel="apple-touch-icon">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
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
        <h2 class="mb-4">Why Choose MEDCANCER Rwanda Content</h2>
        <form method="post">
            <!-- Why Choose Section -->
            <div class="form-group">
                <label for="why_choose_h3">Title</label>
                <input type="text" class="form-control" name="why_choose_h3" value="<?php echo $whyChooseContent['h3']; ?>" required>
            </div>

            <div class="form-group">
                <label for="why_choose_p">Paragraph</label>
                <textarea class="form-control" name="why_choose_p" rows="5" required><?php echo $whyChooseContent['p']; ?></textarea>
            </div>

            <!-- Box 1 -->
            <div class="form-group">
                <label for="box1_icon">Box 1 Icon</label>
                <input type="text" class="form-control" name="box1_icon" value="<?php echo $whyChooseContent['boxes'][0]['icon']; ?>" required>
            </div>
            <div class="form-group">
                <label for="box1_title">Box 1 Title</label>
                <input type="text" class="form-control" name="box1_title" value="<?php echo $whyChooseContent['boxes'][0]['title']; ?>" required>
            </div>
            <div class="form-group">
                <label for="box1_description">Box 1 Description</label>
                <textarea class="form-control" name="box1_description" rows="3" required><?php echo $whyChooseContent['boxes'][0]['description']; ?></textarea>
            </div>

            <!-- Box 2 -->
            <div class="form-group">
                <label for="box2_icon">Box 2 Icon</label>
                <input type="text" class="form-control" name="box2_icon" value="<?php echo $whyChooseContent['boxes'][1]['icon']; ?>" required>
            </div>
            <div class="form-group">
                <label for="box2_title">Box 2 Title</label>
                <input type="text" class="form-control" name="box2_title" value="<?php echo $whyChooseContent['boxes'][1]['title']; ?>" required>
            </div>
            <div class="form-group">
                <label for="box2_description">Box 2 Description</label>
                <textarea class="form-control" name="box2_description" rows="3" required><?php echo $whyChooseContent['boxes'][1]['description']; ?></textarea>
            </div>

            <!-- Box 3 -->
            <div class="form-group">
                <label for="box3_icon">Box 3 Icon</label>
                <input type="text" class="form-control" name="box3_icon" value="<?php echo $whyChooseContent['boxes'][2]['icon']; ?>" required>
            </div>
            <div class="form-group">
                <label for="box3_title">Box 3 Title</label>
                <input type="text" class="form-control" name="box3_title" value="<?php echo $whyChooseContent['boxes'][2]['title']; ?>" required>
            </div>
            <div class="form-group">
                <label for="box3_description">Box 3 Description</label>
                <textarea class="form-control" name="box3_description" rows="3" required><?php echo $whyChooseContent['boxes'][2]['description']; ?></textarea>
            </div>

            <button type="submit" name="update_why_choose" class="btn btn-primary update-button">Update Why Choose Content</button>
        </form>
    </div>

    <!-- Bootstrap JS and Popper.js scripts (required for Bootstrap components) -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
