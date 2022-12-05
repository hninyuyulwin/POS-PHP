<?php

/**
 * graph creator
 */
class Graph
{

  public $canvasX = 1000;
  public $canvasY = 400;
  public $font_size = 16;
  public $styles = "";
  public $title = "Graph Title";
  public $xtitle = "Title X's";

  public function display($data)
  {
    $canvasX = $this->canvasX;
    $canvasY = $this->canvasY;

    if (!is_array($data) || empty($data)) {
      echo "data variable must be an array and contain data!";
      return;
    }

    $xText = array_keys($data);

    $maxY = max($data);
    $maxX = count($data);

    $multiplierY = $canvasY / $maxY;
    $multiplierX = $canvasX / $maxX;

    $num = 1;
    $points = "0,$canvasY ";
    foreach ($data as $key => $value) {

      $points .= $multiplierX * $num . "," . $canvasY - ($value * $multiplierY) . " ";
      $num++;
    }
    $points .= "$canvasX,$canvasY";

    $extraX = 100;
    $extraY = 50;

?>

    <svg viewBox="0 -<?= $extraY ?> <?= $canvasX + $extraX ?> <?= $canvasY + ($extraY * 2.5) ?>" class="border" style="width:100%;<?= $this->styles ?>">

      <!-- top to bottom lines-->
      <?php
      for ($i = 0; $i < $maxX; $i++) {

        $x1 = $i * $multiplierX;
        $y1 = 0;
        $x2 = $x1;
        $y2 = $canvasY;

      ?>
        <polyline points="<?= $x1 ?>,<?= $y1 ?> <?= $x2 ?>,<?= $y2 ?>" style="stroke-width:1;stroke:#eee" />
      <?php
      }

      ?>

      <!-- left to right lines-->
      <?php

      $max_lines = count($data);
      $Ysegment = round($canvasY / $max_lines);
      for ($i = 0; $i < $max_lines; $i++) {

        $x1 = 0;
        $y1 = $i * $Ysegment;
        $x2 = $canvasX;
        $y2 = $y1;

      ?>
        <polyline points="<?= $x1 ?>,<?= $y1 ?> <?= $x2 ?>,<?= $y2 ?>" style="stroke-width:1;stroke:#eee" />
      <?php
      }

      ?>


      <polyline points="<?= $points ?>" style="stroke-width:4;stroke:white;fill:#cccccc66" />

      <?php

      $num = 1;
      $points = "0,$canvasY ";
      foreach ($data as $key => $value) {

      ?>
        <circle cx="<?= $multiplierX * $num ?>" cy="<?= $canvasY - ($value * $multiplierY) ?>" r="6" style="fill:purple;stroke: white;stroke-width:2" />
        <?php if ($value != 0) : ?>
          <text x="<?= $multiplierX * $num ?>" y="<?= $canvasY - ($value * $multiplierY) + 30 ?>" style="font-size: 20px;fill:orange;"><?= $value; ?></text>
        <?php endif; ?>
      <?php
        $num++;
      }

      ?>

      <!-- X text values-->
      <?php $num = 0 ?>
      <?php foreach ($xText as $value) : $num++ ?>
        <text x="<?= ($num * $multiplierX) - $multiplierX / 5 ?>" y="<?= $canvasY + ($extraY / 1.5) ?>" style="fill:black;font-size: <?= $this->font_size ?>px"><?= $value ?></text>
      <?php endforeach; ?>

      <!-- Y text values-->
      <?php
      $max_lines = count($data);
      $Ysegment = round($canvasY / $max_lines);
      $num = $maxY;
      for ($i = 0; $i < $max_lines; $i++) {

        $x = $canvasX;
        $y = $i * $Ysegment;
        if (round($num) < 0) {
          break;
        }

      ?>
        <text x="<?= $x + ($multiplierX / 8) ?>" y="<?= $y ?>" style="fill:black;font-size: <?= $this->font_size ?>px"><?= round($num) ?></text>
      <?php

        $max_lines = $max_lines ? $max_lines : 1;
        $num -= $maxY / $max_lines;
      }

      ?>

      <!-- Graph Y Title -->
      <text x="10" y="-<?= ($extraY / 3) ?>" style="font-size: 25px;">
        <?= $this->title ?>
      </text>

      <!-- Graph X Title -->
      <?php $textoffset = (strlen($this->xtitle) / 2) * 8; ?>
      <text x="<?= ($canvasX / 2) - $textoffset ?>" y="<?= ($canvasY + $extraY + 10) ?>" style="font-size: 18px;">
        <?= $this->xtitle ?>
      </text>

    </svg>

<?php
  }
}
