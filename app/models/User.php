<?php

class User extends Model
{
  protected $table = 'users';

  protected $allowed_column = [
    'username',
    'email',
    'password',
    'role',
    'image',
    'date',
  ];

  public function validate($data)
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

    return $errors;
  }
}
