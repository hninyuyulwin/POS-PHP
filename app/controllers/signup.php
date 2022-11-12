<?php
$errors = [];
if ($_SERVER['REQUEST_METHOD'] == 'POST') {

  $_POST['role'] = 'user';
  $_POST['date'] = date("Y-m-d H:i:s");

  //$query = "INSERT INTO users (username,email,password,date,role) VALUES (:username,:email,:password,:date,:role)";
  //$arr = allowed_column($_POST, 'users');
  //query($query, $arr);

  $errors  = validate($_POST, 'users');
  if (empty($errors)) {
    insert($_POST, 'users');
  }
}
require views_path('auth/signup');
