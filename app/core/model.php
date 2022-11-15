<?php

class Model extends Database
{

  protected function get_allowed_column($data)
  {
    if (!empty($this->allowed_column)) {
      foreach ($data as $key => $value) {
        if (!in_array($key, $this->allowed_column)) {
          unset($data[$key]);
        }
      }
    }
    return $data;
  }

  public function insert($data)
  {
    //$query = "INSERT INTO users (username,email,password,date,role) VALUES (:username,:email,:password,:date,:role)";
    $clean_array = $this->get_allowed_column($data, $this->table);
    $keys = array_keys($clean_array);

    $query = "INSERT INTO $this->table ";
    $query .= "(" . implode(",", $keys) . ") VALUES ";
    $query .= "(:" . implode(",:", $keys) . ")";

    $db = new Database();
    $db->query($query, $clean_array);
  }


  public function where($data)
  {
    //$query = "SELECT * FROM users WHERE email=:email AND password=:password";
    $keys = array_keys($data);

    $query = "SELECT * FROM $this->table WHERE ";
    foreach ($keys as $key) {
      $query .= "$key = :$key && ";
    }
    $query = trim($query, "&& ");

    $db = new Database();
    return $db->query($query, $data);
  }
}

$m = new Model();
$m->query("SELECT * FROM users");
