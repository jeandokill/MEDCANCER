<?php
// Include database connection file
include_once "db_connect.php";

// Check if council ID is provided in the URL parameter
if(isset($_GET['id'])) {
    // Retrieve the council ID from the URL
    $council_id = $_GET['id'];

    // Fetch council information from the database based on the ID
    $sql = "SELECT * FROM councils WHERE id = $council_id";
    $result = mysqli_query($conn, $sql);

    // Check if council exists
    if(mysqli_num_rows($result) == 1) {
        // Fetch council data
        $row = mysqli_fetch_assoc($result);
        // Close the result set
        mysqli_free_result($result);
    } else {
        // Council not found, redirect to error page or handle accordingly
        echo "Council not found.";
        // You may want to redirect to an error page here
        // header("Location: error.php");
        // exit();
    }
} else {
    // Redirect to error page if council ID is not provided
    echo "Council ID not provided.";
    // You may want to redirect to an error page here
    // header("Location: error.php");
    // exit();
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Council</title>
    <!-- Bootstrap CSS -->
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <!-- Font Awesome CSS -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
</head>

<body>
    <div class="container mt-5">
        <h2 class="mb-4">Edit Council</h2>
        <!-- Edit Council Form -->
        <form action="update_councils.php" method="POST" enctype="multipart/form-data">
        <input type="hidden" name="council_id" value="<?php echo $council_id; ?>">
                    <div class="form-group">
                        <label for="firstName">First Name:</label>
                        <input type="text" class="form-control" id="firstName" name="firstName" value="<?php echo isset($row['firstName']) ? $row['firstName'] : ''; ?>">
                    </div>
                    <div class="form-group">
                        <label for="middleName">Middle Name:</label>
                        <input type="text" class="form-control" id="middleName" name="middleName" value="<?php echo isset($row['middleName']) ? $row['middleName'] : ''; ?>">
                    </div>
                    <div class="form-group">
                        <label for="lastName">Last Name:</label>
                        <input type="text" class="form-control" id="lastName" name="lastName" value="<?php echo isset($row['lastName']) ? $row['lastName'] : ''; ?>">
                    </div>
                    <div class="form-group">
                        <label for="professionalTitle">Professional Title:</label>
                        <input type="text" class="form-control" id="professionalTitle" name="professionalTitle" value="<?php echo isset($row['professionalTitle']) ? $row['professionalTitle'] : ''; ?>">
                    </div>
                    <div class="form-group">
                        <label for="qualifications">Qualifications:</label>
                        <div class="custom-file">
                            <input type="file" class="custom-file-input" id="qualifications" name="qualifications" placeholder="(e.g., Degrees, Certifications)">
                            <label class="custom-file-label" for="qualifications">Choose file...</label>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="licenseNumber">License Number:</label>
                        <input type="text" class="form-control" id="licenseNumber" name="licenseNumber" placeholder="(If applicable)" value="<?php echo isset($row['licenseNumber']) ? $row['licenseNumber'] : ''; ?>">
                    </div>
                    <div class="form-group">
                        <label for="areasOfExpertise">Areas of Expertise:</label>
                        <input type="text" class="form-control" id="areasOfExpertise" name="areasOfExpertise" placeholder="(e.g., Cancer counseling, Psychotherapy)" value="<?php echo isset($row['areasOfExpertise']) ? $row['areasOfExpertise'] : ''; ?>">
                    </div>
                    <div class="form-group">
                        <label for="yearsOfExperience">Years of Experience:</label>
                        <input type="number" class="form-control" id="yearsOfExperience" name="yearsOfExperience" value="<?php echo isset($row['yearsOfExperience']) ? $row['yearsOfExperience'] : ''; ?>">
                    </div>
                    <div class="form-group">
                        <label for="training">Specialized Training:</label>
                        <input type="text" class="form-control" id="training" name="training" value="<?php echo isset($row['training']) ? $row['training'] : ''; ?>">
                    </div>
                    <div class="form-group">
                        <label for="email">Email Address:</label>
                        <input type="email" class="form-control" id="email" name="email" value="<?php echo isset($row['email']) ? $row['email'] : ''; ?>">
                    </div>
                    <div class="form-group">
                        <label for="phoneNumber">Phone Number:</label>
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <span class="input-group-text"><i class="fas fa-phone"></i></span>
                            </div>
                            <input type="tel" class="form-control" id="phoneNumber" name="phoneNumber" value="<?php echo isset($row['phoneNumber']) ? $row['phoneNumber'] : ''; ?>">
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="officeAddress">Office Address:</label>
                        <input type="text" class="form-control" id="officeAddress" name="officeAddress" value="<?php echo isset($row['officeAddress']) ? $row['officeAddress'] : ''; ?>">
                    </div>
                    <div class="form-group">
                        <label for="availability">Availability:</label>
                        <input type="text" class="form-control" id="availability" name="availability" placeholder="(Available time for counseling session)" value="<?php echo isset($row['availability']) ? $row['availability'] : ''; ?>">
                    </div>
                    <div class="form-group">
                        <label for="preferredModes">Preferred Modes of Counseling:</label>
                        <input type="text" class="form-control" id="preferredModes" name="preferredModes" placeholder="(in-person, phone, video call)" value="<?php echo isset($row['preferredModes']) ? $row['preferredModes'] : ''; ?>">
                    </div>
                    <div class="form-group">
                        <label for="counselingApproach">Counseling Approach:</label>
                        <input type="text" class="form-control" id="counselingApproach" name="counselingApproach" placeholder="(e.g., Cognitive-Behavioral Therapy, Person-Centered Therapy)" value="<?php echo isset($row['counselingApproach']) ? $row['counselingApproach'] : ''; ?>">
                    </div>
                    <div class="form-group">
                        <label for="counselingTechniques">Counseling Techniques:</label>
                        <input type="text" class="form-control" id="counselingTechniques" name="counselingTechniques" value="<?php echo isset($row['counselingTechniques']) ? $row['counselingTechniques'] : ''; ?>">
                    </div>
                    <div class="form-group">
                        <label for="website">Professional Website or Profile:</label>
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <span class="input-group-text"><i class="fas fa-globe"></i></span>
                            </div>
                            <input type="url" class="form-control" id="website" name="website" value="<?php echo isset($row['website']) ? $row['website'] : ''; ?>">
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="professionalLinks">Professional Links:</label>
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <span class="input-group-text"><i class="fab fa-linkedin"></i></span>
                                <span class="input-group-text"><i class="fab fa-facebook"></i></span>
                                <span class="input-group-text"><i class="fab fa-instagram"></i></span>
                                <span class="input-group-text"><i class="fab fa-whatsapp"></i></span>
                            </div>
                            <input type="url" class="form-control" id="linkedin" name="linkedin" placeholder="LinkedIn" value="<?php echo isset($row['linkedin']) ? $row['linkedin'] : ''; ?>">
                            <input type="url" class="form-control" id="facebook" name="facebook" placeholder="Facebook" value="<?php echo isset($row['facebook']) ? $row['facebook'] : ''; ?>">
                            <input type="url" class="form-control" id="instagram" name="instagram" placeholder="Instagram" value="<?php echo isset($row['instagram']) ? $row['instagram'] : ''; ?>">
                            <input type="url" class="form-control" id="whatsapp" name="whatsapp" placeholder="WhatsApp" value="<?php echo isset($row['whatsapp']) ? $row['whatsapp'] : ''; ?>">
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="testimonials">Testimonials:</label>
                        <textarea class="form-control" id="testimonials" name="testimonials" placeholder="Testimonials from previous clients" rows="3"><?php echo isset($row['testimonials']) ? $row['testimonials'] : ''; ?></textarea>
                    </div>
                    <div class="form-group">
                        <label for="profilePicture">Profile Picture:</label>
                        <div class="custom-file">
                            <input type="file" class="custom-file-input" id="profilePicture" name="profilePicture">
                            <label class="custom-file-label" for="profilePicture">Choose file...</label>
                        </div>
                    </div>
                    <button type="submit" class="btn btn-primary btn-block">Save Changes</button>
                </form>
    </div>

    <!-- Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>

</html>
