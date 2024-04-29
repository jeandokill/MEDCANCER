<?php
include("../admin/pages/awareness/skills section/data.php");
include("../admin/pages/awareness/f1 section/f1_code.php");
include("../admin/pages/awareness/f2 section/f2_code.php");
include("../admin/pages/awareness/f3 section/f3_code.php");
include("../admin/pages/awareness/f4 section/f4_code.php");
include("../login/MainClass.php");

?>






<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">

  <title>MEDCANCER Initiative Rwanda </title>

  <meta content="" name="description">
  <meta content="" name="keywords">

  <!-- Favicons -->
  <link rel="stylesheet" href="https://unpkg.com/bootstrap@5.3.2/dist/css/bootstrap.min.css">
  <link rel="stylesheet" href="https://unpkg.com/bs-brain@2.0.3/components/heroes/hero-1/assets/css/hero-1.css">
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
  <link href="assets/vendor/remixicon/remixicon.css" rel="stylesheet">
  <link href="assets/vendor/swiper/swiper-bundle.min.css" rel="stylesheet">

  <!-- Template Main CSS File -->
  <link href="assets/css/style.css" rel="stylesheet">
  <link href="assets/css/awareness.css" rel="stylesheet">

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
          <li><a  href="index.php">Home</a></li>
          <li><a class="active" href="awareness.php">Awareness</a></li>
          <li><a  href="services.php">Services</a></li>
          <li><a  href="About Us.php">About Us</a></li>
          <li><a  href="Blog.php">Blog</a></li>
          <li><a  href="contact.php">Contact</a></li>
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

  <!-- hero section  -->

  <section class="bsb-hero-1 px-3 bsb-overlay bsb-hover-pull" style="background-image: url('./assets/img/hero-img.jpeg');">
    <div class="container">
      <div class="row justify-content-md-center">
        <div class="col-12 col-md-11 col-lg-9 col-xl-7 col-xxl-6 text-center text-white">
          <h2 class="display-3 fw-bold mb-3">Be aware of cancer!</h2>
          <p class="lead mb-5">through this page, you will learn more about cancer and take the step to develop the powerful shield over it, where type it should be.</p>
          <div class="d-grid gap-2 d-sm-flex justify-content-sm-center">
          </div>
        </div>
      </div>
    </div>
  </section>
  




  <!-- skills section -->


  <section id="skills" class="skills">
    <div class="container" data-aos="fade-up">
        <div class="row">
            <div class="col-lg-6 d-flex align-items-center" data-aos="fade-right" data-aos-delay="100">
                <img src="/Medcancer/admin/pages/awareness/skills section/<?php echo $skillsContent['image']; ?>" class="img-fluid" alt="">
            </div>
            <div class="col-lg-6 pt-4 pt-lg-0 content" data-aos="fade-left" data-aos-delay="100">
                <h3><?php echo $skillsContent['heading']; ?></h3>
                <p class="fst-italic"><?php echo $skillsContent['paragraph']; ?></p>

                <div class="skills-content">
                    <!-- Display dynamic progress bars based on $skillsContent['progress_values'] -->
                    <?php foreach ($skillsContent['progress_values'] as $index => $value) : ?>
                        <div class="progress">
                            <span class="skill"><?php echo $skillsContent['progress_names'][$index]; ?> <i class="val"><?php echo $value; ?>%</i></span>
                            <div class="progress-bar-wrap">
                                <div class="progress-bar" role="progressbar" aria-valuenow="<?php echo $value; ?>" aria-valuemin="0" aria-valuemax="100"></div>
                            </div>
                        </div>
                    <?php endforeach; ?>
                </div>
            </div>
        </div>
    </div>
</section>



  <!-- feature section -->


  <section id="features" class="features">
    <div class="container">
        <div class="row gy-4 align-items-center features-item" data-aos="fade-up">
          <div class="col-md-5">
        <img src="/Medcancer/admin/pages/awareness/f1 section/<?php echo $f1Content['image']; ?>" class="img-fluid" alt="F1 Image">
          </div>
          <div class="col-md-7">
              <h3><?php echo $f1Content['heading']; ?></h3>
              <p class="fst-italic"><?php echo nl2br($f1Content['introduction']); ?></p>
              <ul>
                  <li><i class="bi bi-check"></i> <?php echo nl2br($f1Content['short_sentence_1']); ?></li>
                  <li><i class="bi bi-check"></i> <?php echo nl2br($f1Content['short_sentence_2']); ?></li>
                  <li><i class="bi bi-check"></i> <?php echo nl2br($f1Content['short_sentence_3']); ?></li>
                  <li><i class="bi bi-check"></i> <?php echo nl2br($f1Content['short_sentence_4']); ?></li>
                  <li><i class="bi bi-check"></i> <?php echo nl2br($f1Content['short_sentence_5']); ?></li>
              </ul>
              <a href="#" class="continue-reading-link" data-toggle="collapse" data-target="#f1LongParagraph" aria-expanded="false" aria-controls="f1LongParagraph">Continue reading...</a>
              <div class="collapse" id="f1LongParagraph">
                  <p><?php echo nl2br($f1Content['continue_reading']); ?></p>
              </div>
          </div>
        </div>
        <!-- F1 Features Item -->
        <div class="row gy-4 align-items-center features-item" data-aos="fade-up">
            <div class="col-md-5 order-1 order-md-2">
                <img src="/Medcancer/admin/pages/awareness/f2 section/<?php echo $f2Content['image']; ?>" class="img-fluid" alt="F2 Image">
            </div>
            <div class="col-md-7 order-2 order-md-1">
                <h3><?php echo $f2Content['heading']; ?></h3>
                <p class="fst-italic"><?php echo nl2br($f2Content['introduction']); ?></p>
                <p><?php echo nl2br($f2Content['paragraph']); ?></p>
                <a href="#" class="continue-reading-link" data-toggle="collapse" data-target="#f2LongParagraph" aria-expanded="false" aria-controls="f2LongParagraph">Continue reading...</a>
                <div class="collapse" id="f2LongParagraph">
                    <p><?php echo nl2br($f2Content['continue_reading']); ?></p>
                </div>
            </div>
        </div><!-- Features Item -->


        <div class="row gy-4 align-items-center features-item" data-aos="fade-up">
    <div class="col-md-5">
        <img src="/Medcancer/admin/pages/awareness/f3 section/<?php echo $f3Content['image']; ?>" class="img-fluid" alt="F3 Image">
    </div>
    <div class="col-md-7">
        <h3><?php echo $f3Content['heading']; ?></h3>
        <p class="fst-italic"><?php echo nl2br($f3Content['introduction']); ?></p>
        <ul>
            <li><i class="bi bi-check"></i> <?php echo nl2br($f3Content['short_sentence_1']); ?></li>
            <li><i class="bi bi-check"></i> <?php echo nl2br($f3Content['short_sentence_2']); ?></li>
            <li><i class="bi bi-check"></i> <?php echo nl2br($f3Content['short_sentence_3']); ?></li>
            <li><i class="bi bi-check"></i> <?php echo nl2br($f3Content['short_sentence_4']); ?></li>
            <li><i class="bi bi-check"></i> <?php echo nl2br($f3Content['short_sentence_5']); ?></li>
        </ul>
        <a href="#" class="continue-reading-link" data-toggle="collapse" data-target="#f3LongParagraph" aria-expanded="false" aria-controls="f3LongParagraph">Continue reading...</a>
        <div class="collapse" id="f3LongParagraph">
            <p><?php echo nl2br($f3Content['continue_reading']); ?></p>
        </div>
    </div>
</div>
<!-- Features Item -->

<div class="row gy-40 align-items-center features-item" data-aos="fade-up">
    <div class="col-md-5 order-1 order-md-2">
        <img src="/Medcancer/admin/pages/awareness/f4 section/<?php echo $f4Content['image']; ?>" class="img-fluid" alt="F4 Image">
    </div>
    <div class="col-md-7 order-2 order-md-1">
        <h3><?php echo $f4Content['heading']; ?></h3>
        <p class="fst-italic"><?php echo nl2br($f4Content['introduction']); ?></p>
        <p><?php echo nl2br($f4Content['paragraph']); ?></p>
        <a href="#" class="continue-reading-link" data-toggle="collapse" data-target="#f4LongParagraph" aria-expanded="false" aria-controls="f4LongParagraph">Continue reading...</a>
        <div class="collapse" id="f4LongParagraph">
            <p><?php echo nl2br($f4Content['continue_reading']); ?></p>
        </div>
    </div>
</div>

<!-- Features Item -->

    </div>
  </section>



  <?php
  include("footer.php");
  ?>


  <!-- Vendor JS Files -->
  <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
  <script src="assets/vendor/aos/aos.js"></script>
  <script src="assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
  <script src="assets/vendor/glightbox/js/glightbox.min.js"></script>
  <script src="assets/vendor/isotope-layout/isotope.pkgd.min.js"></script>
  <script src="assets/vendor/swiper/swiper-bundle.min.js"></script>
  <script src="assets/vendor/waypoints/noframework.waypoints.js"></script>
  <script src="assets/vendor/php-email-form/validate.js"></script>


  <!-- Template Main JS File -->
  <script src="assets/js/main.js"></script>


  
  <script>
    $(document).ready(function() {
      $('.progress').each(function() {
        var progressValue = parseInt($(this).find('.val').text()); // Parse as integer
        var progressBar = $(this).find('.progress-bar');
        progressBar.css('width', progressValue + '%');
        progressBar.attr('aria-valuenow', progressValue);
      });
    });
  </script>
  <script>
    $(document).ready(function() {
        $('.continue-reading-link').click(function(e) {
            e.preventDefault(); // Prevent default link behavior
            var targetId = $(this).data('target');
            $(targetId).collapse('toggle');
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