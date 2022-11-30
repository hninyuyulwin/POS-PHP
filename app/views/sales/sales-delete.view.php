<?php require views_path('partials/header'); ?>

<div class="row py-5">
  <div class="col-md-4 offset-md-4">
    <div class="card">
      <div class="card-header">
        <h3 class="text-danger"><i class="fa fa-hamburger"></i> Delete Sales Record</h3>
      </div>
      <div class="card-body">
        <?php if (!empty($row)) : ?>
          <div class="alert alert-warning text-center"><i class="fa fa-trash me-2"></i>Are you sure want to delete?</div>
          <form action="" method="post" enctype="multipart/form-data">
            <div class="form-group mb-4">
              <label for="description"><i class="fa fa-user me-2"></i>Product Description</label>
              <input disabled value="<?php echo $row['description']; ?>" type="text" class="form-control">
            </div>
            <div class="form-group mb-4">
              <label for="barcode"><i class="fa fa-barcode me-2"></i>Barcode</label>
              <input disabled value="<?php echo $row['barcode']; ?>" type="text" class=" form-control">
            </div>
            <div class="form-group mb-4">
              <label for="barcode"><i class="fa fa-barcode me-2"></i>Total</label>
              <input disabled value="<?php echo $row['total']; ?>" type="text" class=" form-control">
            </div>
            <div class="form-group mb-4">
              <label for="barcode"><i class="fa fa-vocher me-2"></i>Recipt No.</label>
              <input disabled value="<?php echo $row['recipt_no']; ?>" type="text" class=" form-control">
            </div>

            <button type="submit" class="btn btn-danger">Delete</button>
            <a href="index.php?pg=admin&tab=sales">
              <button type="button" class="btn btn-outline-primary">Cancle</button>
            </a>
          </form>
        <?php else : ?>
          <div class="alert alert-danger">Record not found!</div>
          <a href="index.php?pg=admin&tab=sales" class="mt-2 btn btn-info">Back</a>
        <?php endif; ?>
      </div>
    </div>
  </div>
</div>

<?php require views_path('partials/footer'); ?>