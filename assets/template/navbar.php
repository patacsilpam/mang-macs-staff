<li class="dropdown">
    <a class="dropdown-toggle" href="#" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
        <i class="fas fa-bell text-primary"><sup><?= $fetchNotif[0] ?></sup></i>
    </a>
    <div class="dropdown-menu dropdown-bell-icon" aria-labelledby="dropdownMenuLink">
        <a class="dropdown-item" href="inventory.php">
            <?php
            $getExpDate = "SELECT * FROM tblinventory WHERE expiration_date < now()";
            $displayExpDate = $connect->query($getExpDate);
            if ($displayExpDate) {
                while ($fetchItem = $displayExpDate->fetch_assoc()) {
                    $expDate = date('F d, Y', strtotime($fetchItem['created_at']));
                    $timeLapse = round(abs(strtotime(date('y-m-d')) - strtotime($fetchItem['expiration_date'])) / (60 * 60 * 24), 0);
            ?>
                    <div class="dropdown-notif">
                        <b>Expired</b>
                        <p class="text-dark">The item<i>( <?= $fetchItem['product'] ?> )</i> you added from <br> <?= $expDate ?> has expired.</p>
                        <p> In charge - <?= $fetchItem['in_charge'] ?></p>
                        <?php if ($timeLapse > 0) {
                            echo $timeLapse . '<small> days ago</small>';
                        } else {
                            echo '<small>Today</small>';
                        } ?>
                        <hr>
                    </div>
                <?php
                }
            }
            $getAboutToExp = "SELECT * FROM tblinventory WHERE expiration_date BETWEEN curdate() AND DATE_ADD(curdate(), INTERVAL 7 DAY)";
            $displayAboutToExp = $connect->query($getAboutToExp);
            if ($displayAboutToExp) {
                while ($fetchItem = $displayAboutToExp->fetch_assoc()) {
                    $date = date('y-m-d');
                    $expDate = date('F d, Y', strtotime($fetchItem['expiration_date']));
                    $today = date('F d, Y', strtotime($fetchItem['created_at']));
                    $timeLapse = round(abs(strtotime(date('y-m-d h:i')) - strtotime($fetchItem['expiration_date'])) / (60 * 60 * 24), 0);

                ?>
                    <div class="dropdown-notif">
                        <b>About to Expire</b>
                        <p class="text-dark">The item <i>( <?= $fetchItem['product'] ?> )</i> you added from <br> <?= $today ?> is about to expire on <br><?= $expDate ?>.</p>
                        <p> In charge - <?= $fetchItem['in_charge'] ?></p>
                        <?php if ($timeLapse > 0) {
                            echo $timeLapse . '<small> day(s) to go</small>';
                        } else {
                            echo '<small>Today</small>';
                        } ?>
                        <hr>
                    </div>
            <?php
                }
            }
            ?>
        </a>
    </div>
</li>
<li><i class="fas fa-cog text-white"></i></li>
<li class="dropdown">
    <button type="button" class="button admin-name-right" style="color: black;" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
        <a href="profile.php" class="text-dark"><?php echo $_SESSION['staff-fname'] . " " . $_SESSION['staff-lname'] ?>&emsp;<i class="fas fa-caret-down"></i></a>
    </button>
    <div class="dropdown-menu dropdown-profile-list">
        <div><a href="profile.php"><i class="fas fa-user-circle icons"></i>Profile</a></div>
        <div> <a href="logout.php"><i class="fas fa-sign-out-alt icons"></i>Logout</a></div>
    </div>
</li>
<style>
    .button{
        background: transparent;
        border: none;
    }
</style>