<?php
include 'data.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['update_services'])) {
    // Update section title and subtitle
    $sectionTitle = $_POST['section_title'];
    $sectionSubtitle = $_POST['section_subtitle'];

    // Update or add cards
    $cards = [];
    foreach ($_POST['card'] as $index => $card) {
        // Ensure that title and content are not empty
        if (!empty($card['title']) && !empty($card['content'])) {
            $cards[] = [
                'title'   => $card['title'],
                'content' => $card['content'],
            ];
        }
    }

    // Save the updated content to data_services.php
    $servicesContent = [
        'sectionTitle'   => $sectionTitle,
        'sectionSubtitle' => $sectionSubtitle,
        'cards'           => $cards,
    ];

    file_put_contents('data_services.php', '<?php $servicesContent = ' . var_export($servicesContent, true) . '; ?>');

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
    <title>Admin Panel</title>
    <!-- Bootstrap CSS link -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <style>
        .card {
            margin-bottom: 20px;
        }

        .card-body {
            position: relative;
        }

        .edit-button,
        .delete-button {
            position: absolute;
            bottom: 10px;
            right: 10px;
        }

        .btn-add-card {
            margin-top: 20px;
        }
    </style>
</head>
<body>
    <div class="container mt-5">
        <h2 class="mb-4">Services Content</h2>

        <!-- Section Title and Subtitle -->
        <form method="post" action="/Medcancer/admin/pages/services/features%20section/update_section.php">
            <!-- Section Title and Subtitle -->
            <div class="form-group">
                <label for="section_title">Section Title</label>
                <input type="text" class="form-control" name="section_title" value="<?php echo $servicesContent['sectionTitle']; ?>">
            </div>

            <div class="form-group">
                <label for="section_subtitle">Section Subtitle</label>
                <input type="text" class="form-control" name="section_subtitle" value="<?php echo $servicesContent['sectionSubtitle']; ?>">
            </div>

            <!-- Update Section Button -->
            <button type="submit" name="update_section" class="btn btn-primary">Update Section</button>
        </form>


        <!-- Current Cards -->
        <!-- Current Cards -->
        <!-- Current Cards -->
<div class="mb-4 mt-4">
    <h3>Current Cards</h3>
    <div class="row">
        <?php foreach ($servicesContent['cards'] as $index => $card): ?>
            <div class="col-md-4">
                <div class="card <?php echo isset($card['color']) ? $card['color'] : ''; ?>" style="transition: background-color 0.3s ease;">
                    <div class="card-header">Card <?php echo $index + 1; ?></div>
                    <div class="card-body">
                        <h5 class="card-title"><?php echo $card['title']; ?></h5>
                        <p class="card-text"><?php echo $card['content']; ?></p>
                        <div class="d-flex justify-content-between">
                            <!-- Edit Button -->
                            <a href="/Medcancer/admin/pages/services/features%20section/edit_card.php?index=<?php echo $index; ?>" class="btn btn-primary">Edit</a>
                            <!-- Delete Button -->
                            <a href="/Medcancer/admin/pages/services/features%20section/delete_card.php?index=<?php echo $index; ?>" class="btn btn-danger delete-button">Delete</a>
                        </div>
                    </div>
                </div>
            </div>
        <?php endforeach; ?>
    </div>
</div>

<script>
    // Add hover effect to change background color on hover
    document.querySelectorAll('.card').forEach(card => {
        card.addEventListener('mouseover', () => {
            card.style.backgroundColor = '#e0e0e0'; // Change to desired hover color
        });

        card.addEventListener('mouseout', () => {
            card.style.backgroundColor = ''; // Reset to default color on mouseout
        });
    });
</script>



        <!-- Add Card Button -->
        <a href="/Medcancer/admin/pages/services/features%20section/add_card.php" class="btn btn-success btn-add-card">Add Card</a>
    </div>

    <!-- Include necessary scripts here -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
