<?php
require 'public/staff-inventory.php';
require 'public/staff-pos.php'
?>
<!DOCTYPE html>
<html lang="en-us">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="POS" content="Mang Macs-POS">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
    <script src="https://kit.fontawesome.com/a076d05399.js" crossorigin="anonymous"></script>
    <script src="js/jquery-3.5.1.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/js/bootstrap.bundle.min.js"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/css/bootstrap.min.css">
    <link rel="icon" type="image/jpeg" href="assets/images/mang-macs-logo.jpg" sizes="70x70">
    <link rel="stylesheet" href="assets/css/main.css">
    <title>POS</title>
</head>

<body>
    <div class="grid-container">
        <!--Navigation-->
        <header class="nav-container">
            <h3>POS</h3>
            <ul class="nav-list">
                <?php include 'assets/template/navbar.php'?>
            </ul>
        </header>
        <!--Sales' Categories-->
        <main class="main-container">
            <section>
                <article>
                    <div class="products-container">
                        <div class="add-product-container">    
                        <?php
                            if(isset($_SESSION["cart"])){
                                $total_quantity = 0;
                                $total_price = 0;
                        ?>	
                        <div class="text-business-name">
                            <strong>Mang Mac's Marinero's Pizza House</strong>  
                            <samp>Zone 5, Barangay Sta.Lucia Bypass Road, Urdaneta, Philippines</samp>
                            <em>0905-332-9184</em>
                        </div>
                        <form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF'])?>" method="POST">
                        <div class="table-responsive table-center">
                            <table class="table table-hover">
                                <thead class="thead-dark">
                                    <tr>
                                        <th class="input-name">Product</th> 
                                        <th class="input-cart">Quantity</th>
                                        <th class="input-cart">Price</th>
                                        <th class="input-cart">Subtotal</th>
                                        <th class="input-cart">Variation</th>
                                        <th class="input-cart">Remove</th>
                                    </tr>	
                                </thead>
                                <tbody class="overflow-auto">
                                    <div>
                                    <tr>
                                    <?php		
                                        foreach ($_SESSION["cart"] as $item){
                                            $item_price = $item["quantity"]*$item["price"];
                                             $total_quantity += $item["quantity"];
                                                $total_price += ($item["price"]*$item["quantity"]);
                                            ?>
                                            <tr>
                                                <td class="input-name"><?= $item['name']?></td>
                                                <td class="input-cart"><?=$item["quantity"];?></td> 
                                                <td class="input-cart">₱<?= number_format($item["price"],2); ?></td>
                                                <td class="input-cart">₱<?= number_format($item_price,2); ?></td>
                                                <td class="input-cart"><?= $item["variation"]; ?></td>
                                                <td>
                                                    <a href="pos.php?action=remove&code=<?php echo $item["id"]; ?>"><i class="fas fa-times p-1 mb-2 bg-danger text-white" title="Remove"></i></a>
                                                </td>
                                                <input type="hidden" name="id[]" value="0">
                                                <input type="hidden" name="productName[]" value="<?= $item['name']?>">
                                                <input type="hidden" name="quantity[]" value="<?=$item["quantity"]; ?>" >
                                                <input type="hidden" name="variation[]" value="<?= $item["variation"]; ?>">
                                                <input type="hidden" name="price[]" value="<?= $item["price"]; ?>" >
                                                <input type="hidden" name="subTotal[]" value="<?= $item_price; ?>">
                                                <input type="hidden" name="totalQuantity[]" value="<?= $total_quantity; ?>">
                                                <input type="hidden" name="totalPrice" value="<?= $total_price; ?>">
                                            </tr>
                                            <?php
                                               
                                        }
                                            ?>
                                        <tr>
                                    </div>
                                </tbody>
                            </table>
                        </div>
                            <div class="empty-cart">
                                <table class="table table-bordered">
                                    <tr>
                                        <td>Total:</td>
                                        <td><?= $total_quantity; ?></td>
                                    </tr>	
                                    <tr>
                                        <td>Total Price</td>
                                        <td>₱<?= number_format($total_price,2); ?></td>
                                    </tr>
                                </table>
                                <div class="empty-table-cart-btn">
                                    <a href="pos.php?action=empty" class="btn btn-secondary"><i class="fas fa-table"></i> Empty</a>
                                    <a href="pos.php?action=empty" class="btn btn-danger"><i class="fas fa-window-close"></i> Cancel</a>
                                    <button type="button" class="btn btn-success" data-toggle="modal" data-target="#payModal"><i class="fas fa-file-invoice-dollar"></i> Pay</button>
                                    <?php include 'assets/template/pos-pay.php'?>
                                </div>
                            </div>
                        </form>
                            <?php
                                    
                                } else{
                                ?>
                                <div class="empty-cart">
                                    <div class="text-business-name">
                                        <strong>Mang Mac's Marinero's Pizza House</strong>  
                                        <samp>Zone 5, Barangay Sta.Lucia Bypass Road, Urdaneta, Philippines</samp>
                                        <em>0905-332-9184</em>
                                    </div>
                                    <table class="table table-bordered empty-table">
                                        <tr>
                                            <td>Total items</td>
                                            <td>0</td>
                                        </tr>
                                        <tr>
                                            <td>Total Price</td>
                                            <td>0.00</td>
                                        </tr>
                                    </table>
                                    <div class="empty-table-cart-btn">
                                        <button type="button" class="btn btn-secondary"><i class="fas fa-table"></i> Empty</button>
                                        <button type="button" class="btn btn-danger"><i class="fas fa-window-close"></i> Cancel</button>
                                        <button type="button" class="btn btn-success"><i class="fas fa-save"></i> Pay</button>
                                    </div>
                                </div>
                            <?php
                                }
                            ?>
                                   
                        </div>
                            <?php include 'assets/template/pos.php'?>
                        </div>
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
    <script src="assets/js/tab.js"></script>
</body>

</html>