<?php include("header.php");
$func->rank("bilgilerim");
?>
<h3 class="baslik">Bilgilerim</h3>
<?php
$k = array(
  "name" => strip_tags(trim($_POST['name'])),
  "mail" => strip_tags(trim($_POST['mail'])),
  "password" => strip_tags(trim($_POST['password']))
);
if ($_POST) {
  if (empty($k["name"]) or empty($k["mail"]) or empty($k["password"])) {
    echo "Boş Bırakmayın!";
  } else {
    $kontrol = $db->prepare("select * from kullanici where mail=?");
    $kontrol->execute(array($k["mail"]));

    $user2 = $kontrol->fetch(PDO::FETCH_ASSOC);

    if (!$kontrol->rowCount()) {
      $users = $db->prepare("update kullanici set name=?,mail=?,password=? WHERE id=?");
      $users->execute(array($k["name"], $k["mail"], $k["password"], $_SESSION["user"]["id"]));
      $user = $users->fetch(PDO::FETCH_ASSOC);
      header("location:exit.php");
    } else {
      if ($_SESSION["user"]["mail"] == $user2["mail"]) {
        $users = $db->prepare("update kullanici set name=?,mail=?,password=? WHERE id=?");
        $users->execute(array($k["name"], $k["mail"], $k["password"], $_SESSION["user"]["id"]));
        header("location:exit.php");
      } else {
        echo "E-Posta kullanılmaktadır";
      }
    }
  }
}

?>
<form method="post">
  <input name="name" type="name" placeholder="Adı" value="<?= $_SESSION["user"]["name"] ?>" />
  <br>
  <input name="mail" type="mail" placeholder="E-Posta" value="<?= $_SESSION["user"]["mail"] ?>" />
  <br>
  <input name="password" type="password" placeholder="Şifre" />
  <br>
  <button type="submit">Hesabımı Güncelle</button>

</form>
<?php include("footer.php"); ?>