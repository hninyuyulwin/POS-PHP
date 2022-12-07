<?php require views_path('partials/header'); ?>
<style>
  .hide {
    display: none;
  }

  @keyframes appear {
    0% {
      opacity: 0;
      transform: translateY(-100px);
    }

    100% {
      opacity: 1;
      transform: translateY(0px);
    }
  }
</style>
<div class="container-fluid p-5 pt-3">
  <h2 class="text-center mb-5"><?= APP_NAME ?></h2>

  <div class="col-md-12 d-flex">
    <div class="col-md-7 shadow-lg p-4 pt-2" style="min-height: 600px;">
      <h3 class="text-center mb-5">Items
        <div class="col-5 float-end">
          <div class="input-group">
            <div class="form-outline">
              <input onkeyup="check_for_enter_key(event)" oninput="search_item(event)" type="search" id="form1" class="form-control js-search" placeholder="Search..." />
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
              <th>Action</th>
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
        <button onclick="show_modal('amount-paid')" class="btn btn-lg btn-primary" data-bs-target="#exampleModal">Checkout</button>
        <button onclick="clear_all()" class="btn btn-lg btn-outline-warning">Clear All</button>
      </div>
    </div>

  </div>
</div>

<!-- modal start -->
<!--amount paid modal start-->
<div role="close-button" onclick="hide_modal(event,'amount-paid')" class="js-amount-paid-modal hide" style="animation: appear .5s ease;background-color: #00000077;width: 100%;height: 100%;position: fixed;left: 0px;top: 0px;z-index: 999;">
  <div class="shadow-lg" style="width: 500px;min-height: 200px;background-color: white;padding: 20px;margin: auto;margin-top: 12%;border-radius: 10px;">
    <h4 class="text-primary mb-2">Check Out
      <button role="close-button" onclick="hide_modal(event,'amount-paid')" class="btn float-end"><i class="fa fa-times"></i></button>
    </h4>
    <input onkeyup="if(event.keyCode == 13) validated_amount_input(event)" type="text" class="js-amount-paid-input form-control my-3" placeholder="Enter Amount Paid">
    <button onclick="validated_amount_input(event)" class="btn btn-success">Next</button>
    <button role="close-button" onclick="hide_modal(event,'amount-paid')" class="btn btn-danger float-end">Cancle</button>
  </div>
</div>
<!--amount paid modal end-->
<!--change modal start-->
<div role="close-button" onclick="hide_modal(event,'change')" class="js-change-modal hide" style="animation: appear .5s ease;background-color: #00000077;width: 100%;height: 100%;position: fixed;left: 0px;top: 0px;z-index: 999;">

  <div class="shadow-lg" style="width: 500px;min-height: 200px;background-color: white;padding: 20px;margin: auto;margin-top: 12%;border-radius: 10px;">
    <h4 class="text-primary mb-2">Change
      <button role="close-button" onclick="hide_modal(event,'change')" class="btn float-end"><i class="fa fa-times"></i></button>
    </h4>
    <hr>
    <div class="js-change-input text-center my-3" style="font-size: 30px;"></div>
    <button role="close-button" onclick="hide_modal(event,'change')" class="btn btn-danger float-end js-btn-close-change">Proceed</button>
  </div>
</div>
<!--change modal end-->
<!-- end modal -->

<script>
  //var search_box = document.querySelector('.js-search');
  //search_box.addEventListener("change",function(e){
  //  console.log("Changed");
  //});

  var PRODUCTS = [];
  var ITEMS = [];
  var BARCODE = false;
  var main_input = document.querySelector('.js-search');
  var GTOTAL = 0;
  var CHANGE = 0;
  var RECEIPT_WINDOW = null;


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
          if (ajax.responseText.trim() != "") {
            handle_result(ajax.responseText);
          } else {
            if (BARCODE) {
              alert("That item was not found!");
            }
          }
        } else {
          console.log("An error occurs! Error Code :" + ajax.status + ".Error Message :" + ajax.statusText);
          console.log(ajax);
        }
        // Clear main input if enter key pressed
        if (BARCODE) {
          main_input.value = "";
          main_input.focus();
        }
        BARCODE = false;
      }
      //console.log(ajax.readyState);
    });
    ajax.open('POST', 'index.php?pg=ajax', true);
    ajax.send(JSON.stringify(data)); // stringify = convert object to string
  }

  function handle_result(result) {
    //console.log(result);
    var obj = JSON.parse(result);

    if (typeof obj != 'undefined') {
      // Valid JSON
      if (obj.data_type == "search") {

        var mydiv = document.querySelector(".js-products");
        mydiv.innerHTML = "";
        PRODUCTS = [];
        var mydiv = document.querySelector(".js-products");
        if (obj.data != "") {
          PRODUCTS = obj.data;
          for (var i = 0; i < obj.data.length; i++) {
            mydiv.innerHTML += product_html(obj.data[i], i);
          }
          if (BARCODE && PRODUCTS.length == 1) {
            add_item_from_index(0);
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

  function item_html(data, index) {
    return `
      <!--item-->
        <tr>
          <td>
            <img src="${data.image}" class="rounded border" alt="" width="100" height="100">
          </td>
          <td>
            <p class="text-info"><b>${data.description}</b></p>
            <div class="input-group" style="max-width: 150px;">
              <span index="${index}" onclick="change_qty('down',event)" class="input-group-text" style="cursor: pointer;" id="basic-addon1"><i class="fa fa-minus text-primary"></i></span>
              <input index="${index}" onblur="change_qty('input',event)" type="text" disabled class="form-control text-primary text-center bg-white" placeholder="1" value="${data.qty}">
              <span index="${index}" onclick="change_qty('up',event)" class="input-group-text" style="cursor: pointer;" id="basic-addon1"><i class="fa fa-plus text-primary"></i></span>
            </div>

          </td>
          <td>
            <p><b>${data.amount+" Ks"}</b></p>
          </td>
          <td>
            <button onclick="clear_item(${index})" class="btn btn-sm btn-outline-danger"><i class="fa fa-times"></i></button>
          </td>
        </tr>
      <!--end item-->
    `;
  }

  function add_item_from_index(index) {
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

  function add_item(e) {
    if (e.target.tagName == "IMG") {
      var index = e.target.getAttribute("index");

      add_item_from_index(index);
    }
  }

  function refresh_items_display() {
    var item_count = document.querySelector('.js-item-count');
    item_count.innerHTML = ITEMS.length;

    var items_div = document.querySelector('.js-items');
    items_div.innerHTML = "";
    var grand_total = 0;
    for (let i = ITEMS.length - 1; i >= 0; i--) {
      items_div.innerHTML += item_html(ITEMS[i], i);
      grand_total += ITEMS[i].qty * ITEMS[i].amount;
    }
    var gtotal_div = document.querySelector('.js-gtotal');
    gtotal_div.innerHTML = "Total : " + grand_total + " Ks";
    GTOTAL = grand_total;
  }

  function clear_all() {
    if (!confirm('Are you sure want to clear all in the list??!!')) {
      return;
    }
    ITEMS = [];
    refresh_items_display();
  }

  function clear_item(index) {
    if (!confirm('Sure to Remove Item??')) {
      return;
    }
    ITEMS.splice(index, 1);
    refresh_items_display();
  }

  function change_qty(direction, e) {
    var index = e.currentTarget.getAttribute('index');
    if (direction == 'up') {
      ITEMS[index].qty += 1;
    } else if (direction == 'down') {
      ITEMS[index].qty -= 1;
    } else {
      ITEMS[index].qty = parseInt(e.currentTarget.value);
    }

    // make sure not to less than 1
    if (ITEMS[index].qty < 1) {
      ITEMS[index].qty = 1;
    } else if (ITEMS[index].qty >= PRODUCTS[index].qty) {
      ITEMS[index].qty = PRODUCTS[index].qty;
    }
    refresh_items_display();
  }

  function check_for_enter_key(e) {
    if (e.keyCode == 13) // enter key
    {
      BARCODE = true;
      search_item(e);
    }
  }

  function show_modal(modal) {
    if (modal == 'amount-paid') {
      if (ITEMS.length == 0) {
        alert('Please add at least one item in the cart!');
        return;
      }
      var mydiv = document.querySelector('.js-amount-paid-modal');
      mydiv.classList.remove('hide');

      mydiv.querySelector('.js-amount-paid-input').value = "";
      mydiv.querySelector('.js-amount-paid-input').focus();
    } else if (modal == 'change') {
      var mydiv = document.querySelector('.js-change-modal');
      mydiv.classList.remove('hide');

      mydiv.querySelector('.js-change-input').innerHTML = CHANGE;
      mydiv.querySelector('.js-btn-close-change').focus();
    }
  }

  function hide_modal(e, modal) {
    if (modal == 'amount-paid') {
      if (e == true || e.target.getAttribute('role') == 'close-button') {
        var mydiv = document.querySelector('.js-amount-paid-modal');
        mydiv.classList.add('hide');
      }
    } else if (modal == 'change') {
      if (e.target.getAttribute('role') == 'close-button') {
        var mydiv = document.querySelector('.js-change-modal');
        mydiv.classList.add('hide');
      }
    }
  }

  function validated_amount_input(e) {
    var amount = e.currentTarget.parentNode.querySelector('.js-amount-paid-input').value.trim();
    amount = parseInt(amount);
    if (amount < GTOTAL) {
      alert('Your amount is less than your total value');
      return;
    } else if (!amount) {
      alert('Input value must be number and not empty');
      return;
    }
    CHANGE = parseInt(amount - GTOTAL);
    hide_modal(true, 'amount-paid');
    show_modal('change');

    //remove unwanted information
    var ITEMS_NEW = [];
    for (let i = 0; i < ITEMS.length; i++) {
      var tmp = {};
      tmp.id = ITEMS[i]['id'];
      tmp.qty = ITEMS[i]['qty'];
      tmp.description = ITEMS[i]['description'];

      ITEMS_NEW.push(tmp);
    }

    // Send cart data through ajax
    send_data({
      data_type: 'checkout',
      text: ITEMS_NEW
    });

    // open recipt page
    print_recipt({
      company: 'Daisy',
      amount: amount,
      change: CHANGE,
      data: ITEMS,
      total: GTOTAL,
    });

    // clear items
    ITEMS = [];
    refresh_items_display();

    // reload products
    send_data({
      data_type: 'search',
      text: ''
    });
  }

  function print_recipt(obj) {
    var vars = JSON.stringify(obj);
    RECEIPT_WINDOW = window.open('index.php?pg=print&vars=' + vars, 'printpage', "width=200px;");
    setTimeout(function() {
      RECEIPT_WINDOW.close();
    }, 3000);
  }

  send_data({
    data_type: "search",
    text: ""
  });
</script>

<?php require views_path('partials/footer'); ?>