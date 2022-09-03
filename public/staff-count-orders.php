<?php
function countActiveOrders(){
    require 'public/connection.php';
    $orderCompleted = "Order Completed";
    $orderReceived = "Order Received";
    $orderCancelled = "Cancelled";
    $orderType = "Dine In";
    $count = $connect->prepare("SELECT SUM(COUNT(DISTINCT order_number)) OVER() as 'active_orders' 
    FROM tblorderdetails WHERE order_status != ? AND order_status!=? AND order_status!=? AND order_type != ?
    GROUP BY order_number");
    $count->bind_param('ssss',$orderCompleted,$orderReceived,$orderCancelled,$orderType);
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
//count new table reservation(pending and reserved)
function countActiveBooking(){
    require 'public/connection.php';
    date_default_timezone_set("Asia/Manila");
    $bookPending = "Pending";
    $bookReserved = "Reserved";
    $count = $connect->prepare("SELECT COUNT(*) as 'active_booking' FROM tblreservation 
    WHERE  status=? AND status=? AND
    STR_TO_DATE(CONCAT(scheduled_date,' ', scheduled_time),'%Y-%m-%d %h:%i %p') >= DATE_SUB(CURDATE(), INTERVAL 30 MINUTE)");
    $count->bind_param('ss',$bookPending,$bookReserved);
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