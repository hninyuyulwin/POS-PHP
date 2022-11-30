<?php require views_path('partials/header'); ?>

<style>
  .gradient-custom {
    /* fallback for old browsers */
    background: #f6d365;

    /* Chrome 10-25, Safari 5.1-6 */
    background: -webkit-linear-gradient(to right bottom, rgba(246, 211, 101, 1), rgba(253, 160, 133, 1));

    /* W3C, IE 10+/ Edge, Firefox 16+, Chrome 26+, Opera 12+, Safari 7+ */
    background: linear-gradient(to right bottom, rgba(246, 211, 101, 1), rgba(253, 160, 133, 1))
  }

  .for-edit-hover:hover {
    color: yellow;
  }
</style>
<section class="vh-100" style="background-color: #f4f5f7;">
  <div class="container py-5">
    <?php if (Auth::access('admin')) : ?>
      <div class="row">
        <div class="col">
          <nav aria-label="breadcrumb" class="bg-light rounded-3 p-3 mb-4">
            <ol class="breadcrumb mb-0">
              <li class="breadcrumb-item"><a href="index.php?pg=home">Home</a></li>
              <li class="breadcrumb-item"><a href="index.php?pg=admin&tab=users">User</a></li>
              <?php if (!empty($rows)) : ?>
                <li class="breadcrumb-item active" aria-current="page">Hello, <?= $rows['username']; ?></li>
              <?php endif; ?>
            </ol>
          </nav>
        </div>
      </div>
    <?php endif; ?>

    <?php if (is_array($rows)) : ?>
      <div class="row d-flex justify-content-center align-items-center">
        <div class="col col-lg-6 mb-4 mb-lg-0">
          <div class="card mb-3" style="border-radius: .5rem;">
            <div class="row g-0">
              <div class="col-md-4 gradient-custom text-center text-white" style="border-top-left-radius: .5rem; border-bottom-left-radius: .5rem;">
                <img src="<?= crop($rows['image'], 400, $rows['gender']) ?>" alt="Avatar" class="img-fluid my-5" style="width: 80px;border-radius: 50px;" />
                <h5><?= $rows['username']; ?></h5>
                <p><?= $rows['role']; ?></p>
                <a class="for-edit-hover" href="index.php?pg=user-edit&id=<?= $rows['id']; ?>">
                  <i class="far fa-edit me-2"></i>Edit Profile
                </a>
              </div>
              <div class="col-md-8">
                <div class="card-body p-4">
                  <h6>Information</h6>
                  <hr class="mt-0 mb-4">
                  <div class="row pt-1">
                    <div class="col-6 mb-3">
                      <h6>Email</h6>
                      <p class="text-muted"><?= $rows['email']; ?></p>
                    </div>
                    <div class="col-6 mb-3">
                      <h6>Password</h6>
                      <p class="text-muted"><?= 56324586; ?></p>
                    </div>
                  </div>
                  <div class="row pt-1">
                    <div class="col-6 mb-3">
                      <h6>Gender</h6>
                      <p class="text-muted"><?= $rows['gender']; ?></p>
                    </div>
                    <div class="col-6 mb-3">
                      <h6>Role</h6>
                      <p class="text-muted"><?= $rows['role']; ?></p>
                    </div>
                  </div>
                  <div class="row pt-1">
                    <div class="col-6 mb-3">
                      <h6>Joined Date</h6>
                      <p class="text-muted"><?= get_date($rows['date']); ?></p>
                    </div>
                  </div>
                  <h6>Account Deletion</h6>
                  <hr class="mt-0 mb-3">
                  <div class="col-6 mb-5">
                    <a href="index.php?pg=user-delete&id=<?= $rows['id']; ?>">
                      <button type="button" class="btn btn-outline-danger">Delete Your Account</button>
                    </a>
                  </div>
                  <div class="d-flex justify-content-start">
                    <a href="#!"><i class="fab fa-facebook-f fa-lg me-3"></i></a>
                    <a href="#!"><i class="fab fa-twitter fa-lg me-3"></i></a>
                    <a href="#!"><i class="fab fa-instagram fa-lg"></i></a>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    <?php else : ?>
      <div class="alert alert-danger">
        <h4 class="text-center">User was not found!</h4>
      </div>
      <a href="index.php?pg=admin&tab=users" class="btn btn-outline-warning btn-lg ms-2">Cancle</a>

    <?php endif; ?>
  </div>
</section>
<?php require views_path('partials/footer'); ?>