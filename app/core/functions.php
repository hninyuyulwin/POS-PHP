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


function redirect($page)
{
  header("location:index.php?pg=" . $page);
  die();
}

function set_values($key, $default = "") // it will work like old value in laravel
{
  if (!empty($_POST[$key])) {
    return $_POST[$key];
  }
  return $default;
}

function authenticate($row)
{
  $_SESSION['USER'] = $row;
}


function auth($column)
{
  if (!empty($_SESSION['USER'][$column])) {
    return $_SESSION['USER'][$column];
  }
  return "Unknown User";
}

function crop($filename, $size = 400, $type = 'product')
{
  $ext = strtolower(pathinfo($filename, PATHINFO_EXTENSION));
  //$cropped_file = str_replace("." . $ext, "_cropped." . $ext, $filename);
  $cropped_file = preg_replace("/\.$ext$/", "_cropped." . $ext, $filename);

  // if cropped file already exitst
  if (file_exists($cropped_file)) {
    return $cropped_file;
  }

  // if file to be cropped do not exits
  if (!file_exists($filename)) {
    if ($type == 'male') {
      return 'assets/images/user_male.png';
    } else if ($type == 'female') {
      return 'assets/images/user_female.png';
    } else {
      return 'assets/images/no_image.png';
    }
  }

  // create image resource
  switch ($ext) {
    case 'jpeg':
    case 'jpg':
      $src_image = imagecreatefromjpeg($filename);
      break;
    case 'png':
      $src_image = imagecreatefrompng($filename);
      break;
    case 'gif':
      $src_image = imagecreatefromgif($filename);
      break;
    default:
      return $filename;
      break;
  }
  // Set cropping params

  // assign values
  $dst_x = 0;
  $dst_y = 0;
  $dst_w = (int) $size;
  $dst_h = (int) $size;

  $original_width = imagesx($src_image);
  $original_height = imagesy($src_image);
  if ($original_width < $original_height) {
    $src_x = 0;
    $src_y = ($original_height - $original_width) / 2;
    $src_w = $original_width;
    $src_h = $original_width;
  } else {
    $src_x = ($original_width - $original_height) / 2;
    $src_y = 0;
    $src_w = $original_height;
    $src_h = $original_height;
  }

  $dst_image = imagecreatetruecolor((int)$size, (int)$size);

  imagecopyresampled($dst_image, $src_image, $dst_x, $dst_y, $src_x, $src_y, $dst_w, $dst_h, $src_w, $src_h);

  // save FINAL image
  switch ($ext) {
    case 'jpeg':
    case 'jpg':
      imagejpeg($dst_image, $cropped_file, 90);
      break;
    case 'png':
      imagepng($dst_image, $cropped_file, 90);
      break;
    case 'gif':
      imagegif($dst_image, $cropped_file, 90);
      break;
    default:
      return $filename;
      break;
  }

  imagedestroy($dst_image);
  imagedestroy($src_image);

  return $cropped_file;
}

function get_recipt_no()
{
  $num = 1;

  $db = new Database();
  $rows = $db->query("SELECT recipt_no from sales order by id desc limit 1");
  if (is_array($rows)) {
    $num = (int)$rows[0]['recipt_no'] + 1;
  }
  return $num;
}

function get_date($date)
{
  return date("d-M-Y H:i:s", strtotime($date));
}

function get_user_by_id($id)
{
  $user = new User();
  return $user->first(['id' => $id]);
}

function generate_daily_data($records)
{
  $arr = [];
  for ($i = 0; $i < 24; $i++) {
    if (!isset($arr[$i])) {
      $arr[$i] = 0;
    }
    foreach ($records as $row) {
      $hour = date('H', strtotime($row['date']));
      if ($hour == $i) {
        $arr[$i] += $row['total'];
      }
    }
  }
  return $arr;
}

function generate_monthly_data($records)
{
  $arr = [];
  $total_days = cal_days_in_month(CAL_GREGORIAN, date('m'), date('Y'));
  for ($i = 1; $i <= $total_days; $i++) {
    if (!isset($arr[$i])) {
      $arr[$i] = 0;
    }
    foreach ($records as $row) {
      $day = date('d', strtotime($row['date']));
      if ($day == $i) {
        $arr[$i] += $row['total'];
      }
    }
  }
  return $arr;
}

function generate_yearly_data($records)
{
  $arr = [];
  $months = ['0', 'Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec'];
  for ($i = 1; $i <= 12; $i++) {
    if (!isset($arr[$months[$i]])) {
      $arr[$months[$i]] = 0;
    }
    foreach ($records as $row) {
      $month = date('m', strtotime($row['date']));
      if ($month == $i) {
        $arr[$months[$i]] += $row['total'];
      }
    }
  }
  return $arr;
}
