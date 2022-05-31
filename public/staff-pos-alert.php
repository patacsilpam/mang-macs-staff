<?php
    if(isset($_GET['success'])){
        ?>
    <script>
        swal({
            title: "Successful",
            text: "Successfully saved",
            icon: "success",
            button: "Ok",
        });
    </script>
    <?php    
        unset($_SESSION['status_pos']);
    }
    else{
        if(isset($_GET['error'])){
        ?>
    <script>
        swal({
            title: "Error",
            text: "Could not save item",
            icon: "error",
            button: "Ok",
        });
    </script>
        <?php
        }
    }
?>