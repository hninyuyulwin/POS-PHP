<?php
$errors = [];
if ($_SERVER['REQUEST_METHOD'] == 'POST') {

  $user = new User();
  $_POST['role'] = 'user';
  $_POST['date'] = date("Y-m-d H:i:s");

  //$query = "INSERT INTO users (username,email,password,date,role) VALUES (:username,:email,:password,:date,:role)";
  //$arr = allowed_column($_POST, 'users');
  //query($query, $arr);

  $errors  = $user->validate($_POST);
  if (empty($errors)) {
    $_POST['password'] = password_hash($_POST['password'], PASSWORD_DEFAULT);
    $user->insert($_POST);
    redirect('login');
  }
}
require views_path('auth/signup');
