<?php
$tab = $_GET['tab'] ?? 'dashboard';

if ($tab == 'products') {
  $productClass = new Product();
  $limit = 7;
  $pager = new Pager($limit);
  $offset = $pager->offset;
  $products = $productClass->query("SELECT * FROM products ORDER BY id DESC limit $limit offset $offset");
} else if ($tab == 'users') {
  $userClass = new User();
  $limit = 7;
  $pager = new Pager($limit);
  $offset = $pager->offset;
  $users = $userClass->query("SELECT * FROM users ORDER By id DESC limit $limit offset $offset");
} else if ($tab == 'sales') {

  $session = $_GET['s'] ?? 'table';
  $startdate = $_GET['start'] ?? null;
  $enddate = $_GET['end'] ?? null;

  $saleClass = new Sale();
  $limit = $_GET['limit'] ?? 10;
  $limit = (int)$limit;
  $limit = ($limit < 1) ? 10 : $limit;

  $pager = new Pager($limit);
  $offset = $pager->offset;
  $query = "SELECT * FROM sales ORDER By id DESC limit $limit offset $offset";

  // get today's sales total
  $year = date("Y");
  $month = date("m");
  $day = date("d");
  $query_total = "SELECT sum(total) as total FROM sales WHERE day(date) = $day && month(date) = $month && year(date) = $year";


  // if both startdate and enddate contain
  if ($startdate && $enddate) {
    $query = "SELECT * FROM sales WHERE date BETWEEN '$startdate' and '$enddate' ORDER By id DESC limit $limit offset $offset";
    $query_total = "SELECT sum(total) as total FROM sales WHERE date between '$startdate' and '$enddate'";
  }
  // if only startdate is set
  else if ($startdate && !$enddate) {
    $query = "SELECT * FROM sales WHERE date = '$startdate' ORDER By id DESC limit $limit offset $offset";
    $query_total = "SELECT sum(total) as total FROM sales WHERE date = '$startdate'";
  }
  $sales = $saleClass->query($query);

  $st = $saleClass->query($query_total);
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
