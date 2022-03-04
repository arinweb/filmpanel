<?php include("header.php"); ?>
<?php
$func->rank("filmekle");
$id = strip_tags(trim($_GET["id"]));
if ($id) {
  if ($db->query("delete from filmler where id=".$id)) {
    echo "Seçilen film silindi";
  } else {
    echo "Seçilen film silinemedi :(";
  }
}
 include("footer.php"); ?>