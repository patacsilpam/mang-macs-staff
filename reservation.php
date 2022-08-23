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
                                    <th scope="col">Date</th>
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
                                    $time = date('h:i a');
                                    $queryReservation = $connect->query("SELECT * FROM tblreservation 
                                    WHERE STR_TO_DATE(CONCAT(scheduled_date,' ', scheduled_time),'%Y-%m-%d %h:%i %p') 
                                    >= DATE_SUB(now(),INTERVAL 30 minute) AND status != 'Cancelled' AND status != 'No Shows'
                                    ORDER BY STR_TO_DATE(CONCAT(scheduled_date,' ', scheduled_time),'%Y-%m-%d %h:%i %p') ASC");
                                    while($fetch = $queryReservation->fetch_assoc()){
                                        "SELECT COUNT(*) as 'active_booking' FROM tblreservation WHERE scheduled_date >= CURDATE() AND scheduled_time >=?"
                                   ?>
                                <tr>
                                    <td><?= $fetch['id']?></td>
                                    <td><?= $fetch['created_at']?></td>
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
                                    <button title="View Details" type="button" class="btn btn-primary" data-toggle="modal" data-target="#viewTable<?= $fetch['id']; ?>">
                                        <i class="fas fa-eye"></i>
                                    </button>  
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