<?php
include("conn.php");
include("func.php");
$func = new func();
$func->rankBAN();
if (!$_SESSION["user"]["status"]) {
  header("location:login.php");
  exit;
}
?>
<!DOCTYPE html>
<html lang="tr">
<head>
  <!--Meta Verileri-->
  <meta charset="UTF-8">
  <meta http-equiv="content-language" content="tr">
  <meta http-equiv="X-UA-Compatible" content="IE=Edge">
  <meta name="viewport" content="width=device-width, initial-scale=1, minimum-scale=1, maximum-scale=1">
  <meta name="theme-color" content="BARCOLOR">
  <!--Meta Verileri-->
  <link rel="alternate" hreflang="tr" />
  <link rel="icon" type="image/png" sizes="16x16" href="FAVİCON">
  <script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  <title>Film info Admin Paneli</title>
  <style>
@import url("https://fonts.googleapis.com/css?family=Quicksand");
    * {
      font-family: Quicksand;
    }
    .baslik {
      background: #1500ff;
      color: white;
      margin: 10px 0px;
      border-radius: 5px;
      padding: 5px;
    }
    #userdelete {
      color: white;
      background: red;
      padding: 10px;
      border-radius: 5px;
      text-decoration: none;
      display: inline-block;
      text-align: center;
      margin: 0px 20px;
    }
    table,.listDiv {
      overflow: scroll;
      width: 100%;
    }
    table tr:nth-child(1) td {
      color: #1500ff;
      border: 2px solid #1500ff;
    }
    table tr td {
      padding: 5px;
      border: 2px solid black;
      border-radius: 5px;
    }
    table tr td a {
      background: red;
      color: white;
      padding: 5px;
      border-radius: 5px;
      display: block;
      text-decoration: none;
      text-align: center;
      width: 80%;
    }
    .menu {
      display: grid;
      grid-template-columns: auto auto auto;
      width: 90%;
    }
    .menu a {
      width: 100%;
      height: 30px;
      display: flex;
      align-items: center;
      justify-content: center;
      margin: 5px;
    }
    .bilgi {
      background: #1500ff;
      color: white;
      width: 90%;
      display: block;
      margin: 0px;
      padding: 10px;
      border-radius: 5px;
    }
    .bilgi h3 {
      display: inline-block;
      margin: 5px 5px 5px -10px;
      background: #101010;
      padding: 10px;
      border-radius: 0px 5px 5px 0px;
    }
    ul {
      list-style: none;
      margin: 5px;
      padding: 5px;
      width: 30%;
    }
    ul li {
      margin: 5px 0px;
    }
    ul li a {
      padding: 5px;
      margin: 5px;
      width: 100%;
      background: #1500ff;
      color: white;
      border-radius: 5px;
      text-decoration: none;
      text-align: center;
      display: block;
    }
    input,select {
      padding: 5px;
      margin: 10px;
      width: 60%;
      border: 2px solid #1249d6;
      outline: none;
      font-size: 18px;
      border-radius: 5px;
    }
    textarea {
      width: 90%;
      height: 300px;
    }
    button {
      margin: 10px;
      font-size: 18px;
      border-radius: 5px;
      background: #1500ff;
      color: white;
      padding: 10px;
      border: none;
      outline: none;
    }
    .formX ul {
      width: 80%;
    }
    .formX ul li {
      display: flex;
      align-items: center;
      justify-content: left;
    }
    .formX ul li input, select {
      width: 80%;
      background: white;
    }
    .formX select {
      background: white;
    }
    .formX textarea {
      margin: 10px;
      border: 2px solid #1249ff;
      border-radius: 5px;
    }
    .formX .checkbox {
      width: 25px;
      height: 25px;
    }
    .formX #bankontrol {
      width: 30px;
      height: 30px;
      margin-left: 20px;
      display: block;
    }
    #imageOut {
      max-width: 350px;
      max-height: 350px;
      margin: 5px;
      border-radius: 5px;
      border:2px solid #212121;
    }
  </style>
</head>
<body>
  <h1 class="baslik">Film İnfo</h1>
  <ul class="bilgi">
    <h3>Üye Bilgileri</h3>
    <li><b>Adı:&nbsp;</b> <?= $_SESSION["user"]["name"] ?></li>
    <li><b>E-Posta:&nbsp;</b> <?= $_SESSION["user"]["mail"] ?></li>
    <li><b>Önceki Giriş:&nbsp;</b> <?= $_SESSION["user"]["songiris"] ?></li>
    <li><b>Güncel Tarih:&nbsp;</b> <?= date('d-m-Y H:i:s') ?></li>
  </ul>
  <br>
  <ul class="menu">
    <?php

    $func->menuLINK("", "Ana Sayfa", "index.php");
    $func->menuLINK("filmlist", "Film Listesi", "filmlist.php");
    $func->menuLINK("filmekle", "Film Ekle", "filmekle.php");
    $func->menuLINK("filmedit", "Film Düzenle", "filmedit.php");
    $func->menuLINK("uye", "Ziyaretçiler", "ziyaretci.php");
    $func->menuLINK("uye", "Üye Listesi", "uyelist.php");
    $func->menuLINK("uye", "Üye Ekle", "uyeekle.php");
    $func->menuLINK("bilgilerim", "Bilgilerim", "bilgilerim.php");
    $func->menuLINK("chat", "Chat", "messages.php");
    $func->menuLINK("sql", "Sql Yükle", "importsqlfile.php");
    $func->menuLINK("sql", "Sql Kodla", "importsqlcode.php");
    $func->menuLINK("phpmyadmin", "PhpMyAdmin", "");
    $func->menuLINK("", "Çıkış Yap", "exit.php", "background:#1500ffaa");

    ?>
  </ul>