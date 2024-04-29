<?php
include 'data.php';

// Initialize $faqEntries if not set
$faqEntries = getFaqEntriesFromDatabase();

// Check if the form is submitted
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['add_faq'])) {
        // Add new FAQ entry
        $newFaq = [
            'question' => $_POST['new_question'],
            'answer'   => $_POST['new_answer'],
        ];

        $faqEntries[] = $newFaq;
        saveFaqEntriesToDatabase($faqEntries);
        // Reload the page after adding the FAQ to reflect changes
        header("Location: admin_faq.php");
        exit();
    } elseif (isset($_POST['edit_faq'])) {
        // Edit existing FAQ entry
        $editId = $_POST['edit_id'];
        $faqEntries[$editId]['question'] = $_POST['edit_question'];
        $faqEntries[$editId]['answer'] = $_POST['edit_answer'];
        saveFaqEntriesToDatabase($faqEntries);
        // Reload the page after editing the FAQ to reflect changes
        header("Location: admin_faq.php");
        exit();
    } elseif (isset($_POST['remove_faq'])) {
        // Remove FAQ entry
        $removeId = $_POST['remove_id'];
        unset($faqEntries[$removeId]);
        // Re-index the array to prevent gaps in IDs
        $faqEntries = array_values($faqEntries);
        saveFaqEntriesToDatabase($faqEntries);
        // Reload the page after removing the FAQ to reflect changes
        header("Location: admin_faq.php");
        exit();
    }
}

// Fetch FAQs after action
$faqEntries = getFaqEntriesFromDatabase();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <title>Admin Panel - FAQs</title>
    <link href="/Medcancer/Home/assets/img/favicon.png" rel="icon">
    <link href="/Medcancer/Home/assets/img/favicon.png" rel="apple-touch-icon">
    <!-- Include Bootstrap CSS -->
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
        <h2 class="mb-4">FAQ Management</h2>

        <!-- Add/Edit FAQ Form -->
        <form method="post">
            <div class="form-group">
                <label for="new_question">New Question</label>
                <input type="text" class="form-control" name="new_question" required>
            </div>

            <div class="form-group">
                <label for="new_answer">New Answer</label>
                <textarea class="form-control" name="new_answer" rows="5" required></textarea>
            </div>

            <button type="submit" name="add_faq" class="btn btn-success update-button">Add FAQ</button>
        </form>

        <!-- Current FAQs Table -->
        <h2 class="mt-4">Current FAQs</h2>

        <table class="table">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Question</th>
                    <th>Answer</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($faqEntries as $id => $faq): ?>
                    <tr>
                        <td><?= $id ?></td>
                        <td><?= $faq['question'] ?></td>
                        <td><?= $faq['answer'] ?></td>
                        <td>
                            <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#editModal<?= $id ?>">
                                Edit FAQ
                            </button>
                            <form method="post" style="display: inline-block;">
                                <input type="hidden" name="remove_id" value="<?= $id ?>">
                                <button type="submit" name="remove_faq" class="btn btn-danger">Remove FAQ</button>
                            </form>
                        </td>
                    </tr>

                    <!-- Edit FAQ Modal -->
                    <div class="modal fade" id="editModal<?= $id ?>" tabindex="-1" role="dialog" aria-labelledby="editModalLabel" aria-hidden="true">
                        <div class="modal-dialog" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="editModalLabel">Edit FAQ</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <div class="modal-body">
                                    <form method="post">
                                        <input type="hidden" name="edit_id" value="<?= $id ?>">
                                        <div class="form-group">
                                            <label for="edit_question">Question:</label>
                                            <input type="text" name="edit_question" class="form-control" value="<?= $faq['question'] ?>" required>
                                        </div>
                                        <div class="form-group">
                                            <label for="edit_answer">Answer:</label>
                                            <textarea name="edit_answer" class="form-control" rows="3" required><?= $faq['answer'] ?></textarea>
                                        </div>
                                        <button type="submit" name="edit_faq" class="btn btn-primary">Save Changes</button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>

    <!-- Include Bootstrap JS and Popper.js -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
