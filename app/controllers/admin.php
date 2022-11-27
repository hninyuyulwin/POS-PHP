<?php
$tab = $_GET['tab'] ?? 'dashboard';

if ($tab == 'products') {
  $productClass = new Product();
  $products = $productClass->query("SELECT * FROM products ORDER BY id DESC");
} else if ($tab == 'users') {
  $userClass = new User();
  $users = $userClass->query("SELECT * FROM users ORDER By id DESC");
} else if ($tab == 'sales') {
  $saleClass = new Sale();
  $sales = $saleClass->query("SELECT * FROM sales ORDER By id DESC");

  // get today's sales total
  $year = date("Y");
  $month = date("m");
  $day = date("d");
  $query = "SELECT sum(total) as total FROM sales WHERE day(date) = $day && month(date) = $month && year(date) = $year";

  $st = $saleClass->query($query);
  $sales_total = 0;
  if ($st) {
    $sales_total = $st[0]['total'] ?? 0;
  }
}


if (Auth::access('supervisor')) {
  require views_path('admin/admin');
} else {
  Auth::setMessage("You don't have access to admin page");
  require views_path('auth/dennied');
}
