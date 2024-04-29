<?php
// Start session
session_start();

// Include the database connection file
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "event";
$connection = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($connection->connect_error) {
    die("Connection failed: " . $connection->connect_error);
}

// Check if session ID is set and valid
if (isset($_GET['id']) && is_numeric($_GET['id'])) {
    $session_id = $_GET['id'];

    // Fetch counseling session details from the database
    $sql = "SELECT * FROM council WHERE id = $session_id";
    $result = $connection->query($sql);

    if ($result->num_rows > 0) {
        // Counseling session found, display details
        $session_data = $result->fetch_assoc();

        // Mark the notification as read in the database
        $update_sql = "UPDATE council SET status = 'read' WHERE id = $session_id";
        $connection->query($update_sql);
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>View Counseling Session</title>
    <!-- Bootstrap CSS -->
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <!-- Custom CSS -->
    <style>
        /* Add your custom styles here */
    </style>
</head>

<body>
    <div class="container mt-5">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">Counseling Session Details</div>

                    <div class="card-body">
                        <p><strong>Full Name:</strong> <?php echo $session_data['full_name']; ?></p>
                        <p><strong>Email:</strong> <?php echo $session_data['email']; ?></p>
                        <p><strong>Phone:</strong> <?php echo $session_data['phone']; ?></p>
                        <p><strong>Gender:</strong> <?php echo $session_data['gender']; ?></p>
                        <p><strong>Age:</strong> <?php echo $session_data['age']; ?></p>
                        <p><strong>Subject:</strong> <?php echo $session_data['subject']; ?></p>
                        <p><strong>Message:</strong> <?php echo $session_data['message']; ?></p>
                        <!-- Add more details as needed -->

                        <!-- Add a link to go back to the previous page -->
                        <a href="javascript:history.back()" class="btn btn-primary">Go Back</a>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Bootstrap JS -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <!-- Custom JavaScript -->
    <script>
        // Move the alert to the "Read Alerts" section
        $(document).ready(function() {
            var alertsDropdown = $("#alertsDropdown").next();
            var readAlertsDropdown = $("#readAlertsDropdown").next();
            alertsDropdown.find(".dropdown-item").each(function() {
                if ($(this).attr("href") == "#") {
                    $(this).appendTo(readAlertsDropdown);
                }
            });
        });
    </script>
</body>

</html>

<?php
    } else {
        // Counseling session not found, display an error message
        echo "Counseling session not found.";
    }
} else {
    // Invalid session ID, redirect to another page or display an error message
    echo "Invalid session ID.";
}

// Close connection
$connection->close();
?>
