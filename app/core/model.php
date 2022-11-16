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

  public function update($id, $data)
  {
    $clean_array = $this->get_allowed_column($data, $this->table);
    $keys = array_keys($clean_array);

    //"UPDATE Table set id= :id,description = :description where id=2";
    $query = "UPDATE $this->table SET ";
    foreach ($keys as $column) {
      $query .= "$column = :$column,";
    }
    $query = trim($query, ",");
    $query .= " WHERE id = :id";
    $clean_array['id'] = $id;

    $db = new Database();
    $db->query($query, $clean_array);
  }

  public function delete($id)
  {
    $query = "DELETE FROM $this->table WHERE id = :id LIMIT 1";
    $clean_array['id'] = $id;

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

  public function first($data)
  {
    //$query = "SELECT * FROM users WHERE email=:email AND password=:password";
    $keys = array_keys($data);

    $query = "SELECT * FROM $this->table WHERE ";
    foreach ($keys as $key) {
      $query .= "$key = :$key && ";
    }
    $query = trim($query, "&& ");

    $db = new Database();
    $res = $db->query($query, $data);
    if ($res) {
      return $res[0];
    }
    return false;
  }
}

$m = new Model();
