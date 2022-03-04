<?php
error_reporting(0);
try {
  $db = new PDO("mysql:host=localhost;dbname=filminfo;charset=utf8", "root", "");

  #echo "Bağlanıldı";
}catch (PDOExpception $hata) {
  echo $hata->getMessage();
}
date_default_timezone_set("Europe/Istanbul");
ob_start();
session_start();
?>