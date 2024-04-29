<?php
if(session_status() === PHP_SESSION_NONE)
session_start();
Class MainClass{
    protected $db;
    function __construct(){
        $this->db = new mysqli('localhost','root','','login_otp_db');
        if(!$this->db){
            die("Database Connection Failed. Error: ".$this->db->error);
        }
    }
    function db_connect(){
        return $this->db;
    }







    public function resetPasswordRequest($email) {
        $token = bin2hex(random_bytes(32)); // Generate a unique token
        $expiration = date("Y-m-d H:i", strtotime("+1 hour"));
        $updateSql = "UPDATE `users` SET reset_token = '$token', reset_token_expiration = '$expiration' WHERE email = ?";
        $stmt = $this->db->prepare($updateSql);
        $stmt->bind_param('s', $email);
        $stmt->execute();
    
        if ($stmt->affected_rows > 0) {
            $resetLink = "localhost/Medcancer/login/reset_password.php?token=$token&email=$email";

            $this->sendResetEmail($email, $resetLink);
            return true;
        } else {
            return false;
        }
    }
    
    public function verifyResetToken($token) {
        $sql = "SELECT id FROM `users` WHERE reset_token = ? AND reset_token_expiration > NOW()";
        $stmt = $this->db->prepare($sql);
        $stmt->bind_param('s', $token);
        $stmt->execute();
        $stmt->store_result();
        return $stmt->num_rows > 0;
    }
    
    public function resetPassword($token, $newPassword) {
        $passwordHash = password_hash($newPassword, PASSWORD_DEFAULT);
        $sql = "UPDATE `users` SET password = ?, reset_token = NULL, reset_token_expiration = NULL WHERE reset_token = ?";
        $stmt = $this->db->prepare($sql);
        $stmt->bind_param('ss', $passwordHash, $token);
        $stmt->execute();
    
        if ($stmt->affected_rows > 0) {
            return true;
        } else {
            return false;
        }
    }
    
    private function sendResetEmail($to, $resetLink) {
        if(!empty($to)){
            try{
                $email = 'info@xyzapp.com';
                $headers = 'From:' .$email . '\r\n'. 'Reply-To:' .
                $email. "\r\n" .
                'X-Mailer: PHP/' . phpversion()."\r\n";
                $headers .= "MIME-Version: 1.0" . "\r\n";
                $headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";
                // Generate the clickable link
                $resetLink = "<a href='$resetLink'>$resetLink</a>";
                // the message
                $msg = "
                <html>
                    <body>
                        <h2>Welcome to MEDCACANCER RWANDA, </h2>
                        <p>Here is your reset password link:</p>
                        <h3><b>$resetLink</b></h3>
                    </body>
                </html>
                ";
    
                // send email
                mail($to,"Reset Password",$msg,$headers);
                // die("ERROR<br>".$headers."<br>".$msg);
    
            }catch(Exception $e){
                $_SESSION['flashdata']['type']='danger';
                $_SESSION['flashdata']['msg'] = ' An error occurred while sending the reset password email. Error: '.$e->getMessage();
            }
        }
    }
    



    public function updatePassword($email, $newPassword){
        $password = password_hash($newPassword, PASSWORD_DEFAULT);
        $sql = "UPDATE `users` SET password = ? WHERE email = ?";
        $stmt = $this->db->prepare($sql);
        $stmt->bind_param('ss', $password, $email);
        $result = $stmt->execute();
        if($result){
            return true; // Password updated successfully
        } else {
            return false; // Error updating password
        }
    }
    
    public function register(){
        $resp = array(); // Initialize the response array
    
        // Check if POST variables are set
        if(isset($_POST['firstname'], $_POST['middlename'], $_POST['lastname'], $_POST['email'], $_POST['password'], $_FILES['profile_picture'])) {
            // Escape and assign values to variables
            $firstname = $this->db->real_escape_string($_POST['firstname']);
            $middlename = $this->db->real_escape_string($_POST['middlename']);
            $lastname = $this->db->real_escape_string($_POST['lastname']);
            $email = $this->db->real_escape_string($_POST['email']);
            $password = password_hash($_POST['password'], PASSWORD_DEFAULT);
            
            // File upload
            $targetDir = "uploads/";
            $fileName = basename($_FILES["profile_picture"]["name"]);
            $targetFilePath = $targetDir . $fileName;
            $fileType = pathinfo($targetFilePath, PATHINFO_EXTENSION);
            
            // Allow certain file formats
            $allowTypes = array('jpg','png','jpeg','gif');
            if(in_array($fileType, $allowTypes)){
                // Upload file to server
                if(move_uploaded_file($_FILES["profile_picture"]["tmp_name"], $targetFilePath)){
                    // Insert user details into the database
                    $sql = "INSERT INTO `users` (firstname,middlename,lastname,email,password,profile_picture) VALUES ('$firstname','$middlename','$lastname','$email','$password','$targetFilePath')";
                    $save = $this->db->query($sql);
                    if($save){
                        $resp['status'] = 'success';
                    } else {
                        $resp['status'] = 'failed';
                        $resp['err'] = $this->db->error;
                        $_SESSION['flashdata']['type']='danger';
                        $_SESSION['flashdata']['msg'] = ' An error occurred.';
                    }
                } else {
                    $resp['status'] = 'failed';
                    $_SESSION['flashdata']['type']='danger';
                    $_SESSION['flashdata']['msg'] = ' Failed to upload file.';
                }
            } else {
                $resp['status'] = 'failed';
                $_SESSION['flashdata']['type']='danger';
                $_SESSION['flashdata']['msg'] = ' Only JPG, JPEG, PNG, GIF files are allowed.';
            }
        } else {
            // Handle case where POST variables are not set
            $resp['status'] = 'failed';
            $resp['err'] = 'POST variables are not set';
        }
        return json_encode($resp);
    }
    
    
    public function login(){
        extract($_POST);
        $sql = "SELECT * FROM `users` where `email` = ? ";
        $stmt = $this->db->prepare($sql);
        $stmt->bind_param('s',$email);
        $stmt->execute();
        $result = $stmt->get_result();
        if($result->num_rows > 0){
            $data = $result->fetch_array();
            $pass_is_right = password_verify($password,$data['password']);
            $has_code = false;
            if($pass_is_right && (is_null($data['otp']) || (!is_null($data['otp']) && !is_null($data['otp_expiration']) && strtotime($data['otp_expiration']) < time()) ) ){
                $otp = sprintf("%'.06d",mt_rand(0,999999));
                $expiration = date("Y-m-d H:i" ,strtotime(date('Y-m-d H:i')." +1 mins"));
                $update_sql = "UPDATE `users` set otp_expiration = '{$expiration}', otp = '{$otp}' where id='{$data['id']}' ";
                $update_otp = $this->db->query($update_sql);
                if($update_otp){
                    $has_code = true;
                    $resp['status'] = 'success';
                    $_SESSION['otp_verify_user_id'] = $data['id'];
                    $this->send_mail($data['email'],$otp);
                }else{
                    $resp['status'] = 'failed';
                    $_SESSION['flashdata']['type'] = 'danger';
                    $_SESSION['flashdata']['msg'] = ' An error occurred while loggin in. Please try again later.';
                }
 
            }else if(!$pass_is_right){
               $resp['status'] = 'failed';
               $_SESSION['flashdata']['type'] = 'danger';
               $_SESSION['flashdata']['msg'] = ' Incorrect Password';
            }
        }else{
            $resp['status'] = 'failed';
            $_SESSION['flashdata']['type'] = 'danger';
            $_SESSION['flashdata']['msg'] = ' Email is not registered.';
        }
        return json_encode($resp);
    }
    public function get_user_data($id){
        extract($_POST);
        $sql = "SELECT * FROM `users` where `id` = ? ";
        $stmt = $this->db->prepare($sql);
        $stmt->bind_param('i',$id);
        $stmt->execute();
        $result = $stmt->get_result();
        $dat=[];
        if($result->num_rows > 0){
            $resp['status'] = 'success';
            foreach($result->fetch_array() as $k => $v){
                if(!is_numeric($k)){
                    $data[$k] = $v;
                }
            }
            $resp['data'] = $data;
        }else{
            $resp['status'] = 'false';
        }
        return json_encode($resp);
    }
    public function resend_otp($id){
        $otp = sprintf("%'.06d",mt_rand(0,999999));
        $expiration = date("Y-m-d H:i" ,strtotime(date('Y-m-d H:i')." +1 mins"));
        $update_sql = "UPDATE `users` set otp_expiration = '{$expiration}', otp = '{$otp}' where id = '{$id}' ";
        $update_otp = $this->db->query($update_sql);
        if($update_otp){
            $resp['status'] = 'success';
            $email = $this->db->query("SELECT email FROM `users` where id = '{$id}'")->fetch_array()[0];
            $this->send_mail($email,$otp);
        }else{
            $resp['status'] = 'failed';
            $resp['error'] = $this->db->error;
        }
        return json_encode($resp);
    }
    public function otp_verify(){
        extract($_POST);
         $sql = "SELECT * FROM `users` where id = ? and otp = ?";
         $stmt = $this->db->prepare($sql);
         $stmt->bind_param('is',$id,$otp);
         $stmt->execute();
         $result = $stmt->get_result();
         if($result->num_rows > 0){
             $resp['status'] = 'success';
             $this->db->query("UPDATE `users` set otp = NULL, otp_expiration = NULL where id = '{$id}'");
             $_SESSION['user_login'] = 1;
             foreach($result->fetch_array() as $k => $v){
                 if(!is_numeric($k))
                 $_SESSION[$k] = $v;
             }
         }else{
             $resp['status'] = 'failed';
             $_SESSION['flashdata']['type'] = 'danger';
             $_SESSION['flashdata']['msg'] = ' Incorrect OTP.';
         }
         return json_encode($resp);
    }
    function send_mail($to="",$pin=""){
        if(!empty($to)){
            try{
                $email = 'info@xyzapp.com';
                $headers = 'From:' .$email . '\r\n'. 'Reply-To:' .
                $email. "\r\n" .
                'X-Mailer: PHP/' . phpversion()."\r\n";
                $headers .= "MIME-Version: 1.0" . "\r\n";
                $headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";
                // the message
                $msg = "
                <html>
                    <body>
                        <h2>Welcome to MEDCACANCER RWANDA, </h2>
                        <p>Here is yout OTP (One-Time PIN) to verify your Identity.</p>
                        <h3><b>".$pin."</b></h3>
                    </body>
                </html>
                ";
 
                // send email
                mail($to,"OTP",$msg,$headers);
                // die("ERROR<br>".$headers."<br>".$msg);
 
            }catch(Exception $e){
                $_SESSION['flashdata']['type']='danger';
                $_SESSION['flashdata']['msg'] = ' An error occurred while sending the OTP. Error: '.$e->getMessage();
            }
        }
    }
    function __destruct(){
         $this->db->close();
    }
}
$class = new MainClass();
$conn= $class->db_connect();