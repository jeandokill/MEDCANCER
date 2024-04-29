<?php
include("security.php");
$connection = mysqli_connect("localhost", "root", "", "event");



if (isset($_POST['registerbtn'])) {
    // Registration logic
    $username = $_POST['username'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $cpassword = $_POST['confirmpassword'];
    $usertype = $_POST['usertype'];

    if ($password === $cpassword) {
        $query = "INSERT INTO register (username, email, password, usertype) VALUES ('$username', '$email','$cpassword', '$usertype')";
        $query_run = mysqli_query($connection, $query);

        if ($query_run) {
            $_SESSION['success'] = "Admin Profile Added";
            header('Location: register.php');
        } else {
            $_SESSION['status'] = "Admin Profile Not Added";
            header("Location: register.php");
        }
    } else {
        $_SESSION['status'] = "Password and Confirm Password Do Not Match";
        header('Location: register.php');
    }
}



if (isset($_POST['updatebtn'])) {
    // Update logic
    $id = $_POST['edit_id'];
    $username = $_POST['edit_username'];
    $email = $_POST['edit_email'];
    $password = $_POST['edit_password'];
    $userupdate = $_POST['update_usertype'];

    $query = "UPDATE register SET username= '$username', email='$email', password = '$password',  usertype = '$userupdate' WHERE id = '$id' ";
    $query_run = mysqli_query($connection, $query);

    if ($query_run) {
        $_SESSION["success"] = " YOUR DATA IS UPDATED";
        header("LOCATION: register.php");
    } else {
        $_SESSION["status"] = "YOUR DATA IS NOT UPDATED";
        header("LOCATION: register.php");
    }
}



if (isset($_POST["delete_btn"])) {
    // Delete logic
    $id = $_POST["delete_id"];
    $query = "DELETE FROM register WHERE id= '$id' ";
    $query_run = mysqli_query($connection, $query);

    if ($query_run) {
        $_SESSION["success"] = "YOUR DATA IS DELETED SUCCESSFULLY";
        header("LOCATION: register.php");
    } else {
        $_SESSION["status"] = "YOUR DATA IS NOT DELETED";
        header("LOCATION: register.php");
    }
}




if (isset($_POST["login_btn"])) {
    // Login logic
    $email_login = $_POST["email"];
    $password_login = $_POST["password"];

    $query = "SELECT * FROM register WHERE email='$email_login' AND password= '$password_login' ";
    $query_run = mysqli_query($connection, $query);

    if (mysqli_fetch_array($query_run)) {
        $_SESSION["username"] = $email_login;
        header("LOCATION: index.php");
    } else {
        $_SESSION["status"] = 'Email id/password is Invalid';
        header('LOCATION: login.php');
    }
}



if (isset($_POST['about_btn'])) 
{
    $title = $_POST['title'];
    $subtitle = $_POST['subtitle'];
    $content = $_POST['content'];


    $query ="INSERT INTO about_section (title, subtitle, content) VALUES ('$title', '$subtitle','$content') ";
    $query_run = mysqli_query($connection, $query);


    if ($query_run)
    {
        $_SESSION["success"] = "about us section added";
        header("LOCATION: ../Home/index.php");
    }
    else
    {
        $_SESSION["status"] = "about us section not added";
        header("LOCATION:  about.php");
    }
}

if (isset($_POST["update_btn"]))
{
    $id = $_POST["edit_id"];
    $title = $_POST["edit_title"];
    $subtitle = $_POST["edit_subtitle"];
    $content = $_POST["edit_content"];

    $query ="UPDATE about_section SET title= '$title', subtitle='$subtitle', content = '$content' WHERE id = '$id' ";
    $query_run = mysqli_query($connection, $query);

    if ($query_run)
    {
        $_SESSION["success"] = "your data is updated";
        header("LOCATION: about.php");
    }
    else
    {
        $_SESSION["status"] = "your data is not updated";
        header("LOCATION: about.php");
    }
}


if (isset($_POST["delete_btn"])) {
    // Delete logic
    $id = $_POST["delete_id"];
    $query = "DELETE FROM about_section WHERE id= '$id' ";
    $query_run = mysqli_query($connection, $query);

    if ($query_run) {
        $_SESSION["success"] = "YOUR DATA IS DELETED SUCCESSFULLY";
        header("LOCATION: about.php");
    } else {
        $_SESSION["status"] = "YOUR DATA IS NOT DELETED";
        header("LOCATION: about.php");
    }
}


?>




