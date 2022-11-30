<?php
$errors = [];

$id = $_GET['id'] ?? null;

$sale = new Sale();
$row = $sale->first(['id' => $id]);

if ($_SERVER['REQUEST_METHOD'] == 'POST' && $row) {

  $sale->delete($row['id']);
  //delete old images
  if (file_exists($row['image'])) {
    unlink($row['image']);
  }

  redirect('admin&tab=sales');
}

require views_path('sales/sales-delete');
