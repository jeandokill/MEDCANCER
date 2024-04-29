<?php
// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Include database connection file
    include_once "db_connect.php";

    // Retrieve form data and sanitize it
    $firstName = mysqli_real_escape_string($conn, $_POST['firstName']);
    $middleName = mysqli_real_escape_string($conn, $_POST['middleName']);
    $lastName = mysqli_real_escape_string($conn, $_POST['lastName']);
    $professionalTitle = mysqli_real_escape_string($conn, $_POST['professionalTitle']);
    // Handle file upload for qualifications
    $qualifications = ''; // Default empty value
    if ($_FILES['qualifications']['size'] > 0) {
        $uploadDir = 'uploads/';
        $fileName = basename($_FILES['qualifications']['name']);
        $targetFilePath = $uploadDir . $fileName;
        if (move_uploaded_file($_FILES['qualifications']['tmp_name'], $targetFilePath)) {
            $qualifications = $targetFilePath;
        } else {
            echo "Failed to upload file.";
            exit;
        }
    }
    $profilePicture = ''; // Default empty value
    if ($_FILES['profilePicture']['size'] > 0) {
        $uploadDir = 'uploads/';
        $fileName = basename($_FILES['profilePicture']['name']);
        $targetFilePath = $uploadDir . $fileName;
        if (move_uploaded_file($_FILES['profilePicture']['tmp_name'], $targetFilePath)) {
            $profilePicture = $targetFilePath;
        } else {
            echo "Failed to upload profile picture.";
            exit;
        }
    }
    $licenseNumber = mysqli_real_escape_string($conn, $_POST['licenseNumber']);
    $areasOfExpertise = mysqli_real_escape_string($conn, $_POST['areasOfExpertise']);
    $yearsOfExperience = mysqli_real_escape_string($conn, $_POST['yearsOfExperience']);
    $training = mysqli_real_escape_string($conn, $_POST['training']);
    $email = mysqli_real_escape_string($conn, $_POST['email']);
    $phoneNumber = mysqli_real_escape_string($conn, $_POST['phoneNumber']);
    $officeAddress = mysqli_real_escape_string($conn, $_POST['officeAddress']);
    $availability = mysqli_real_escape_string($conn, $_POST['availability']);
    $preferredModes = mysqli_real_escape_string($conn, $_POST['preferredModes']);
    $counselingApproach = mysqli_real_escape_string($conn, $_POST['counselingApproach']);
    $counselingTechniques = mysqli_real_escape_string($conn, $_POST['counselingTechniques']);
    $website = mysqli_real_escape_string($conn, $_POST['website']);
    $linkedin = mysqli_real_escape_string($conn, $_POST['linkedin']);
    $facebook = mysqli_real_escape_string($conn, $_POST['facebook']);
    $instagram = mysqli_real_escape_string($conn, $_POST['instagram']);
    $whatsapp = mysqli_real_escape_string($conn, $_POST['whatsapp']);
    $testimonials = mysqli_real_escape_string($conn, $_POST['testimonials']);

    // SQL query to insert data into the councils table
    $sql = "INSERT INTO councils (firstName, middleName, lastName, professionalTitle, qualifications,profilePicture, licenseNumber, areasOfExpertise, yearsOfExperience, training, email, phoneNumber, officeAddress, availability, preferredModes, counselingApproach, counselingTechniques, website, linkedin, facebook, instagram, whatsapp, testimonials) VALUES ('$firstName', '$middleName', '$lastName', '$professionalTitle', '$qualifications', '$profilePicture', '$licenseNumber', '$areasOfExpertise', '$yearsOfExperience', '$training', '$email', '$phoneNumber', '$officeAddress', '$availability', '$preferredModes', '$counselingApproach', '$counselingTechniques', '$website', '$linkedin', '$facebook', '$instagram', '$whatsapp', '$testimonials')";

    if (mysqli_query($conn, $sql)) {
        // Close database connection
        mysqli_close($conn);
        // Redirect to a success page
        header("Location: success.php");
        exit; // Stop further execution
    } else {
        echo "Error: " . $sql . "<br>" . mysqli_error($conn);
    }

    // Close database connection
    mysqli_close($conn);
}
?>



<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Council Member</title>

    <!-- Bootstrap CSS -->
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">

    <!-- Font Awesome CSS -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">

    <!-- Custom CSS -->
    <style>
        body {
            background-color: #f8f9fa; /* Light Gray */
            color: #343a40; /* Dark Gray */
            font-family: Arial, sans-serif;
        }

        .form-container {
            background-color: #ffffff; /* White */
            border-radius: 10px;
            padding: 20px;
            margin-top: 50px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        .form-container h2 {
            color: #007bff; /* Blue */
            font-weight: bold;
        }

        .form-group label {
            color: #007bff; /* Blue */
            font-weight: bold;
        }

        .btn-primary {
            background-color: #007bff; /* Blue */
            border-color: #007bff; /* Blue */
            font-weight: bold;
        }

        .btn-primary:hover {
            background-color: #0056b3; /* Darker Blue */
            border-color: #0056b3; /* Darker Blue */
        }

        .form-group .input-group-prepend span {
            color: #007bff; /* Blue */
            font-size: 1.25rem;
        }
    </style>
</head>

<body>

    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-6 form-container">
                <h2 class="text-center mb-4">Add Council Member</h2>
                <!-- Add Council Form -->
                <form action="add_councils.php" method="POST" enctype="multipart/form-data">
                    <div class="form-group">
                        <label for="firstName">firstName:</label>
                        <input type="text" class="form-control" id="firstName" name="firstName" required>
                    </div>
                    <div class="form-group">
                        <label for="firstName">middleName:</label>
                        <input type="text" class="form-control" id="middleName" name="middleName" required>
                    </div>
                    <div class="form-group">
                        <label for="firstName">lastName:</label>
                        <input type="text" class="form-control" id="lastName" name="lastName" required>
                    </div>
                    <div class="form-group">
                        <label for="professionalTitle">Professional Title:</label>
                        <input type="text" class="form-control" id="professionalTitle" name="professionalTitle">
                    </div>
                    <div class="form-group">
                        <label for="qualifications">Qualifications:</label>
                        <div class="custom-file">
                            <input type="file" class="custom-file-input" id="qualifications" name="qualifications" placeholder="(e.g., Degrees, Certifications)" required>
                            <label class="custom-file-label" for="qualifications">Choose file...</label>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="licenseNumber">License Number:</label>
                        <input type="text" class="form-control" id="licenseNumber" name="licenseNumber" placeholder="(If applicable)">
                    </div>
                    <div class="form-group">
                        <label for="areasOfExpertise">Areas of Expertise:</label>
                        <input type="text" class="form-control" id="areasOfExpertise" name="areasOfExpertise" placeholder="(e.g., Cancer counseling, Psychotherapy)">
                    </div>
                    <div class="form-group">
                        <label for="yearsOfExperience">Years of Experience:</label>
                        <input type="number" class="form-control" id="yearsOfExperience" name="yearsOfExperience">
                    </div>
                    <div class="form-group">
                        <label for="training">Specialized Training:</label>
                        <input type="text" class="form-control" id="training" name="training">
                    </div>
                    <div class="form-group">
                        <label for="email">Email Address:</label>
                        <input type="email" class="form-control" id="email" name="email" required>
                    </div>
                    <div class="form-group">
                        <label for="phoneNumber">Phone Number:</label>
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <span class="input-group-text"><i class="fas fa-phone"></i></span>
                            </div>
                            <input type="tel" class="form-control" id="phoneNumber" name="phoneNumber" required>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="officeAddress">Office Address:</label>
                        <input type="text" class="form-control" id="officeAddress" name="officeAddress">
                    </div>
                    <div class="form-group">
                        <label for="availability">Availability:</label>
                        <input type="text" class="form-control" id="availability" name="availability" placeholder="(Avilable time for councelling session)">
                    </div>
                    <div class="form-group">
                        <label for="preferredModes">Preferred Modes of Counseling:</label>
                        <input type="text" class="form-control" id="preferredModes" name="preferredModes" placeholder="(in-person, phone, video call)">
                    </div>
                    <div class="form-group">
                        <label for="counselingApproach">Counseling Approach:</label>
                        <input type="text" class="form-control" id="counselingApproach" name="counselingApproach" placeholder="(e.g., Cognitive-Behavioral Therapy, Person-Centered Therapy)">
                    </div>
                    <div class="form-group">
                        <label for="counselingTechniques">Counseling Techniques:</label>
                        <input type="text" class="form-control" id="counselingTechniques" name="counselingTechniques">
                    </div>
                    <div class="form-group">
                        <label for="website">Professional Website or Profile:</label>
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <span class="input-group-text"><i class="fas fa-globe"></i></span>
                            </div>
                            <input type="url" class="form-control" id="website" name="website">
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
                            <input type="url" class="form-control" id="linkedin" name="linkedin" placeholder="LinkedIn">
                            <input type="url" class="form-control" id="facebook" name="facebook" placeholder="Facebook">
                            <input type="url" class="form-control" id="instagram" name="instagram" placeholder="Instagram">
                            <input type="url" class="form-control" id="whatsapp" name="whatsapp" placeholder="WhatsApp">
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="testimonials">Testimonials:</label>
                        <textarea class="form-control" id="testimonials" name="testimonials" placeholder="testomials from previous clients" rows="3"></textarea>
                    </div>
                    <div class="form-group">
                        <label for="profilePicture">Profile Picture:</label>
                        <div class="custom-file">
                            <input type="file" class="custom-file-input" id="profilePicture" name="profilePicture" required>
                            <label class="custom-file-label" for="profilePicture">Choose file...</label>
                        </div>
                    </div>
                    <button type="submit" class="btn btn-primary btn-block">Add Council</button>
                </form>
            </div>
        </div>
    </div>

    <!-- Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>

</html>
