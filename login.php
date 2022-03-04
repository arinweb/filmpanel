<?php
include("conn.php");
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
  <link rel="icon" type="image/png" sizes="16x16" href="FAVİCON">
  <link rel="stylesheet" href="style.css" type="text/css" media="all" />
  <script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  <script type="text/javascript" src="main.js"></script>
  <title>Film İnfo Giriş Paneli</title>
  <style>
@import url("https://fonts.googleapis.com/css?family=Quicksand");
    * {
      font-family: Quicksand;
    }
    h1 {
      color: #1249d6;
    }
    input {
      padding: 5px;
      margin: 10px;
      width: 60%;
      border: 2px solid #1249d6;
      outline: none;
      font-size: 18px;
      border-radius: 5px;
    }
    button {
      margin: 10px;
      font-size: 18px;
      border-radius: 5px;
      background: #1249ff;
      color: white;
      padding: 10px;
      border: none;
      outline: none;
    }
  </style>
</head>
<body>
  <h1>Film İnfo Giriş Paneli</h1>
  <?php

  if ($_SESSION["user"]["status"]) {
    header("location:index.php");
    exit;
  }

  $k = array(
    "mail" => strip_tags(trim($_POST['mail'])),
    "password" => strip_tags(trim($_POST['password']))
  );




  if ($_POST) {
    if (empty($k["mail"]) or empty($k["password"])) {
      echo "Boş Bırakmayın!";
    } else {
      $users = $db->prepare("SELECT * FROM kullanici WHERE mail=? and BINARY password=?");
      $users->execute(array($k["mail"], $k["password"]));
      $user = $users->fetch(PDO::FETCH_ASSOC);
      if ($users->rowCount()) {
        $songiris = $db->prepare("update kullanici set songiris=? where id=?");
        $songiris->execute(array(date('d-m-Y H:i:s', time()), $user["id"]));
        if ($songiris->rowCount()) {
          $_SESSION["user"] = array(
            "kurucu" => $user["kurucu"],
            "name" => $user["name"],
            "mail" => $user["mail"],
            "songiris" => $user["songiris"],
            "id" => $user["id"],
            "bankontrol" => $user["bankontrol"],
            "bilgilerimkontrol" => $user["bilgilerimkontrol"],
            "uyekontrol" => $user["uyekontrol"],
            "chatkontrol" => $user["chatkontrol"],
            "sqlkontrol" => $user["sqlkontrol"],
            "phpmyadminkontrol" => $user["phpmyadminkontrol"],
            "filmeklekontrol" => $user["filmeklekontrol"],
            "filmeditkontrol" => $user["filmeditkontrol"],
            "filmlistkontrol" => $user["filmlistkontrol"],
            "status" => true
          );
          header("location:index.php");
        } else {
          echo "Hata";
        }
      } else {
        echo "Mail veya Şifreniz yanlış!";
      }
    }
  }

  ?>
  <form method="post">
    <input name="mail" type="mail" placeholder="E-Posta" value="<?= $k["mail"] ?>" />
    <br>
    <input name="password" type="password" placeholder="Şifre" />
    <br>
    <button type="submit">Giriş Yap</button>
  </form>

</body>
</html>