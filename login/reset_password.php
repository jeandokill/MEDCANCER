<!DOCTYPE html>
<html lang="en">
<head>  
    <title>Password Reset</title>  
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" />
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>MEDCANCER LOGIN SYSTEM</title>
    <link href="/Medcancer/Home/assets/img/favicon.png" rel="icon">
    <link href="/Medcancer/Home/assets/img/favicon.png" rel="apple-touch-icon">
    <style>
        /* Adjust font sizes for smaller screen devices */
        @media (max-width: 768px) {
            body {
                font-size: 16px;
            }
            h3 {
                font-size: 24px;
            }
            .form-group label {
                font-size: 18px;
            }
            .form-control {
                font-size: 18px;
            }
            .btn {
                font-size: 18px;
            }
            .text-danger {
                font-size: 16px;
            }
        }
    </style>
</head>

<?php
require_once('MainClass.php');

$mainClass = new MainClass();

// Verify the reset token and show the reset password form
if (isset($_GET['token'])) {
    $token = $_GET['token'];
    $email = $_GET['email']; // Retrieve email from URL
    $isValidToken = $mainClass->verifyResetToken($token);

    if (!$isValidToken) {
        // Invalid token, show error message
    }
}

if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['token'])) {
    $result = $mainClass->resetPassword($_POST['token'], $_POST['pwd']); // Use $_POST['pwd'] for password
    
    // Redirect to the login page after resetting password
    if ($result) {
        // Set flash data
        $_SESSION['flashdata'] = array(
            'type' => 'success',
            'msg' => 'Your password has been successfully reset. Please log in.'
        );
        header("Location: /Medcancer/login/login.php");
        exit(); // Ensure that no further code is executed after redirection
    } else {
        // Handle error message if necessary
    }
}
?>



<body>
    <div class="container">  
        <h3 class="text-center">Reset Password</h3>
        <div class="row">
            <div class="col-md-6 col-md-offset-3">
                <div class="panel panel-default">
                    <div class="panel-body">
                        <form id="validate_form" method="post" >  
                            <input type="hidden" name="token" value="<?php echo $token; ?>"/>
                            <input type="hidden" name="email" value="<?php echo $email; ?>"/>
                            <div class="form-group">
                                <label for="pwd">Password</label>
                                <input type="password" name="pwd" id="pwd" placeholder="Enter Password" required class="form-control"/>
                            </div>
                            <div class="form-group">
                                <label for="cpwd">Confirm Password</label>
                                <input type="password" name="cpwd" id="cpwd" placeholder="Enter Confirm Password" required class="form-control"/>
                            </div>
                            <div class="form-group">
                                <input type="submit" id="login" name="pwdrst" value="Reset Password" class="btn btn-success" />
                            </div>
                            <p class="text-danger"><?php if(!empty($msg)){ echo $msg; } ?></p>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
</html>
