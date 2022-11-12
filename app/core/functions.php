<?php
function show($data)
{
  echo "<pre>";
  print_r($data);
}

function views_path($view)
{
  if (file_exists("../app/views/$view.view.php")) {
    return "../app/views/$view.view.php";
  } else {
    echo "View file $view not found";
  }
}

function esc($str)
{
  return htmlspecialchars($str);
}


function db_connect()
{
  $DBHOST = 'localhost';
  $DBNAME = 'pos_php';
  $DBUSER = 'root';
  $DBPASS = 6144;
  $DBDRIVER = 'mysql';

  try {
    $con = new PDO($DBDRIVER . ":host=" . $DBHOST . ";dbname=" . $DBNAME, $DBUSER, $DBPASS);
  } catch (PDOException $e) {
    echo $e->getMessage();
  }
  return $con;
}

function query($query, $data = array())
{
  $conn = db_connect();
  $stmt = $conn->prepare($query);
  $check = $stmt->execute($data);
  if ($check) {
    $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
    if (is_array($result) && count($result) > 0) {
      return $result;
    }
  }
  return false;
}



function allowed_column($data, $table)
{
  if ($table == 'users') {
    $columns = [
      'username',
      'email',
      'password',
      'role',
      'image',
      'date',
    ];
    foreach ($data as $key => $value) {
      if (!in_array($key, $columns)) {
        unset($data[$key]);
      }
    }
    return $data;
  }
}

function insert($data, $table)
{
  //$query = "INSERT INTO users (username,email,password,date,role) VALUES (:username,:email,:password,:date,:role)";
  $clean_array = allowed_column($data, $table);
  $keys = array_keys($clean_array);

  $query = "INSERT INTO $table ";
  $query .= "(" . implode(",", $keys) . ") VALUES ";
  $query .= "(:" . implode(",:", $keys) . ")";

  query($query, $clean_array);
}

function validate($data, $table)
{
  $errors = [];
  if ($table == 'users') {
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
  }
  return $errors;
}

function set_values($key, $default = "") // it will work like old value in laravel
{
  if (!empty($_POST[$key])) {
    return $_POST[$key];
  }
  return $default;
}
