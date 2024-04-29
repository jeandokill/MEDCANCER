<?php
include 'data.php';

// Check if the form is submitted
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['update_tenets'])) {
    // Update tenets content based on the submitted form data
    $tenetsContent = [
        'tenets_title' => $_POST['tenets_title'],
        'tenets_description' => $_POST['tenets_description'],
        'mission' => [
            'title' => $_POST['mission_title'],
            'description' => $_POST['mission_description']
        ],
        'plan' => [
            'title' => $_POST['plan_title'],
            'description' => $_POST['plan_description']
        ],
        'vision' => [
            'title' => $_POST['vision_title'],
            'description' => $_POST['vision_description']
        ],
        'care' => [
            'title' => $_POST['care_title'],
            'description' => $_POST['care_description']
        ],
    ];

    // Save the updated content to data.php
    file_put_contents('data.php', '<?php $tenetsContent = ' . var_export($tenetsContent, true) . '; ?>');

    // Redirect back to admin/index.php with a success message
    header('Location: /Medcancer/admin/index.php?success=1');
    exit(); // Ensure that the script stops here
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
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
        <h2 class="mb-4">Tenets Section Content</h2>
        <form method="post">
            <!-- Tenets Section -->
            <div class="form-group">
                <label for="tenets_title">Tenets Title</label>
                <input type="text" class="form-control" name="tenets_title" value="<?php echo $tenetsContent['tenets_title']; ?>" required>
            </div>

            <div class="form-group">
                <label for="tenets_description">Tenets Description</label>
                <textarea class="form-control" name="tenets_description" rows="5" required><?php echo $tenetsContent['tenets_description']; ?></textarea>
            </div>

            <!-- Mission -->
            <div class="form-group">
                <label for="mission_title">Mission Title</label>
                <input type="text" class="form-control" name="mission_title" value="<?php echo $tenetsContent['mission']['title']; ?>" required>
            </div>

            <div class="form-group">
                <label for="mission_description">Mission Description</label>
                <textarea class="form-control" name="mission_description" rows="5" required><?php echo $tenetsContent['mission']['description']; ?></textarea>
            </div>

            <!-- Plan -->
            <div class="form-group">
                <label for="plan_title">Plan Title</label>
                <input type="text" class="form-control" name="plan_title" value="<?php echo $tenetsContent['plan']['title']; ?>" required>
            </div>

            <div class="form-group">
                <label for="plan_description">Plan Description</label>
                <textarea class="form-control" name="plan_description" rows="5" required><?php echo $tenetsContent['plan']['description']; ?></textarea>
            </div>

            <!-- Vision -->
            <div class="form-group">
                <label for="vision_title">Vision Title</label>
                <input type="text" class="form-control" name="vision_title" value="<?php echo $tenetsContent['vision']['title']; ?>" required>
            </div>

            <div class="form-group">
                <label for="vision_description">Vision Description</label>
                <textarea class="form-control" name="vision_description" rows="5" required><?php echo $tenetsContent['vision']['description']; ?></textarea>
            </div>

            <!-- Care -->
            <div class="form-group">
                <label for="care_title">Care Title</label>
                <input type="text" class="form-control" name="care_title" value="<?php echo $tenetsContent['care']['title']; ?>" required>
            </div>

            <div class="form-group">
                <label for="care_description">Care Description</label>
                <textarea class="form-control" name="care_description" rows="5" required><?php echo $tenetsContent['care']['description']; ?></textarea>
            </div>

            <button type="submit" name="update_tenets" class="btn btn-primary update-button">Update Tenets Content</button>
        </form>
    </div>

    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>

</html>
