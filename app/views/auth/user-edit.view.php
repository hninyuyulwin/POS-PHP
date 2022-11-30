<?php require views_path('partials/header'); ?>

<?php
if (!empty($_SESSION['referer'])) {
  $back_link = $_SESSION['referer'];
} else {
  $back_link = "index.php?pg=admin&tab=users";
}
?>
<section class="vh-200 py-5">
  <div class="container h-100">
    <div class="row d-flex justify-content-center align-items-center h-100">
      <div class="col-lg-12 col-xl-11">
        <div class="card text-black" style="border-radius: 25px;">
          <div class="card-body">
            <div class="row justify-content-center">
              <div class="col-md-10 col-lg-6 col-xl-5 order-2 order-lg-1">

                <p class="text-center h1 fw-bold mb-5 mx-1 mx-md-4 mt-4">Edit User</p>
                <?php if (is_array($rows)) : ?>
                  <form method="POST" action="" class="mx-1 mx-md-4" enctype="multipart/form-data">

                    <div class="d-flex flex-row align-items-center mb-4">
                      <i class="fas fa-user fa-lg me-3 fa-fw"></i>
                      <div class="form-outline flex-fill mb-0">
                        <input value="<?php echo set_values('username', $rows['username']); ?>" type="text" name="username" class="form-control <?php echo !empty($errors['username']) ? 'border-danger' : ''; ?> " placeholder="Your Name" />
                        <span class="text-danger"><?php echo empty($errors['username']) ? '' : "*" . $errors['username']; ?></span>
                      </div>
                    </div>

                    <div class="d-flex flex-row align-items-center mb-4">
                      <i class="fas fa-envelope fa-lg me-3 fa-fw"></i>
                      <div class="form-outline flex-fill mb-0">
                        <input value="<?php echo set_values('email', $rows['email']); ?>" type="text" name="email" class="form-control <?php echo !empty($errors['username']) ? 'border-danger' : ''; ?> " placeholder="Your Email" />
                        <span class="text-danger"><?php echo empty($errors['email']) ? '' : "*" . $errors['email']; ?></span>
                      </div>
                    </div>

                    <div class="d-flex flex-row align-items-center mb-4">
                      <i class="fas fa-lock fa-lg me-3 fa-fw"></i>
                      <div class="form-outline flex-fill mb-0">
                        <input value="<?php echo set_values('password'); ?>" type="password" name="password" class="form-control <?php echo !empty($errors['username']) ? 'border-danger' : ''; ?> " placeholder="Password (Can Leave Empty not to Change)" />
                        <span class="text-danger"><?php echo empty($errors['password']) ? '' : "*" . $errors['password']; ?></span>
                      </div>
                    </div>

                    <div class="d-flex flex-row align-items-center mb-4">
                      <i class="fas fa-key fa-lg me-3 fa-fw"></i>
                      <div class="form-outline flex-fill mb-0">
                        <input value="<?php echo set_values('password_retype'); ?>" type="password" name="password_retype" class="form-control <?php echo !empty($errors['username']) ? 'border-danger' : ''; ?> " placeholder="Repeat password (Can Leave Empty not to Change)" />
                        <span class="text-danger"><?php echo empty($errors['password_retype']) ? '' : "*" . $errors['password_retype']; ?></span>
                      </div>
                    </div>

                    <div class="d-flex flex-row align-items-center mb-4">
                      <i class="fas fa-venus-mars fa-lg me-3 fa-fw"></i>
                      <div class="form-outline flex-fill mb-0">
                        <select name="gender" class="form-control <?php echo !empty($errors['gender']) ? 'border-danger' : ''; ?> ">
                          <!--<option value="">Select Gender</option>-->
                          <option value="<?= $rows['gender']; ?>"><?= $rows['gender']; ?></option>
                          <option value="male">Male</option>
                          <option value="female">Female</option>
                        </select>
                        <span class="text-danger"><?php echo empty($errors['gender']) ? '' : "*" . $errors['gender']; ?></span>
                      </div>
                    </div>
                    <?php if (Auth::get('role') == 'admin') : ?>
                      <div class="d-flex flex-row align-items-center mb-4">
                        <i class="fa fa-unlock fa-lg me-3 fa-fw"></i>
                        <div class="form-outline flex-fill mb-0">
                          <select name="role" class="form-control <?php echo !empty($errors['role']) ? 'border-danger' : ''; ?> ">
                            <option value="<?= $rows['role']; ?>"><?= $rows['role']; ?></option>
                            <option value="admin">Admin</option>
                            <option value="supervisor">Supervisor</option>
                            <option value="accountant">Accountant</option>
                            <option value="cashier">Cashier</option>
                            <option value="user">User</option>
                          </select>
                          <span class="text-danger"><?php echo empty($errors['role']) ? '' : "*" . $errors['role']; ?></span>
                        </div>
                      </div>
                    <?php endif; ?>

                    <div class="d-flex flex-row align-items-center mb-4">
                      <i class="fa fa-image fa-lg me-3 fa-fw"></i>
                      <div class="form-outline flex-fill mb-0">
                        <input value="<?php echo set_values('image'); ?>" type="file" name="image" id="image" class="form-control <?php echo empty($errors['image']) ? '' : 'border-danger'; ?>">
                        <span class="text-danger"><?php echo empty($errors['image']) ? "" : "*" . $errors['image']; ?></span>
                      </div>
                    </div>
                    <div class="d-flex flex-row align-items-center mb-4">
                      <img src="<?php echo $rows['image']; ?>" class="mt-3 mx-auto d-block" width="200" style="border-radius: 8px;">
                    </div>

                    <div class="d-flex justify-content-center mx-4 mb-3 mb-lg-4">
                      <button type="submit" class="btn btn-primary btn-lg">Save</button>
                      <a href="<?= $back_link; ?>" class="btn btn-outline-warning btn-lg ms-2">Cancle</a>
                    </div>

                    <p class="text-center text-muted mb-0">Have already an account?
                      <a href="index.php?pg=login" class="fw-bold text-body"><u>Login here</u></a>
                    </p>

                  </form>
                <?php else : ?>
                  <div class="alert alert-danger">
                    <h4>User was not found!</h4>
                  </div>
                  <a href="<?= $back_link; ?>" class="btn btn-outline-warning btn-lg ms-2">Cancle</a>
                <?php endif; ?>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>

<?php require views_path('partials/footer'); ?>