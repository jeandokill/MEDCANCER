<?php
include("../admin/pages/services/features section/data.php");
include("../admin/pages/services/testmonial section/data.php");
include("../login/MainClass.php");
$features = isset($features) ? $features : [];


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
  <link href="assets/css/services.css" rel="stylesheet">
</head>

<body>

  <!-- ======= Header ======= -->
  <header id="header" class="d-flex align-items-center ">
    <div class="container-fluid container-xxl d-flex align-items-center">

      <div id="logo" class="me-auto">
        <a href="index.html" class="scrollto"><img src="assets/img/FAVICON.jpg" alt="" title=""></a>
      </div>

      <nav id="navbar" class="navbar order-last order-lg-0">
        <ul>
          <li><a  href="index.php">Home</a></li>
          <li><a  href="awareness.php">Awareness</a></li>
          <li><a class="active" href="services.php">Services</a></li>
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
    </a>
    
    </div> -->
  </header><!-- End Header -->

  <!-- ======= Hero Section ======= -->
  <section id="hero">
    <div class="hero-container" data-aos="zoom-in" data-aos-delay="100">
      <h1 class="mb-4 pb-0">MEDCANCER<br><span> SOLUTION</span>  ON CANCER AWARENESS</h1>
      <p class="mb-4 pb-0">Together, Cancer diminution is promised</p>
    </div>
  </section>

  <!-- ======= Services Section ======= -->
  <section id="services" class="services">
    <div class="container" data-aos="fade-up">
        <header class="section-header">
            <h2><?php echo $servicesContent['sectionTitle']; ?></h2>
            <p><?php echo $servicesContent['sectionSubtitle']; ?></p>
        </header>
        <div class="row gy-4">
            <?php
            // Array of different icons
            $icons = array(
                'bi bi-box-seam-fill', // Blue box icon
                'bi bi-gift', // Gift icon
                'bi bi-heart-fill', // Heart icon
                'bi bi-lightbulb-fill', // Lightbulb icon
                'bi bi-star-fill' // Star icon
            );
            // Shuffle the array to randomize the icons
            shuffle($icons);
            ?>
            <?php foreach ($servicesContent['cards'] as $index => $card): ?>
                <div class="col-lg-4 col-md-6" data-aos="fade-up" data-aos-delay="200">
                    <div class="service-box blue">
                        <i class="<?php echo $icons[$index % count($icons)]; ?>" style="font-size: 50px; color: #392cc0;"></i>
                        <h3><?php echo $card['title']; ?></h3>
                        <p><?php echo $card['content']; ?></p>
                        <!-- Ensure $index is properly defined here -->
                        <a href="single_service.php?index=<?php echo $index; ?>" class="read-more"><span>Read More</span> <i class="bi bi-arrow-right"></i></a>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
    </div>
</section>



  <!-- users testmonial -->

  <div class="section-title">
    <div class="core-tenets-container" data-aos="fade-up">
      <h2 style="font-size: 40px; font-weight: bold; color: blue; text-align: center; padding: 20px; border-radius: 20px; margin-bottom: 20px;">Users testimonial</h2>
        <p style="background-color: #e0e8f3; padding: 20px; border-radius: 10px; margin-bottom: 20px;">Many users found this organization more impactful on thier life and hope for tomorrow, and then some of the gave us the reviews on it.</p>
    </div>
</div>


<section id="testimonials" class="testimonials">
    <div class="container position-relative" data-aos="fade-up">
        <div class="testimonials-slider swiper" data-aos="fade-up" data-aos-delay="100">
            <div class="swiper-wrapper">

                <?php
                
                foreach ($testimonials as $testimonial) {
                    echo '<div class="swiper-slide">';
                    echo '<div class="testimonial-item">';
                    echo '<img src="/Medcancer/admin/pages/services/testmonial section/' . $testimonial['image'] . '" class="testimonial-img" alt="">';
                    echo '<h3>' . $testimonial['name'] . '</h3>';
                    echo '<h4>' . $testimonial['location'] . '</h4>';
                    echo '<p>';
                    echo '<i class="bx bxs-quote-alt-left quote-icon-left"></i>';
                    echo $testimonial['comment'];
                    echo '<i class="bx bxs-quote-alt-right quote-icon-right"></i>';
                    echo '</p>';
                    echo '</div>';
                    echo '</div>';
                }
                ?>

            </div>
            <div class="swiper-pagination"></div>
        </div>
    </div>
</section>





  <?php
  include("footer.php");
  ?><!-- End  Footer -->

  <!-- Vendor JS Files -->
  <script src="assets/vendor/swiper/swiper-bundle.min.js"></script>
  <script src="assets/vendor/aos/aos.js"></script>
  <script src="assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
  <script src="assets/vendor/glightbox/js/glightbox.min.js"></script>
  <script src="assets/vendor/php-email-form/validate.js"></script>

<!-- Swiper Initialization -->
<script>
    var mySwiper = new Swiper('.testimonials-slider', {
        loop: true,
        autoplay: {
            delay: 5000,
            disableOnInteraction: false,
        },
        pagination: {
        el: '.swiper-pagination',
        clickable: true, // Enable clickable pagination bullets
    },
       
    });
</script>

<!-- Template Main JS File -->
<script src="assets/js/main.js"></script>

<svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-box-seam-fill" viewBox="0 0 16 16">
    <path fill-rule="evenodd" d="M15.528 2.973a.75.75 0 0 1 .472.696v8.662a.75.75 0 0 1-.472.696l-7.25 2.9a.75.75 0 0 1-.557 0l-7.25-2.9A.75.75 0 0 1 0 12.331V3.669a.75.75 0 0 1 .471-.696L7.443.184l.01-.003.268-.108a.75.75 0 0 1 .558 0l.269.108.01.003 6.97 2.789ZM10.404 2 4.25 4.461 1.846 3.5 1 3.839v.4l6.5 2.6v7.922l.5.2.5-.2V6.84l6.5-2.6v-.4l-.846-.339L8 5.961 5.596 5l6.154-2.461z"/>
</svg>

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
