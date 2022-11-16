<?php require views_path('partials/header'); ?>

<div class="container-fluid p-5 pt-3">
  <h2 class="text-center mb-5"><?= APP_NAME ?></h2>

  <div class="col-md-12 d-flex">
    <div class="col-md-7 shadow-lg p-4 pt-2" style="min-height: 600px;">
      <h3 class="text-center mb-5">Items
        <div class="col-5 float-end">

          <div class="input-group">
            <div class="form-outline">
              <input type="search" id="form1" class="form-control" placeholder="Search..." />
            </div>
            <button type="button" class="btn btn-primary">
              <i class="fas fa-search"></i>
            </button>
          </div>
        </div>
      </h3>

      <div class="js-products d-flex" style="flex-wrap: wrap;height: 90%;overflow-y: scroll;">
        <!-- card -->
        <div class="card border-0 me-3">
          <a href="">
            <img src="assets/images/image.jpg" class="rounded border" alt="" width="200" height="200">
          </a>
          <div class="p-2">
            <h5>Soft Drink Coffee</h5>
            <p><b>$5.00</b></p>
          </div>
        </div>
        <!--end card-->
        <!-- card -->
        <div class="card border-0 me-3">
          <a href="">
            <img src="assets/images/caramel-moolatte.png" class="rounded border" alt="" width="200" height="200">
          </a>
          <div class="p-2">
            <h5>Caramel Moolatte</h5>
            <p><b>$5.00</b></p>
          </div>
        </div>
        <!--end card-->
        <!-- card -->
        <div class="card border-0 me-3">
          <a href="">
            <img src="assets/images/orangeSoftDrink.jpg" class="rounded border" alt="" width="200" height="200">
          </a>
          <div class="p-2">
            <h5>Caramel Moolatte</h5>
            <p><b>$5.00</b></p>
          </div>
        </div>
        <!--end card-->
        <!-- card -->
        <div class="card border-0 me-3">
          <a href="">
            <img src="assets/images/fast-food.jpg" class="rounded border" alt="" width="200" height="200">
          </a>
          <div class="p-2">
            <h5>Caramel Moolatte</h5>
            <p><b>$5.00</b></p>
          </div>
        </div>
        <!--end card-->
        <!-- card -->
        <div class="card border-0 me-3">
          <a href="">
            <img src="assets/images/Taco.jpg" class="rounded border" alt="" width="200" height="200">
          </a>
          <div class="p-2">
            <h5>Caramel Moolatte</h5>
            <p><b>$5.00</b></p>
          </div>
        </div>
        <!--end card-->
      </div>
    </div>

    <div class="col-md-5 bg-light p-4 pt-2">
      <div class="row">
        <h3 class="text-center mb-3">
          Cart
          <span class="badge bg-warning rounded-circle">3</span>
        </h3>
      </div>
      <div class="table-responsive" style="height: 400px;overflow-y: scroll;">
        <table class="table table-striped table-hover">
          <tr>
            <th>Image</th>
            <th>Description</th>
            <th>Amount</th>
          </tr>
          <!--item-->
          <tr>
            <td>
              <img src="assets/images/image.jpg" class="rounded border" alt="" width="100" height="100">
            </td>
            <td>
              <p class="text-info"><b>Soft Drink Coffee</b></p>
              <div class="input-group" style="max-width: 150px;">
                <span class="input-group-text" style="cursor: pointer;" id="basic-addon1"><i class="fa fa-minus text-primary"></i></span>
                <input type="number" class="form-control text-primary text-center" placeholder="1" value="1">
                <span class="input-group-text" style="cursor: pointer;" id="basic-addon1"><i class="fa fa-plus text-primary"></i></span>
              </div>

            </td>
            <td>
              <p><b>$5.00</b></p>
            </td>
          </tr>
          <!--end item-->
          <!--item-->
          <tr>
            <td>
              <img src="assets/images/burgercombo.png" class="rounded border" alt="" width="100" height="100">
            </td>
            <td>
              <p class="text-info"><b>Burger & Cola Combo Set</b></p>
              <div class="input-group" style="max-width: 150px;">
                <span class="input-group-text" style="cursor: pointer;" id="basic-addon1"><i class="fa fa-minus text-primary"></i></span>
                <input type="number" class="form-control text-primary text-center" placeholder="1" value="1">
                <span class="input-group-text" style="cursor: pointer;" id="basic-addon1"><i class="fa fa-plus text-primary"></i></span>
              </div>

            </td>
            <td>
              <p><b>$9.00</b></p>
            </td>
          </tr>
          <!--end item-->
        </table>
      </div>
      <hr>

      <div class="alert alert-success" style="font-size: 20px;">
        Sub Total : $3.00
      </div>
      <div class="float-end">
        <button class="btn btn-lg btn-primary">Checkout</button>
        <button class="btn btn-lg btn-outline-warning">Clear All</button>
      </div>
    </div>

  </div>
</div>

<script>
  function get_data() {
    var ajax = new XMLHttpRequest();
    ajax.addEventListener('readystatechange', function(e) {
      console.log(ajax.responseText());
    });
    ajax.open('POST', 'index.php?pg=home', ture);
    ajax.send();
  }
</script>

<?php require views_path('partials/footer'); ?>