<?php

class Database
{

  private function db_connect()
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

  public function query($query, $data = array())
  {
    $conn = $this->db_connect();
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
}
