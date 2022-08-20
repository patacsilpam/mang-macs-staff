<?php
function countActiveOrders(){
    require 'public/connection.php';
    $pending = "Pending";
    $orderReceived = "Order Received";
    $shipped = "Order Processing";
    $readyForPickUp = "Ready For Pick Up";
    $outForDelivery = "Out for Delivery";
    $count = $connect->prepare("SELECT SUM(COUNT(DISTINCT order_number)) OVER() as 'active_orders' FROM tblorderdetails WHERE order_status=? OR order_status=? OR order_status=? OR order_status=? OR order_status=? GROUP BY order_number");
    $count->bind_param('sssss',$pending,$orderReceived,$shipped,$readyForPickUp,$outForDelivery);
    $count->execute();
    $row = $count->get_result();
    $fetch = $row->fetch_assoc();
    if(isset($fetch['active_orders'])){
        echo $countActiveOrder = $fetch['active_orders']; 
    }
    else{
        echo 0;
    }
}
//count new table reservation
function countActiveBooking(){
    require 'public/connection.php';
    date_default_timezone_set("Asia/Manila");
    $time = date('h:i a');
    $count = $connect->prepare("SELECT COUNT(*) as 'active_booking' FROM tblreservation WHERE scheduled_date >= CURDATE()");
   // $count->bind_param('s',$time);
    $count->execute();
    $row = $count->get_result();
    $fetch = $row->fetch_assoc();
   if(isset($fetch['active_booking'])){
        echo $countActiveBooking = $fetch['active_booking']; 
   }
   else{
        echo 0;
   }
}
?>