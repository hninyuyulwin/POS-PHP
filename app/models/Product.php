<?php

class Product extends Model
{
  protected $table = 'products';

  protected $allowed_column = [
    'barcode',
    'user_id',
    'description',
    'qty',
    'amount',
    'image',
    'date',
    'views',
  ];

  public function validate($data)
  {
    $errors = [];
    // Check description
    if (empty($data['description'])) {
      $errors['description'] = "Product description is required!";
    } else if (!preg_match("/^[a-zA-z0-9_\- ]*$/", $data['description'])) {
      $errors['description'] = "Allow only letters & numbers!";
    }

    // Check Quantity
    if (empty($data['qty'])) {
      $errors['qty'] = "Product Quantity is required!";
    } else if (!preg_match("/^[0-9]*$/", $data['qty'])) {
      $errors['qty'] = "Allow only numbers in quantity!";
    }

    // Check Amount
    if (empty($data['amount'])) {
      $errors['amount'] = "Product price is required!";
    } else if (!preg_match("/^[0-9]*$/", $data['amount'])) {
      $errors['amount'] = "Allow only numbers in price!";
    }

    // Check Image
    //$ext = strtolower(pathinfo($data['image']['name'], PATHINFO_EXTENSION));

    $max_size = 4; //mbs
    $size = $max_size * (1024 * 1024);

    if (empty($data['image'])) {
      $errors['image'] = "Product Image is required!";
    } else if (!($data['image']['type'] == 'image/png' || $data['image']['type'] == 'image/jpeg')) {
      $errors['image'] = "Product Image must be JPEG or PNG!";
    } else if ($data['image']['error'] > 0) {
      $errors['image'] = "Image failed to upload. Error No ." . $data['image']['error'];
    } else if ($data['image']['size'] > $size) {
      $errors['image'] = "Image Size must not greater than " . $size . " mb";
    }

    return $errors;
  }

  public function generate_barcode()
  {
    return date("Y") . rand(1000, 9999999);
  }

  public function generate_filename($ext = "jpg")
  {
    return date("Ymd") . "daisy" . date("His") . "." . $ext;
  }
}
