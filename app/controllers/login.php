<?php
$errors = [];
if ($_SERVER['REQUEST_METHOD'] == 'POST') {

  //$arr['email'] = $_POST['email'];
  //$arr = ['email' => $_POST['email']];

  $user = new User();
  if ($row = $user->where(['email' => $_POST['email']])) {
    $hashed_password = $row[0]['password'];
    $password = password_verify($_POST['password'], $hashed_password);

    if ($password) {
      authenticate($row[0]);
      redirect('home');
    } else {
      $errors['password'] = "Incorrect Password!";
    }
  } else {
    $errors['email'] = "Email not found!";
  }
}
require views_path('auth/login');
