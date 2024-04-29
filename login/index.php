<?php
require_once('auth.php');
require_once('MainClass.php');
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Medcancer Initiative Rwanda</title>
    <link href="/Medcancer/Home/assets/img/favicon.png" rel="icon">
    <link href="/Medcancer/Home/assets/img/favicon.png" rel="apple-touch-icon">
    <link rel="stylesheet" href="./css/bootstrap.min.css">
    <link rel="stylesheet" href="./Font-Awesome-master/css/all.min.css">
    <style>
        html,body {
            height: 100%;
            width: 100%;
            font-family: Arial, sans-serif;
            background-color: #e9ecef; /* Set a light background color */
        }
        main {
            height: 100%;
            display: flex;
            flex-flow: column;
        }
        .card {
            border: none;
            border-radius: 20px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        }
        .card-body {
            text-align: center;
        }
        h1 {
            font-size: 2.5rem;
            margin-bottom: 20px;
        }
        p {
            font-size: 1.2rem;
            color: #6c757d; /* Set a dark gray color */
            margin-bottom: 30px;
        }
        .profile-pic {
            width: 150px;
            height: 150px;
            border-radius: 50%;
            object-fit: cover;
            margin-bottom: 20px;
        }
        .btn {
            font-size: 1.2rem;
            padding: 10px 20px;
            border-radius: 20px;
            margin-right: 10px;
            transition: all 0.3s ease;
            color: #343a40; /* Set text color */
        }
        .btn:hover {
            transform: translateY(-2px);
            background-color: #6c757d; /* Change background color on hover */
            color: white; /* Change text color on hover */
        }
        .btn i {
            margin-right: 5px;
        }
        .btn-secondary {
            background-color: #e9ecef; /* Set a light background color */
            border-color: #e9ecef; /* Set border color same as background */
        }
        .bg-gradient {
            background: linear-gradient(to right, #007bff, #6c757d); /* Set a gradient background */
            color: burlywood;
            font-weight: bold;
        }
    </style>
</head>
<body>
    <main>
        <nav class="navbar navbar-expand-lg navbar-dark bg-dark bg-gradient" id="topNavBar">
            <div class="container">
                <a class="navbar-brand" href="#">MEDCANCER</a>
            </div>
        </nav>
        <div class="container py-5" id="page-container">
            <div class="row justify-content-center">
                <div class="col-lg-5 col-md-8 col-sm-12 col-xs-12">
                    <div class="card shadow">
                        <div class="card-body py-4">
                            <img src="<?= $_SESSION['profile_picture'] ?>" alt="Profile Picture" class="profile-pic">
                            <h1>Welcome <?= ucwords($_SESSION['firstname'].' '.$_SESSION['middlename'].' '.$_SESSION['lastname']) ?></h1>
                            <p>You are logged in as <?= $_SESSION['email'] ?></p>
                            <div class="text-end">
                                <a href="/Medcancer/login/logout.php" class="btn btn-secondary bg-gradient rounded-pill"><i class="fas fa-sign-out-alt"></i> Logout</a>
                                <a href="/Medcancer/Home/index.php" class="btn btn-secondary bg-gradient rounded-pill"><i class="fas fa-arrow-right"></i> CONTINUE TO SITE</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>
</body>
</html>

