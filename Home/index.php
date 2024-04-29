<?php
include("../admin/pages/home/about section/data.php");
include("../admin/subscribe/subscribe.php");
include("../admin/pages/home/Faq section/data.php");
include("../admin/pages/home/gallery section/data.php");
include("../admin/pages/home/team section/data.php");
include("../admin/pages/home/feature section/data.php");
include("../admin/pages/home/hero section/data.php");
include("../admin/pages/home/sponsors section/data.php");
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


    <!-- Template Main CSS File -->
    <link href="assets/css/style.css" rel="stylesheet">
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
        
    </header><!-- End Header -->
    <?php
$result = mysqli_query($connection, "SELECT * FROM hero_section ORDER BY id DESC LIMIT 1");

if ($result) {
    $row = mysqli_fetch_assoc($result);
    // Output other values for debugging if needed
    // echo 'Link: ' . $row['link'] . '<br>';
     // Get the dynamic link from the database or configuration file
    $learnMoreLink =$row['link']; // Adjust the link variable according to your database structure

    // Output the hero section
    echo '<section id="hero" class="hero d-flex flex-column justify-content-center align-items-center" data-aos="fade" data-aos-delay="1500">';
    echo '<div class="hero-container" data-aos="zoom-in" data-aos-delay="100">';
    echo '<div class="embed-responsive embed-responsive-16by9" style="border-radius: 20px; overflow: hidden;">';
    echo '<video class="embed-responsive-item" autoplay muted loop playsinline style="object-fit: cover; width: 100%; height: 100%;">';
    echo '<source src="/Medcancer/admin/pages/home/hero section/' . $row['video_path'] . '" type="video/mp4">';
    echo 'Your browser does not support the video tag.';
    echo '</video>';
    echo '</div>';
    echo '<a href="' . $learnMoreLink . '" class="about-btn scrollto">Learn More</a>';

    echo '</div>';
    echo '</section>';
} else {
    echo "Error: " . mysqli_error($connection);
}
?>



  <!-- End Hero Section -->

  <main id="main">

    <!-- End About Section -->


    <!-- why us section -->

    <section id="about" class="about">
    <section id="about" class="about">
        <div id="about" class="d-flex justify-content-center align-items-center">
            <div class="container-fluid container-xxl">
                <div class="row justify-content-center">
                    <div class="col-lg-6 d-flex flex-column justify-content-center" data-aos="fade-up" data-aos-delay="200">
                        <div class="content">
                            <!-- Fetching dynamic content from data.php -->
                            <h3><?php echo $aboutContent['h3']; ?></h3>
                            <h2><?php echo $aboutContent['h2']; ?></h2>
                            <p><?php echo $aboutContent['p']; ?></p>
                            <!-- End dynamic content -->

                            <div class="text-center text-lg-start">
                                <a href="About Us.php" class="btn-read-more d-inline-flex align-items-center justify-content-center align-self-center">
                                    <span class="button">Read More</span>
                                    <i class="bi bi-arrow-right"></i>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

      

    </section>
    
    
    
    <section id="why-us" class="why-us">
    <div class="container">
        <div class="row">
            <div class="col-lg-4" data-aos="fade-up">
                <div class="box">
                    <span><?php echo $featureContent['mission_title']; ?></span>
                    <p><?php echo $featureContent['mission']; ?></p>
                </div>
            </div>
            <div class="col-lg-4 mt-4 mt-lg-0" data-aos="fade-up" data-aos-delay="150">
                <div class="box">
                    <span><?php echo $featureContent['vision_title']; ?></span>
                    <p><?php echo $featureContent['vision']; ?></p>
                </div>
            </div>
            <div class="col-lg-4 mt-4 mt-lg-0" data-aos="fade-up" data-aos-delay="300">
                <div class="box">
                    <span><?php echo $featureContent['goal_title']; ?></span>
                    <p><?php echo $featureContent['goal']; ?></p>
                </div>
            </div>
        </div>
    </div>
    
    </section>



    <!-- ======= Speakers Section ======= -->
    <?php
// Include database connection code here
$teamSectionData = getTeamSectionData();
$galleryImages = getGalleryImages();

// Fetch team members data
$teamResult = mysqli_query($connection, "SELECT * FROM team_members");
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <!-- Include necessary CSS and JS files -->
</head>
<body>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        var socialLinks = document.querySelectorAll('.social a');
        socialLinks.forEach(function(link) {
            link.addEventListener('click', function(event) {
                event.preventDefault();
                var redirectUrl = link.getAttribute('href');

                // Check if the link is not null or empty before redirecting
                if (redirectUrl && redirectUrl !== 'null') {
                    console.log('Clicked on social link:', redirectUrl);
                    window.location.href = redirectUrl;
                } else {
                    console.log('Social link is null or empty.');
                    // You can handle this case as needed, e.g., display an alert or do nothing.
                }
            });
        });
    });
</script>

<section id="speakers">
    <div class="container" data-aos="fade-up">
        <div class="section-header">
            <h2><?= isset($teamSectionData['title']) ? htmlspecialchars($teamSectionData['title']) : '' ?></h2>
            <p><?= isset($teamSectionData['subtitle']) ? htmlspecialchars($teamSectionData['subtitle']) : '' ?></p>
        </div>
        <div class="row">
            <?php while ($row = mysqli_fetch_assoc($teamResult)): ?>
                <div class="col-lg-4 col-md-6">
                    <div class="speaker" data-aos="fade-up" data-aos-delay="100">
                        <img src="/Medcancer/admin/pages/home/team section/<?= $row['image_path'] ?>" alt="<?= $row['name'] ?>" class="img-fluid">
                        <div class="details">
                            <h3><?= $row['name'] ?></a></h3>
                            <p><?= $row['role'] ?></p>
                            <div class="social">
                                <a href="<?= $row['twitter'] ?>"><i class="bi bi-twitter"></i></a>
                                <a href="<?= $row['facebook'] ?>"><i class="bi bi-facebook"></i></a>
                                <a href="<?= $row['instagram'] ?>"><i class="bi bi-instagram"></i></a>
                                <a href="<?= $row['linkedin'] ?>"><i class="bi bi-linkedin"></i></a>
                            </div>
                        </div>
                    </div>
                </div>
            <?php endwhile; ?>
        </div>
    </div>
</section>
</body>
</html>



<!-- End Speakers Section -->

    <!-- ======= Gallery Section ======= -->

    
    <section id="gallery">

      <div class="container" data-aos="fade-up">
        <div class="section-header">
          <h2>Gallery</h2>
          <p>Check our gallery from the recent events</p>
        </div>
      </div>

      <!-- Display gallery images -->
      <div class="gallery-slider swiper">
        <div class="swiper-wrapper align-items-center">
            <?php foreach ($galleryImages as $image): ?>
                <div class="swiper-slide">
                    <a href="/Medcancer/admin/pages/home/gallery section/<?= $image['image_path'] ?>" class="gallery-lightbox">
                    <img src="/Medcancer/admin/pages/home/gallery section/<?= $image['image_path'] ?>" alt="Gallery Image" class="img-fluid">
                    </a>
                </div>
            <?php endforeach; ?>
        </div>
        <div class="swiper-pagination"></div>
      </div>
    </section><!-- End Gallery Section -->

<!-- End Gallery Section -->

    <!-- ======= Supporters Section ======= -->
    <section id="supporters" class="section-with-bg">
        <div class="container" data-aos="fade-up">
            <div class="section-header">
                <h2>Sponsors</h2>
            </div>

            <div class="row no-gutters supporters-wrap clearfix" data-aos="zoom-in" data-aos-delay="100">
                <?php

                // Get sponsor images
                $sponsorImages = getSponsorImages();

                // Display sponsor logos
                foreach ($sponsorImages as $sponsor): ?>
                    <div class="col-lg-3 col-md-4 col-xs-6">
                        <div class="supporter-logo">
                            <img src="/Medcancer/admin/pages/home/sponsors section/<?= $sponsor['image_path'] ?>" class="img-fluid" alt="Sponsor Logo">
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>
        </div>
    </section>
<!-- End Sponsors Section -->

    <!-- =======  F.A.Q Section ======= -->

    
    <section id="faq">
    <div class="container" data-aos="fade-up">
        <div class="section-header">
            <h2>FAQs</h2>
        </div>
        <div class="row justify-content-center" data-aos="fade-up" data-aos-delay="100">
            <div class="col-lg-9">
                <ul class="faq-list">
                    <?php foreach (getFaqEntriesFromDatabase() as $faq): ?>
                        <li>
                            <div data-bs-toggle="collapse" class="collapsed question" data-bs-target="#faq<?= $faq['id'] ?>">
                                <?= $faq['question'] ?> <i class="bi bi-chevron-down icon-show"></i><i class="bi bi-chevron-up icon-close"></i>
                            </div>
                            <div id="faq<?= $faq['id'] ?>" class="collapse" data-bs-parent=".faq-list">
                                <p><?= $faq['answer'] ?></p>
                            </div>
                        </li>
                    <?php endforeach; ?>
                </ul>
            </div>
        </div>
    </div>
</section>



    <!-- ======= Subscribe Section ======= -->
   <!-- Subscribe Section -->

   <section id="subscribe">
  <div class="container" data-aos="zoom-in">
    <div class="section-header">
      <h2>Newsletter</h2>
      <p>Welcome to our newsletter, subscribe and get our timely updates.</p>
    </div>

    <form id="subscribe-form" method="POST" action="/Medcancer/admin/subscribe/subscribe.php">
      <div class="row justify-content-center">
        <div class="col-lg-6 col-md-8 col-sm-12">
          <!-- Adjusted the column class to col-sm-12 for full width on small devices -->
          <div class="input-group">
            <input id="email-input" type="email" name="email" class="form-control" placeholder="Enter your Email" required>
            <button type="submit" class="btn btn-primary">Subscribe</button>
          </div>
        </div>
      </div>
    </form>
  </div>

  <!-- Bootstrap Modal -->
  <div class="modal fade" id="myModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Subscription Status</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body" id="modal-body">
          <!-- Modal body content will be filled dynamically -->
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
        </div>
      </div>
    </div>
  </div>
</section>



<!-- End Subscribe Section -->

    <!-- ======= Contact Section ======= -->
    <section id="contact" class="contact">
      <div class="container">

        <div class="section-title">
          <span>Contact</span>
          <h2>Contact</h2>
          <p>Feel free to reach on us</p>
        </div>

        <div class="row" data-aos="fade-up">
          <div class="col-lg-6">
            <div class="info-box mb-4">
              <i class="bx bx-map"></i>
              <h3>Our Address</h3>
              <p>HUYE RWANDA</p>
            </div>
          </div>

          <div class="col-lg-3 col-md-6">
            <div class="info-box  mb-4">
              <i class="bx bx-envelope"></i>
              <h3>Email Us</h3>
              <p>INfo@medcancer.org</p>
            </div>
          </div>

          <div class="col-lg-3 col-md-6">
            <div class="info-box  mb-4">
              <i class="bx bx-phone-call"></i>
              <h3>Call Us</h3>
              <p>+250781182207</p>
            </div>
          </div>

        </div>

        <div class="row" data-aos="fade-up">

          <div class="col-lg-6 ">
            <iframe class="mb-4 mb-lg-0" src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3985.662197764232!2d29.740277672328254!3d-2.615429097362473!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x19c30c875461a279%3A0x5e3baaf0d5aded1b!2sUniversity%20of%20Rwanda!5e0!3m2!1sen!2srw!4v1707292859435!5m2!1sen!2srw" frameborder="0" style=" border: 0; width: 100%; height: 380px;"></iframe>
          </div>

          <div class="col-lg-6">
              <form action="contacts.php" method="post" role="form" class="php-email-form">
                  <div class="row">
                      <div class="col-md-6 form-group">
                          <input type="text" name="name" class="form-control" id="name" placeholder="Your Name" required>
                      </div>
                      <div class="col-md-6 form-group mt-3 mt-md-0">
                          <input type="email" class="form-control" name="email" id="email" placeholder="Your Email" required>
                      </div>
                  </div>
                  <div class="form-group mt-3">
                      <input type="text" class="form-control" name="subject" id="subject" placeholder="Subject" required>
                  </div>
                  <div class="form-group mt-3">
                      <textarea class="form-control" name="message" rows="5" placeholder="Message" required></textarea>
                  </div>
                  <div class="my-3">
                      <div class="loading">Loading</div>
                      <div class="error-message"></div>
                      <div class="sent-message">Your message has been sent. Thank you!</div>
                  </div>
                  <div class="text-center"><button type="submit" name="submit">Send Message</button></div>
              </form>
          </div>

        </div>

      </div>
    </section><!-- End Contact Section -->

  </main><!-- End #main -->

  <!-- ======= Footer ======= -->
  <?php
  include("footer.php");
  ?>

  <!-- Vendor JS Files -->
  <!-- Include Bootstrap CSS -->

  <script src="assets/vendor/aos/aos.js"></script>
  <script src="assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
  <script src="assets/vendor/glightbox/js/glightbox.min.js"></script>
  <script src="assets/vendor/swiper/swiper-bundle.min.js"></script>
  <script src="assets/vendor/php-email-form/validate.js"></script>



  <!-- Template Main JS File -->
  <script src="assets/js/main.js"></script>

  <script>
    document.addEventListener('DOMContentLoaded', function () {
        const lightbox = GLightbox();
    });
</script>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
  $(document).ready(function() {
    // Form Submission Handling
    $('#subscribe-form').submit(function(event) {
      event.preventDefault(); // Prevent default form submission
      
      // Ajax request to handle form submission
      $.ajax({
        type: 'POST',
        url: '/Medcancer/admin/subscribe/subscribe.php',
        data: $(this).serialize(), // Serialize form data
        success: function(response) {
          if (response === 'success') {
            // Success message
            $('#modal-body').html('Thank you for subscribing!');
          } else if (response === 'exists') {
            // Email already exists
            $('#modal-body').html('Email already exists!');
          }
          $('#myModal').modal('show');
          
          // Refresh page after 2 seconds
          setTimeout(function() {
            location.reload();
          }, 2000);
        }
      });
    });
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