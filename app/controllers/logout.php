<?php
if (isset($_SESSION['USER'])) {
  unset($_SESSION['USER']);
}
redirect('login');
//session_destroy();
//session_regenerate_id();
