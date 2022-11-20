<?php require views_path('partials/header'); ?>

<div class="container-fluid p-5 pt-3">
  <h2 class="text-center mb-5"><?= APP_NAME ?></h2>

  <div class="col-md-12 d-flex">
    <div class="col-md-7 shadow-lg p-4 pt-2" style="min-height: 600px;">
      <h3 class="text-center mb-5">Items
        <div class="col-5 float-end">
          <div class="input-group">
            <div class="form-outline">
              <input oninput="search_item(event)" type="search" id="form1" class="form-control js-search" placeholder="Search..." />
            </div>
            <button type="button" class="btn btn-primary">
              <i class="fas fa-search"></i>
            </button>
          </div>
        </div>
      </h3>

      <div onclick="add_item(event)" class="js-products d-flex" style="flex-wrap: wrap;height: 90%;overflow-y: scroll;">

      </div>
    </div>

    <div class="col-md-5 bg-light p-4 pt-2">
      <div class="row">
        <h3 class="text-center mb-3">
          Cart
          <span class="badge bg-warning rounded-circle js-item-count">0</span>
        </h3>
      </div>
      <div class="table-responsive" style="height: 400px;overflow-y: scroll;">
        <table class="table table-striped table-hover">
          <thead>
            <tr>
              <th>Image</th>
              <th>Description</th>
              <th>Amount</th>
            </tr>
          </thead>
          <tbody class="js-items">

          </tbody>
        </table>
      </div>
      <hr>

      <div class="js-gtotal alert alert-success" style="font-size: 20px;">
        Total : 0 Ks
      </div>
      <div class="float-end">
        <button class="btn btn-lg btn-primary">Checkout</button>
        <button class="btn btn-lg btn-outline-warning">Clear All</button>
      </div>
    </div>

  </div>
</div>

<script>
  //var search_box = document.querySelector('.js-search');
  //search_box.addEventListener("change",function(e){
  //  console.log("Changed");
  //});

  var PRODUCTS = [];
  var ITEMS = [];

  function search_item(e) {
    //console.log('Hello Changed');
    var text = e.target.value.trim();

    //if (text == "") return;

    var data = {};
    data.data_type = "search";
    data.text = text;
    send_data(data);
  };

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
    ajax.send(JSON.stringify(data)); // stringify = convert object to string
  }

  function handle_result(result) {
    var obj = JSON.parse(result);

    if (typeof obj != 'undefined') {
      // Valid JSON
      if (obj.data_type == "search") {
        var mydiv = document.querySelector(".js-products");
        mydiv.innerHTML = "";
        PRODUCTS = [];
        if (obj.data != "") {
          PRODUCTS = obj.data;
          for (var i = 0; i < obj.data.length; i++) {
            mydiv.innerHTML += product_html(obj.data[i], i);
          }
        }
      }

    }
  }

  function product_html(data, index) {
    return `
    <!-- card -->
        <div class="card text-center border-0 me-3">
          <a href="#">
            <img index="${index}" src="${data.image}" class="rounded border" alt="" width="200" height="200">
          </a>
          <div class="p-2">
            <h5>${data.description}</h5>
            <p><b>${data.amount+" Ks"}</b></p>
          </div>
        </div>
        <!--end card-->
        `;
  }

  function item_html(data) {
    return `
      <!--item-->
        <tr>
          <td>
            <img src="${data.image}" class="rounded border" alt="" width="100" height="100">
          </td>
          <td>
            <p class="text-info"><b>${data.description}</b></p>
            <div class="input-group" style="max-width: 150px;">
              <span class="input-group-text" style="cursor: pointer;" id="basic-addon1"><i class="fa fa-minus text-primary"></i></span>
              <input type="number" class="form-control text-primary text-center" placeholder="1" value="${data.qty}">
              <span class="input-group-text" style="cursor: pointer;" id="basic-addon1"><i class="fa fa-plus text-primary"></i></span>
            </div>

          </td>
          <td>
            <p><b>${data.amount+" Ks"}</b></p>
          </td>
        </tr>
      <!--end item-->
    `;
  }

  function add_item(e) {
    if (e.target.tagName == "IMG") {
      var index = e.target.getAttribute("index");

      // check if items exists
      for (var i = ITEMS.length - 1; i >= 0; i--) {
        if (ITEMS[i].id == PRODUCTS[index].id) {
          ITEMS[i].qty += 1;
          refresh_items_display();
          return;
        }
      }
      var temp = PRODUCTS[index];
      temp.qty = 1;
      ITEMS.push(temp);
      refresh_items_display();
    }
  }

  function refresh_items_display() {
    var item_count = document.querySelector('.js-item-count');
    item_count.innerHTML = ITEMS.length;

    var items_div = document.querySelector('.js-items');
    items_div.innerHTML = "";
    var grand_total = 0;
    for (let i = ITEMS.length - 1; i >= 0; i--) {
      items_div.innerHTML += item_html(ITEMS[i]);
      grand_total += ITEMS[i].qty * ITEMS[i].amount;
    }
    var gtotal_div = document.querySelector('.js-gtotal');
    gtotal_div.innerHTML = "Total : " + grand_total + " Ks";
  }

  send_data({
    data_type: "search",
    text: ""
  });
</script>

<?php require views_path('partials/footer'); ?>