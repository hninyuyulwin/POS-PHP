<?php require views_path('partials/header'); ?>

<section class="vh-100">
  <div class="container h-100">
    <div class="row d-flex justify-content-center align-items-center h-100">
      <div class="col-lg-12 col-xl-11">
        <div class="card text-black" style="border-radius: 25px;">
          <div class="card-body p-md-5">
            <div class="row justify-content-center">
              <div class="col-md-10 col-lg-6 col-xl-5 order-2 order-lg-1">

                <p class="text-center h1 fw-bold mb-5 mx-1 mx-md-4 mt-4">Sign up</p>

                <form method="POST" action="" class="mx-1 mx-md-4">

                  <div class="d-flex flex-row align-items-center mb-4">
                    <i class="fas fa-user fa-lg me-3 fa-fw"></i>
                    <div class="form-outline flex-fill mb-0">
                      <input value="<?php echo set_values('username'); ?>" type="text" name="username" class="form-control <?php echo !empty($errors['username']) ? 'border-danger' : ''; ?> " placeholder="Your Name" />
                      <span class="text-danger"><?php echo empty($errors['username']) ? '' : "*" . $errors['username']; ?></span>
                    </div>
                  </div>

                  <div class="d-flex flex-row align-items-center mb-4">
                    <i class="fas fa-envelope fa-lg me-3 fa-fw"></i>
                    <div class="form-outline flex-fill mb-0">
                      <input value="<?php echo set_values('email'); ?>" type="text" name="email" class="form-control <?php echo !empty($errors['username']) ? 'border-danger' : ''; ?> " placeholder="Your Email" />
                      <span class="text-danger"><?php echo empty($errors['email']) ? '' : "*" . $errors['email']; ?></span>
                    </div>
                  </div>

                  <div class="d-flex flex-row align-items-center mb-4">
                    <i class="fas fa-lock fa-lg me-3 fa-fw"></i>
                    <div class="form-outline flex-fill mb-0">
                      <input value="<?php echo set_values('password'); ?>" type="password" name="password" class="form-control <?php echo !empty($errors['username']) ? 'border-danger' : ''; ?> " placeholder="Password" />
                      <span class="text-danger"><?php echo empty($errors['password']) ? '' : "*" . $errors['password']; ?></span>
                    </div>
                  </div>

                  <div class="d-flex flex-row align-items-center mb-4">
                    <i class="fas fa-key fa-lg me-3 fa-fw"></i>
                    <div class="form-outline flex-fill mb-0">
                      <input value="<?php echo set_values('password_retype'); ?>" type="password" name="password_retype" class="form-control <?php echo !empty($errors['username']) ? 'border-danger' : ''; ?> " placeholder="Repeat your password" />
                      <span class="text-danger"><?php echo empty($errors['password_retype']) ? '' : "*" . $errors['password_retype']; ?></span>
                    </div>
                  </div>

                  <div class="form-check d-flex justify-content-center mb-5">
                    <input class="form-check-input me-2" type="checkbox" value="" id="form2Example3" />
                    <label class="form-check-label" for="form2Example3">
                      I agree all statements in <a href="#!">Terms of service</a>
                    </label>
                  </div>

                  <div class="d-flex justify-content-center mx-4 mb-3 mb-lg-4">
                    <button type="submit" class="btn btn-primary btn-lg">Create</button>
                    <a href="index.php?pg=admin&tab=users" class="btn btn-outline-warning btn-lg ms-2">Cancle</a>
                  </div>

                  <p class="text-center text-muted mb-0">Have already an account?
                    <a href="index.php?pg=login" class="fw-bold text-body"><u>Login here</u></a>
                  </p>

                </form>

              </div>
              <div class="col-md-10 col-lg-6 col-xl-7 d-flex align-items-center order-1 order-lg-2">
                <img src="https://mdbcdn.b-cdn.net/img/Photos/new-templates/bootstrap-registration/draw1.webp" class="img-fluid" alt="Sample image">
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>

<?php require views_path('partials/footer'); ?>