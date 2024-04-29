<?php
// Start session
session_start();
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require '../vendor/autoload.php'; 

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

// Check if form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Escape user inputs for security
    $full_name = mysqli_real_escape_string($connection, $_POST['full_name']);
    $email = mysqli_real_escape_string($connection, $_POST['email']);
    $phone = mysqli_real_escape_string($connection, $_POST['phone']);
    $gender = mysqli_real_escape_string($connection, $_POST['gender']);
    $age = mysqli_real_escape_string($connection, $_POST['age']);
    $subject = mysqli_real_escape_string($connection, $_POST['subject']);
    $message = mysqli_real_escape_string($connection, $_POST['message']);

    // Insert user data into database
    $sql = "INSERT INTO council (full_name, email, phone, gender, age, subject, message) VALUES ('$full_name', '$email', '$phone', '$gender', '$age', '$subject', '$message')";
    
    if ($connection->query($sql) === TRUE) {
        // Set success flash message
        $_SESSION['flash_message'] = "Your counseling session request has been submitted successfully!";
        
        // Instantiate PHPMailer object
        $mail = new PHPMailer(true);

        // Server settings
        $mail->isSMTP();
        $mail->Host       = 'smtp.gmail.com';  // SMTP server
        $mail->SMTPAuth   = true;               // Enable SMTP authentication
        $mail->Username   = 'medcancer408@gmail.com';  // SMTP username
        $mail->Password   = 'dtmi qncl fnjt liau';           // SMTP password
        $mail->SMTPSecure = 'tls';              // Enable TLS encryption, `ssl` also accepted
        $mail->Port       = 587;                // TCP port to connect to

        // Recipients
        $mail->setFrom($email, $full_name);
        $mail->addAddress('medcancer408@gmail.com'); // Add a recipient
        $mail->Subject = 'New Counseling Session Request';
        $mail->Body = "Hello Admin,\n\nA new counseling session request has been submitted by: $full_name.\n\nPlease login to the admin panel to view the details.";
        
        if ($mail->send()) {
            // Redirect to user dashboard
            header("Location: user.php");
            exit();
        } else {
            // Set error flash message
            $_SESSION['flash_message'] = "Error: Failed to submit your counseling session request. Please try again later.";
            // Redirect to user dashboard
            header("Location: user.php");
            exit();
        }
    } else {
        // Set error flash message
        $_SESSION['flash_message'] = "Error: Failed to submit your counseling session request. Please try again later.";
        // Redirect to user dashboard
        header("Location: user.php");
        exit();
    }
}

// Close connection
$connection->close();
?>
