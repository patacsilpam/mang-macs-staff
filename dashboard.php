<?php require 'public/staff-inventory.php'; require 'public/staff-count-orders.php'?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.7.3/Chart.js"></script>
    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.7.3/Chart.js"></script>
    <script src="https://kit.fontawesome.com/4adbff979d.js" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/css/bootstrap.min.css">
    <link rel="icon" type="image/jpeg" href="assets/images/mang-macs-logo.jpg" sizes="70x70">
    <link rel="stylesheet" href="assets/css/main.css" type="text/css">
    <title>Dashboard</title>
</head>

<body>
    <div class="grid-container">
        <!--header-->
        <header class="nav-container">
            <h3 class="mx-2 font-weight-normal">Dashboard</h3>
            <ul class="nav-list">
                <?php include 'assets/template/navbar.php'?>
            </ul>
        </header>
        <!--Inventory Container-->
        <main class="main-container">
            <!--Row 1--->
            <article class="sales-order-container">
                <!--Chart for orders-->
                <section class="sales-report-orders">
                    <!---Active Order--->
                    <section>
                        <section class="box-orders">
                            <h3>New Order</h3>
                            <section class="view-sales-details">
                                <p class="text--active"><?php countActiveOrders();?></p>
                                <a href="orders.php" title="View Details">View</a>
                            </section>
                        </section>
                    </section>
                      <!--New Reservation---->
                      <section>
                        <section class="box-orders">
                            <h3>New Reservation</h3>
                            <section class="view-sales-details">
                                <p class="text--active"><?php countActiveBooking() ?></p>
                                <a href="reservation.php" title="View Details">View</a>
                            </section>
                        </section>
                    </section>
                </section>
            </article>
          
        </main>
        <?php include 'assets/template/sidebar.php'?>
    </div>
    <script src="assets/js/sidebar-menu-active.js"></script>
    <script src="assets/js/activePage.js"></script>
</body>

</html>