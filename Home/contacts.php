<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require '../vendor/autoload.php'; 

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Collect form data
    $name = $_POST['name'];
    $email = $_POST['email'];
    $subject = $_POST['subject'];
    $message = $_POST['message'];

    // Instantiate PHPMailer
    $mail = new PHPMailer(true);

    try {
        // Server settings
        $mail->isSMTP();
        $mail->Host       = 'smtp.gmail.com';  // SMTP server
        $mail->SMTPAuth   = true;               // Enable SMTP authentication
        $mail->Username   = 'medcancer408@gmail.com';  // SMTP username
        $mail->Password   = 'dtmi qncl fnjt liau';           // SMTP password
        $mail->SMTPSecure = 'tls';              // Enable TLS encryption, `ssl` also accepted
        $mail->Port       = 587;                // TCP port to connect to

        // Recipients
        $mail->setFrom($email, $name);
        $mail->addAddress('medcancer408@gmail.com'); // Add a recipient

        // Content
        $mail->isHTML(true);
        // Styling the email content
        $mail->Subject = "New message from website: $subject";
        $mail->Body = "
            <div style='font-size: 18px;'>
                <p><strong>Name:</strong> $name</p>
                <p><strong>Email:</strong> $email</p>
                <p><strong>Subject:</strong> $subject</p>
                <p><strong>Message:</strong></p>
                <div style='background-color: #f4f4f4; padding: 15px; border-radius: 10px;'>
                    <p style='color: #333; font-size: 16px; line-height: 1.6;'>$message</p>
                </div>
            </div>
        ";

        // Send email
        $mail->send();
        
        // Display success message with styled box
        echo "<div style='background-color: #dff0d8; color: #3c763d; border: 1px solid #d6e9c6; border-radius: 4px; padding: 15px; margin-top: 20px;'>Your message has been sent. Thank you!</div>";
    } catch (Exception $e) {
        // Display error message with styled box
        echo "<div style='background-color: #f2dede; color: #a94442; border: 1px solid #ebccd1; border-radius: 4px; padding: 15px; margin-top: 20px;'>Message could not be sent. Mailer Error: {$mail->ErrorInfo}</div>";
    }
}
?>

