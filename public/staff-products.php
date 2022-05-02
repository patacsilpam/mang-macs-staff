<?php
require 'public/connection.php';
require 'public/staff-inventory.php';
date_default_timezone_set('Asia/Manila');
function insertProducts(){
    require 'public/connection.php';
    if(isset($_SERVER["REQUEST_METHOD"]) == "POST"){
        if (isset($_POST['btn-save-products'])) {
            $id = mysqli_real_escape_string($connect, $_POST['id']);
            $code = bin2hex(random_bytes(20));
            $productName = mysqli_real_escape_string($connect, $_POST['productName']);
            $productCategory = mysqli_real_escape_string($connect, $_POST['productCategory']);
            $productVariation = mysqli_real_escape_string($connect, $_POST['productVariation']);
            $status = mysqli_real_escape_string($connect, $_POST['status']);
            $price = mysqli_real_escape_string($connect, $_POST['productPrice']);
            $productImage = basename($_FILES['imageProduct']['name'] ?? '');
            $imageTemp = $_FILES['imageProduct']['tmp_name'] ?? '';
            $imageServerUrl = "http://192.168.1.14/MangMacs/assets/img-products/".$productImage;
            $created_at = date('Y-m-d h:i:s');
            $imageFolderPath = "assets/img-products/".$productImage;
            move_uploaded_file($imageTemp,$imageFolderPath);
            //insert product
            $insertProduct = $connect->prepare("INSERT tblproducts(id,code,productName,productCategory,productVariation,status,price,productImage,created_at)
                VALUES(?,?,?,?,?,?,?,?,?)");
            $insertProduct->bind_param('isssssiss', $id,$code, $productName, $productCategory, $productVariation, $status, $price, $imageServerUrl, $created_at);
            $insertProduct->execute();
            //check if true
            if ($insertProduct) {
                header('Location:products.php?insert-successfully');
            }
        }
    }
}
function updateProducts(){
    require 'public/connection.php';
    if(isset($_SERVER["REQUEST_METHOD"]) == "POST"){
        if (isset($_POST['btn-update-products'])) {
            $id = mysqli_real_escape_string($connect, $_POST['id']);
            $editProductName = mysqli_real_escape_string($connect, $_POST['editProductName']);
            $editProductCategory = mysqli_real_escape_string($connect, $_POST['editProductCategory']);
            $editProductVariation = mysqli_real_escape_string($connect, $_POST['editProductVariation']);
            $editStatus = mysqli_real_escape_string($connect, $_POST['editStatus']);
            $editPrice = mysqli_real_escape_string($connect, $_POST['editProductPrice']);
            $editImageProduct = basename( $_FILES['editImageProduct']['name'] ?? '');
            $editImageProductTemp = $_FILES["editImageProduct"]["tmp_name"] ?? '';
            $imageFolderPath = "assets/img-products/".$editImageProduct;
            $imageServerUrl = "http://192.168.1.14/MangMacs/assets/img-products/".$editImageProduct;
            $edited_at = date('Y-m-d h:i:s');
          
            if  ($editImageProduct  != '') {
                //update product
                $updateProduct = $connect->prepare("UPDATE tblproducts SET productName=?,productCategory=?,productVariation=?,status=?,price=?,productImage=?,created_at=? WHERE id=?");
                $updateProduct->bind_param('ssssissi', $editProductName, $editProductCategory, $editProductVariation, $editStatus, $editPrice, $imageServerUrl, $edited_at, $id);
                $updateProduct->execute();
                if ($updateProduct) {
                    move_uploaded_file($editImageProductTemp,$imageFolderPath);
                    header('Location:products.php?update-successfully');
                }
            } else {
                //check image product
                $check_image_product = $connect->prepare("SELECT * FROM tblproducts WHERE id=?");
                $check_image_product->bind_param('i', $id);
                $check_image_product->execute();
                $row = $check_image_product->get_result();
                $fetch = $row->fetch_assoc();
                $editProductImage = $fetch['productImage'];
                //update product
                $updateProduct = $connect->prepare("UPDATE tblproducts SET productName=?,productCategory=?,productVariation=?,status=?,price=?,productImage=?,created_at=? WHERE id=?");
                $updateProduct->bind_param('ssssissi', $editProductName, $editProductCategory, $editProductVariation, $editStatus, $editPrice,  $editProductImage, $edited_at, $id);
                $updateProduct->execute();
                if ($updateProduct) {
                    header('Location:products.php?');
                }
            }
        }
    }
}
function deleteProducts(){
    require 'public/connection.php';
    if(isset($_SERVER["REQUEST_METHOD"]) == "POST"){
        if (isset($_POST['btn-delete-products'])) {
            $id = mysqli_real_escape_string($connect, $_POST['id']);
            $deleteProduct = $connect->prepare("DELETE FROM tblproducts WHERE id=?");
            $deleteProduct->bind_param('i', $id);
            $deleteProduct->execute();
            //alter table id
            $alterTable = "ALTER TABLE tblproducts AUTO_INCREMENT=1";
            $alter = $connect->query($alterTable);
            if ($alter) {
                header('Location:products.php?');
            }
        }
    }
}
insertProducts();
updateProducts();
deleteProducts();
?>