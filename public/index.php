<?php
session_start();
require "../app/core/init.php";

$controller = $_GET['pg'] ?? "home";
$controller = strtolower($controller);

//if (isset($_GET['page_name'])) {
//  $controller = $_GET['page_name'];
//}

if (file_exists("../app/controllers/" . $controller . ".php")) {
  require "../app/controllers/" . $controller . ".php";
} else {
  echo "Controller not found";
}
