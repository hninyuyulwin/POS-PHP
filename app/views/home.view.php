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
  function send_data(data) {
    var ajax = new XMLHttpRequest();

    ajax.addEventListener('readystatechange', function(e) {

      if (ajax.readyState == 4) {
        if (ajax.status == 200) {
          handle_result(ajax.responseText);
        } else {
          console.log("An error occurs! Error Code :" + ajax.status + ".Error Message :" + ajax.statusText);
          console.log(ajax);
        }
      }
      //console.log(ajax.readyState);
    });
    ajax.open('POST', 'index.php?pg=ajax', true);
    ajax.send();
  }

  function handle_result(result) {
    var obj = JSON.parse(result);

    if (typeof obj != 'undefined') {
      // Valid JSON
      var mydiv = document.querySelector(".js-products ");
      mydiv.innerHTML = "";
      for (var i = 0; i < obj.length; i++) {
        mydiv.innerHTML += product_html(obj[i]);
      }
    }
  }

  function product_html(data) {
    return `
    <!-- card -->
        <div class="card border-0 me-3">
          <a href="">
            <img src="${data.image}" class="rounded border" alt="" width="200" height="200">
          </a>
          <div class="p-2">
            <h5>${data.description}</h5>
            <p><b>${data.amount+" Ks"}</b></p>
          </div>
        </div>
        <!--end card-->
        `;
  }

  send_data();
</script>

<?php require views_path('partials/footer'); ?>