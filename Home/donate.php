<?php
include("../login/MainClass.php");
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Donate to Cancer Charity - Medcancer</title>
  <!-- Bootstrap CSS -->

  <link href="assets/img/favicon.png" rel="icon">
  <link href="assets/img/favicon.png" rel="apple-touch-icon">


  <link href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
  <!-- Custom CSS -->
  <style>
    body {
      background-color: #343a40;
      color: #fff;
      font-family: Arial, sans-serif;
    }
    .navbar-nav .nav-link {
      font-size: 14px;
      color: #fff !important;
    }
    .navbar-nav .nav-link:hover {
      color: #17a2b8 !important;
    }
    .login-button {
      background-color: darkslategray;
      border-radius: 10px;
      font-weight: bold;
      color: lavenderblush;
    }
    .donate-section {
      padding: 50px 0;
    }
    .donate-form {
      background-color: #212529;
      border-radius: 10px;
      padding: 30px;
      box-shadow: 0px 0px 20px 0px rgba(0,0,0,0.5);
    }
    .donate-form img {
      max-width: 100%;
      border-radius: 10px;
      margin-bottom: 20px;
    }
    .donate-form p {
      font-size: 16px;
      line-height: 1.6;
    }
    .btn-reveal {
      background-color: #dc3545;
      border: none;
      border-radius: 5px;
      padding: 12px 30px;
      font-size: 18px;
      font-weight: bold;
      color: #fff;
      transition: background-color 0.3s;
    }
    .btn-reveal:hover {
      background-color: #c82333;
    }
  </style>
</head>
<body>

<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
  <div class="container">
    <a class="navbar-brand" href="index.php">Medcancer</a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>

    <div class="collapse navbar-collapse" id="navbarSupportedContent">
      <ul class="navbar-nav ml-auto">
        <li class="nav-item"><a class="nav-link" href="awareness.php">Awareness</a></li>
        <li class="nav-item"><a class="nav-link" href="services.php">Services</a></li>
        <li class="nav-item"><a class="nav-link" href="About Us.php">About Us</a></li>
        <li class="nav-item"><a class="nav-link" href="Blog.php">Blog</a></li>
        <li class="nav-item"><a class="nav-link" href="contact.php">Contact</a></li>
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

<section class="donate-section">
  <div class="container">
    <div class="row">
      <div class="col-md-6 offset-md-3">
        <div class="donate-form text-center">
          <img src="assets/img/mtn.jpg" alt="MTN Logo">
          <p>Your donation can make a big difference in the fight against cancer. Let's join hands to make a positive impact on the lives of those affected.</p>
          <p>To donate, you can:</p>
          <button class="btn btn-reveal mb-3" onclick="toggleVisibility('mobileNumber', 'donationCode', this)">Show Mobile Number</button>
          <button class="btn btn-reveal" onclick="toggleVisibility('donationCode', 'mobileNumber', this)">Show Donation Code</button>
          <p id="mobileNumber" style="display:none;">Mobile Number: +250781182207</p>
          <p id="donationCode" style="display:none;">Donation Code: 431810</p>
        </div>
      </div>
    </div>
  </div>
</section>

<!-- Bootstrap JS -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

<script>
  function toggleVisibility(showId, hideId, button) {
    var showElement = document.getElementById(showId);
    var hideElement = document.getElementById(hideId);
    
    if (showElement.style.display === "none") {
      showElement.style.display = "block";
      hideElement.style.display = "none";
      button.innerText = "Show " + hideId.replace(/([A-Z])/g, " $1").toLowerCase();
    } else {
      showElement.style.display = "none";
      hideElement.style.display = "block";
      button.innerText = "Show " + showId.replace(/([A-Z])/g, " $1").toLowerCase();
    }
  }
</script>

</body>
</html>