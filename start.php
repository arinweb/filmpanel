<?php
include("conn.php");
$sql = file_get_contents("filminfo.sql");
if ($db->query("DROP TABLE `filmler`, `kullanici`, `mesaj`;") and $db->query($sql)) {
  echo "Kurulum Başarılı";
  echo "<br><br>";
  echo "<b>Bu dosyanın yedeğini aldıktan sonra silmeyi unutmayın aksi takdirde verileriniz çalınabilir</b>";
  echo "<br><br>";
  if ($_GET["sil"] == 16) {
    echo "Dosya Silindi";
    echo "<br><br>";
    sleep(1);
    unlink("start.php");
    unlink("filminfo.sql");
  }
} else {
  echo "Kurulum Başarısız";
  echo "<br><br>";
}
?>
<a href="start.php?sil=16">YEDEĞİNİ ALMADAN HEMEN SİL</a>