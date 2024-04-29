<?php
require '../../vendor/autoload.php'; // Include PHPMailer autoload file

// Check if form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // PHPMailer objects initialization
    $mail = new PHPMailer\PHPMailer\PHPMailer();
    $mail->isSMTP();

    $mail->Host       = 'smtp.gmail.com';  // SMTP server
    $mail->SMTPAuth   = true;               // Enable SMTP authentication
    $mail->Username   = 'medcancer408@gmail.com';  // SMTP username
    $mail->Password   = 'dtmi qncl fnjt liau';           // SMTP password
    $mail->SMTPSecure = 'tls';              // Enable TLS encryption, `ssl` also accepted
    $mail->Port       = 587;                // TCP port to connect to
    
    // Email content
    $mail->setFrom('medcancer408@gmail.com', 'MEDCANCER INITIATIVE RWANDA');
    $mail->Subject = $_POST['emailTitle']; // Subject from form

    // Constructing email body
    $emailBody = '
    <!DOCTYPE html>
    <html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Email Template</title>
        <style>
            /* Add your email styles here */
            body {
                font-family: Arial, sans-serif;
            }
            .logo {
                width: 100px; /* Adjust the width of the logo */
            }
            .email-content {
                margin-top: 20px;
                padding: 20px;
                background-color: #f4f4f4; /* Set the background color */
                border-radius: 10px;
            }
        </style>
    </head>
    <body>
        <div>
            <img src="cid:logo" alt="Logo" class="logo">
        </div>
        <div class="email-content">
            <h2>'. $_POST['emailTitle'] .'</h2>
            <p>'. $_POST['emailMessage'] .'</p>
        </div>
    </body>
    </html>';

    $mail->isHTML(true);
    $mail->Body = $emailBody;

    // Add recipients from the submitted form
    if (isset($_POST['selected']) && is_array($_POST['selected'])) {
        foreach ($_POST['selected'] as $email) {
            $mail->addAddress($email);
        }
    }

    // Handle attachment
    if (isset($_FILES['attachment']) && $_FILES['attachment']['error'] === UPLOAD_ERR_OK) {
        $attachmentName = $_FILES['attachment']['name'];
        $attachmentPath = $_FILES['attachment']['tmp_name'];
        $mail->addAttachment($attachmentPath, $attachmentName);
    }

    // Embed logo image as inline attachment
    $logoFilePath = '../../Home/assets/img/favicon.png';
    $mail->addEmbeddedImage($logoFilePath, 'logo');

    // Send email
    if($mail->send()) {
        echo 'Message has been sent';
        // Redirect back to subscribers.php
        echo '<script>window.location.href = "/Medcancer/admin/subscribe/subscribers.php";</script>';
        exit;
    } else {
        echo 'Message could not be sent.';
        echo 'Mailer Error: ' . $mail->ErrorInfo;
    }
}