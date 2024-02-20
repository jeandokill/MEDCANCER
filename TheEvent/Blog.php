<?php
include("../admin/blog/blog_data.php");

// Check if 'id' is set in the $_GET array
$blogId = isset($_GET['id']) ? $_GET['id'] : null;

// Check if $blogId is not null before using it

?>


<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">

  <title>MEDCANCER BLOG</title>
  <meta content="" name="description">
  <meta content="" name="keywords">

  <!-- Favicons -->
  <link href="assets/img/favicon.png" rel="icon">
  <link href="assets/img/apple-touch-icon.png" rel="apple-touch-icon">

  <!-- Google Fonts -->
  <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i|Nunito:300,300i,400,400i,600,600i,700,700i|Poppins:300,300i,400,400i,500,500i,600,600i,700,700i" rel="stylesheet">

  <!-- Vendor CSS Files -->
  <link href="assets/vendor/aos/aos.css" rel="stylesheet">
  <link href="assets/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
  <link href="assets/vendor/bootstrap-icons/bootstrap-icons.css" rel="stylesheet">
  <link href="assets/vendor/glightbox/css/glightbox.min.css" rel="stylesheet">
  <link href="assets/vendor/remixicon/remixicon.css" rel="stylesheet">
  <link href="assets/vendor/swiper/swiper-bundle.min.css" rel="stylesheet">

  <!-- Template Main CSS File -->
  <link href="assets/css/style.css" rel="stylesheet">
</head>

<body>

  <!-- ======= Header ======= -->
 <header id="header" class="d-flex align-items-center" style="background-color: black;">
    <div class="container-fluid container-xxl d-flex align-items-center">

      <div id="logo" class="me-auto">
        <a href="index.html" class="scrollto"><img src="assets/img/FAVICON.jpg" alt="" title=""></a>
      </div>

      <nav id="navbar" class="navbar order-last order-lg-0">
        <ul>
          <li><a  href="index.php">Home</a></li>
          <li><a  href="awareness.php">Awareness</a></li>
          <li><a  href="services.php">Services</a></li>
          <li><a  href="About Us.php">About Us</a></li>
          <li><a class="active"  href="Blog.php">Blog</a></li>
          <li><a  href="contact.php">Contact</a></li>
        </ul>
        <i class="bi bi-list mobile-nav-toggle"></i>
      </nav><!-- .navbar -->
      <a href="#buy-tickets" id="donate-button">
        <span></span>
        <span></span>
        <span></span>
        <span></span>
        Donate
    </a>
    
    </div>
  </header><!-- End Header -->

  <main id="main">

    <!-- ======= Breadcrumbs ======= -->
    <section class="breadcrumbs">
      <div class="container">
        <h2>Blog</h2>
      </div>
    </section><!-- End Breadcrumbs -->



    <!-- ======= Blog Section ======= -->
    <section id="blog" class="blog">
    <div class="container" data-aos="fade-up">

        <div class="row">

            <!-- Main Blog Entries -->
            <div class="col-lg-8">
                <?php
                // Fetch and display blog data
                if (!empty($blogs)) {
                    foreach ($blogs as $blog) {
                        echo "<article class='entry'>";
                        echo "<div class='entry-img'>";
                        echo "<img src='/EVENT/admin/blog/" . $blog['image'] . "' alt='' class='img-fluid'>";
                        echo "</div>";

                        echo "<h2 class='entry-title'>";
                        echo "<a href='blog_single.php?id=" . $blog['id'] . "'>" . $blog['title'] . "</a>";
                        echo "</h2>";

                        echo "<div class='entry-meta'>";
                        echo "<ul>";
                        echo "<li class='d-flex align-items-center'><i class='bi bi-person'></i> " . $blog['author_name'] . "</li>";
                        echo "<li class='d-flex align-items-center'><i class='bi bi-clock'></i> <time datetime='" . $blog['publish_date'] . "'>" . $blog['publish_date'] . "</time></li>";
                        echo "</ul>";
                        echo "</div>";

                        echo "<div class='entry-content'>";
                        echo "<p>" . $blog['paragraph'] . "</p>";
                        echo "<div class='read-more'>";
                        echo "<a href='blog_single.php?id=" . $blog['id'] . "'>Read More</a>";
                        echo "</div>";
                        echo "</div>";

                        echo "</article><!-- End blog entry -->";
                    }
                } else {
                    echo "No blogs found.";
                }
                ?>
            </div>

            <!-- Sidebar -->
            <div class="col-lg-4">

                <div class="sidebar">

                    <h3 class="sidebar-title">Search</h3>
                    <div class="sidebar-item search-form">
                        <form action="">
                            <input type="text">
                            <button type="submit"><i class="bi bi-search"></i></button>
                        </form>
                    </div>
                    <!-- End sidebar search formn-->

                    <h3 class="sidebar-title">Recent Posts</h3>
                            <div class="sidebar-item recent-posts">
                            <?php
                                $recentPosts = getRecentPosts();

                                if (!empty($recentPosts)) {
                                    foreach ($recentPosts as $recentPost) {
                                        echo "<div class='post-item clearfix'>";
                                        echo "<img src='/EVENT/admin/blog/" . $recentPost['image'] . "' alt=''>";
                                        echo "<h4><a href='blog_recent.php?id={$recentPost['id']}'>{$recentPost['title']}</a></h4>";
                                        echo "<time datetime='{$recentPost['publish_date']}'>{$recentPost['publish_date']}</time>";
                                        echo "</div>";
                                    }
                                } else {
                                    echo "<p>No recent posts found.</p>";
                                }
                                ?>
                            </div><!-- End sidebar recent posts-->

                </div><!-- End sidebar -->

            </div><!-- End blog sidebar -->

        </div>

    </div>
    </section><!-- End Blog Section -->
<!-- End Blog Section -->

  </main><!-- End #main -->

  <!-- ======= Footer ======= -->
  <?php
  include("footer.php");
  ?>

  <a href="#" class="back-to-top d-flex align-items-center justify-content-center"><i class="bi bi-arrow-up-short"></i></a>

  <!-- Vendor JS Files -->
  <script src="assets/vendor/purecounter/purecounter_vanilla.js"></script>
  <script src="assets/vendor/aos/aos.js"></script>
  <script src="assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
  <script src="assets/vendor/glightbox/js/glightbox.min.js"></script>
  <script src="assets/vendor/isotope-layout/isotope.pkgd.min.js"></script>
  <script src="assets/vendor/swiper/swiper-bundle.min.js"></script>
  <script src="assets/vendor/php-email-form/validate.js"></script>

  <!-- Template Main JS File -->
  <script src="assets/js/main.js"></script>

</body>

</html>