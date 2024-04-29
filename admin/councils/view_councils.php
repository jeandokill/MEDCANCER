<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>View Council Information</title>
    <!-- Bootstrap CSS -->
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <!-- Font Awesome CSS -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
    <style>
        /* Custom styles for this page */
        .container {
            margin-top: 50px;
        }

        .card {
            margin-bottom: 20px;
        }

        .card-header {
            background-color: #007bff;
            color: #fff;
        }

        .card-body {
            background-color: #f8f9fa;
        }

        .card-title {
            font-size: 24px;
        }

        .card-text {
            font-size: 18px;
        }

        .profile-picture {
            max-width: 200px;
            margin: 0 auto 20px;
            display: block;
        }

        .social-icons a {
            color: #007bff;
            margin-right: 10px;
        }
    </style>
</head>

<body>
    <div class="container">
        <div class="row">
            <div class="col-md-6 offset-md-3">
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">Council Information</h3>
                    </div>
                    <div class="card-body">
                        <?php
                        // Include database connection file
                        include_once "db_connect.php";

                        // Check if council ID is provided
                        if (isset($_GET['id'])) {
                            $council_id = $_GET['id'];

                            // SQL query to fetch council information by ID
                            $sql = "SELECT * FROM councils WHERE id = $council_id";

                            // Execute the query
                            $result = mysqli_query($conn, $sql);

                            // Check if the council exists
                            if (mysqli_num_rows($result) == 1) {
                                $row = mysqli_fetch_assoc($result);
                                // Display council information
                                echo "<img src='" . $row['profilePicture'] . "' alt='Profile Picture' class='profile-picture'>";
                                echo "<h4 class='card-title text-center'>" . $row['firstName'] . " " . $row['middleName'] . " " . $row['lastName'] . "</h4>";
                                echo "<p class='card-text'><strong>Professional Title: </strong>" . $row['professionalTitle'] . "</p>";
                                echo "<p class='card-text'><strong>Qualifications: </strong><a href='" . $row['qualifications'] . "' class='download-link'><i class='fas fa-download'></i></a></p>";
                                echo "<p class='card-text'><strong>License Number: </strong>" . $row['licenseNumber'] . "</p>";
                                echo "<p class='card-text'><strong>Areas of Expertise: </strong>" . $row['areasOfExpertise'] . "</p>";
                                echo "<p class='card-text'><strong>Years of Experience: </strong>" . $row['yearsOfExperience'] . "</p>";
                                echo "<p class='card-text'><strong>Training: </strong>" . $row['training'] . "</p>";
                                echo "<p class='card-text'><strong>Email: </strong>" . $row['email'] . "</p>";
                                echo "<p class='card-text'><strong>Phone Number: </strong>" . $row['phoneNumber'] . "</p>";
                                echo "<p class='card-text'><strong>Office Address: </strong>" . $row['officeAddress'] . "</p>";
                                echo "<p class='card-text'><strong>Availability: </strong>" . $row['availability'] . "</p>";
                                echo "<p class='card-text'><strong>Preferred Modes: </strong>" . $row['preferredModes'] . "</p>";
                                echo "<p class='card-text'><strong>Counseling Approach: </strong>" . $row['counselingApproach'] . "</p>";
                                echo "<p class='card-text'><strong>Counseling Techniques: </strong>" . $row['counselingTechniques'] . "</p>";
                                // Social Media Icons
                                echo "<div class='social-icons'>";
                                if (!empty($row['website'])) {
                                    echo "<a href='" . $row['website'] . "'><i class='fas fa-globe'></i></a>";
                                }
                                if (!empty($row['linkedin'])) {
                                    echo "<a href='" . $row['linkedin'] . "'><i class='fab fa-linkedin'></i></a>";
                                }
                                if (!empty($row['facebook'])) {
                                    echo "<a href='" . $row['facebook'] . "'><i class='fab fa-facebook-f'></i></a>";
                                }
                                if (!empty($row['instagram'])) {
                                    echo "<a href='" . $row['instagram'] . "'><i class='fab fa-instagram'></i></a>";
                                }
                                if (!empty($row['whatsapp'])) {
                                    echo "<a href='" . $row['whatsapp'] . "'><i class='fab fa-whatsapp'></i></a>";
                                }
                                echo "</div>"; // Close social-icons div
                                // Add more information fields as needed
                            } else {
                                echo "<p class='text-danger'>Council not found.</p>";
                            }
                        } else {
                            echo "<p class='text-danger'>Council ID not provided.</p>";
                        }

                        // Close database connection
                        mysqli_close($conn);
                        ?>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>

</html>
