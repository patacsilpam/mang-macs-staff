<?php
function countActiveOrders(){
    require 'public/connection.php';
    $orderStatus = "Order Completed";
    $orderType = "Dine In";
    $count = $connect->prepare("SELECT SUM(COUNT(DISTINCT order_number)) OVER() as 'active_orders' FROM tblorderdetails WHERE order_status != ? AND order_type != ? GROUP BY order_number");
    $count->bind_param('ss',$orderStatus,$orderType);
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