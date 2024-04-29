<?php
include 'data.php';

// Check if the form is submitted
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['update_feature'])) {
    // Update feature content based on the submitted form data
    $featureContent = [
        'mission_title' => $_POST['mission_title'],
        'mission' => $_POST['mission'],
        'vision_title' => $_POST['vision_title'],
        'vision' => $_POST['vision'],
        'goal_title' => $_POST['goal_title'],
        'goal' => $_POST['goal'],
    ];

    // Save the updated content to data.php
    file_put_contents('data.php', '<?php $featureContent = ' . var_export($featureContent, true) . '; ?>');

    // Redirect back to admin/index.php with a success message
    header('Location: /Medcancer/admin/index.php?success=1');
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
        <h2 class="mb-4">Feature Section Content</h2>
        <form method="post">
            <!-- Feature Section -->
            <div class="form-group">
                <label for="mission_title">Mission Title</label>
                <input type="text" class="form-control" name="mission_title" value="<?php echo $featureContent['mission_title']; ?>" required>
            </div>

            <div class="form-group">
                <label for="mission">Mission</label>
                <textarea class="form-control" name="mission" rows="5" required><?php echo $featureContent['mission']; ?></textarea>
            </div>

            <div class="form-group">
                <label for="vision_title">Vision Title</label>
                <input type="text" class="form-control" name="vision_title" value="<?php echo $featureContent['vision_title']; ?>" required>
            </div>

            <div class="form-group">
                <label for="vision">Vision</label>
                <textarea class="form-control" name="vision" rows="5" required><?php echo $featureContent['vision']; ?></textarea>
            </div>

            <div class="form-group">
                <label for="goal_title">Goal Title</label>
                <input type="text" class="form-control" name="goal_title" value="<?php echo $featureContent['goal_title']; ?>" required>
            </div>

            <div class="form-group">
                <label for="goal">Goal</label>
                <textarea class="form-control" name="goal" rows="5" required><?php echo $featureContent['goal']; ?></textarea>
            </div>

            <button type="submit" name="update_feature" class="btn btn-primary update-button">Update Feature Content</button>
        </form>
    </div>

    
        <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"></script>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>

