<?php require views_path('partials/header'); ?>

<div class="row py-5">
  <div class="col-md-4 offset-md-4">
    <div class="card">
      <div class="card-header">
        <h3 class="text-primary"><i class="fa fa-hamburger"></i> Edit Product</h3>
      </div>
      <div class="card-body">
        <?php if (!empty($row)) : ?>
          <form action="" method="post" enctype="multipart/form-data">
            <div class="form-group mb-4">
              <label for="description"><i class="fa fa-user me-2"></i>Product Description</label>
              <input value="<?php echo set_values('description', $row['description']); ?>" type="text" name="description" id="description" class="form-control <?php echo empty($errors['description']) ? '' : 'border-danger'; ?>" placeholder="Enter Product Description">
              <span class="text-danger"><?php echo empty($errors['description']) ? "" : "*" . $errors['description']; ?></span>
            </div>
            <div class="form-group mb-4">
              <label for="barcode"><i class="fa fa-barcode me-2"></i>Barcode</label>
              <span class="text-danger">*</span>
              <span class="text-muted">(Optional)</span>
              <input value="<?php echo set_values('barcode', $row['barcode']); ?>" type="text" name="barcode" id="barcode" class=" form-control" placeholder="Product Barcode">
            </div>
            <div class="input-group">
              <span class="input-group-text">Qty :</span>
              <input value="<?php echo set_values('qty', $row['qty']); ?>" type="number" name="qty" value="1" class="form-control <?php echo empty($errors['qty']) ? '' : 'border-danger'; ?>" placeholder="Quantity">
              <span class="input-group-text">Amount :</span>
              <input value="<?php echo set_values('amount', $row['amount']); ?>" type="number" name="amount" value="0" step="100" class="form-control <?php echo empty($errors['amount']) ? '' : 'border-danger'; ?>" placeholder="Amount">
            </div>
            <div class="mb-4">
              <span class="text-danger"><?php echo empty($errors['qty']) ? "" : "*" . $errors['qty']; ?></span>
              <span class="text-danger"><?php echo empty($errors['amount']) ? "" : "*" . $errors['amount']; ?></span>
            </div>

            <div class="form-group mb-4">
              <label for="image"><i class="fa fa-image me-2"></i>Product Image</label>
              <input value="<?php echo set_values('image'); ?>" type="file" name="image" id="image" class="form-control <?php echo empty($errors['image']) ? '' : 'border-danger'; ?>">
              <img src="<?php echo $row['image']; ?>" class="mt-3 mx-auto d-block" width="200" style="border-radius: 8px;">
              <span class="text-danger"><?php echo empty($errors['image']) ? "" : "*" . $errors['image']; ?></span>
            </div>

            <button type="submit" class="btn btn-success">Save</button>
            <a href="index.php?pg=admin&tab=products">
              <button type="button" class="btn btn-outline-warning">Cancle</button>
            </a>
          </form>
        <?php else : ?>
          <div class="alert alert-danger">Product not found!</div>
          <a href="index.php?pg=admin&tab=products" class="mt-2 btn btn-info">Back</a>
        <?php endif; ?>
      </div>
    </div>
  </div>
</div>

<?php require views_path('partials/footer'); ?>