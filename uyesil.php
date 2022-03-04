<?php include("header.php"); ?>
<?php
$func->rank("uye");
$id = strip_tags(trim($_GET["id"]));
if ($_SESSION["user"]["id"] != $id) {
  if ($db->query("delete from kullanici where id=".$id)) {
    echo "Seçilen Üyeyi Silme İşlemi Başarılı";
  } else {
    echo "Seçilen Üyeyi Silme İşlemi Başarısız :(";
  }
} else {
  echo "Bu hesap sana ait silinecek eminmisin?";
  ?>
  <a href="uyelist.php">Hayır</a>
  <a href="uyesil.php?id=<?=$id ?>&x=true">Evet</a>
  <?php
  if (strip_tags(trim($_GET["x"]))) {
    if ($db->query("delete from kullanici where id=".$id)) {
      session_destroy();
      header("Refresh:2;url=index.php");
      echo "Hesabınız silindi";
    } else {
      echo "Hesabınız silinemedi";
    }
  }
}
?>
<?php include("footer.php"); ?>