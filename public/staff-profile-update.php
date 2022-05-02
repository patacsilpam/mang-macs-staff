<?php
error_reporting(0);
require 'public/staff-inventory.php';
//update form
function updateAccount(){
    require 'public/connection.php';
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        if (isset($_POST['btn-update-account'])) {
            $id = mysqli_real_escape_string($connect, $_POST['number']);
            $fname = mysqli_real_escape_string($connect, $_POST['fname']);
            $lname = mysqli_real_escape_string($connect, $_POST['lname']);
            $email = mysqli_real_escape_string($connect, $_POST['email']);
            $uname = mysqli_real_escape_string($connect, $_POST['uname']);
            $staffImage = basename($_FILES['adminImage']['name'] ?? '');
            $staffImageTemp = $_FILES['adminImage']['tmp_name'] ?? '';
            $imageserverUrl = "http://192.168.1.14/MangMacs/assets/users-image/".$staffImage;
            $position = mysqli_real_escape_string($connect, $_POST['position']);
            //file upload path
            $targetFilePath = "assets/users-image/".$staffImage;
            move_uploaded_file( $staffImageTemp, $targetFilePath);
            if ($staffImageTemp != '') {
                $update_admin_profile = $connect->prepare("UPDATE tblusers SET fname=?,lname=?,uname=?,email=?,profile=?,position=? WHERE id=?");
                $update_admin_profile->bind_param('ssssssi', $fname, $lname, $uname, $email,$imageserverUrl, $position, $id);
                $update_admin_profile->execute();
                if ($update_admin_profile) {
                    header('Location:profile.php?msg-updated');
                }
            } else {
                $check_admin_profile = $connect->prepare("SELECT * FROM tblusers WHERE id=?");
                $check_admin_profile->bind_param('i', $id);
                $check_admin_profile->execute();
                $row = $check_admin_profile->get_result();
                $fetch = $row->fetch_assoc();
                $fetchImage = $fetch['profile'];
                //update
                $update_admin_profile = $connect->prepare("UPDATE tblusers SET fname=?,lname=?,uname=?,email=?,profile=?,position=? WHERE id=?");
                $update_admin_profile->bind_param('ssssssi', $fname, $lname, $uname, $email, $fetchImage, $position, $id);
                $update_admin_profile->execute();
                if ($update_admin_profile) {
                    header('Location:profile.php');
                }
            }
        }
    }
}
updateAccount();