
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
        $query = "SELECT * FROM products WHERE description LIKE :find LIMIT 10";
        $rows = $productClass->query($query, ['find' => $text]);
      } else {
        // Get All
        $rows = $productClass->getAll();
      }
      if ($rows) {
        echo json_encode($rows);
      }
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
