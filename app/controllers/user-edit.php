<?php
$errors = [];

$id = $_GET['id'] ?? null;

$user = new User();
$rows = $user->first(['id' => $id]);

if (!empty($_SERVER['HTTP_REFERER']) && !strstr($_SERVER['HTTP_REFERER'], "user-edit")) {
  $_SESSION['referer'] = $_SERVER['HTTP_REFERER'];
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {

  if (!empty($_FILES['image']['name'])) {
    $_POST['image'] = $_FILES['image'];
  }

  // make sure only admin can make other to admin
  if (isset($_POST['role']) && $_POST['role'] != $rows['role']) {
    if (Auth::get('role') != 'admin') {
      $_POST['role'] = $rows['role'];
    }
  }
  //$query = "INSERT INTO users (username,email,password,date,role) VALUES (:username,:email,:password,:date,:role)";
  //$arr = allowed_column($_POST, 'users');
  //query($query, $arr);

  $errors  = $user->validate($_POST, $id);
  if (empty($errors)) {

    $folder = 'uploads/';
    if (!file_exists($folder)) {
      mkdir($folder, 0777, true);
    }

    if (!empty($_POST['image'])) {
      $ext = strtolower(pathinfo($_POST['image']['name'], PATHINFO_EXTENSION));
      $product = new Product();
      $filename = $_FILES['image']['tmp_name'];
      $destination = $folder . $product->generate_filename($ext);
      move_uploaded_file($filename, $destination);
      $_POST['image'] = $destination;

      if (file_exists($rows['image'])) {
        unlink($rows['image']);
      }
    }

    if (empty($_POST['password'])) {
      unset($_POST['password']);
    } else {
      $_POST['password'] = password_hash($_POST['password'], PASSWORD_DEFAULT);
    }
    $user->update($id, $_POST);
    redirect("profile&id=$id");
  }
}
if (Auth::access('admin')  || ($rows && $rows['id'] == Auth::get('id'))) {
  require views_path('auth/user-edit');
} else {
  Auth::setMessage("Only Admin can Edit user account!!");
  require views_path('auth/dennied');
}
