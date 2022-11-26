<?php require views_path('partials/header'); ?>
<div class="container py-5">
  <h1 class="text-center mb-3">Access Denied!!</h1>
  <div class="alert alert-warning text-center">
    <h4><?php echo Auth::getMessage(); ?></h4>
  </div>
</div>
<?php require views_path('partials/footer'); ?>