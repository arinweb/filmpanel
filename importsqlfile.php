<?php include("header.php"); 
$func->rank("sql");
?>


<h3 class="baslik">Sql Dosya Yükle</h3>

<?php
$file = $_FILES["sqlfile"]["name"];
$fileTmp = $_FILES["sqlfile"]["tmp_name"];
$fileName = rand(1111, 9999).".sql";
$fileX = array_reverse(explode(".", $file));
$fileX = $fileX[0];


if($_FILES) {
  echo "Dosya Seçildi<br>";
  
  if ($fileX == "sql") {
    echo "Dosya Uzantısı Doğru<br>";
    if (move_uploaded_file($fileTmp,$fileName)) {
      echo "Dosya Yükleme Başarılı<br>";
      $fileOn = file_get_contents($fileName);
      if ($db->query($fileOn)) {
        echo "Veritabanına Ekleme Tamamlandı<br>";
        unlink($fileName);
      } else {
        echo "Veritabanına Eklenemedi<br>";
      }
    } else {
      echo "Dosya Yükleme Başarısız<br>";
    }
  } else {
    echo "Dosya uzantısı sql olmalı!<br>";
  }
  
} else {
  echo "Dosya Seç";
}

?>

<form method="post" enctype="multipart/form-data">
  <input type="file" name="sqlfile" required/>
  <button type="submit">Sql Dosyasını Yükle</button>
</form>
<?php include("footer.php"); ?>