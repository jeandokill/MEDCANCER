<?php
include("security.php");

$connection = mysqli_connect("localhost", "root", "", "event");

if (isset($_POST["login_btn"])) {
    $email_login = $_POST['email'];
    $password_login = $_POST['password'];
   

    $query = "SELECT * FROM register WHERE email = '$email_login' AND password = '$password_login' ";

    $query_run = mysqli_query($connection, $query);
    $usertypes = mysqli_fetch_array($query_run);

    if ($usertypes['usertype'] == "admin")
     {

        $_SESSION['username'] = $email_login;
        header('LOCATION: index.php');
         // Redirect to admin dashboard
    } else if ($usertypes['usertype'] == "user")
    {
        $_SESSION["username"] = $email_login;
        header("LOCATION:../Home/index.php"); // Redirect to user dashboard
    } else {
        $_SESSION['status'] = "Email / password is Invalid";
        header("LOCATION: login.php");
    }
}
?>

