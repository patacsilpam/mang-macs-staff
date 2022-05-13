<!--Delete--->
<form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']) ?>" method="POST">
  <div class="modal fade" id="emptyCart" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Mang Mac's Product</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <input type="hidden" name="id" value="<?= $fetch['id']; ?>">
          <p>Delete Product</p>
          <div class="modal-body-container">
            <i class="fas fa-exclamation-circle fa-3x icon-warning"></i><br>
            <p class="icon-text-warning">Are you sure you want to empty all the products that you selected?</p>
          </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
          <a href="pos.php?action=empty"  class="btn btn-warning"><i class="fas fa-table"></i> Empty</a>
        </div>
      </div>
    </div>
  </div>
</form>
<!--Cancel--->
<form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']) ?>" method="POST">
  <div class="modal fade" id="cancelCart" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Mang Mac's Product</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <input type="hidden" name="id" value="<?= $fetch['id']; ?>">
          <p>Delete Product</p>
          <div class="modal-body-container">
            <i class="fas fa-exclamation-circle fa-3x icon-warning"></i><br>
            <p class="icon-text-warning">Are you sure you want to cancel all the product that you selected?</p>
          </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
          <a href="pos.php?action=empty"  class="btn btn-danger"><i class="fas fa-window-close"></i> Cancel</a>
        </div>
      </div>
    </div>
  </div>
</form>