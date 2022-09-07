<?php 
require 'public/staff-inventory.php'; 
require 'public/staff-reservation.php'; 
?>
<!DOCTYPE html>
<html lang="en-us">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="Inventory" content="Mang Macs-Reservation">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://kit.fontawesome.com/a076d05399.js" crossorigin="anonymous"></script>
    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdn.datatables.net/1.10.25/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.10.25/js/dataTables.bootstrap4.min.js"></script>
    <link rel="stylesheet" href="https://cdn.datatables.net/1.10.25/css/dataTables.bootstrap4.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/css/bootstrap.min.css">
    <link rel="icon" type="image/jpeg" href="assets/images/mang-macs-logo.jpg" sizes="70x70">
    <link rel="stylesheet" href="assets/css/main.css">
    <title>Reservation</title>
</head>

<body>
    <div class="grid-container">
        <!--header-->
        <header class="nav-container">
            <h3>Reservation</h3>
            <ul class="nav-list">
                <?php include 'assets/template/navbar.php'?>
            </ul>
        </header>
        <!--Inventory Container-->
        <main class="main-container">
            <section>
                <article>
                    <div class="table-responsive table-container">
                        <table id="example" class="table table-hover">
                            <thead class="thead-dark">
                                <tr>
                                    <th scope="col">#</th>
                                    <th scope="col">Date Schedule</th>
                                    <th scope="col">Name</th>
                                    <th scope="col">Email</th>
                                    <th scope="col">Guests</th>
                                    <th scope="col">Status</th>
                                    <th scope="col">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                    require 'public/connection.php';
                                    date_default_timezone_set("Asia/Manila");
                                    $queryReservation = $connect->query("SELECT DISTINCT(tblorderdetails.order_number),tblreservation.id, 
                                    tblreservation.token,tblorderdetails.created_at, tblreservation.fname,tblreservation.lname,
                                    tblreservation.guests,tblreservation.status,
                                    tblreservation.scheduled_date, tblreservation.scheduled_time, tblreservation.email,
                                    tblorderdetails.order_status, tblorderdetails.order_type
                                    FROM tblreservation LEFT JOIN tblorderdetails ON 
                                    tblreservation.refNumber = tblorderdetails.order_number 
                                    WHERE tblreservation.status IN ('Pending','Reserved') AND tblorderdetails.order_type = 'Dine In' 
                                    AND STR_TO_DATE(CONCAT(tblreservation.scheduled_date,' ', tblreservation.scheduled_time),'%Y-%m-%d %h:%i %p') >= DATE_SUB(CURDATE(), INTERVAL 30 MINUTE)
                                    GROUP BY tblorderdetails.order_number
                                    ORDER BY STR_TO_DATE(CONCAT(.tblreservation.scheduled_date,' ',tblreservation.scheduled_time),'%Y-%m-%d %h:%i %p') ASC");
                                    while($fetch = $queryReservation->fetch_assoc()){
                                   ?>
                                <tr>
                                    <td><?= $fetch['order_number']?></td>
                                    <td><?= $fetch['scheduled_date']?> <br> <?=$fetch['scheduled_time']?></td>
                                    <td><?= $fetch['fname'] ?> <?=$fetch['lname']?></td>
                                    <td><?= $fetch['email']?></td>
                                    <td><?= $fetch['guests']?></td>
                                    <td>
                                        <input type="text"  class="order-status" value="<?=$fetch['status']?>">
                                        <button title="Edit" type="button" class="btn btn-transparent"
                                            data-toggle="modal" data-target="#editUsers<?= $fetch['id'] ?>"><i
                                                class="fas fa-edit" style="color: blue;"></i></button>
                                        <?php include 'assets/template/bookingStatus.php' ?>
                                    </td>
                                    <td>
                                        <a href='reservation_summary.php?order_number=<?= $fetch['order_number'];?>' title="View Order Details">
                                            <button class="btn btn-primary"><i class="fas fa-eye"></i></button>
                                        </a>
                                    </td>
                                </tr>
                                <?php
                                    }
                                ?>
                            </tbody>
                        </table>
                    </div>
                </article>
            </section>
        </main>
        <!--Sidebar-->
        <?php include 'assets/template/sidebar.php' ?>
    </div>
    <script src="assets/js/sidebar-menu-active.js"></script>
    <script src="assets/js/activePage.js"></script>
    <script src="assets/js/table.js"></script>
    <script src="assets/js/highlight-order-status.js"></script>
</body>

</html>