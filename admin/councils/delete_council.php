<?php
// Include database connection file
include_once "db_connect.php";

// Check if council ID is provided in the URL parameter
if(isset($_GET['id'])) {
    // Retrieve the council ID from the URL
    $council_id = $_GET['id'];

    // Prepare a DELETE statement
    $sql = "DELETE FROM councils WHERE id = ?";

    // Prepare the statement
    $stmt = mysqli_prepare($conn, $sql);

    if ($stmt) {
        // Bind parameters to the statement
        mysqli_stmt_bind_param($stmt, "i", $council_id);

        // Execute the statement
        if (mysqli_stmt_execute($stmt)) {
            // Council deleted successfully
            echo "Council deleted successfully";
        } else {
            // Error occurred while deleting council
            echo "Error: " . mysqli_error($conn);
        }

        // Close statement
        mysqli_stmt_close($stmt);
    } else {
        // Error occurred while preparing the statement
        echo "Error: " . mysqli_error($conn);
    }

    // Close database connection
    mysqli_close($conn);
} else {
    // Redirect to error page if council ID is not provided
    header("Location: error.php");
    exit();
}
?>
