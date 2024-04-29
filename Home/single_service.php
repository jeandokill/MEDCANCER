<?php
include("../login/MainClass.php");
include("../admin/pages/services/features section/data.php");
$index = isset($_GET['index']) ? intval($_GET['index']) : 0;

if ($index >= 0 && $index < count($servicesContent['cards'])) {
  $card = $servicesContent['cards'][$index];
} else {
  // Redirect or display an error message if the index is invalid
  // For example:
  header("Location: services.php");
  exit;
}

?>



<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Single Service Page</title>
  <link href="assets/img/favicon.png" rel="icon">
  <link href="assets/img/favicon.png" rel="apple-touch-icon">
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
  <style>
    /* Add custom styles for dark theme */
    body {
      background-color: #343a40;
      color: #fff;
      font-family: Arial, sans-serif;
    }
    .navbar {
      background-color: #212529;
    }
    .navbar-dark .navbar-nav .nav-link {
      color: rgba(255,255,255,.5);
      font-size: 18px;
    }
    .navbar-dark .navbar-nav .nav-link:hover {
      color: #fff;
    }
    .service-title {
      color: green; /* Yellow color for service title */
      text-align: center;
      font-size: 3em;
      animation: fadeInUp 1s ease;
      max-width: 90%; /* Limit the width of the title container */
      margin: 0 auto; /* Center align */
    }
    #hero-section {
      position: relative;
      overflow: hidden;
      height: 50vh; /* Increase the height of hero section */
    }
    #hero-image {
      width: 100%;
      height: auto;
      position: absolute;
      top: 0;
      left: 0;
      z-index: -1;
      opacity: 0.5;
      animation: fadeIn 2s ease;
    }
    /* Update text color for visibility */
    .lead, .my-4 {
      background: none;/* Remove white background */
    }
    .lead, .my-4, p {
      color: #fff; /* Set text color to white */
    }
    /* Animations */
    @keyframes fadeIn {
      from {
        opacity: 0;
      }
      to {
        opacity: 0.5;
      }
    }
    @keyframes fadeInUp {
      from {
        opacity: 0;
        transform: translateY(20px);
      }
      to {
        opacity: 1;
        transform: translateY(0);
      }
    }
    /* Card deck styling */
    .card-deck {
      margin-top: 40px;
    }
    .card {
      background-color: #212529;
      border: none;
      border-radius: 15px;
      box-shadow: 0 4px 8px rgba(0,0,0,0.1);
      transition: transform 0.3s ease;
    }
    .card:hover {
      transform: translateY(-5px);
    }
    .card-img-top {
      border-top-left-radius: 15px;
      border-top-right-radius: 15px;
    }
    .card-title {
      color: green;
    }
    .card-text {
      color: #ddd;
    }
    .btn-primary {
      background-color: green;
      border: none;
    }
    .btn-primary:hover {
      background-color: #ffca3a;
    }
    /* Donation section */
    #donation-section {
      background-color: #212529;
      color: #fff;
      padding: 50px 0;
      text-align: center;
    }
    #donation-section h2 {
      font-size: 2.5em;
      margin-bottom: 30px;
    }
    #donation-button {
      background-color: green;
      border: none;
      padding: 15px 30px;
      font-size: 1.2em;
      border-radius: 5px;
      transition: background-color 0.3s ease;
    }
    #donation-button:hover {
      background-color: #ffca3a;
    }
  </style>
</head>
<body>

<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
  <div class="container">
    <a class="navbar-brand" href="#">MEDCANCER</a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarNav">
      <ul class="navbar-nav ml-auto">
        <li class="nav-item">
          <a class="nav-link" href="index.php">Home</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="awareness.php">Awareness</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="blog.php">Blog</a>
        </li>
        <li class="nav-item active">
          <a class="nav-link" href="service.php">Service</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="contact.php">Contact</a>
        </li>
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
    </div>
  </div>
</nav>

<div id="hero-section">
  <img id="hero-image" src="/Medcancer/admin/pages/services/features section/uploads/<?php echo $card['hero_image']; ?>" alt="Background Image">
  <div class="container">
    <!-- Auto typing service title -->
    <h1 class="display-4 service-title" id="service-title"><?php ?></h1>
  </div>
</div>

<div class="container mt-5">
  <div>
    <div>
      <div class="container">
        <!-- Introduction, paragraphs, images, and conclusion -->
        <?php echo $card['introduction']; ?>
        <?php echo $card['paragraphs'][0]; ?>
        <img src="/Medcancer/admin/pages/services/features section/uploads/<?php echo $card['images'][0]; ?>" class="img-fluid my-4" alt="Image 1" style="width: 100%;" >
        <?php echo $card['paragraphs'][1]; ?>
        <img src="/Medcancer/admin/pages/services/features section/uploads/<?php echo $card['images'][1]; ?>" class="img-fluid my-4" alt="Image 2" style="width: 100%;" >
        <?php echo $card['paragraphs'][2]; ?>
        <img src="/Medcancer/admin/pages/services/features section/uploads/<?php echo $card['images'][2]; ?>" class="img-fluid my-4" alt="Image 3" style="width: 100%;" >
        <?php echo $card['conclusion']; ?>
      </div>
      <!-- Feedback Form -->
      <div class="container mt-5">
      <h2 class="text-center mb-4" style="color: green;">Your Feedback matters!</h2>
      <div class="row justify-content-center">
        <div class="col-md-6">
            <form action="contacts.php" method="post" role="form" class="php-email-form">
                <div class="form-group">
                    <label for="name">Your Name</label>
                    <input type="text" class="form-control" id="name" name="name" placeholder="Enter your name" required>
                </div>
                <div class="form-group">
                    <label for="email">Your Email</label>
                    <input type="email" class="form-control" id="email" name="email" placeholder="Enter your email" required>
                </div>
                <div class="form-group">
                    <label for="subject">Feedback</label>
                    <input type="text" class="form-control" id="subject" name="subject" placeholder="Enter the Feedback" required>
                </div>
                <div class="form-group">
                    <label for="message">Message</label>
                    <textarea class="form-control" id="message" name="message" rows="5" placeholder="Enter your message" required></textarea>
                </div>
                <button type="submit" class="btn btn-primary btn-block" name="submit">Submit Feedback</button>
            </form>
        </div>
    </div>
</div>


      <!-- Donation section -->
      <div id="donation-section">
        <div class="container">
          <h2>Support Our Cause</h2>
          <p>Your donation helps us continue our mission to raise awareness and support those affected by cancer.</p>
          <a href="donate.php">
          <button id="donation-button" class="btn btn-lg">Donate Now</button>
          </a>
        </div>
      </div>
    </div>
  </div>
</div>
<!-- Cards of other services -->
<div class="card-deck">
  <?php
  // Loop through the first 3 services
  for ($i = 0; $i < 3 && $i < count($servicesContent['cards']); $i++) {
      $service = $servicesContent['cards'][$i];
      ?>
    <div class="card">
      <img src="/Medcancer/admin/pages/services/features section/uploads/<?php echo $service['hero_image']; ?>" class="card-img-top" alt="...">
      <div class="card-body">
        <h5 class="card-title"><?php echo $service['title']; ?></h5>
        <p class="card-text"><?php echo $service['content']; ?></p>
        <a href="single_service.php?index=<?php echo $i; ?>" class="btn btn-primary">Read More</a>
      </div>
    </div>
  <?php
  }
  ?>
</div>

<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
<script>
  // Auto-typing effect for service title
  const titleElement = document.getElementById('service-title');
  let titleText = "<?php echo $card['title']; ?>"; // Your service title
  let index = 0;

  function typeTitle() {
    if (index < titleText.length) {
      titleElement.innerHTML += titleText.charAt(index);
      index++;
      setTimeout(typeTitle, 100); // Adjust typing speed here
    }
  }

  window.onload = typeTitle;
</script>
<script>
    document.addEventListener('DOMContentLoaded', function () {
        const lightbox = GLightbox();
    });
</script>


<!--Start of Tawk.to Script-->
<script type="text/javascript">
var Tawk_API=Tawk_API||{}, Tawk_LoadStart=new Date();
(function(){
var s1=document.createElement("script"),s0=document.getElementsByTagName("script")[0];
s1.async=true;
s1.src='https://embed.tawk.to/662b4bb21ec1082f04e733b7/1hschvdet';
s1.charset='UTF-8';
s1.setAttribute('crossorigin','*');
s0.parentNode.insertBefore(s1,s0);
})();
</script>
<!--End of Tawk.to Script-->



</body>
</html>
