<?php
$errors = [];

$id = $_GET['id'] ?? Auth::get('id');

$user = new User();
$rows = $user->first(['id' => $id]);

if ($_SERVER['REQUEST_METHOD'] == 'POST') {

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
    if (empty($_POST['password'])) {
      unset($_POST['password']);
    } else {
      $_POST['password'] = password_hash($_POST['password'], PASSWORD_DEFAULT);
    }
    $user->update($id, $_POST);
    redirect('admin&tab=users');
  }
}
if (Auth::access('admin') || ($rows && $rows['id'] == Auth::get('id'))) {
  require views_path('auth/profile');
} else {
  Auth::setMessage("Only Admin can Edit user account!!");
  require views_path('auth/dennied');
}
