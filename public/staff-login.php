<?php
//session_start();
$unameEmailError = $pwordError = "";
function staffLogin(){
    require 'public/connection.php';
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        if (isset($_POST['btnSignin'])) {
            $unameEmail = mysqli_real_escape_string($connect, $_POST['unameEmail']);
            $pword = mysqli_real_escape_string($connect, $_POST['pword']);
            $position = 'Staff';
            //check username and email
            $check_uname_email = $connect->prepare("SELECT * FROM tblusers WHERE uname=? OR email=?");
            $check_uname_email->bind_param('ss', $unameEmail, $unameEmail);
            $check_uname_email->execute();
            $row_uname_email = $check_uname_email->get_result();
            $fetch = $row_uname_email->fetch_assoc();
            if ($row_uname_email->num_rows == 1) {
                if ($pword == $fetch['user_password'] ||  password_verify($pword, $fetch['user_password'])) {
                    if($position == $fetch['position']){
                        $_SESSION['staff-id'] = $fetch['id'];
                        $_SESSION['staff-fname'] = $fetch['fname'];
                        $_SESSION['staff-lname'] = $fetch['lname'];
                        $_SESSION['staff-uname'] = $fetch['uname'];
                        $_SESSION['staff-email'] = $fetch['email'];
                        $_SESSION['staff-loggedIn'] = true;
                        header('Location:orders.php');
                    } else{
                        $GLOBALS['unameEmailError'] = "Username or email not found.";
                    }
                } else {
                    $GLOBALS['pwordError'] = "Incorrect Password.";
                }
            } else {
                $GLOBALS['unameEmailError'] = "Username or email not found.";
            }
        }
    }
}
staffLogin();
?>