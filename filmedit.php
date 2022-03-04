<?php include("header.php"); ?>
<?php
$func->rank("filmedit");
$film = array(
  "filmresmi" => $_FILES["filmresmi"],
  "filmadi" => strip_tags(trim($_POST["filmadi"])),
  "filmkategori" => strip_tags(trim($_POST["filmkategori"])),
  "filmaciklamasi" => strip_tags(trim($_POST["filmaciklamasi"])),
  "filmsuresi" => strip_tags(trim($_POST["filmsuresi"])),
  "filmimdbpuani" => strip_tags(trim($_POST["filmimdbpuani"])),
  "filminfopuani" => strip_tags(trim($_POST["filminfopuani"])),
  "filmreleasedate" => strip_tags(trim($_POST["filmreleasedate"])),
  "filmdate" => date('d-m-Y H:i:s'),
  "filmid" => strip_tags(trim($_GET["id"]))
);




$filmKontrol = $db->prepare("select * from filmler where film_id=?");
$filmKontrol->execute(array(strip_tags(trim($_GET['id']))));
$filmX = $filmKontrol->fetch(PDO::FETCH_ASSOC);
if ($filmKontrol->rowCount()) {
  if ($_POST) {
    switch ($film["filmkategori"]) {
      case '1':
        $film["filmkategori"] = "Fantastik";
        break;

      case '2':
        $film["filmkategori"] = "Korku/Gerilim";
        break;

      case '3':
        $film["filmkategori"] = "Cinsellik";
        break;

      case '4':
        $film["filmkategori"] = "Komedi";
        break;

      case '5':
        $film["filmkategori"] = "Diğer";
        break;

      default:
        $film["filmkategori"] = "";
        break;
    }
    if (
      empty($film["filmadi"]) or
      empty($film["filmkategori"]) or
      empty($film["filmaciklamasi"]) or
      empty($film["filmsuresi"]) or
      empty($film["filmimdbpuani"]) or
      empty($film["filminfopuani"]) or
      empty($film["filmreleasedate"])
    ) {
      echo "Tüm metin kontrol edin boş bırakmayın!";
    } else {
      $img = array_reverse(explode(".", $film["filmresmi"]["name"]));
      $img = $img[0];
      if (isset($_POST["imgIzin"])) {
        $imgName = "filminfoimg/filminfo_".$film["filmid"].".png";
        if ($img == "jpg" or $img == "jpeg" or $img == "png") {
          if(move_uploaded_file($film["filmresmi"]["tmp_name"], $imgName)){
          } else{
            echo "Resim Güncellenemedi :(";
          }
        } else {
          echo "Dosya uzantısı uygun değil [ jpeg,jpg,png ]";
        }
      }else{
        $imgName = $filmX["film_img_url"];
      }
      
      
      
      $importFilm = $db->query("
          update filmler set
          film_img_url='".$imgName."',
          film_adi='".$film["filmadi"]."',
          film_konu='".$film["filmkategori"]."',
          film_aciklama='".$film["filmaciklamasi"]."',
          film_time='".$film["filmsuresi"]."',
          film_imdb_puan='".$film["filmimdbpuani"]."',
          film_info_puan='".$film["filminfopuani"]."',
          film_release_date='".$film["filmreleasedate"]."',
          film_date='".$film["filmdate"]."'
          where film_id=".strip_tags(trim($_GET["id"]))
      );


      if ($importFilm) {
        echo "Film Başarıyla Güncellendi";
        exit;
      } else {
        echo "<br>Film Güncellenemedi :(";
      }
    }
  }
} else {
  header("location:filmlist.php");
}
if ($filmKontrol->rowCount()) {
  ?>
  <form method="post" enctype="multipart/form-data" class="formX" autocomplete="off">
    <ul>
      <li><input type="checkbox" name="imgIzin" id="imgIzin" class="imgIzin checkbox" value="1"/><label for="imgIzin">Resim Güncelle</label></li>
      <li class="imageX">Film Resmi</li>
      <li class="imageX"><input onchange="previewFile(this)" id="imgSelect" name="filmresmi" type="file" accept="image/*" /></li>
      <li class="imageX"><img src="<?=$filmX["film_img_url"] ?>" id="imageOut" /></li>
      <li>Film Adı</li>
      <li><input name="filmadi" type="name" value="<?=$filmX["film_adi"] ?>" /></li>
      <li>Film Kategorisi</li>
      <li>
        <select name="filmkategori" class="kategori">
          <option value="0" disabled <?= $func->formSelect($filmX["film_konu"], "SEÇ") ?>>SEÇ</option>
          <option value="1" <?= $func->formSelect($filmX["film_konu"], "Fanrastik") ?>>Fantastik</option>
          <option value="2" <?= $func->formSelect($filmX["film_konu"], "Korku/Gerilim") ?>>Korku/Gerilim</option>
          <option value="3" <?= $func->formSelect($filmX["film_konu"], "Cinsellik") ?>>Cinsellik</option>
          <option value="4" <?= $func->formSelect($filmX["film_konu"], "Komedi") ?>>Komedi</option>
          <option value="5" <?= $func->formSelect($filmX["film_konu"], "Diğer") ?>>Diğer</option>
        </select></li>
      <li>Film Açıklaması</li>
      <li><textarea name="filmaciklamasi"><?=$filmX["film_aciklama"] ?></textarea></li>
      <li>Film Süresi</li>
      <li><input name="filmsuresi" type="time" value="<?=$filmX["film_time"] ?>" /></li>
      <li>Film IMDB Puanı</li>
      <li><input name="filmimdbpuani" type="puan" value="<?=$filmX["film_imdb_puan"] ?>" /></li>
      <li>Film Info Puanı</li>
      <li><input name="filminfopuani" type="puan" value="<?=$filmX["film_info_puan"] ?>" /></li>
      <li>Film Çıkış Tarihi</li>
      <li><input name="filmreleasedate" type="date" value="<?=$filmX["film_release_date"] ?>" /></li>
    </ul>

    <button type="submit">Filmi Güncelle</button>
    <a href="filmsil.php?id=<?=$filmX["id"]?>">Filmi Sil</a>
  </form>


  <script>

    $(".imageX").slideUp(0);
    $(".imgIzin").click(function() {

      if ($(this).prop("checked")) {
        $(".imageX").slideDown();
      } else {
        $(".imageX").slideUp();
      }

    });


  </script>
  <?php
} include("footer.php"); ?>