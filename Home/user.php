<?php
include("../login/MainClass.php");
?>


<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">
    <meta content="width=device-width, initial-scale=1.0" name="viewport">

    <title>MEDCANCER Initiative Rwanda</title>
    <meta content="" name="description">
    <meta content="" name="keywords">

    <!-- Favicons -->
    <link href="assets/img/favicon.png" rel="icon">
    <link href="assets/img/favicon.png" rel="apple-touch-icon">
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Custom CSS -->
    <style>
        body {
            background-color: #f0f7f9;
        }
        .profile-section {
            text-align: center;
            margin-bottom: 30px;
        }
        .user-info {
            background-color: #ffffff;
            border-radius: 10px;
            padding: 20px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }
        .user-info h2 {
            color: #1b4965;
            border-bottom: 1px solid #1b4965;
            padding-bottom: 10px;
            margin-bottom: 20px;
        }
        .user-info p {
            color: #2c3e50;
        }
        .profile-picture {
            max-width: 300px; /* Increased the maximum width */
            max-height: 300px; /* Increased the maximum height */
            border-radius: 50%;
            margin-bottom: 20px;
            border: 5px solid #63c76a;
        }
        .logout-btn {
            background-color: #2c3e50;
            border-color: #2c3e50;
        }
        .logout-btn:hover {
            background-color: #1b4965;
            border-color: #1b4965;
        }
        .counseling-request {
            background-color: #ffffff;
            border-radius: 10px;
            padding: 20px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }
        .counseling-request h2 {
            color: #1b4965;
            border-bottom: 1px solid #1b4965;
            padding-bottom: 10px;
            margin-bottom: 20px;
        }
        .form-label {
            color: #2c3e50;
            font-weight: bold;
        }
        .form-control {
            border-radius: 5px;
        }
        .form-check-label {
            color: #2c3e50;
        }
        .btn-primary {
            background-color: #1b4965;
            border-color: #1b4965;
        }
        .btn-primary:hover {
            background-color: #0a2c3e;
            border-color: #0a2c3e;
        }
        /* Navbar Styling */
        .navbar {
            background-color: #fff; /* Set background color */
            padding: 20px 0; /* Add padding */
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1); /* Add box shadow */
        }
        .navbar-brand img {
            max-height: 50px; /* Adjust logo size */
            margin-left: 20px; /* Add margin to the logo */
        }
        .navbar-nav .nav-item {
            margin-right: 20px; /* Adjust spacing between menu items */
        }
        .navbar-nav .nav-link {
            color: #000;
            transition: 0.3s;
        }
        .navbar-nav .nav-link:hover {
            color: #1b4965;
        }
    </style>
</head>
<body>


<?php
    // Check if flash message is set
    if (isset($_SESSION['flash_message'])) {
        // Display flash message
        echo '<div class="alert alert-success" role="alert">' . $_SESSION['flash_message'] . '</div>';
        // Unset flash message to prevent it from showing again on page reload
        unset($_SESSION['flash_message']);
    }
    ?>

<!-- ======= Header ======= -->
<header>
    <nav class="navbar navbar-expand-lg navbar-light bg-light">
        <div class="container-fluid">
            <a class="navbar-brand" href="index.php"><img src="assets/img/FAVICON.jpg" alt="" title=""></a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav">
                    <li class="nav-item"><a class="nav-link active" href="index.php">Home</a></li>
                    <li class="nav-item"><a class="nav-link" href="awareness.php">Awareness</a></li>
                    <li class="nav-item"><a class="nav-link" href="services.php">Services</a></li>
                    <li class="nav-item"><a class="nav-link" href="About Us.php">About Us</a></li>
                    <li class="nav-item"><a class="nav-link" href="Blog.php">Blog</a></li>
                    <li class="nav-item"><a class="nav-link" href="contact.php">Contact</a></li>
                    <?php
                    // Check if user is logged in
                    if (isset($_SESSION['profile_picture'])) {
                        // If logged in, display profile picture with maximum dimensions and circular shape
                        echo '<li class="nav-item"><a class="nav-link" href="/Medcancer/Home/user.php"><img src="/Medcancer/login/' . $_SESSION['profile_picture'] . '" alt="Profile Picture" style="max-width: 40px; max-height: 40px; border-radius: 50%; margin-right: 20px; margin-left: 25px;"></a></li>';
                    } else {
                        // If not logged in, display login link
                        echo '<li class="nav-item"><a class="nav-link" href="/Medcancer/login/login.php">Login</a></li>';
                    }
                    ?>
                </ul>
            </div>
        </div>
    </nav>
</header><!-- End Header -->

<div class="container mt-5">
    <div class="row">
        <!-- User Profile Section -->
        <div class="col-md-6">
            <?php
            // Include the authentication script to access session variables
            include("../login/auth.php");

            // Check if user is logged in
            if (!isset($_SESSION['email'])) {
                // If not logged in, redirect to login page
                header("Location: /Medcancer/login/login.php");
                exit();
            }
            ?>

            <div class="profile-section">
                <img src="/Medcancer/login/<?php echo $_SESSION['profile_picture']; ?>" alt="Profile Picture" class="profile-picture">
            </div>

            <div class="user-info">
                <h2>User Information</h2>
                <p><strong>First Name:</strong> <?php echo ucwords($_SESSION['firstname']); ?></p>
                <p><strong>Middle Name:</strong> <?php echo ucwords($_SESSION['middlename']); ?></p>
                <p><strong>Last Name:</strong> <?php echo ucwords($_SESSION['lastname']); ?></p>
                <p><strong>Email:</strong> <?php echo $_SESSION['email']; ?></p>
                <a href="/Medcancer/login/index.php" class="btn btn-danger logout-btn">Logout</a>
            </div>
        </div>

        <!-- Counseling Request Form -->
        <div class="col-md-6">
            <div class="counseling-request">
                <h2>Request Counseling Session</h2>
                <form action="submit_counseling_request.php" method="POST">
                    <div class="mb-3">
                        <label for="full_name" class="form-label">Full Name</label>
                        <input type="text" class="form-control" id="full_name" name="full_name" required>
                    </div>
                    <div class="mb-3">
                        <label for="email" class="form-label">Email</label>
                        <input type="email" class="form-control" id="email" name="email" required>
                    </div>
                    <div class="mb-3">
                        <label for="phone" class="form-label">Phone</label>
                        <input type="tel" class="form-control" id="phone" name="phone" required>
                    </div>
                    <div class="mb-3">
                        <label for="gender" class="form-label">Gender</label>
                        <select class="form-select" id="gender" name="gender" required>
                            <option value="">Select Gender</option>
                            <option value="male">Male</option>
                            <option value="female">Female</option>
                            <option value="other">Other</option>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="age" class="form-label">Age</label>
                        <input type="number" class="form-control" id="age" name="age" required>
                    </div>
                    <div class="mb-3">
                        <label for="subject" class="form-label">Subject of Counseling</label>
                        <input type="text" class="form-control" id="subject" name="subject" required>
                    </div>
                    <div class="mb-3">
                        <label for="message" class="form-label">Message</label>
                        <textarea class="form-control" id="message" name="message" rows="5" required></textarea>
                    </div>
                    <div class="mb-3 form-check">
                        <input type="checkbox" class="form-check-input" id="terms" required>
                        <label class="form-check-label" for="terms">I agree to the terms and conditions</label>
                    </div>
                    <button type="submit" class="btn btn-primary">Submit Request</button>
                </form>
            </div>
        </div>
    </div>
</div>

<!-- Bootstrap Bundle with Popper -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
<!-- Font Awesome JS -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/js/all.min.js"></script>
<!-- Add your custom JavaScript if needed -->

</body>
</html>
