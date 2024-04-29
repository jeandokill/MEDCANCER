<?php
include("../admin/pages/about us/about section/data.php");
include("../admin/pages/about us/tenets section/data.php");
include("../admin/pages/home/team section/data.php");
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

  <!-- Template Main CSS File -->
  <link href="assets/css/style.css" rel="stylesheet">
  <link href="assets/css/about use.css" rel="stylesheet">

  <!-- =======================================================
  * Template Name: Home
  * Updated: Sep 18 2023 with Bootstrap v5.3.2
  * Template URL: https://bootstrapmade.com/theevent-conference-event-bootstrap-template/
  * Author: BootstrapMade.com
  * License: https://bootstrapmade.com/license/
  ======================================================== -->
</head>

<body>

  <!-- ======= Header ======= -->
  <header id="header" class="d-flex align-items-center ">
    <div class="container-fluid container-xxl d-flex align-items-center">

      <div id="logo" class="me-auto">
        <!-- Uncomment below if you prefer to use a text logo -->
        <!-- <h1><a href="index.html">The<span>Event</span></a></h1>-->
        <a href="index.php" class="scrollto"><img src="assets/img/FAVICON.jpg" alt="" title=""></a>
      </div>

      <nav id="navbar" class="navbar order-last order-lg-0">
        <ul>
          <li><a  href="index.php">Home</a></li>
          <li><a  href="awareness.php">Awareness</a></li>
          <li><a  href="services.php">Services</a></li>
          <li><a class="active" href="About Us.php">About Us</a></li>
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

<!-- hero section -->

<section id="hero" class="d-flex flex-column justify-content-center align-items-center">
    <div class="container" data-aos="fade-in">
      <h1>Welcome to MEDCANCER Rwanda</h1>
      <h2>We are deligheted to reduce the cancer attacks in Rwanda and  increase the awareness of it.</h2>
    </div>
  </section>

  <main id="main">

    <!-- why use section -->

    <section id="why-us" class="why-us">
      <div class="container">

          <div class="row">
              <div class="col-xl-4 col-lg-5" data-aos="fade-up">
                  <div class="content">
                      <h3><?php echo $whyChooseContent['h3']; ?></h3>
                      <p><?php echo $whyChooseContent['p']; ?></p>
                  </div>
              </div>
              <div class="col-xl-8 col-lg-7 d-flex">
                  <div class="icon-boxes d-flex flex-column justify-content-center">
                      <div class="row">
                          <?php foreach ($whyChooseContent['boxes'] as $box) : ?>
                              <div class="col-xl-4 d-flex align-items-stretch" data-aos="fade-up" data-aos-delay="100">
                                  <div class="icon-box mt-4 mt-xl-0">
                                      <i class="bx <?php echo $box['icon']; ?>"></i>
                                      <h4><?php echo $box['title']; ?></h4>
                                      <p><?php echo $box['description']; ?></p>
                                  </div>
                              </div>
                          <?php endforeach; ?>
                      </div>
                  </div>
              </div>
          </div>

      </div>
    </section>



      <!-- values section -->
      <section id="values" class="values">
    <div class="container">
        <div class="section-title">
            <div class="core-tenets-container" data-aos="fade-up">
                <h2 style="font-size: 40px; font-weight: bold; color: blue;"><?php echo $tenetsContent['tenets_title']; ?></h2>
                <p><?php echo $tenetsContent['tenets_description']; ?></p>
            </div>
        </div>

        <div class="row">
            <!-- Mission -->
            <div class="col-md-6 d-flex align-items-stretch" data-aos="fade-up">
                <div class="card" style="background-image: url(assets/img/mission.jpeg);">
                    <div class="card-body">
                        <h5 class="card-title"><a href=""><?php echo $tenetsContent['mission']['title']; ?></a></h5>
                        <p class="card-text"><?php echo $tenetsContent['mission']['description']; ?></p>
                    </div>
                </div>
            </div>

            <!-- Plan -->
            <div class="col-md-6 d-flex align-items-stretch mt-4 mt-md-0" data-aos="fade-up" data-aos-delay="100">
                <div class="card" style="background-image: url(assets/img/values-2.jpg);">
                    <div class="card-body">
                        <h5 class="card-title"><a href=""><?php echo $tenetsContent['plan']['title']; ?></a></h5>
                        <p class="card-text"><?php echo $tenetsContent['plan']['description']; ?></p>
                    </div>
                </div>
            </div>

            <!-- Vision -->
            <div class="col-md-6 d-flex align-items-stretch mt-4 " style="margin-bottom: 20px;" data-aos="fade-up" data-aos-delay="200">
                <div class="card" style="background-image: url(assets/img/vision.jpeg);">
                    <div class="card-body">
                        <h5 class="card-title"><a href=""><?php echo $tenetsContent['vision']['title']; ?></a></h5>
                        <p class="card-text"><?php echo $tenetsContent['vision']['description']; ?></p>
                    </div>
                </div>
            </div>

            <!-- Care -->
            <div class="col-md-6 d-flex align-items-stretch mt-4" style="margin-bottom: 20px; " data-aos="fade-up" data-aos-delay="300">
                <div class="card" style="background-image: url(assets/img/values-4.jpg);">
                    <div class="card-body">
                        <h5 class="card-title"><a href=""><?php echo $tenetsContent['care']['title']; ?></a></h5>
                        <p class="card-text"><?php echo $tenetsContent['care']['description']; ?></p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>


      <!-- team section -->

<?php $teamSectionData = getTeamSectionData();

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

      <section id="team" class="team section-bg">
        <div class="container">
            <div class="section-title team-section">
                <h2 data-aos="fade-up" style="font-size: 40px; font-weight: bold; color: blue;">TEAM</h2>
                <p data-aos="fade-up">Learn more about our team and validate your reason why you should work with us; working with us will provide you the benefit of diverse expertise and the robustness we carry.</p>
            </div>
        </div>

        <section id="speakers">
          <div class="container" data-aos="fade-up">
              <div class="row">
                  <?php while ($row = mysqli_fetch_assoc($teamResult)): ?>
                      <div class="col-lg-4 col-md-6">
                          <div class="speaker" data-aos="fade-up" data-aos-delay="100">
                              <img src="/Medcancer/admin/pages/home/team section/<?= $row['image_path'] ?>" alt="<?= $row['name'] ?>" class="img-fluid">
                              <div class="details">
                                  <h3><a href="#"><?= $row['name'] ?></a></h3>
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
  
        </div>
      </section>

  </main>

    

  <?php
  include("footer.php");
  ?>
  <!-- Vendor JS Files -->
  <script src="assets/vendor/aos/aos.js"></script>
  <script src="assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
  <script src="assets/vendor/glightbox/js/glightbox.min.js"></script>
  <script src="assets/vendor/swiper/swiper-bundle.min.js"></script>
  <script src="assets/vendor/php-email-form/validate.js"></script>

  <!-- Template Main JS File -->
  <script src="assets/js/main.js"></script>

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