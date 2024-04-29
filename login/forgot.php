<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require '../vendor/autoload.php'; 
include_once('connection.php');
include_once('MainClass.php');
require_once('MainClass.php');

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $mainClass = new MainClass();
    $result = $mainClass->resetPasswordRequest($_POST['email']);
    
    if ($result) {
        // Set flash message if the reset link is successfully sent
        $_SESSION['flashdata'] = array(
            'type' => 'success',
            'msg' => 'Reset link has been sent to your email. Please check'
        );
    } else {
        // Set flash message for error
        $_SESSION['flashdata'] = array(
            'type' => 'danger',
            'msg' => 'Failed to send reset link. Please try again.'
        );
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>MEDCANCER LOGIN SYSTEM</title>
    <link href="/Medcancer/Home/assets/img/favicon.png" rel="icon">
    <link href="/Medcancer/Home/assets/img/favicon.png" rel="apple-touch-icon">
    <link rel="stylesheet" href="./Font-Awesome-master/css/all.min.css">
    <link rel="stylesheet" href="./css/bootstrap.min.css">
    <script src="./js/jquery-3.6.0.min.js"></script>
    <script src="./js/popper.min.js"></script>
    <script src="./js/bootstrap.min.js"></script>
    <script src="./Font-Awesome-master/js/all.min.js"></script>
    <style>
        html,body{
            height:100%;
            width:100%;
        }
        main{
            height:calc(100%);
            width:calc(100%);
            display:flex;
            flex-direction:column;
            align-items:center;
            justify-content:center;
        }
    </style>
</head>

<body class="bg-dark bg-gradient">
    <main>
       <div class="col-lg-7 col-md-9 col-sm-12 col-xs-12 mb-4">
           <h1 class="text-light text-center">MEDCANCER</h1>
        </div>
       <div class="col-lg-3 col-md-8 col-sm-12 col-xs-12">
           <div class="card shadow rounded-0">
               <div class="card-header py-1">
                   <h4 class="card-title text-center">RESET PASSWORD</h4>
               </div>
               <div class="card-body py-4">
                   <div class="container-fluid">
                   <form id="validate_form" method="post" > 
                       <?php 
                            if(isset($_SESSION['flashdata'])):
                        ?>
                        <div class="dynamic_alert alert alert-<?php echo $_SESSION['flashdata']['type'] ?> my-2 rounded-0">
                            <div class="d-flex align-items-center">
                                <div class="col-11"><?php echo $_SESSION['flashdata']['msg'] ?></div>
                                <div class="col-1 text-end">
                                    <div class="float-end"><a href="javascript:void(0)" class="text-dark text-decoration-none" onclick="$(this).closest('.dynamic_alert').hide('slow').remove()">x</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <?php unset($_SESSION['flashdata']) ?>
                        <?php endif; ?>
                           <div class="form-group">
                               <label for="email" >Email</label>
                               <input type="text" name="email" id="email" placeholder="Enter Email" required
                               data-parsley-type="email" data-parsley-trigg
                              er="keyup" class="form-control" />
                            </div>
                          <div class="form-group text-center mt-3">
                          <input type="submit" id="login" name="pwdrst" value="Send Password Reset Link" class="btn btn-success" />
                          </div>

                          <p class="error"><?php if(!empty($msg)){ echo $msg; } ?></p>
                    </form>
                   </div>
               </div>
           </div>
       </div>
    </main>
</body>
</html>
