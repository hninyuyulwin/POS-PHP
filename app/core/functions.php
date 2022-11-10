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
