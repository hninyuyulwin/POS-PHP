<ul class="nav nav-tabs">
  <li class="nav-item">
    <a href="index.php?pg=admin&tab=sales" class="nav-link <?php echo ($session == 'table') ? 'active' : ''; ?>" aria-current="page">Table View</a>
  </li>
  <li class="nav-item">
    <a href="index.php?pg=admin&tab=sales&s=graph" class="nav-link  <?php echo ($session == 'graph') ? 'active' : ''; ?>">Graph View</a>
  </li>
</ul>
<?php if ($session == 'table') : ?>
  <div class="table-responsive">
    <form action="" class="mt-3">
      <input type="hidden" name="pg" value="admin">
      <input type="hidden" name="tab" value="sales">
      <div class="row">
        <div class="col-3">
          <label for="start">Start Date :</label>
          <input type="date" name="start" id="start" class="form-control" value="<?= !empty($_GET['start']) ? $_GET['start'] : ''; ?>">
        </div>
        <div class="col-3">
          <label for="end">End Date :</label>
          <input type="date" name="end" id="end" class="form-control" value="<?= !empty($_GET['end']) ? $_GET['end'] : ''; ?>">
        </div>
        <div class="col-3">
          <label for="limit">Rows :</label>
          <input type="number" name="limit" id="limit" min="1" class="form-control" value="<?= !empty($_GET['limit']) ? $_GET['limit'] : '10'; ?>">
        </div>
      </div>
      <button type="submit" class="btn btn-sm btn-primary mt-1">Go <i class="fa fa-chevron-right"></i></button>
    </form>
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
<?php else : ?>
  <style>
    @keyframes move {
      0% {
        transform: translateY(100px);
      }

      100% {
        transform: translateY(0px);
      }
    }

    svg circle {
      stroke: orange;
      animation: move 1s ease;
    }

    svg circle:hover {
      stroke: palegreen;
    }
  </style>
  <?php
  $graph = new Graph();

  $data = generate_daily_data($today_records);
  $graph->title = "Today's Sale";
  $graph->xtitle = "Hour of the day";
  $graph->styles = "width:80%;margin:auto;display:block;";
  $graph->display($data);
  ?>
  <br>

  <?php
  $data = generate_monthly_data($thismonth_records);
  $graph->title = "This Month Sale";
  $graph->xtitle = "Days of the month";
  $graph->styles = "width:80%;margin:auto;display:block;";
  $graph->display($data);
  ?>
  <br>

  <?php
  $data = generate_yearly_data($thisyear_records);
  $graph->title = "This Year Sale";
  $graph->xtitle = "Month of the Year";
  $graph->styles = "width:80%;margin:auto;display:block;";
  $graph->display($data);
  ?>
<?php endif; ?>