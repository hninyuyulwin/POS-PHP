<?php

class User extends Model
{
  protected $table = 'users';

  protected $allowed_column = [
    'username',
    'email',
    'password',
    'role',
    'gender',
    'image',
    'date',
  ];

  public function validate($data, $id = null)
  {
    $errors = [];
    // Check username
    if (empty($data['username'])) {
      $errors['username'] = "Username is required!";
    } else if (!preg_match("/^[a-zA-z ]*$/", $data['username'])) {
      $errors['username'] = "Allow only letters!";
    }

    // Check email
    if (empty($data['email'])) {
      $errors['email'] = "E-mail is required!";
    } else if (!filter_var($data['email'], FILTER_VALIDATE_EMAIL)) {
      $errors['email'] = "Invalid E-mail Format!";
    }

    // Check password
    if (!$id) {
      if (empty($data['password'])) {
        $errors['password'] = "Password is required!";
      } else if (strlen($data['password']) < 8) {
        $errors['password'] = "Password at least 8 character long!";
      }
      if (empty($data['password_retype'])) {
        $errors['password_retype'] = "Repeat Password is required!";
      } else if ($data['password_retype'] !== $data['password']) {
        $errors['password_retype'] = "Password not match!";
      }
    } else {
      if (!empty($data['password'])) {
        if ($data['password_retype'] !== $data['password']) {
          $errors['password_retype'] = "Password not match!";
        } else if (strlen($data['password']) < 8) {
          $errors['password'] = "Password at least 8 character long!";
        }
      }
    }
    return $errors;
  }
}
