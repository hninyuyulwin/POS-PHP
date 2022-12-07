<?php
if ($_SERVER['REQUEST_METHOD'] == 'POST') {

  $WshShell = new COM("WScript.Shell");
  $obj = $WshShell->Run("cmd /c wscript.exe " . ABSPATH . "/file.vbs", 0, true);

  $WshShell = new COM("WScript.Shell");
  $obj = $WshShell->Run("cmd /c wscript.exe " . ABSPATH . "/file.vbs", 0, true);

  // $WshShell = new COM("WScript.Shell");
  // $obj = $WshShell->Run("cmd /c wscript.exe " . ABSPATH . "/file.vbs", 0, true);
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title><?= esc(APP_NAME) ?></title>
  <link rel="stylesheet" href="assets/css/bootstrap.min.css">
  <link rel="stylesheet" href="assets/css/all.min.css">
  <link rel="stylesheet" href="assets/css/main.css">

</head>

<body>
  <div class="container-fluid">
    <?php
    $vars = $_GET['vars'] ?? "";
    $obj = json_decode($vars, true);
    ?>
    <?php if (is_array($obj)) : ?>
      <center>
        <h1><?= $obj['company']; ?></h1>
        <h4>Recipt</h4>
      </center>
      <hr>
      <p class="float-end" style="font-style: italic;"><?= date('d-M-Y H:i A'); ?></p>

      <table class="table">
        <thead>
          <tr>
            <th>Product</th>
            <th>Qty</th>
            <th>@</th>
            <th>Price</th>
          </tr>
        </thead>
        <tbody>
          <?php
          $no = 1;
          foreach ($obj['data'] as $row) :
          ?>
            <tr>
              <td><?= $no . ". " . $row['description']; ?></td>
              <td><?= $row['qty']; ?></td>
              <td><?= number_format($row['amount']) . " Ks"; ?></td>
              <td><?= number_format($row['qty'] * $row['amount']) . " Ks"; ?></td>
            </tr>
          <?php
            $no++;
          endforeach;
          ?>
        </tbody>
        <tfoot>
          <tr>
            <td><b>Total</b></td>
            <td></td>
            <td></td>
            <td><b><?= number_format($obj['total']) . " Ks"; ?></b></td>
          </tr>
          <tr>
            <td><b>Amount Paid</b></td>
            <td></td>
            <td></td>
            <td><b><?= number_format($obj['amount']) . " Ks"; ?></b></td>
          </tr>
          <tr>
            <td><b>Change</b></td>
            <td></td>
            <td></td>
            <td><b><?= number_format($obj['change']) . " Ks"; ?></b></td>
          </tr>
        </tfoot>
      </table>
      <center>
        <p>Thanks For Shopping With Us!</p>
      </center>

    <?php endif; ?>
  </div>
  <script>
    window.print();
    var ajax = new XMLHttpRequest();
    ajax.addEventListener('readystatechange', function() {
      if (ajax.readyState == 4) {
        //console.log(ajax.responseText);
      }
    });
    ajax.open('POST', '', true);
    //ajax.send();
  </script>
</body>


<script src="assets/js/bootstrap.min.js"></script>

</html>