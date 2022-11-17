<?php require 'public/staff-profile-update.php' ?>

<!DOCTYPE html>
<html lang="en-us">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="Profile" content="Mang Macs-Profile">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
    <script src="https://kit.fontawesome.com/4adbff979d.js" crossorigin="anonymous"></script>
    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdn.datatables.net/1.10.25/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.10.25/js/dataTables.bootstrap4.min.js"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.10.25/css/dataTables.bootstrap4.min.css"> 
    <link rel="icon" type="image/jpeg" href="assets/images/mang-macs-logo.jpg" sizes="70x70">
    <link rel="stylesheet" href="assets/css/main.css">
    <title>Profile</title>
</head>

<body>             
    <div class="grid-container">
        <!--Navigation-->
        <header class="nav-container">
            <h3 class="mx-2 font-weight-normal">Profile</h3>
            <ul class="nav-list">
                <?php include 'assets/template/navbar.php'?>
            </ul>
        </header>
        <!--Admin Profile-->
        <main class="main-container">
            <section>
                <article>
                    <div class="admin-container">
                        <div class="profile-information-container">
                            <h1>Account Information</h1>
                            <form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']) ?>" method="POST"
                                class="profile-information-container" enctype="multipart/form-data">
                                <?php
                                $email = $_SESSION['staff-email'];
                                $GLOBALS['eSignature'] = "";
                                $check_admin_profile = $connect->prepare("SELECT * FROM tblusers WHERE email=?");
                                $check_admin_profile->bind_param('s', $email);
                                $check_admin_profile->execute();
                                $rows = $check_admin_profile->get_result();
                                while ($fetch = $rows->fetch_assoc()) {
                                ?>
                                <input type="hidden" name="number" value="<?= $fetch['id'] ?>">
                                <label>First Name</label>
                                <input type="text" class="form-control" name="fname" placeholder="First Name"
                                    value="<?= $fetch['fname'] ?>" required>
                                <label for="lastName">Last Name</label>
                                <input type="text" class="form-control" name="lname" id="lastName"
                                    placeholder="Last Name" value="<?= $fetch['lname'] ?>" required>
                                <label>Position</label>
                                <select name="position" class="form-control">
                                    <option value="none" disabled>Select Position</option>
                                    <option value="Admin" disabled
                                        <?php if ($fetch['position'] == "Admin") echo 'selected="selected"'; ?>>Admin
                                    </option>
                                    <option value="Staff"
                                        <?php if ($fetch['position'] == "Staff") echo 'selected="selected"'; ?>>Staff
                                    </option>
                                </select>
                                <label>Username</label>
                                <input type="text" class="form-control" name="uname" placeholder="Username"
                                    value="<?= $fetch['uname'] ?>" required>
                                <label>Email</label>
                                <input type="email" class="form-control" name="email" placeholder="Email Address"
                                    value="<?= $fetch['email'] ?>" required>
                                <label>
                                    <input type="file" name="adminImage" multiple
                                        accept="image/png, image/jpeg, image/jpg" size="60">
                                </label>
                                <div> <img src="<?= $fetch['profile']; ?>" width="100"></div>
                                <button type="Submit" class="btn btn-success" name="btn-update-account">Update
                                    Account</button>
                                <?php
                                }
                                ?>
                            </form>
                        </div>
                    </div>
                </article>
            </section>
        </main>
        <!--Sidebar-->
        <?php include 'assets/template/sidebar.php' ?>
        <?php
            if(isset($_GET['success'])){
                ?>
            <script>
            swal({
                title: "Successful",
                text: "Successfully updated",
                icon: "success",
                button: "Ok",
            });
            </script>
            <?php    
                unset($_SESSION['status_pos']);
            } else{
                if(isset($_GET['error'])){
                ?>
                <script>
                    swal({
                        title: "Error",
                        text: "Could not updated item",
                        icon: "error",
                        button: "Ok",
                    });
                </script>
                <?php
                }
            }
        ?>
    </div>
    <script src="assets/js/sidebar-menu.js"></script>
    <script src="assets/js/sidebar-menu-active.js"></script>
    <script type="text/javascript">
        var sig = $('#signature-con').signature({syncField: '#signature-base64', syncFormat: 'PNG'});
        $('#clear').click(function(e) {
            e.preventDefault();
            sig.signature('clear');
            $("#signature-base64").val('');
        });
    </script>
</body>

</html>