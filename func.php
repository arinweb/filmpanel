<?php
class func {
  function rank($gorev) {
    if ($_SESSION["user"]["kurucu"] == 0) {
      if ($_SESSION["user"][$gorev."kontrol"] == 0) {
        echo "Bu sayfaya erişiminiz yoktur!";
        exit;
      }
    }
  }
  function rankBAN() {
    if ($_SESSION["user"]["bankontrol"] == 1) {
      echo "<h1>Hesabınız Banlanmıştır!</h1>";
      session_destroy();
      header("Refresh:5;url=login.php");
      exit;
    }
  }
  
  function menuLINK($gorev, $name, $url, $css = "", $type = 0) {
    if (!empty($gorev)) {
      if ($_SESSION["user"][$gorev."kontrol"] == 1) {
        if ($type == 1) {
          ?>
          <li><a target="_blank" href="<?=$url ?>" style="<?=$css ?>"><?=$name ?></a></li>
          <?php
        } else {
          ?>
          <li><a href="<?=$url ?>" style="<?=$css ?>"><?=$name ?></a></li>
          <?php
        }
      }
    } else {
      if ($type == 1) {
        ?>
        <li><a target="_blank" href="<?=$url ?>" style="<?=$css ?>"><?=$name ?></a></li>
        <?php
      } else {
        ?>
        <li><a href="<?=$url ?>" style="<?=$css ?>"><?=$name ?></a></li>
        <?php
      }
    }
  }
  
  
  function formSelect($x,$y){
    if($x == $y){
      echo "selected";
    }
  }
}
?>