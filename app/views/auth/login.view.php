<?php require views_path('partials/header'); ?>
<section class="vh-100">
  <div class="container py-5 h-100">
    <div class="row d-flex align-items-center justify-content-center h-100">
      <div class="col-md-8 col-lg-7 col-xl-6">
        <img src="https://mdbcdn.b-cdn.net/img/Photos/new-templates/bootstrap-login-form/draw2.svg" class="img-fluid mb-3" alt="Phone image">
      </div>
      <div class="col-md-7 col-lg-5 col-xl-5 offset-xl-1">
        <form>

          <div class="d-flex align-items-center mb-3 pb-1">
            <i class="fas fa-cubes fa-2x me-3" style="color: #1266F1;"></i>
            <span class="h1 fw-bold mb-0"><?= APP_NAME ?></span>
          </div>

          <h5 class="fw-normal mb-3 pb-3" style="letter-spacing: 1px;">Sign into your account</h5>

          <div class="form-outline mb-4">
            <input type="email" class="form-control form-control-lg" placeholder="Email address" />
          </div>

          <div class="form-outline mb-4">
            <input type="password" class="form-control form-control-lg" placeholder="Password" />
          </div>

          <div class="pt-1 mb-4">
            <button class="btn btn-primary btn-lg btn-block text-white" type="submit">Login</button>
          </div>

          <a class="small text-muted" href="#!">Forgot password?</a>
          <p class="mb-5 pb-lg-2" style="color: #393f81;">Don't have an account? <a href="index.php?pg=signup" style="color: #393f81;">Register here</a></p>
          <a href="#!" class="small text-muted">Terms of use.</a>
          <a href="#!" class="small text-muted">Privacy policy</a>
        </form>
      </div>
    </div>
  </div>
</section>
<?php require views_path('partials/footer'); ?>