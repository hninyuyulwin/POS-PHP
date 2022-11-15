<a href="index.php?pg=product-new" class="btn btn-sm btn-primary mb-3 float-end"><i class="fa fa-plus me-2"></i>Add New</a>
<table class="table table-hovered">
  <tr>
    <th>Barcode</th>
    <th>Product</th>
    <th>Qty</th>
    <th>Price</th>
    <th>Image</th>
    <th>Date</th>
    <th>Action</th>
  </tr>
  <?php
  if (!empty($products)) :
    foreach ($products as $product) :
  ?>
      <tr>
        <td><?php echo esc($product->barcode); ?></td>
        <td><?php echo esc($product->description); ?></td>
        <td><?php echo esc($product->qty); ?></td>
        <td><?php echo esc($product->amount); ?></td>
        <td>
          <img src="<?php echo esc($product->image); ?>" alt="">
        </td>
        <td><?php echo esc($product->date); ?></td>
        <td>
          <a href="" class="btn btn-sm btn-warning">Edit</a>
          <a href="" class="btn btn-danger btn-sm">Delete</a>
        </td>
      </tr>
      <?php
    endforeach;
  else :
      ?><?php
      endif;
        ?>
</table>