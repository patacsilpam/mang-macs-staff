<div class="sidebar">
    <div class="burger" id="menu">
        <i class="fa fa-bars text-white" style="font-size:1.7rem;"></i>
    </div>
    <h1 class="logo">Mang Macs Marinero <br> Pizza House</h1>
    <img class="img-logo" src="assets/images/logo.png" alt="mang macs logo">
    <ul class="sidebar-links">

        <li title="Orders">
            <a href="orders.php"><i class="fas fa-shopping-cart icons"></i><span class="span">Orders</span></a>
        </li>
        <li title="Reservation">
            <a href="reservation.php"><i class="fas fa-ticket-alt icons"></i><span class="span">Reservation</span></a>
        </li>
        <li title="Products">
            <a href="products.php"><i class="fab fa-product-hunt icons"></i><span class="span">Products</span></a>
        </li>
        <li title="POS" class="dropdown show">
            <a class="dropdown-toggle" href="pos.php" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                <i class="fas fa-boxes icons"></i><span class="span">POS</span>
            </a>
            <div class="dropdown-menu" aria-labelledby="dropdownMenuLink">
                <a class="dropdown-item" href="pos.php">POS</a>
                <a class="dropdown-item" href="pos-orders.php">POS Orders</a>
            </div>
        </li>
        <li title="Stocks">
            <a href="inventory.php"><i class="fas fa-boxes icons"></i><span class="span">Inventory</span></a>
        </li>
    </ul>
</div>
</div>
<style>
    .dropdown-menu{
        background-color:#3abd79;
        color: #ffff;
    }
    .dropdown-menu:hover{
        background-color: #3abd79;
        color: #ffff;
    }
    .dropdown-item{
        color: #ffff;
    }
    .dropdown-item:hover{
        color: #ffff;
    }
</style>