<?php

defined("ABSPATH") ? "" : die();

// capture ajax data
$raw_data = file_get_contents("php://input");
if (!empty($raw_data)) {
  $OBJ = json_decode($raw_data, true); // convert obj to array?
  if (is_array($OBJ)) {
    if ($OBJ['data_type'] == 'search') {
      $productClass = new Product();
      if (!empty($OBJ['text'])) {
        // Search
        $text = "%" . $OBJ['text'] . "%";
        $barcode = $OBJ['text'];
        $query = "SELECT * FROM products WHERE description LIKE :find || barcode = :barcode LIMIT 10";
        $rows = $productClass->query($query, ['find' => $text, 'barcode' => $barcode]);
      } else {
        // Get All
        $rows = $productClass->getAll();
      }
      if ($rows) {
        /*
        foreach ($rows as $key => $row) {
          $rows[$key]['image'] = crop($row['image']);
          $rows[$key]['description'] = strtoupper($row['description']);
        }
        */
        $info['data_type'] = "search";
        $info['data'] = $rows;
        echo json_encode($info);
      }
    }else if ($OBJ['data_type'] == 'checkout') {

      $data = $OBJ['text'];
      $recipt_no = get_recipt_no();
      $user_id = auth("id");
      $date = date('Y-m-d H:i:s');
  
      $db = new Database();
      //read from database
      foreach ($data as $row) {
        $arr = [];
        $arr['id'] = $row['id'];
        $query = "SELECT * FROM products WHERE id = :id LIMIT 1";
        $check = $db->query($query, $arr);
        if (is_array($check)) {
          // save to database
          $check = $check[0];
          $arr = [];
          $arr['barcode'] = $check['barcode'];
          $arr['description'] = $check['description'];
          $arr['amount'] = $check['amount'];
          $arr['qty'] = $row['qty'];
          $arr['total'] = $row['qty'] * $check['amount'];
          $arr['recipt_no'] = $recipt_no;
          $arr['date'] = $date;
          $arr['user_id'] = $user_id;
  
          $query = "INSERT INTO sales (barcode,recipt_no,description,qty,amount,total,date,user_id) values (:barcode,:recipt_no,:description,:qty,:amount,:total,:date,:user_id)";
  
          $db->query($query, $arr);
        }
      }
  
      // barcode   recipt_no   description   qty   amount  total   data  user_id
      $info['data_type'] = "checkout";
      $info['data'] = "Items saved success";
      echo json_encode($info);
    }
  } 
  
}
/*
$productClass = new Product();
$rows = $productClass->getAll();

//show($rows);

//for crop image
//if ($rows) {
//  foreach ($rows as $key => $row) {
//    //$rows[$key]['image'] = crop($row['image']);
//    //$rows[$key]['description'] = strtoupper($row['description']);
//  }
//}
echo json_encode($rows);
*/