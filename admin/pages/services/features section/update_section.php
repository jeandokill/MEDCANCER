<?php
include 'data.php'; // Include the correct data file

// Check if the update_section button is clicked
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['update_section'])) {
    // Update section title and subtitle
    $sectionTitle = $_POST['section_title'];
    $sectionSubtitle = $_POST['section_subtitle'];

    // Save the updated content to data_services.php
    $servicesContent['sectionTitle'] = $sectionTitle;
    $servicesContent['sectionSubtitle'] = $sectionSubtitle;

    file_put_contents('data.php', '<?php $servicesContent = ' . var_export($servicesContent, true) . '; ?>');

    // Redirect back to admin/index.php
    header('Location: /Medcancer/admin/index.php');
    exit();
} else {
    // If update_section button is not clicked, redirect to admin/index.php or handle accordingly
    header('Location: /Medcancer/admin/index.php');
    exit();
}
?>
