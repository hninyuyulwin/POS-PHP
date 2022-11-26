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
}


if (Auth::access('supervisor')) {
  require views_path('admin/admin');
} else {
  Auth::setMessage("You don't have access to admin page");
  require views_path('auth/dennied');
}
