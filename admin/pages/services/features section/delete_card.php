<?php
include 'data.php'; // Include the correct data file

// Check if the index is provided in the URL
if (isset($_GET['index'])) {
    $index = $_GET['index'];

    // Check if the index is valid
    if ($index >= 0 && $index < count($servicesContent['cards'])) {
        // Remove the card at the specified index
        array_splice($servicesContent['cards'], $index, 1);

        // Save the updated content to data_services.php
        file_put_contents('data.php', '<?php $servicesContent = ' . var_export($servicesContent, true) . '; ?>');

        // Redirect back to admin/index.php
        header('Location: /Medcancer/admin/index.php');
        exit();
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
