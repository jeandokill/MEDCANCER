<?php
// Include database connection file
include_once "db_connect.php";

// Check if form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve council ID from the form
    if(isset($_POST['council_id'])) {
        $council_id = $_POST['council_id'];

        // Retrieve other form data
        $firstName = $_POST['firstName'];
        $middleName = $_POST['middleName'];
        $lastName = $_POST['lastName'];
        $professionalTitle = $_POST['professionalTitle'];
        $qualifications = isset($_POST['qualifications']) ? $_POST['qualifications'] : '';
        $licenseNumber = $_POST['licenseNumber'];
        $areasOfExpertise = $_POST['areasOfExpertise'];
        $yearsOfExperience = $_POST['yearsOfExperience'];
        $training = $_POST['training'];
        $email = $_POST['email'];
        $phoneNumber = $_POST['phoneNumber'];
        $officeAddress = $_POST['officeAddress'];
        $availability = $_POST['availability'];
        $preferredModes = $_POST['preferredModes'];
        $counselingApproach = $_POST['counselingApproach'];
        $counselingTechniques = $_POST['counselingTechniques'];
        $website = $_POST['website'];
        $linkedin = $_POST['linkedin'];
        $facebook = $_POST['facebook'];
        $instagram = $_POST['instagram'];
        $whatsapp = $_POST['whatsapp'];
        $testimonials = $_POST['testimonials'];
        $profilePicture = isset($_POST['profilePicture']) ? $_POST['profilePicture'] : '';

       // Update council information in the database
       $sql = "UPDATE councils SET 
       firstName = ?,
       middleName = ?,
       lastName = ?,
       professionalTitle = ?,
       qualifications = ?,
       licenseNumber = ?,
       areasOfExpertise = ?,
       yearsOfExperience = ?,
       training = ?,
       email = ?,
       phoneNumber = ?,
       officeAddress = ?,
       availability = ?,
       preferredModes = ?,
       counselingApproach = ?,
       counselingTechniques = ?,
       website = ?,
       linkedin = ?,
       facebook = ?,
       instagram = ?,
       whatsapp = ?,
       testimonials = ?,
       profilePicture = ?
       WHERE id = ?";

       // Prepare the statement
       $stmt = mysqli_prepare($conn, $sql);

       if ($stmt) {
           // Bind parameters to the statement
           mysqli_stmt_bind_param($stmt, "sssssssssssssssssssssssi", $firstName, $middleName, $lastName, $professionalTitle, $qualifications, $licenseNumber, $areasOfExpertise, $yearsOfExperience, $training, $email, $phoneNumber, $officeAddress, $availability, $preferredModes, $counselingApproach, $counselingTechniques, $website, $linkedin, $facebook, $instagram, $whatsapp, $testimonials, $profilePicture, $council_id);

           // Execute the statement
           if (mysqli_stmt_execute($stmt)) {
               // Council information updated successfully
               echo "Council information updated successfully";
           } else {
               // Error occurred while updating council information
               echo "Error: " . mysqli_error($conn);
           }

           // Close statement
           mysqli_stmt_close($stmt);
       } else {
           // Error occurred while preparing the statement
           echo "Error: " . mysqli_error($conn);
       }

       // Close database connection
       mysqli_close($conn);

   } else {
       // Redirect to error page if council ID is not provided
       header("Location: error.php");
       exit();
   }
} else {
   // Redirect to error page if accessed directly
   header("Location: error.php");
   exit();
}
?>