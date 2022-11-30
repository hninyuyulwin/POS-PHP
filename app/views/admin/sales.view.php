<ul class="nav nav-tabs">
  <li class="nav-item">
    <a href="#" class="nav-link active" aria-current="page">Table View</a>
  </li>
  <li class="nav-item">
    <a href="#" class="nav-link">Graph View</a>
  </li>
</ul>
<div class="table-responsive">
  <h4 class="my-3 text-success">Today Sales Total : <?= number_format($sales_total) . " MMK"; ?></h4>
  <table class="table table-hovered table-primary">
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
          <?php
          $cashier = get_user_by_id($sale['user_id']);
          if (empty($cashier)) {
            $name = "Unknown User";
            $role = "Unknown Role";
            $nameLink = "#";
          } else {
            $name = $cashier['username'];
            $role = $cashier['role'];
            $nameLink = "index.php?pg=profile&id=" . $cashier['id'];
          }
          ?>
          <td>
            <a href="<?= $nameLink ?>"><?php echo esc($name) . "(" . $role . ")"; ?></a>
          </td>
          <td>
            <a href="index.php?pg=sales-delete&id=<?= $sale['id']; ?>" class="btn btn-sm btn-danger"><i class="fa fa-trash"></i></a>
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

  <?php
  echo $pager->display();
  ?>


</div>