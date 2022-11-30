<?php
$errors = [];

$id = $_GET['id'] ?? null;

$user = new User();
$row = $user->first(['id' => $id]);

if ($_SERVER['REQUEST_METHOD'] == 'POST') {

  if (is_array($row) && Auth::get('role') == 'admin' && $row['role'] != 'admin') {
    $user->delete($id);
    redirect('admin&tab=users');
  }
}
if (Auth::access('admin') || ($row && $row['id'] == Auth::get('id'))) {
  require views_path('auth/user-delete');
} else {
  Auth::setMessage("Only Admin can delete user account!!");
  require views_path('auth/dennied');
}
