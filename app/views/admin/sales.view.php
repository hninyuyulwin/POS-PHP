<table class="table table-hovered">
  <?php
  $id = 1;
  if (!empty($sales)) :
  ?>
    <tr>
      <th>#</th>
      <th>Barcode</th>
      <th>Recipt No</th>
      <th>Description</th>
      <th>Qty</th>
      <th>Amount</th>
      <th>Total</th>
      <th>Date</th>
      <th>Seller Name</th>
      <th>Action</th>
    </tr>
    <?php
    foreach ($sales as $sale) :
    ?>
      <tr>
        <td><?php echo $id; ?></td>
        <td><?php echo esc($sale['barcode']); ?></td>
        <td><?php echo esc($sale['recipt_no']); ?></td>
        <td><?php echo esc($sale['description']); ?></td>
        <td><?php echo esc($sale['qty']); ?></td>
        <td><?php echo esc($sale['amount']); ?></td>
        <td><?php echo esc($sale['total']); ?></td>
        <td><?php echo date("jS M, Y", strtotime($sale['date'])); ?></td>
        <td><?php echo esc($sale['user_id']); ?></td>
        <td>
          <a href="index.php?pg=user-delete&id=<?= $sale['id']; ?>" class="btn btn-sm btn-danger"><i class="fa fa-trash"></i></a>
      </tr>
    <?php
      $id++;
    endforeach;
  else :
    ?>
    <div class="alert alert-warning text-center">
      <h3>No Sales Items Yet!!</h3>
    </div>
  <?php
  endif;
  ?>
</table>