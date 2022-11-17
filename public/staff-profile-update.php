<?php

require 'public/connection.php';
require 'public/staff-inventory.php';
//update form

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        if (isset($_POST['btn-update-account'])) {
            $id = mysqli_real_escape_string($connect, $_POST['number']);
            $fname = mysqli_real_escape_string($connect, $_POST['fname']);
            $lname = mysqli_real_escape_string($connect, $_POST['lname']);
            $email = mysqli_real_escape_string($connect, $_POST['email']);
            $uname = mysqli_real_escape_string($connect, $_POST['uname']);
            $position = mysqli_real_escape_string($connect, $_POST['position']);
            $staffImg = basename($_FILES['adminImage']['name'] ?? '');
            $staffImgTemp = $_FILES['adminImage']['tmp_name'] ?? '';
            $imgUserDecodeUrl = "http://192.168.1.70/mang-macs-staff-web/assets/user-profile-pic/".$staffImg;
            $targetFilePath =  "assets/user-profile-pic/".$staffImg; //file upload path
            move_uploaded_file($staffImgTemp, $targetFilePath);
           
            if (!empty($staffImgTemp)) {
                $check_admin_profile = $connect->prepare("SELECT * FROM tblusers WHERE id=?");
                $check_admin_profile->bind_param('i', $id);
                $check_admin_profile->execute();
                $row = $check_admin_profile->get_result();
                $fetch = $row->fetch_assoc();
                $userProfilePic = (empty($staffImgTemp)) ? $fetch['profile'] : $imgUserDecodeUrl;
                //update user's profile
                $update_admin_profile = $connect->prepare("UPDATE tblusers SET fname=?,lname=?,uname=?,email=?,profile=?,position=? WHERE id=?");
                $update_admin_profile->bind_param('ssssssi', $fname, $lname, $uname, $email, $userProfilePic, $position,$id);
                $update_admin_profile->execute();
                if ($update_admin_profile) {  
                    header('Location:profile.php?updated');
                } else{
                    header('Location:profile.php?error');
                }
            } else {
                //update user's profile
                $update_admin_profile = $connect->prepare("UPDATE tblusers SET fname=?,lname=?,uname=?,email=?,position=? WHERE id=?");
                $update_admin_profile->bind_param('sssssi', $fname, $lname, $uname, $email, $position ,$id);
                $update_admin_profile->execute();
                if ($update_admin_profile) {  
                    header('Location:profile.php?updated');
                } else{
                    header('Location:profile.php?error');
                }
            }
        }
    }