<?php include("header.php");
$func->rank("filmekle");
?>
<?php
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
  "filmid" => rand(00000, 99999)
);



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
    if ($img == "jpg" or $img == "jpeg" or $img == "png") {
      $imgName = "filminfoimg/filminfo_".$film["filmid"].".png";
      if (move_uploaded_file($film["filmresmi"]["tmp_name"], $imgName)) {
        $importFilm = $db->query("
          insert into filmler set
          film_img_url='".$imgName."',
          film_adi='".$film["filmadi"]."',
          film_konu='".$film["filmkategori"]."',
          film_aciklama='".$film["filmaciklamasi"]."',
          film_time='".$film["filmsuresi"]."',
          film_imdb_puan='".$film["filmimdbpuani"]."',
          film_info_puan='".$film["filminfopuani"]."',
          film_release_date='".$film["filmreleasedate"]."',
          film_date='".$film["filmdate"]."',
          film_id='".$film["filmid"]."'"
        );
        
        if($importFilm){
          echo "Film başarıyla Eklendi";
          exit;
        }else{
          echo "Film Eklenemedi :(";
          print_r($film);
        }
      } else {
        echo "Resim Yüklenemedi";
      }
    } else {
      echo "Resim seçmediniz veya dosya uzantısı uygun değil [ jpeg,jpg,png ]";
    }
  }
}

?>

<form method="post" enctype="multipart/form-data" class="formX" autocomplete="off">
  <ul>
    <li>Film Resmi</li>
    <li><input onchange="previewFile(this)" id="imgSelect" name="filmresmi" type="file" accept="image/*" /></li>
    <li><img id="imageOut" /></li>
    <li>Film Adı</li>
    <li><input name="filmadi" type="name" value="<?=$film["filmadi"] ?>" /></li>
    <li>Film Kategorisi</li>
    <li><select name="filmkategori" class="kategori">
      <option value="0" disabled selected>SEÇ</option>
      <option value="1">Fantastik</option>
      <option value="2">Korku/Gerilim</option>
      <option value="3">Cinsellik</option>
      <option value="4">Komedi</option>
      <option value="5">Diğer</option>
    </select></li>
    <li>Film Açıklaması</li>
    <li><textarea name="filmaciklamasi"><?=$film["filmaciklamasi"] ?></textarea></li>
    <li>Film Süresi</li>
    <li><input name="filmsuresi" type="time" value="<?=$film["filmsuresi"] ?>" /></li>
    <li>Film IMDB Puanı</li>
    <li><input name="filmimdbpuani" type="puan" value="<?=$film["filmimdbpuani"] ?>" /></li>
    <li>Film Info Puanı</li>
    <li><input name="filminfopuani" type="puan" value="<?=$film["filminfopuani"] ?>" /></li>
    <li>Film Çıkış Tarihi</li>
    <li><input name="filmreleasedate" type="date" value="<?=$film["filmreleasedate"] ?>" /></li>
  </ul>

  <button type="submit">Filmi Oluştur</button>
</form>
<?php include("footer.php"); ?>