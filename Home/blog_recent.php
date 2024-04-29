<?php
session_start();



// Include necessary functions or classes
include("../admin/blog/blog_db.php");
include("../admin/blog/blog_data.php");
include("../admin/blog/comment.php");
include("../admin/blog/comment_db.php");
include("../login/MainClass.php");
?>


<!DOCTYPE html>
<html lang="en">

<head>

<style>
  
  .like-comment i.bi-heart::before {
    content: "\2661"; /* Unicode character for an empty heart */
    color: #ccc;
    font-size: 24px; 
  }

  /* Filled heart when liked */
  .like-comment.liked i.bi-heart::before,
  .like-comment:active i.bi-heart::before {
    content: "\2665"; /* Unicode character for a filled heart */
    color: red;
    font-size: 24px; 
  }

  /* Style for the comment author name */
  .comment-author {
    font-weight: bold;
    color: black;
  }
</style>


  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">

  <title>MEDCANCER-RECENT-BLOG </title>
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
  <header id="header" class="header fixed-top">
    <div class="container-fluid container-xl d-flex align-items-center justify-content-between">

      <a href="index.php" class="logo d-flex align-items-center">
        <span>MEDCANCER</span>
      </a>

            <nav id="navbar" class="navbar">
            <ul>
                <li><a  href="index.php">Home</a></li>
                <li><a  href="awareness.php">Awareness</a></li>
                <li><a  href="services.php">Services</a></li>
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

    </div>
  </header><!-- End Header -->

  <main id="main">

<!-- ======= Blog Single Section ======= -->
<section id="blog" class="blog">
    <div class="container" data-aos="fade-up">
        <div class="row">
            <div class="col-lg-8 entries">
                <?php


                if(isset($_GET['id'])) {
                    // Get the ID of the clicked blog post
                    $blogPostId = $_GET['id'];

                    // Fetch blog post details based on the ID
                    $blogPost = getBlogPostById($blogPostId);

                    // Check if the blog post exists
                    if ($blogPost) {
                    }
                }

                // Fetch and display blog data
                if (!empty($blogPost)) {
                    echo "<article class='entry entry-single'>";
                    echo "<div class='entry-img'>";
                    echo "<img src='/Medcancer/admin/blog/uploads/" .$blogPost['image'] . "' alt='' class='img-fluid'>";
                    echo "</div>";

                    echo "<h2 class='entry-title'>";
                    echo "<a href='blog_single.php?id=" .$blogPost['title'] . "'>" .$blogPost['title'] . "</a>";
                    echo "</h2>";

                    echo "<div class='entry-meta'>";
                    echo "<ul>";
                    echo "<li class='d-flex align-items-center'><i class='bi bi-person'></i> <a href='#'>" .$blogPost['author_name'] . "</a></li>";
                    echo "<li class='d-flex align-items-center'><i class='bi bi-clock'></i> <a href='#'><time datetime='" .$blogPost['publish_date'] . "'>" .$blogPost['publish_date'] . "</time></a></li>";
                    echo "</ul>";
                    echo "</div>";

                    echo "<div class='entry-content'>";
                    echo "<p class='blog-paragraph'>" .$blogPost['paragraph'] . "</p>";

                    echo "<p class='blockquote'>" .$blogPost['blockquote'] . "</p>";
                    echo "<h3 class='content-subtitle'>" .$blogPost['content1_subtitle'] . "</h3>";
                    echo "<p class='content'>" .$blogPost['content1_content'] . "</p>";
                    echo "<h3 class='content-subtitle'>" .$blogPost['content2_subtitle'] . "</h3>";
                    echo "<p class='content'>" .$blogPost['content2_content'] . "</p>";
                    echo "<img src='/Medcancer/admin/blog/uploads/" .$blogPost['content_image'] . "' alt='' class='img-fluid'>";
                    echo "<h3 class='content-subtitle'>" .$blogPost['content3_subtitle'] . "</h3>";
                    echo "<p class='content'>" .$blogPost['content3_content'] . "</p>";

                    echo "<div class='blog-author d-flex align-items-center'>";
                    echo "<img src='/Medcancer/admin/blog/uploads/" .$blogPost['author_image'] . "' class='rounded-circle float-left' alt='author image'>";
                    echo "<div class='author-info'>";
                    echo "<h4>" .$blogPost['author_name'] . "</h4>";
                    echo "<div class='social-links'>";
                    echo "<a href='https://twitter.com/#'><i class='bi bi-twitter'></i></a>";
                    echo "<a href='https://facebook.com/#'><i class='bi bi-facebook'></i></a>";
                    echo "<a href='https://instagram.com/#'><i class='bi bi-instagram'></i></a>";
                    echo "</div>";
                    echo "<p class='author-bio'>" .$blogPost['author_bio'] . "</p>";
                    echo "</div>";
                    echo "</div><!-- End blog author bio -->";

                    echo "</div>";
                    echo "</article><!-- End blog entry -->";

                    // Display existing comments
                    
                    $comments = getComments($blogPostId);
                    if (!empty($comments)) {
                        // Reverse the order of comments
                        $reversedComments = array_reverse($comments);

                        echo '<div class="blog-comments">';
                        echo '<h4 class="comments-count">' . count($reversedComments) . ' Comments</h4>';

                        foreach ($reversedComments as $key => $comment) {
                            // Fetch user details (username and profile picture) based on the comment's email
                            $userDetails = getUserDetailsByEmail($comment['email']);
                            $username = $userDetails['username'];
                            $profilePicture = $userDetails['profile_picture'];

                            echo '<div id="comment-' . ($key + 1) . '" class="comment">';
                            echo '<div class="d-flex">';
                            echo '<div class="comment-img"><img src="/Medcancer/admin/blog/' . $profilePicture . '" alt="Profile Picture"></div>';
                            echo '<div>';
                            echo '<h5><a href="#" id="like-comment-' . ($key + 1) . '" class="like-comment" onclick="likeComment(' . ($key + 1) . '); return false;"><i class="bi bi-heart"></i></a> <span id="like-count-' . ($key + 1) . '">0</span> <span class="comment-author">' . $username . '</span></h5>';
                            echo '<time datetime="' . $comment['date'] . '">' . date('d M, Y', strtotime($comment['date'])) . '</time>';
                            echo '<p>' . $comment['comment'] . '</p>';
                            echo '</div>';
                              echo '</div>';
      
                        
                      
                          echo '</div><!-- End comment #' . ($key + 1) . '-->';
                      }
                    
                        echo '</div><!-- End blog-comments -->';
                    }

                   
                                        
                    // reply form
                    echo '<div class="reply-form">';
                    echo '<h4 style="font-weight: bold;">Leave a Reply</h4>';
                    echo '<p>Your email address will not be published. Required fields are marked *</p>';
                    echo '<form id="commentForm" method="post" onsubmit="return postComment()">';
                    echo '<input type="hidden" name="id" id="blog_id" value="' . $blogPostId . '">';
                    echo '<div class="form-group" style="margin-bottom: 20px;">';
                    echo '<label for="name">Your Name*</label>';
                    echo '<input name="name" type="text" class="form-control" placeholder="Your Name*" required>';
                    echo '</div>';

                    echo '<div class="form-group" style="margin-bottom: 20px;">';
                    echo '<label for="email">Your Email*</label>';
                    echo '<input name="email" type="email" class="form-control" placeholder="Your Email*" required>';
                    echo '</div>';

                    echo '<div class="form-group">';
                    echo '<label for="comment">Your Comment*</label>';
                    echo '<textarea name="comment" class="form-control" placeholder="Your Comment*" required></textarea>';
                    echo '</div>';

                    echo '<button type="submit" class="btn btn-primary" id="submitBtn" onclick="postComment()">Post Comment</button>';
                    echo '</form>';
                  
                  }
                        ?> 
                                 
            </div>
        </div>
                        <div class="col-lg-4">
                            <div class="sidebar">
                            <h3 class="sidebar-title">Recent Posts</h3>
                            <div class="sidebar-item recent-posts">
                            <?php
                                $recentPosts = getRecentPosts();

                                if (!empty($recentPosts)) {
                                    foreach ($recentPosts as $recentPost) {
                                        echo "<div class='post-item clearfix'>";
                                        echo "<img src='/Medcancer/admin/blog/uploads/" . $recentPost['image'] . "' alt=''>";
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
            </section><!-- End Blog Single Section -->

</main>
<!-- End #main -->

  <!-- ======= Footer ======= -->
  <?php
  include("footer.php");
  ?>
  

  <!-- Vendor JS Files -->
  <script src="assets/vendor/aos/aos.js"></script>
  <script src="assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
  <script src="assets/vendor/glightbox/js/glightbox.min.js"></script>
  <script src="assets/vendor/isotope-layout/isotope.pkgd.min.js"></script>
  <script src="assets/vendor/swiper/swiper-bundle.min.js"></script>
  <script src="assets/vendor/php-email-form/validate.js"></script>

  <!-- Template Main JS File -->
  <script src="assets/js/main.js"></script>
</script>

</body>

</html>
<script>
function postComment() {
    // Validate the form (you may want to implement this function)
    if (!validateForm()) {
        return false;
    }

    // Get form data
    var form = document.getElementById('commentForm');
    var formData = new FormData(form);

    // Send an AJAX request to the same page using POST method
    fetch('comment_db.php', {
        method: 'POST',
        body: formData,
    })
    .then(response => response.json())
    .then(data => {
        if (data.success) {
            // Comment posted successfully, update the comments section
            updateCommentsSection(data.comment);
        } else {
            // Comment not posted, handle the error (if needed)
            console.error('Error adding comment:', data.message);
        }
    })
    .catch(error => console.error('Error:', error));

    // Prevent the default form submission
    return false;
}
</script>




<script>
  function likeComment(commentId) {
    var likeButton = document.getElementById('like-comment-' + commentId);
    var likeCount = document.getElementById('like-count-' + commentId);

    // Retrieve liked comments from local storage
    var likedComments = JSON.parse(localStorage.getItem('likedComments')) || {};

    // Check if the comment is already liked
    var isLiked = likedComments[commentId];

    // Retrieve like count from local storage
    var likeCountValue = parseInt(localStorage.getItem('likeCount-' + commentId)) || 0;

    // Simulate server-side update (you would need to handle this with AJAX in a real scenario)
    var newLikes;

    if (isLiked) {
      newLikes = likeCountValue - 1;
      delete likedComments[commentId]; // Remove like from local storage
    } else {
      newLikes = likeCountValue + 1;
      likedComments[commentId] = true; // Add like to local storage
    }

    // Update UI
    likeButton.classList.toggle('liked', !isLiked);
    likeCount.innerText = newLikes;

    // Save liked comments and like count to local storage
    localStorage.setItem('likedComments', JSON.stringify(likedComments));
    localStorage.setItem('likeCount-' + commentId, newLikes);
  }

  // Restore liked state and like count on page load
  document.addEventListener('DOMContentLoaded', function () {
    var likedComments = JSON.parse(localStorage.getItem('likedComments')) || {};

    Object.keys(likedComments).forEach(function (commentId) {
      var likeButton = document.getElementById('like-comment-' + commentId);
      var likeCount = document.getElementById('like-count-' + commentId);

      if (likeButton && likeCount) {
        likeButton.classList.add('liked');

        // Restore like count
        var likeCountValue = parseInt(localStorage.getItem('likeCount-' + commentId)) || 0;
        likeCount.innerText = likeCountValue;
      }
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

</html?