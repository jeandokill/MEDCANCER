
<?php
include("../login/MainClass.php");


if ($_SERVER['REQUEST_URI'] == '/Medcancer/404.php') {
  // If requested URI is 404.php, display the 404 page
  include('../404.php');
  // Terminate further execution
  exit();
}

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

    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,700,700i|Raleway:300,400,500,700,800" rel="stylesheet">

    <!-- Vendor CSS Files -->
    <link href="assets/vendor/aos/aos.css" rel="stylesheet">
    <link href="assets/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <link href="assets/vendor/bootstrap-icons/bootstrap-icons.css" rel="stylesheet">
    <link href="assets/vendor/boxicons/css/boxicons.min.css" rel="stylesheet">
    <link href="assets/vendor/glightbox/css/glightbox.min.css" rel="stylesheet">
    <link href="assets/vendor/swiper/swiper-bundle.min.css" rel="stylesheet">

    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
  <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" rel="stylesheet">


    <!-- Template Main CSS File -->
    <link href="assets/css/style.css" rel="stylesheet">
    <style>
      <style>
    /* Custom styles */
    body {
      background-color: #f8f9fa; /* Light gray background */
      position: relative; /* Relative positioning for chat icon */
      min-height: 100vh;
    }
    .contact-form {
      background-color: #fff; /* White background */
      padding: 30px;
      border-radius: 10px;
      box-shadow: 0px 0px 20px 0px rgba(0,0,0,0.1); /* Soft shadow effect */
    }
    .contact-info {
      list-style: none;
      padding-left: 0;
    }
    .contact-info li {
      margin-bottom: 15px;
      font-size: 18px;
      color: #495057; /* Dark gray color */
    }
    .contact-info li i {
      margin-right: 10px;
      color: #28a745; /* Green color */
    }
    .btn-primary {
      background-color: #007bff !important; /* Blue button color */
      border-color: #007bff !important;
    }
    .btn-primary:hover {
      background-color: #0056b3 !important; /* Darker blue on hover */
      border-color: #0056b3 !important;
    }
    .chat-icon {
      position: fixed;
      bottom: 20px;
      right: 20px;
      font-size: 24px;
      color: #28a745; /* Green color */
      cursor: pointer;
    }
  </style>
    </style>
</head>

<body>

    <!-- ======= Header ======= -->
    <header id="header" class="d-flex align-items-center ">
        <div class="container-fluid container-xxl d-flex align-items-center">

            <div id="logo" class="me-auto">
                <a href="index.php" class="scrollto"><img src="assets/img/FAVICON.jpg" alt="" title=""></a>
            </div>

            <nav id="navbar" class="navbar order-last order-lg-0">
                <ul>
                    <li><a class="active" href="#">Home</a></li>
                    <li><a href="awareness.php">Awareness</a></li>
                    <li><a href="services.php">Services</a></li>
                    <li><a href="About Us.php">About Us</a></li>
                    <li><a href="Blog.php">Blog</a></li>
                    <li><a href="contact.php">Contact</a></li>
                    <?php
                    // Check if user is logged in
                    if (isset($_SESSION['profile_picture'])) {
                        // If logged in, display profile picture with maximum dimensions and circular shape
                        echo '<a href="/Medcancer/Home/user.php"><img src="/Medcancer/login/' . $_SESSION['profile_picture'] . '" alt="Profile Picture" style="max-width: 40px; max-height: 40px; border-radius: 50%; margin-right: 20px; margin-left: 25px;"></a>';
                    } else {
                        // If not logged in, display login link
                        echo '<a href="/Medcancer/login/login.php">Login</a>';
                    }
                    ?>


                </ul>
                <i class="bi bi-list mobile-nav-toggle"></i>
            </nav><!-- .navbar -->
            <!-- <a href="donate.php" id="donate-button">
                <span></span>
                <span></span>
                <span></span>
                <span></span>
                Donate
            </a> -->

        </div> 
        
    </header>
<body>

  <div class="container py-5">
    <div class="row">
      <div class="col-lg-6 mx-auto">
        <div class="contact-form">
          <h2 class="text-center mb-4">Contact Us</h2>
          <form>
            <div class="form-group">
              <input type="text" class="form-control" id="name" placeholder="Your Name">
            </div>
            <div class="form-group">
              <input type="email" class="form-control" id="email" placeholder="Your Email">
            </div>
            <div class="form-group">
              <textarea class="form-control" id="message" rows="5" placeholder="Your Message"></textarea>
            </div>
            <button type="submit" class="btn btn-primary btn-block">Submit</button>
          </form>
          <ul class="contact-info mt-4">
            <li><i class="fas fa-map-marker-alt"></i>Huye, Rwanda</li>
            <li><i class="fas fa-envelope"></i>info@medcancer.org</li>
            <li><i class="fas fa-phone"></i>+250781182207</li>
          </ul>
        </div>
      </div>
    </div>
  </div>

  <!-- Bootstrap JS and dependencies -->
  <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
  <!-- Font Awesome -->
  <script src="https://kit.fontawesome.com/a076d05399.js"></script>

<!--Start of Tawk.to Script-->
<script type="text/javascript">
var Tawk_API=Tawk_API||{dcd54380a2a394dac5a50bc24fb39c1295e517c6}, Tawk_LoadStart=new Date();
(function(){
var s1=document.createElement("script"),s0=document.getElementsByTagName("script")[0];
s1.async=true;
s1.src='https://embed.tawk.to/662abab21ec1082f04e6ff01/1hsbeij3q';
s1.charset='UTF-8';
s1.setAttribute('crossorigin','*');
s0.parentNode.insertBefore(s1,s0);
})();
</script>
<!--End of Tawk.to Script-->


</body>
</html>
