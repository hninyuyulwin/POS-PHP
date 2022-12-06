<div class="row justify-content-center">
  <div class="col-md-5 rounded p-2 my-2 m-md-2 shadow shadow-sm">
    <h3 class="text-center"><i class="fa fa-users fa-md me-2"></i>Total Users</h3>
    <h3 class="text-center text-warning"><?= $total_users; ?></h3>
  </div>
  <div class="col-md-5 rounded p-2 my-2 m-md-2 shadow shadow-sm">
    <h3 class="text-center"><i class="fa fa-hamburger fa-md me-2"></i>Total Products</h3>
    <h3 class="text-center text-warning"><?= $total_prods; ?></h3>
  </div>
  <div class="col-md-5 rounded p-2 my-2 m-md-2 shadow shadow-sm">
    <h3 class="text-center"><i class="fa fa-dollar-sign fa-md me-2"></i>Total Sales</h3>
    <h3 class="text-center text-warning"><?= number_format($total_sales) . "/- Ks"; ?></h3>
  </div>
</div>