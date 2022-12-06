<?php require views_path('partials/header'); ?>
<div class="container my-3">
  <div class="row">
    <h2 class="text-center"><i class="fa fa-user-shield me-2"></i>Admin</h2>
    <div class="col-md-3 mt-4">
      <ul class="list-group">
        <a href="index.php?pg=admin&tab=dashboard">
          <li class="list-group-item <?php echo !$tab || $tab == 'dashboard' ? 'active' : ''; ?>">
            <i class="fa fa-th-large me-2"></i>Dashboard
          </li>
        </a>
        <a href="index.php?pg=admin&tab=users">
          <li class="list-group-item <?php echo $tab == 'users' ? 'active' : ''; ?>">
            <i class="fa fa-users me-2"></i>Users
          </li>
        </a>
        <a href="index.php?pg=admin&tab=products">
          <li class="list-group-item <?php echo $tab == 'products' ? 'active' : ''; ?>">
            <i class="fa fa-hamburger me-2"></i>Products
          </li>
        </a>
        <a href="index.php?pg=admin&tab=sales">
          <li class="list-group-item <?php echo $tab == 'sales' ? 'active' : ''; ?>">
            <i class="fa fa-dollar-sign me-2"></i>Sales
          </li>
        </a>
        <a href="index.php?pg=logout">
          <li class="list-group-item">
            <i class="fa fa-sign-out-alt me-2"></i>Logout
          </li>
        </a>
      </ul>
    </div>
    <div class="col-md-9 mt-4">
      <div class="card">
        <div class="card-header">
          <h3><?php echo strtoupper($tab); ?></h3>
        </div>
        <div class="card-body">
          <?php
          switch ($tab) {
            case 'products':
              require views_path('admin/products');
              break;

            case 'users':
              require views_path('admin/users');
              break;

            case 'sales':
              require views_path('admin/sales');
              break;

            default:
              require views_path('admin/dashboard');
              break;
          }

          ?>
        </div>
      </div>
    </div>
  </div>
</div>
<?php require views_path('partials/footer'); ?>