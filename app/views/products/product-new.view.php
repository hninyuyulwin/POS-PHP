<?php require views_path('partials/header'); ?>

<div class="row py-5">
  <div class="col-md-4 offset-md-4">
    <div class="card">
      <div class="card-header">
        <h3 class="text-success"><i class="fa fa-hamburger"></i> Add New Product</h3>
      </div>
      <div class="card-body">
        <form action="" method="post">
          <div class="form-group mb-4">
            <label for="description"><i class="fa fa-user me-2"></i>Product Description</label>
            <input type="text" name="description" id="description" class="form-control" placeholder="Enter Product Description">
          </div>
          <div class="form-group mb-4">
            <label for="barcode"><i class="fa fa-barcode me-2"></i>Barcode</label>
            <span class="text-danger">*</span>
            <span class="text-muted">(Optional)</span>
            <input type="text" name="barcode" id="barcode" class="form-control" placeholder="Product Barcode">
          </div>
          <div class="input-group mb-4">
            <span class="input-group-text">Qty :</span>
            <input type="number" name="qty" value="1" class="form-control" placeholder="Quantity">
            <span class="input-group-text">Amount :</span>
            <input type="number" name="amount" value="0" step="100" class="form-control" placeholder="Amount">
          </div>
          <div class="form-group mb-4">
            <label for="image"><i class="fa fa-image me-2"></i>Product Image</label>
            <input type="file" name="image" id="image" class="form-control">
          </div>

          <button type="submit" class="btn btn-info">Save</button>
          <button type="button" class="btn btn-outline-secondary">Cancle</button>
        </form>
      </div>
    </div>
  </div>
</div>

<?php require views_path('partials/footer'); ?>