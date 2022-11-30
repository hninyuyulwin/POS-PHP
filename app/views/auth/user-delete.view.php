<?php require views_path('partials/header'); ?>

<div class="row py-5">
  <div class="col-md-4 offset-md-4">
    <div class="card">
      <div class="card-header">
        <h3 class="text-danger"><i class="fa fa-users"></i> Delete User</h3>
      </div>
      <div class="card-body">
        <?php if (!empty($row) &&  $row['role'] != 'admin') : ?>
          <div class="alert alert-warning text-center"><i class="fa fa-trash me-2"></i>Are you sure want to delete?</div>
          <form action="" method="post" enctype="multipart/form-data">
            <div class="form-group mb-4">
              <label for="username"><i class="fa fa-user me-2"></i>Username</label>
              <input disabled value="<?php echo set_values('username', $row['username']); ?>" type="text" name="username" id="username" class="form-control">
            </div>
            <div class="form-group mb-4">
              <label for="email"><i class="fa fa-envelope me-2"></i>E-mail</label>
              <input disabled value="<?php echo set_values('email', $row['email']); ?>" type="text" name="email" id="email" class="form-control">
            </div>
            <div class="form-group mb-4">
              <label for="role"><i class="fa fa-unlock me-2"></i>Role</label>
              <input disabled value="<?php echo set_values('role', $row['role']); ?>" type="text" name="role" id="role" class=" form-control">
            </div>
            <button type="submit" class="btn btn-danger">Delete</button>
            <?php if (Auth::get('role') == 'admin') : ?>
              <a href="index.php?pg=admin&tab=users">
                <button type="button" class="btn btn-outline-primary">Cancle</button>
              </a>
            <?php else : ?>
              <a href="index.php?pg=profile&id=<?= $row['id']; ?>" class="btn btn-outline-warning btn-lg ms-2">Cancle</a>
            <?php endif; ?>
          </form>
        <?php else : ?>
          <?php if (is_array($row) && $row['role'] == 'admin') : ?>
            <div class="alert alert-warning">Admin account can't be delete!</div>
            <a href="index.php?pg=admin&tab=users" class="mt-2 btn btn-info">Back</a>
          <?php else : ?>
            <div class="alert alert-danger">User not found!</div>
            <a href="index.php?pg=admin&tab=users" class="mt-2 btn btn-info">Back</a>
          <?php endif; ?>
        <?php endif; ?>
      </div>
    </div>
  </div>
</div>

<?php require views_path('partials/footer'); ?>