<style>
/* Custom CSS to fix sidebar position */
@media (max-width: 768px) {
    .sticky-sidebar {
        position: fixed;
        top: 0;
        left: 0;
        bottom: 0;
        z-index: 1030;
        display: block;
        overflow-y: auto;
        width: 250px; /* Adjust the width as needed */
        background-color: #343a40; /* Add a background color for better visibility */
        transition: all 0.3s ease; /* Add smooth transition */
    }
    
    .sticky-sidebar.active {
        left: 0; /* Show the sidebar */
    }
    
    .overlay {
        display: none;
        position: fixed;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        background-color: rgba(0, 0, 0, 0.5); /* Semi-transparent overlay */
        z-index: 1029; /* Ensure overlay is below the sidebar */
    }
}
</style>





<ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">
    <!-- Sidebar - Brand -->

    <a class="sidebar-brand d-flex align-items-center justify-content-center" href="index.php">
        <div class="sidebar-brand-icon rotate-n-15">
            <i class="fas fa-user-shield"></i>
        </div>
        <div class="sidebar-brand-text mx-3">ADMIN DASHBOARD</div>
    </a>

    <!-- Divider -->
    <hr class="sidebar-divider my-0">

    <!-- Nav Item - Dashboard -->
    <li class="nav-item active">
        <a class="nav-link" href="index.php">
            <i class="fas fa-tachometer-alt"></i>
            <span>Dashboard</span>
        </a>
    </li>
    <li class="nav-item">
        <a class="nav-link" href="https://dashboard.tawk.to/#/dashboard/662b4bb21ec1082f04e733b7">
            <i class="fas fa-comments"></i>
            <span>CHATROOM</span>
        </a>
    </li>

    <!-- Divider -->
    <hr class="sidebar-divider">

    <!-- Heading -->
    <div class="sidebar-heading">
        Interface
    </div>

    <!-- Nav Item - Pages Collapse Menu -->
    <li class="nav-item">
                <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseTwo"
                    aria-expanded="true" aria-controls="collapseTwo">
                    <i class="fas fa-fw fa-cog"></i>
                    <span>Web Pages</span>
                </a>
                <div id="collapseTwo" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
                        <div class="bg-white py-2 collapse-inner rounded">
                            <h6 class="collapse-header">Custom Components:</h6>
                            <!-- Add a dropdown for Home sections -->
                            <div class="dropdown">
                                <a class="collapse-item dropdown-toggle" href="#" role="button" id="homeDropdown" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    Home page
                                </a>
                                <div class="dropdown-menu" aria-labelledby="homeDropdown">
                                    <a class="dropdown-item" href="pages/home/hero section/admin_hero.php">Hero</a>
                                    <a class="dropdown-item" href="pages/home/about section/admin_about.php">About</a>
                                    <a class="dropdown-item" href="pages/home/feature section/admin_feature.php">Features</a>
                                    <a class="dropdown-item" href="pages/home/team section/admin_team.php">Team</a>
                                    <a class="dropdown-item" href="pages/home/gallery section/admin_gallery.php">Gallery</a>
                                    <a class="dropdown-item" href="pages/home/sponsors section/admin_sponsors.php">Sponsors</a>
                                    <a class="dropdown-item" href="pages/home/Faq section/admin_Faq.php">FAQ</a>
                                    <a class="dropdown-item" href="pages/home/newsletter section/admin_newsletter.php">News letter</a>
                                    <a class="dropdown-item" href="pages/home/contact section/admin_contact.php">Contact</a>

                                    <!-- Add more sections as needed -->
                                </div>
                            </div>
                            <div class="dropdown">
                                <a class="collapse-item dropdown-toggle" href="#" role="button" id="awarenessDropdown" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    Awareness 
                                </a>
                                <div class="dropdown-menu" aria-labelledby="serviceDropdown">
                                    <a class="dropdown-item" href="pages/awareness/skills section/admin_skills.php">SKILLS</a>
                                    <a class="dropdown-item" href="pages/awareness/f1 section/admin_f1.php">F1</a>
                                    <a class="dropdown-item" href="pages/awareness/f2 section/admin_f2.php">F2</a>
                                    <a class="dropdown-item" href="pages/awareness/f3 section/admin_f3.php">F3</a>
                                    <a class="dropdown-item" href="pages/awareness/f4 section/admin_f4.php">F4</a>

                                    <!-- Add more sections as needed -->
                                </div>
                            </div>
                            <div class="dropdown">
                                <a class="collapse-item dropdown-toggle" href="#" role="button" id="homeDropdown" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    Service 
                                </a>
                                <div class="dropdown-menu" aria-labelledby="serviceDropdown">
                                    <a class="dropdown-item" href="pages/services/features section/admin_features.php">Services</a>
                                    <a class="dropdown-item" href="pages/services/testmonial section/admin_testmonial.php">testmonial</a>
                                    
                                    <!-- Add more sections as needed -->
                                </div>
                            </div>
                            <div class="dropdown">
                                <a class="collapse-item dropdown-toggle" href="#" role="button" id="homeDropdown" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    About us 
                                </a>
                                <div class="dropdown-menu" aria-labelledby="blogDropdown">
                                    <a class="dropdown-item" href="pages/about us/about section/admin_about us.php">About</a>
                                    <a class="dropdown-item" href="pages/about us/tenets section/admin_tenets.php">tenets</a>

                                    <!-- Add more sections as needed -->
                                </div>
                            </div>
                           
                            <div class="dropdown">
                                <a class="collapse-item dropdown-toggle" href="#" role="button" id="contactDropdown" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    Contact  
                                </a>
                                <div class="dropdown-menu" aria-labelledby="blogDropdown">
                                    <a class="dropdown-item" href="pages/home/hero section/admin_hero.php">Hero</a>
                                    <a class="dropdown-item" href="pages/home/about section/admin_about.php">About</a>


                                    <!-- Add more sections as needed -->
                                </div>
                            </div>    
                </div>
    </li>
    <!-- Nav Item - Admin Profile -->
    <li class="nav-item">
        <a class="nav-link" href="register.php">
            <i class="fas fa-user"></i>
            <span>Admin profile</span>
        </a>
    </li>


    <!-- Nav Item - Councils Dropdown -->
    <li class="nav-item dropdown">
        <a class="nav-link dropdown-toggle" href="#" id="councilsDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
            <i class="fas fa-users"></i>
            <span>Councils</span>
        </a>
        <div class="dropdown-menu" aria-labelledby="councilsDropdown">
            <a class="dropdown-item" href="/Medcancer/admin/councils/add_councils.php">Add Council</a>
            <a class="dropdown-item" href="/Medcancer/admin/councils/available.php">Available Councils</a>
        </div>
    </li>

    <!-- Nav Item - Blog -->
    <li class="nav-item">
        <a class="nav-link" href="blog/add_blog.php">
            <i class="fas fa-blog"></i>
            <span>Blog</span>
        </a>
        <a class="nav-link" href="blog/recent_post.php">
            <i class="fas fa-history"></i>
            <span>Recent blog posts</span>
        </a>
        <a class="nav-link" href="subscribe/subscribers.php">
            <i class="fas fa-users"></i>
            <span>Subscription management</span>
        </a>
    </li>

    <!-- Nav Item - Users Management -->
    <li class="nav-item">
        <a class="nav-link" href="home.php">
            <i class="fas fa-users-cog"></i>
            <span>Users management</span>
        </a>
    </li>

    <!-- Nav Item - Tasks Management -->
    <li class="nav-item">
        <a class="nav-link" href="/Medcancer/admin/task management/task.php">
            <i class="fas fa-tasks"></i>
            <span>Tasks management</span>
        </a>
    </li>

    <!-- Nav Item - Utilities Collapse Menu -->
    <li class="nav-item">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseUtilities"
            aria-expanded="true" aria-controls="collapseUtilities">
            <i class="fas fa-donate"></i>
            <span>Donation records</span>
        </a>
        <div id="collapseUtilities" class="collapse" aria-labelledby="headingUtilities"
            data-parent="#accordionSidebar">
            <div class="bg-white py-2 collapse-inner rounded">
                <h6 class="collapse-header">Custom Utilities:</h6>
                <a class="collapse-item" href="/Medcancer/admin/donations/received.php">Donations received</a>
                <a class="collapse-item" href="/Medcancer/admin/donations/use.php">Donations used</a>
                <a class="collapse-item" href="/Medcancer/admin/donations/grants.php">Grants from Sponsors</a>
                <a class="collapse-item" href="/Medcancer/admin/donations/statement.php">USAGE SUMMARY</a>
            </div>
        </div>
    </li>

    <!-- Divider -->
    <hr class="sidebar-divider">

    <!-- Sidebar Toggler (Sidebar) -->
    <div class="text-center d-none d-md-inline">
        <button class="rounded-circle border-0" id="sidebarToggle"></button>
    </div>

    <!-- Scroll to Top Button -->
    <a class="scroll-to-top rounded" href="#page-top">
        <i class="fas fa-angle-up"></i>
    </a>

    <!-- Logout Modal -->
    <div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Ready to Leave?</h5>
                    <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">x</span>
                    </button>
                </div>
                <div class="modal-body">Select "Logout" below if you are ready to end your current session.</div>
                <div class="modal-footer">
                    <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>

                    <form action="logout.php" method="POST">
                        <button type="submit" name="logout_btn" class =" btn btn-primary"> Logout</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</ul>


<script>
document.addEventListener("DOMContentLoaded", function() {
    var sidebar = document.querySelector('.sticky-sidebar');
    var overlay = document.querySelector('.overlay');
    var sidebarToggle = document.querySelector('#sidebarToggle');

    // Toggle sidebar and overlay when sidebarToggle is clicked
    sidebarToggle.addEventListener('click', function() {
        sidebar.classList.toggle('active');
        overlay.style.display = sidebar.classList.contains('active') ? 'block' : 'none';
    });

    // Close sidebar and overlay when clicking outside the sidebar
    document.addEventListener('click', function(event) {
        if (!sidebar.contains(event.target) && !sidebarToggle.contains(event.target)) {
            sidebar.classList.remove('active');
            overlay.style.display = 'none';
        }
    });
});
</script>



<script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
<!-- Include Bootstrap JS -->
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

