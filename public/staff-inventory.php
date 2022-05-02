<?php
require 'public/connection.php';
session_start();
if (!isset($_SESSION['staff-loggedIn'])) {
    header('Location:login.php');
}
$fetchNotif="";
date_default_timezone_set('Asia/Manila');
//add inventory item
function insertStock(){
    require 'public/connection.php';
    if(isset($_SERVER["REQUEST_METHOD"]) == "POST"){
        if(isset($_POST["btn-save-inventory"])){
            if (isset($_POST["btn-save-inventory"])) {
                $id = mysqli_real_escape_string($connect, $_POST['id']);
                $created_at = date('y-m-d');
                $expirationDate = mysqli_real_escape_string($connect, $_POST['expirationDate']);
                $product = mysqli_real_escape_string($connect, $_POST['product']);
                $quantityPurchased = mysqli_real_escape_string($connect, $_POST['quantityPurchased']);
                $quantityInStock = $quantityPurchased;
                $quantitySold = 0;
                $status = mysqli_real_escape_string($connect, $_POST['status']);
                $inCharge = mysqli_real_escape_string($connect, $_POST['incharge']);
                //insert inventory
                $insertInventory = $connect->prepare("INSERT tblinventory(id,expiration_date,created_at,product,quantityPurchased,quantityInStock,quantitySold,status,in_charge)
                VALUES (?,?,?,?,?,?,?,?,?)");
                $insertInventory->bind_param('isssiiiss', $id, $expirationDate, $created_at, $product, $quantityPurchased, $quantityInStock, $quantitySold, $status, $inCharge);
                $insertInventory->execute();
                if ($insertInventory) {
                    header('Location:inventory.php?insert-successfully');
                }
            }
        }
    }
}
function editStock(){
    require 'public/connection.php';
    if (isset($_SERVER["REQUEST_METHOD"]) == "POST") {
        if (isset($_POST["btn-edit-inventory"])) {
            $id = mysqli_real_escape_string($connect, $_POST['id']);
            $created_at = date('y-m-d');
            $expirationDate = mysqli_real_escape_string($connect, $_POST['expirationDate']);
            $product = mysqli_real_escape_string($connect, $_POST['product']);
            $quantityPurchased = mysqli_real_escape_string($connect, $_POST['quantityPurchased']);
            $quantityInStock = mysqli_real_escape_string($connect, $_POST['quantityInStock']);
            $quantitySold = $quantityPurchased - $quantityInStock;
            $status = mysqli_real_escape_string($connect, $_POST['status']);
            $inCharge = mysqli_real_escape_string($connect, $_POST['incharge']);
            //insert inventory
            if (!empty($expirationDate) && !empty($product) && !empty($quantityPurchased) && !empty($quantityInStock) && !empty($status) && !empty($inCharge)) {
                $updateInventory = $connect->prepare("UPDATE tblinventory SET expiration_date=?,product=?,quantityPurchased=?,quantityInStock=?,quantitySold=?,status=?,in_charge=? WHERE id=?");
                $updateInventory->bind_param('ssiiissi', $expirationDate, $product, $quantityPurchased, $quantityInStock, $quantitySold, $status, $inCharge, $id);
                $updateInventory->execute();
                if ($updateInventory) {
                    header('Location:inventory.php?update-successfully');
                }
            }
        }
    }
}
function deleteStock(){
    require 'public/connection.php';
    if(isset($_SERVER["REQUEST_METHOD"]) == "POST"){
        if (isset($_POST['btn-delete'])) {
            $id = mysqli_real_escape_string($connect, $_POST['id']);
            $deleteInventory = $connect->prepare("DELETE FROM tblinventory WHERE id=?");
            $deleteInventory->bind_param('i', $id);
            $deleteInventory->execute();
            if ($deleteInventory) {
                //alter table id column
                $alterTable = "ALTER TABLE tblinventory AUTO_INCREMENT = 1";
                $alterTableId = $connect->query($alterTable);
                if ($alterTableId) {
                    header('Location:inventory.php?deleted');
                }
            }
        }
    }
}
function showNotif(){
    require 'public/connection.php';
    $countNotif = "SELECT COUNT(*) FROM
                (SELECT * FROM tblinventory WHERE expiration_date < now()
                 UNION ALL
                SELECT * FROM tblinventory WHERE expiration_date BETWEEN curdate() AND DATE_ADD(curdate(), INTERVAL 7 DAY)) tblinventory";
    $displayNotif = $connect->query($countNotif);
$GLOBALS['fetchNotif'] = $displayNotif->fetch_row();
}
insertStock();
editStock();
deleteStock();
showNotif();