<?php
    if(isset($_SESSION['status']) && isset($_SESSION['status']) != ""){
        ?>
        <script>
        swal({
            title: "<?php echo $_SESSION['status']?>",
            text: "<?php echo $_SESSION['message']?>",
            icon: "<?php echo $_SESSION['status_code']?>",
            button: "Ok",
        });
        </script>
        <?php
            unset($_SESSION['status']);
    } 
   
?>